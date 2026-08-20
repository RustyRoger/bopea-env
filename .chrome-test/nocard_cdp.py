#!/usr/bin/env python
"""Verify widget2 featured is non-card, category only in text."""
import json, time, urllib.request, websocket

CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=nocard1"

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
  function r(sel){ var e=document.querySelector(sel); if(!e) return null; var b=e.getBoundingClientRect(); var cs=getComputedStyle(e); return {top:Math.round(b.top),bottom:Math.round(b.bottom),l:Math.round(b.left),r:Math.round(b.right),bg:cs.backgroundColor,border:cs.borderTopWidth,shadow:cs.boxShadow,radius:cs.borderRadius}; }
  var col = r('.bpc2 .jl_en_lfr');
  var card = r('.bpc2 .jl_en_lfr .jl_cgrid_layout');
  var cardtext = document.querySelector('.bpc2 .jl_en_lfr .jl_cgrid_layout .jl_fe_text');
  var cardtextCS = cardtext ? getComputedStyle(cardtext) : null;
  var container = r('.bpc2 .bpc2-container');
  var out = {
    container: container,
    card: card,
    card_bg: card ? card.bg : null,
    card_border: card ? card.border : null,
    card_shadow: card ? card.shadow : null,
    feat_text_border: cardtextCS ? cardtextCS.borderTopWidth : null,
    tumb_cat_present: !!document.querySelector('.bpc2 .jl_lb4'),
    text_cat_present: !!document.querySelector('.bpc2 .jl_en_lfr .jl_fe_text .jl_f_cat'),
    list_count: document.querySelectorAll('.bpc2 .jl_fli_wrap .jl_mmlistc').length,
  };
  if (col && card) {
    out.card_top_gap = card.top - col.top;
    out.card_bottom_gap = col.bottom - card.bottom;
  }
  return out;
})()
"""
print(json.dumps(ev(js), indent=1))
ws.close()
