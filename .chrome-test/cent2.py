import json, time, urllib.request, websocket
CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=cent2"
def send(ws, mid, method, params=None):
    ws.send(json.dumps({"id": mid, "method": method, "params": params or {}}))
    while True:
        msg = json.loads(ws.recv())
        if msg.get("id") == mid: return msg.get("result", {})
with urllib.request.urlopen(urllib.request.Request(CDP + "/json/new?" + urllib.request.quote(URL, safe=""), method="PUT")) as r:
    tab = json.loads(r.read())
ws = websocket.create_connection(tab["webSocketDebuggerUrl"], timeout=30)
mid=[0]
def cmd(m,p=None):
    mid[0]+=1
    return send(ws,mid[0],m,p)
cmd("Runtime.enable")
time.sleep(3)
def ev(js):
    return cmd("Runtime.evaluate",{"expression":js,"returnByValue":True})["result"].get("value")
js="""
(function(){
  function rr(sel){ var e=document.querySelector(sel); if(!e) return null; var b=e.getBoundingClientRect(); return {l:Math.round(b.left),r:Math.round(b.right),w:Math.round(b.width)}; }
  var col=rr('.bpc2 .jl_en_lfr');
  var cat=rr('.bpc2 .jl_en_lfr .jl_fe_text .jl_f_cat');
  var meta=rr('.bpc2 .jl_en_lfr .jl_post_meta');
  var tumb=rr('.bpc2 .jl_lb4');
  var out={col:col,cat:cat,meta:meta,tumb:tumb};
  if(col&&cat) out.cat_centered = Math.abs((cat.l-col.l) - (col.r-cat.r)) <= 2;
  if(col&&meta) out.meta_centered = Math.abs((meta.l-col.l) - (col.r-meta.r)) <= 2;
  return out;
})()
"""
print(json.dumps(ev(js),indent=1))
ws.close()
