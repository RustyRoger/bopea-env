#!/usr/bin/env python
"""Verify featured card is centered V+H in left column (widget2 test page)."""
import json, time, urllib.request, websocket

CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=cent1"

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
  function r(sel){ var e=document.querySelector(sel); if(!e) return null; var b=e.getBoundingClientRect(); var cs=getComputedStyle(e); return {top:Math.round(b.top),bottom:Math.round(b.bottom),left:Math.round(b.left),right:Math.round(b.right),h:Math.round(b.height),w:Math.round(b.width),ta:cs.textAlign}; }
  var col = r('.bpc2 .jl_en_lfr');
  var card = r('.bpc2 .jl_en_lfr .jl_cgrid_layout');
  var img = r('.bpc2 .jl_en_lfr .jl_imgw');
  var text = r('.bpc2 .jl_en_lfr .jl_fe_text');
  var out = { column: col, card: card, img: img, text: text };
  if (col && card) {
    // vertical centering: gap top vs bottom of card within column
    out.card_top_gap = card.top - col.top;
    out.card_bottom_gap = col.bottom - card.bottom;
    // horizontal: card centered in column
    out.card_left_gap = card.left - col.left;
    out.card_right_gap = col.right - card.right;
  }
  out.text_align = text ? text.ta : null;
  return out;
})()
"""
print(json.dumps(ev(js), indent=1))
ws.close()
