import json, time, urllib.request, websocket
CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=pag4"
def send(ws, mid, method, params=None):
    ws.send(json.dumps({"id": mid, "method": method, "params": params or {}}))
    while True:
        msg = json.loads(ws.recv())
        if msg.get("id") == mid: return msg.get("result", {})
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
ev("document.querySelector('.bpc2 .bpc-foot-nav[data-type=next]').click()")
time.sleep(3)
print("jq_page:", ev("jQuery('.bpc2').data('page_current')"))
print("feat:", ev("jQuery('.bpc2 .jl_en_lfr .jl_fe_title a').text()"))
ws.close()
