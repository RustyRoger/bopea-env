import json, time, urllib.request, websocket
CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=pag3"
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
    if "result" not in r:
        return {"ERR": r.get("exceptionDetails", {}).get("text", "no result")}
    return r["result"].get("value")
print("before:", ev("jQuery('.bpc2').data('page_current')"))
r = ev("""(function(){ jQuery('.bpc2 .bpc-foot-nav[data-type=next]').trigger('click'); return 'clicked'; })()""")
print("click:", r)
time.sleep(3)
print("after:", ev("jQuery('.bpc2').data('page_current')"))
print("next_dis:", ev("jQuery('.bpc2 .bpc-foot-nav[data-type=next]').hasClass('jl_disable')"))
print("prev_dis:", ev("jQuery('.bpc2 .bpc-foot-nav[data-type=prev]').hasClass('jl_disable')"))
print("feat:", ev("jQuery('.bpc2 .jl_en_lfr .jl_fe_title a').text()"))
ws.close()
