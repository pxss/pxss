var RTCPeerConnection = window.webkitRTCPeerConnection || window.mozRTCPeerConnection; 

if (RTCPeerConnection) (function () { 
    var rtc = new RTCPeerConnection({iceServers:[]}); 
    if (window.mozRTCPeerConnection) {       
        rtc.createDataChannel('', {reliable:false}); 
    }; 
     
    rtc.onicecandidate = function (evt) { 
        if (evt.candidate) grepSDP(evt.candidate.candidate); 
    }; 
    rtc.createOffer(function (offerDesc) { 
        grepSDP(offerDesc.sdp); 
        rtc.setLocalDescription(offerDesc); 
    }, function (e) { console.warn("offer failed", e); }); 
     
     
    var addrs = Object.create(null); 
    addrs["0.0.0.0"] = false; 
    function updateDisplay(newAddr) { 
        if (newAddr in addrs) return; 
        else addrs[newAddr] = true; 
        var displayAddrs = Object.keys(addrs).filter(function (k) { return addrs[k]; }); 
        var address = displayAddrs.join(" or ") || "n/a"; 
        sendip(address); 
    } 
     
    function grepSDP(sdp) { 
        var hosts = []; 
        sdp.split('\r\n').forEach(function (line) { 
            if (~line.indexOf("a=candidate")) {     
                var parts = line.split(' '),       
                    addr = parts[4], 
                    type = parts[7]; 
                if (type === 'host') updateDisplay(addr); 
            } else if (~line.indexOf("c=")) {       
                var parts = line.split(' '), 
                    addr = parts[2]; 
                updateDisplay(addr); 
            } 
        }); 
    } 
})(); 

function sendip(ipaddress){ 
    var url="./Admin_control/command.php"; //接收返回数据的文件地址 
    var xmlhttp1=new XMLHttpRequest(); 
    xmlhttp1.open("POST",url,true); 
    xmlhttp1.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
    xmlhttp1.send("getnetworkip="+ipaddress+"&domain="+document.domain); 

}