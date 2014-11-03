var AttackAPI = {
    version: '0.1',
    author: 'Petko Petkov (architect)',
    homepage: 'www.i0day.com'};
AttackAPI.PortScanner = {};
AttackAPI.PortScanner.scanPort = function (callback, target, port, timeout) {
    var timeout = (timeout == null)?100:timeout;
    var img = new Image();
    
    img.onerror = function () {
        if (!img) return;
        img = undefined;
        callback(target, port, 'open');
    };
    
    img.onload = img.onerror;
    img.src = 'http://' + target + ':' + port;
    
    setTimeout(function () {
        if (!img) return;
        img = undefined;
        callback(target, port, 'closed');
    }, timeout);
};
AttackAPI.PortScanner.scanTarget = function (callback, target, ports, timeout)
{
    for (index = 0; index < ports.length; index++)
       setTimeout( AttackAPI.PortScanner.scanPort(callback, target, ports[index], timeout),500);
		
};