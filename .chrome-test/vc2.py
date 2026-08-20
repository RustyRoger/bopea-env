import json, time, urllib.request, websocket
CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=vc2"
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
for i in range(20):
    r = cmd("Runtime.evaluate", {"expression":"document.readyState + '|' + (!!document.querySelector('.bpc2'))", "returnByValue":True})
    s = r["result"].get("value","")
    if ".bpc2" in s and "complete" in s: break
    time.sleep(1)
def ev(js):
    return cmd("Runtime.evaluate",{"expression":js,"returnByValue":True})["result"].get("value")
js="""
(function(){
  function r(sel){ var e=document.querySelector(sel); if(!e) return null; var b=e.getBoundingClientRect(); var cs=getComputedStyle(e); return {top:Math.round(b.top),bottom:Math.round(b.bottom),h:Math.round(b.height),display:cs.display,jc:cs.justifyContent,ai:cs.alignItems,fd:cs.flexDirection}; }
  var fr15=r('.bpc2 .jl_fr15_inner');
  var en=r('.bpc2 .jl_en_lfr');
  var card=r('.bpc2 .jl_en_lfr .jl_cgrid_layout');
  var fli=r('.bpc2 .jl_fli_con');
  var out={fr15:fr15,en_lfr:en,card:card,fli_con:fli};
  if(fr15) out.fr15_ai=getComputedStyle(document.querySelector('.bpc2 .jl_fr15_inner')).alignItems;
  if(en&&card){ out.card_top_gap=card.top-en.top; out.card_bottom_gap=en.bottom-card.bottom; }
  return out;
})()
"""
print(json.dumps(ev(js),indent=1))
ws.close()
