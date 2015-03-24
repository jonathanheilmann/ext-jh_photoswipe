/**
 * Script to read an URL and detect if an gallery should be opend
 * Used links:
 *  - http://www.user-xy.de/unterschied-zwischen-document-ready-und-window-load/
 *
 * Copyright (c) 2014 Jonathan Heilmann;
 *
 * CHANGELOG
 * 0.0.1:	-initial release
 */
var photoswipeParseHash = function() {
	var hash = window.location.hash.substring(1),
    params = {};

    if(hash.length < 5) { // pid=1
        return params;
    }

    var vars = hash.split('&');
    for (var i = 0; i < vars.length; i++) {
        if(!vars[i]) {
            continue;
        }
        var pair = vars[i].split('=');
        if(pair.length < 2) {
            continue;
        }
        params[pair[0]] = pair[1];
    }

    if(params.gid) {
    	params.gid = parseInt(params.gid, 10);
    }

    if(!params.hasOwnProperty('pid')) {
        return params;
    }
    params.pid = parseInt(params.pid, 10);
    return params;
};

// Parse URL and open gallery if it contains #&pid=x&gid=y
var hashData = photoswipeParseHash();
document.onreadystatechange = function () {
	if (document.readyState == "interactive") {
		if(hashData.pid > 0 && hashData.gid > 0) {
			try {
				window["openPhotoSwipe"+hashData.gid]();
			} catch (e) {
				console.error('Function ' + 'openPhotoSwipe' + hashData.gid + '() not available!');
			}
		}
	}
};