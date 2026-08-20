#!/usr/bin/env python
"""Screenshot of widget2 featured on Home, plus bounding boxes."""
import json, time, urllib.request, websocket

CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?nocache=homevc2"

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
cmd("Page.enable")
cmd("Runtime.enable")
for i in range(30):
    r = cmd("Runtime.evaluate", {"expression": "document.querySelectorAll('.bpc2').length", "returnByValue": True})
    if r["result"].get("value") and int(r["result"]["value"]) > 0:
        break
    time.sleep(1)

def ev(js):
    return cmd("Runtime.evaluate", {"expression": js, "returnByValue": True})["result"].get("value")

# scroll widget into view
ev("(function(){ var b=document.querySelector('.bpc2'); if(b) b.scrollIntoView({block:'center'}); return true; })()")
time.sleep(1.5)

# capture screenshot of the bpc2 element
shot = cmd("Page.captureScreenshot")
import base64
data = base64.b64decode(shot["data"])
with open(".chrome-test/home_w2.png", "wb") as f:
    f.write(data)
print("screenshot saved .chrome-test/home_w2.png, bytes", len(data))

# also capture clip of the block
r = ev("(function(){ var b=document.querySelector('.bpc2'); var r=b.getBoundingClientRect(); var s=window.innerHeight; return {x:r.left,y:r.top-80+ (window.scrollY>0? 0:(s/2-r.height/2)),w:r.width,h:r.height+160}; })()")
print("block rect:", json.dumps(r))
ws.close()