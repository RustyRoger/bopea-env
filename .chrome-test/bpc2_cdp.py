#!/usr/bin/env python
"""CDP check for widget 2 (bopea-comunicati-uscz) layout."""
import json, sys, time, urllib.request, websocket

CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=cdp1"

def ws_open(url):
    w = websocket.create_connection(url, timeout=30)
    return w

def send(ws, mid, method, params=None):
    ws.send(json.dumps({"id": mid, "method": method, "params": params or {}}))
    while True:
        msg = json.loads(ws.recv())
        if msg.get("id") == mid:
            return msg.get("result", {})

def get_ws_url(tab_url):
    with urllib.request.urlopen(CDP + "/json") as r:
        tabs = json.loads(r.read())
    for t in tabs:
        if t.get("url") == tab_url or t.get("type") == "page":
            return t["webSocketDebuggerUrl"]
    raise Exception("no tab")

# create tab
with urllib.request.urlopen(urllib.request.Request(CDP + "/json/new?" + urllib.request.quote(URL, safe=""), method="PUT")) as r:
    tab = json.loads(r.read())
ws = ws_open(tab["webSocketDebuggerUrl"])
mid = 0

def cmd(method, params=None):
    global mid
    mid += 1
    return send(ws, mid, method, params)

cmd("Page.enable")
cmd("Runtime.enable")

# poll until widget rendered + styles applied
js_ready = """
(function(){
  var b = document.querySelector('.bpc2');
  if (!b) return {ok:false, why:'no .bpc2'};
  var c = document.querySelector('.bpc2 .bpc2-container');
  if (!c) return {ok:false, why:'no container'};
  var cs = getComputedStyle(c);
  if (cs.borderRadius === '0px') return {ok:false, why:'radius not applied'};
  return {ok:true};
})()
"""
for _ in range(30):
    r = cmd("Runtime.evaluate", {"expression": js_ready, "returnByValue": True})
    val = r["result"].get("value")
    if val and val.get("ok"):
        break
    time.sleep(1)
else:
    print("TIMEOUT waiting render")
    sys.exit(1)

js_measure = r"""
(function(){
  function r(sel){ var e=document.querySelector(sel); if(!e) return null; var b=e.getBoundingClientRect(); var cs=getComputedStyle(e); return {top:b.top,left:b.left,width:b.width,height:b.height,radius:cs.borderRadius,bg:cs.backgroundColor,display:cs.display}; }
  var block = document.querySelector('.bpc2');
  var out = {
    container: r('.bpc2 .bpc2-container'),
    fr15_inner: r('.bpc2 .jl_fr15_inner'),
    featured: r('.bpc2 .jl_en_lfr'),
    fli_con: r('.bpc2 .jl_fli_con'),
    fli_wrap: r('.bpc2 .jl_fli_wrap'),
    first_list_item: r('.bpc2 .jl_fli_wrap .jl_mmlistc'),
    feat_img: r('.bpc2 .jl_en_lfr .jl_imgw'),
    feat_text: r('.bpc2 .jl_en_lfr .jl_fe_text'),
    feat_title: r('.bpc2 .jl_en_lfr .jl_fe_title'),
    list_title: r('.bpc2 .jl_fli_wrap .jl_fe_title'),
    li_in: r('.bpc2 .jl_en_lfr .jl_li_in') || r('.bpc2 .jl_mmlistc .jl_li_in'),
    featured_count: document.querySelectorAll('.bpc2 .jl_en_lfr').length,
    list_count: document.querySelectorAll('.bpc2 .jl_fli_wrap .jl_mmlistc').length,
    nav_count: document.querySelectorAll('.bpc2 .bpc-foot-nav').length,
    tumb_cat: !!document.querySelector('.bpc2 .jl_lb4'),
    video: !!document.querySelector('.bpc2 .jl_fm_vid_load'),
  };
  // columns: are featured and fli_con side by side?
  if (out.featured && out.fli_con) {
    out.side_by_side = out.featured.top === out.fli_con.top && Math.abs(out.featured.left - out.fli_con.left) > 50;
  }
  return out;
})()
"""
res = cmd("Runtime.evaluate", {"expression": js_measure, "returnByValue": True})
print("=== DESKTOP (default) ===")
print(json.dumps(res["result"].get("value"), indent=1))

# mobile: set device metrics 390x844
cmd("Emulation.setDeviceMetricsOverride", {"width": 390, "height": 844, "deviceScaleFactor": 2, "mobile": True})
time.sleep(1.5)
res = cmd("Runtime.evaluate", {"expression": js_measure, "returnByValue": True})
print("=== MOBILE (390x844) ===")
print(json.dumps(res["result"].get("value"), indent=1))

ws.close()
