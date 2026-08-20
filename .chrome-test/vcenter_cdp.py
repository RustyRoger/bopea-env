#!/usr/bin/env python
"""Check vertical centering of featured in left column."""
import json, time, urllib.request, websocket

CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=vcenter1"

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
time.sleep(3)
def ev(js):
    r = cmd("Runtime.evaluate", {"expression": js, "returnByValue": True})
    return r["result"].get("value")

js = r"""
(function(){
  function r(sel){ var e=document.querySelector(sel); if(!e) return null; var b=e.getBoundingClientRect(); var cs=getComputedStyle(e); return {top:Math.round(b.top),bottom:Math.round(b.bottom),h:Math.round(b.height),display:cs.display,justifyContent:cs.justifyContent,alignItems:cs.alignItems,flexDirection:cs.flexDirection}; }
  var fr15 = r('.bpc2 .jl_fr15_inner');
  var enlfr = r('.bpc2 .jl_en_lfr');
  var card = r('.bpc2 .jl_en_lfr .jl_cgrid_layout');
  var fli_con = r('.bpc2 .jl_fli_con');
  var out = { fr15: fr15, en_lfr: enlfr, card: card, fli_con: fli_con };
  if (fr15) out.fr15_align_items = getComputedStyle(document.querySelector('.bpc2 .jl_fr15_inner')).alignItems;
  if (enlfr && card) {
    out.card_top_gap = card.top - enlfr.top;
    out.card_bottom_gap = enlfr.bottom - card.bottom;
  }
  return out;
})()
"""
print(json.dumps(ev(js), indent=1))
ws.close()
