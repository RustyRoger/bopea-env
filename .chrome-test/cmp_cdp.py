#!/usr/bin/env python
"""Compare container padding/radius of widget1 (home) vs widget2 (test page)."""
import json, time, urllib.request, websocket

CDP = "http://127.0.0.1:9222"

def ws_open(url):
    return websocket.create_connection(url, timeout=30)

def send(ws, mid, method, params=None):
    ws.send(json.dumps({"id": mid, "method": method, "params": params or {}}))
    while True:
        msg = json.loads(ws.recv())
        if msg.get("id") == mid:
            return msg.get("result", {})

def new_tab(url):
    req = urllib.request.Request(CDP + "/json/new?" + urllib.request.quote(url, safe=""), method="PUT")
    with urllib.request.urlopen(req) as r:
        return json.loads(r.read())

def measure(url):
    tab = new_tab(url)
    ws = ws_open(tab["webSocketDebuggerUrl"])
    mid = [0]
    def cmd(method, params=None):
        mid[0] += 1
        return send(ws, mid[0], method, params)
    cmd("Runtime.enable")
    time.sleep(3)
    js = """
    (function(){
      function g(sel){ var e=document.querySelector(sel); if(!e) return null; var cs=getComputedStyle(e); var b=e.getBoundingClientRect(); return {w:b.width, pad:cs.padding, rad:cs.borderRadius}; }
      var out = {};
      var w1 = document.querySelector('.bpc-press-conf .bpc-container');
      var w2 = document.querySelector('.bpc2 .bpc2-container');
      if (w1) out.widget1_container = g('.bpc-press-conf .bpc-container');
      if (w2) out.widget2_container = g('.bpc2 .bpc2-container');
      return out;
    })()
    """
    res = cmd("Runtime.evaluate", {"expression": js, "returnByValue": True})
    ws.close()
    return res["result"].get("value")

try:
    print("HOME:", json.dumps(measure("http://localhost:8888/?nocache=w1cmp"), indent=1))
except Exception as e:
    print("HOME error:", e)
try:
    print("TEST:", json.dumps(measure("http://localhost:8888/?p=46351&nocache=w2cmp"), indent=1))
except Exception as e:
    print("TEST error:", e)
