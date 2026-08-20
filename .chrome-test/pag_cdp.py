#!/usr/bin/env python
"""Click next-nav on widget2 test page, verify content swap via AJAX."""
import json, time, urllib.request, websocket

CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=pag1"

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
def cmd(method, params=None):
    mid[0] += 1
    return send(ws, mid[0], method, params)

cmd("Runtime.enable")
time.sleep(3)

def ev(js):
    res = cmd("Runtime.evaluate", {"expression": js, "returnByValue": True, "awaitPromise": True})
    return res["result"].get("value")

print("page_before:", ev("document.querySelector('.bpc2').dataset.page_current"))
print("next_btn:", ev("!!document.querySelector('.bpc2 .bpc-foot-nav[data-type=next]')"))
ev("document.querySelector('.bpc2 .bpc-foot-nav[data-type=next]').click()")
time.sleep(3)
print("page_after:", ev("document.querySelector('.bpc2').dataset.page_current"))
print("first_title_after:", ev("document.querySelector('.bpc2 .jl_fli_wrap .jl_fe_title a') ? document.querySelector('.bpc2 .jl_fli_wrap .jl_fe_title a').textContent : null"))
print("featured_count_after:", ev("document.querySelectorAll('.bpc2 .jl_en_lfr').length"))
print("list_count_after:", ev("document.querySelectorAll('.bpc2 .jl_fli_wrap .jl_mmlistc').length"))
ws.close()
