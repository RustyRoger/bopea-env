import json, time, urllib.request, websocket
CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=cent3"
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
cmd("Emulation.setDeviceMetricsOverride", {"width":390,"height":844,"deviceScaleFactor":2,"mobile":True})
time.sleep(3)
def ev(js):
    return cmd("Runtime.evaluate",{"expression":js,"returnByValue":True})["result"].get("value")
js="""
(function(){
  function rr(sel){ var e=document.querySelector(sel); if(!e) return null; var b=e.getBoundingClientRect(); return {t:Math.round(b.top),b:Math.round(b.bottom),l:Math.round(b.left),r:Math.round(b.right),w:Math.round(b.width)}; }
  var col=rr('.bpc2 .jl_en_lfr');
  var fli=rr('.bpc2 .jl_fli_con');
  var text=rr('.bpc2 .jl_en_lfr .jl_fe_text');
  return {col:col,fli:fli,text:text,stacked: col&&fli && fli.t >= col.b, text_centered: text && text.w>0};
})()
"""
print(json.dumps(ev(js),indent=1))
ws.close()
