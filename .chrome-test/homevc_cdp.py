#!/usr/bin/env python
"""Measure widget2 featured centering on the Home page."""
import json, time, urllib.request, websocket

CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?nocache=homevc1"

def send(ws, mid, method, params=None):
    ws.send(json.dumps({"id": mid, "method": method, "params": params or {}}))
    while True:
        msg = json.loads(ws.recv())
        if msg.get("id") == mid:
            return msg.get("result", {})

with urllib.request.urlopen(urllib.request.Request(CDP + "/json/new?" + urllib.request.quote(URL, safe=""), method="PUT")) as r:
    tab = json.loads(r.read())
ws = websocket.create_connection(tab["webSocketDebuggerUrl"], timeout=30)
mid = [0]
def cmd(m, p=None):
    mid[0] += 1
    return send(ws, mid[0], m, p)
cmd("Runtime.enable")
# wait for widget2 on home
for i in range(30):
    r = cmd("Runtime.evaluate", {"expression": "document.readyState + '|' + document.querySelectorAll('.bpc2').length", "returnByValue": True})
    s = r["result"].get("value", "")
    if "complete" in s and not s.endswith("|0"):
        break
    time.sleep(1)

def ev(js):
    r = cmd("Runtime.evaluate", {"expression": js, "returnByValue": True})
    return r["result"].get("value")

js = r"""
(function(){
  var b = document.querySelector('.bpc2');
  if (!b) return {err:'no .bpc2'};
  function r(sel){ var e=b.querySelector(sel); if(!e) return null; var r=e.getBoundingClientRect(); var cs=getComputedStyle(e); return {top:Math.round(r.top),bottom:Math.round(r.bottom),l:Math.round(r.left),r:Math.round(r.right),h:Math.round(r.height),w:Math.round(r.width),display:cs.display,jc:cs.justifyContent,fd:cs.flexDirection,pad:cs.padding}; }
  var out = {
    container: r('.bpc2-container'),
    fr15_inner: r('.jl_fr15_inner'),
    en_lfr: r('.jl_en_lfr'),
    card: r('.jl_en_lfr .jl_cgrid_layout'),
    fli_con: r('.jl_fli_con'),
    fli_wrap: r('.jl_fli_wrap'),
  };
  if (out.fr15_inner) out.fr15_ai = getComputedStyle(b.querySelector('.jl_fr15_inner')).alignItems;
  var en = b.querySelector('.jl_en_lfr'), card = b.querySelector('.jl_en_lfr .jl_cgrid_layout');
  if (en && card) {
    var er = en.getBoundingClientRect(), cr = card.getBoundingClientRect();
    out.card_top_gap = Math.round(cr.top - er.top);
    out.card_bottom_gap = Math.round(er.bottom - cr.bottom);
  }
  out.list_count = b.querySelectorAll('.jl_fli_wrap .jl_mmlistc').length;
  return out;
})()
"""
print("=== HOME widget2 ===")
print(json.dumps(ev(js), indent=1))
ws.close()
