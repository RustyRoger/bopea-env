import json, time, urllib.request, websocket
CDP = "http://127.0.0.1:9222"
URL = "http://localhost:8888/?p=46351&nocache=pag2b"
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
    return cmd("Runtime.evaluate", {"expression": js, "returnByValue": True})["result"].get("value")
print("jq_page_before:", ev("jQuery('.bpc2').data('page_current')"))
print("jq_max_before:", ev("jQuery('.bpc2').data('page_max')"))
ev("jQuery('.bpc2 .bpc-foot-nav[data-type=next]').click()")
time.sleep(3)
print("jq_page_after:", ev("jQuery('.bpc2').data('page_current')"))
print("jq_max_after:", ev("jQuery('.bpc2').data('page_max')"))
print("next_disabled:", ev("jQuery('.bpc2 .bpc-foot-nav[data-type=next]').hasClass('jl_disable')"))
print("prev_disabled:", ev("jQuery('.bpc2 .bpc-foot-nav[data-type=prev]').hasClass('jl_disable')"))
print("first_feat_title:", ev("jQuery('.bpc2 .jl_en_lfr .jl_fe_title a').text()"))
print("content_html_len:", ev("jQuery('.bpc2 .bpc-content').html().length"))
ws.close()
