var dzsap_list = []
var dzsap_globalidind = 20;
(function ($) {
    $.fn.audioplayer = function (o) {
        var defaults = {
            design_skin: "skin-default",
            autoplay: "off",
            swf_location: "ap.swf",
            design_thumbh: "200",
            design_thumbw: "200",
            disable_volume: "off",
            disable_scrub: "off",
            type: "audio"
        };
        o = $.extend(defaults, o);
        this.each(function () {
            var cthis = $(this);
            var cchildren = cthis.children(),
                cthisId = "ap1";
            var currNr = -1;
            var busy = true;
            var i = 0;
            var ww, wh, tw, th, cw, ch, sw = 0,
                sh, spos = 0;
            var _audioplayerInner, _apControls, _conControls, _conPlayPause, _controlsVolume, _scrubbar,
                _theMedia, _cmedia, _theThumbCon, _metaArtistCon;
            var busy = false,
                playing = false,
                muted = false,
                loaded = false;
            var time_total = 0,
                time_curr = 0;
            var last_vol = 1,
                last_vol_before_mute = 1;
            var inter_check, inter_checkReady;
            var skin_minimal_canvasplay, skin_minimal_canvaspause;
            var is_flashplayer = false;
            var data_source;
            if (String(o.design_thumbh).indexOf("%") == -1) o.design_thumbh = parseInt(o.design_thumbh, 10);
            if (String(o.design_thumbw).indexOf("%") == -1) o.design_thumbw = parseInt(o.design_thumbw, 10);
            init();

            function init() {
                if (cthis.attr("class").indexOf("skin-") == -1) cthis.addClass(o.design_skin);
                if (cthis.hasClass("skin-wave")) o.design_skin = "skin-wave";
              
               
                if (cthis.hasClass("audioplayer")) return;
                if (cthis.attr("id") != undefined) cthisId = cthis.attr("id");
                else cthisId = "ap" + dzsap_globalidind++;
                cthis.removeClass("audioplayer-tobe");
                cthis.addClass("audioplayer");
                if (is_ios()) {
                    o.disable_volume = "on";
                    o.autoplay = "off"
                }
               
                data_source = cthis.attr("data-source");
                setup_structure();
               
               
                setup_media();
                
                if (o.type == "audio")
                    if (is_ios() || is_ie8() || is_flashplayer == true) setTimeout(init_loaded, 1E3);
                    else inter_checkReady = setInterval(check_ready, 50)
            }

            function formatTime(arg) {
                var s = Math.round(arg);
                var m = 0;
                if (s > 0) {
                    while (s > 59) {
                        m++;
                        s -= 60
                    }
                    return String((m < 10 ? "0" : "") + m + ":" + (s < 10 ? "0" : "") + s)
                } else return "00:00"
            }

     

            function check_yt_ready_phase_two(arg) {
                init_loaded()
            }

          

            function check_ready() {
                if (o.type == "youtube");
                else if (_cmedia.nodeName != "AUDIO") init_loaded();
                else if (_cmedia.readyState >= 2) init_loaded()
            }

            function setup_structure() {
                cthis.append('<div class="audioplayer-inner"></div>');
                _audioplayerInner = cthis.children(".audioplayer-inner");
                _audioplayerInner.append('<div class="the-media"></div>');
                _audioplayerInner.append('<div class="ap-controls"></div>');
                _theMedia = _audioplayerInner.children(".the-media").eq(0);
                _apControls = _audioplayerInner.children(".ap-controls").eq(0);
                _apControls.append('<div class="scrubbar"><div class="scrub-bg"></div><div class="scrub-buffer"></div><div class="scrub-prog"></div><div class="scrubBox"></div><div class="scrubBox-prog"></div><div class="scrubBox-hover"></div></div><div class="con-controls"><div class="the-bg"></div><div class="con-playpause"><div class="playbtn"><div class="play-icon"></div><div class="play-icon-hover"></div></div><div class="pausebtn" style="display:none"><div class="pause-icon"><div class="pause-part-1"></div><div class="pause-part-2"></div></div><div class="pause-icon-hover"></div></div></div></div>');
                _scrubbar = _apControls.children(".scrubbar");
                _conControls = _apControls.children(".con-controls");
                _conPlayPause = _conControls.children(".con-playpause").eq(0);
                _conControls.append('<div class="controls-volume"><div class="volumeicon"></div><div class="volume_static"></div><div class="volume_active"></div><div class="volume_cut"></div></div>');
                _controlsVolume = _conControls.children(".controls-volume");
                if (cthis.children(".meta-artist").length > 0) _audioplayerInner.append(cthis.children(".meta-artist"));
                _audioplayerInner.children(".meta-artist").eq(0).wrap('<div class="meta-artist-con"></div>');
                _metaArtistCon = _audioplayerInner.children(".meta-artist-con").eq(0);
                var str_thumbh = "";
                if (o.design_thumbh != "") str_thumbh = " height:" + o.design_thumbh + "px;";
                if (cthis.attr("data-thumb") != undefined && cthis.attr("data-thumb") != "") {
                    _audioplayerInner.prepend('<div class="the-thumb-con"><div class="the-thumb" style="' + str_thumbh + " background-image:url(" + cthis.attr("data-thumb") + ')"></div></div>');
                    _theThumbCon = _audioplayerInner.children(".the-thumb-con").eq(0)
                }
                if (o.disable_volume == "on") _controlsVolume.hide();
                if (o.disable_scrub == "on") _scrubbar.hide();
                if (o.design_skin == "skin-wave") {
                    _metaArtistCon.css({
                        "left": o.design_thumbw + 80
                    });
                    if (cthis.attr("data-scrubbg") != undefined) _scrubbar.children(".scrub-bg").eq(0).append('<img class="scrub-bg-img" src="' + cthis.attr("data-scrubbg") + '"/>');
                    if (cthis.attr("data-scrubprog") != undefined) _scrubbar.children(".scrub-prog").eq(0).append('<img class="scrub-prog-img" src="' + cthis.attr("data-scrubprog") + '"/>');
                    _scrubbar.find(".scrub-bg-img").eq(0).css({
                        "width": _scrubbar.children(".scrub-bg").width()
                    });
                    _scrubbar.find(".scrub-prog-img").eq(0).css({
                        "width": _scrubbar.children(".scrub-bg").width()
                    });
                    _audioplayerInner.children(".the-thumb-con").css({
                        "height": o.design_thumbh
                    });
                    _apControls.css({
                        "height": o.design_thumbh
                    })
                }
         
            }

            function setup_media() {
                
                var aux = "";
                aux += "<audio>";
                if (cthis.attr("data-source") != undefined) {
                    aux += '<source src="' + cthis.attr("data-source") + '" type="audio/mpeg">';
                    if (cthis.attr("data-sourceogg") != undefined) aux += '<source src="' + cthis.attr("data-sourceogg") + '" type="audio/ogg">'
                }
                aux += "</audio>";
                if (can_playmp3() == false && cthis.attr("data-sourceogg") == undefined ||
                    is_ie8()) {
                    aux = '<object type="application/x-shockwave-flash" data="ap.swf" width="100" height="50" id="flashcontent_' + cthisId + '" allowscriptaccess="always" style="visibility: visible; "><param name="movie" value="ap.swf"><param name="menu" value="false"><param name="allowScriptAccess" value="always"><param name="scale" value="noscale"><param name="allowFullScreen" value="true"><param name="wmode" value="opaque"><param name="flashvars" value="media=' + cthis.attr("data-source") + "&fvid=" + cthisId + '">';
                    is_flashplayer = true
                }
                _theMedia.append(aux);
                _cmedia = _theMedia.children("audio").get(0);
                if (is_flashplayer == true) {
                    _cmedia = _theMedia.children("object").get(0);
                    setTimeout(function () {
                        _cmedia = _theMedia.children("object").get(0)
                    }, 500)
                }
                if (is_ie8()) setTimeout(function () {
                    _cmedia = _theMedia.children("object").get(0)
                }, 500)
            }

            function setup_listeners() {
                _scrubbar.bind("mousemove", mouse_scrubbar);
                _scrubbar.bind("mouseleave", mouse_scrubbar);
                _scrubbar.bind("click", mouse_scrubbar);
                _controlsVolume.children(".volumeicon").bind("click",
                    click_mute);
                _controlsVolume.children(".volume_active").bind("click", mouse_volumebar);
                _controlsVolume.children(".volume_static").bind("click", mouse_volumebar);
                _conControls.find(".con-playpause").eq(0).bind("click", click_playpause);
                $(window).bind("resize", handleResize);
                handleResize();
                requestAnimFrame(check_time);
                cthis.get(0).fn_pause_media = pause_media
            }

            function check_time() {
                if (o.type == "youtube") {
                    time_total = _cmedia.getDuration();
                    time_curr = _cmedia.getCurrentTime()
                }
                if (o.type == "audio")
                    if (is_flashplayer ==
                        true) {
                        eval("if(typeof _cmedia.fn_getSoundDuration" + cthisId + " != 'undefined'){time_total = parseFloat(_cmedia.fn_getSoundDuration" + cthisId + "())};");
                        eval("if(typeof _cmedia.fn_getSoundCurrTime" + cthisId + " != 'undefined'){time_curr = parseFloat(_cmedia.fn_getSoundCurrTime" + cthisId + "())};")
                    } else {
                        time_total = _cmedia.duration;
                        time_curr = _cmedia.currentTime
                    }
                spos = time_curr / time_total * sw;
                if (isNaN(spos)) spos = 0;
                if (spos > sw) spos = sw;
                _scrubbar.children(".scrub-prog").css({
                    "width": spos
                });
                if (cthis.hasClass("skin-minimal"))
                    if (is_ie8() || !can_canvas() || is_opera()) _conPlayPause.addClass("canvas-fallback");
                    else {
                        var ctx = skin_minimal_canvasplay.getContext("2d");
                        var ctx_w = $(skin_minimal_canvasplay).width();
                        var ctx_h = $(skin_minimal_canvasplay).height();
                        var pw = ctx_w / 100;
                        var ph = ctx_h / 100;
                        spos = Math.PI * 2 * (time_curr / time_total);
                        if (isNaN(spos)) spos = 0;
                        if (spos > Math.PI * 2) spos = Math.PI * 2;
                        ctx.clearRect(0, 0, ctx_w, ctx_h);
                        var gradient = gradient = ctx.createLinearGradient(0, 0, 0, ctx_h);
                        gradient.addColorStop("0", "#ea8c52");
                        gradient.addColorStop("1.0", "#cb7641");
                        ctx.beginPath();
                        ctx.arc(50 * pw, 50 * ph, 40 * pw, 0, Math.PI * 2, false);
                        ctx.fillStyle = "rgba(0,0,0,0.1)";
                        ctx.fill();
                        ctx.beginPath();
                        ctx.arc(50 * pw, 50 * ph, 30 * pw, 0, Math.PI * 2, false);
                        ctx.fillStyle = gradient;
                        ctx.fill();
                        ctx.beginPath();
                        ctx.arc(50 * pw, 50 * ph, 34 * pw, 0, spos, false);
                        ctx.lineWidth = 10 * pw;
                        ctx.strokeStyle = "rgba(0,0,0,0.3)";
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.strokeStyle = "red";
                        ctx.moveTo(44 * pw, 40 * pw);
                        ctx.lineTo(57 * pw, 50 * pw);
                        ctx.lineTo(44 * pw, 60 * pw);
                        ctx.lineTo(44 * pw, 40 * pw);
                        ctx.fillStyle = "#ddd";
                        ctx.fill();
                        ctx = skin_minimal_canvaspause.getContext("2d");
                        ctx_w = $(skin_minimal_canvaspause).width();
                        ctx_h = $(skin_minimal_canvaspause).height();
                        pw = ctx_w / 100;
                        ph = ctx_h / 100;
                        ctx.clearRect(0, 0, ctx_w, ctx_h);
                        ctx.beginPath();
                        ctx.arc(50 * pw, 50 * ph, 40 * pw, 0, Math.PI * 2, false);
                        ctx.fillStyle = "rgba(0,0,0,0.1)";
                        ctx.fill();
                        ctx.beginPath();
                        ctx.arc(50 * pw, 50 * ph, 30 * pw, 0, Math.PI * 2, false);
                        ctx.fillStyle = gradient;
                        ctx.fill();
                        ctx.beginPath();
                        ctx.arc(50 * pw, 50 * ph, 34 * pw, 0, spos, false);
                        ctx.lineWidth = 10 * pw;
                        ctx.strokeStyle = "rgba(0,0,0,0.35)";
                        ctx.stroke();
                        ctx.fillStyle = "#ddd";
                        ctx.fillRect(43 *
                            pw, 40 * pw, 6 * pw, 20 * pw);
                        ctx.fillRect(53 * pw, 40 * pw, 6 * pw, 20 * pw)
                    }
                if (time_total > 0 && time_curr >= time_total - 0.07) {
                    seek_to(0);
                    pause_media()
                }
               
                else requestAnimFrame(check_time)
            }

            function click_playpause(e) {
                var _t = jQuery(this);
                if (o.design_skin == "skin-minimal") {
                    var center_x = _t.offset().left + 50;
                    var center_y = _t.offset().top + 50;
                    var mouse_x = e.pageX;
                    var mouse_y = e.pageY;
                    var pzero_x = center_x + 50;
                    var pzero_y = center_y;
                    var AB = Math.sqrt(Math.pow(mouse_x -
                        center_x, 2) + Math.pow(mouse_y - center_y, 2));
                    var AC = Math.sqrt(Math.pow(pzero_x - center_x, 2) + Math.pow(pzero_y - center_y, 2));
                    var BC = Math.sqrt(Math.pow(pzero_x - mouse_x, 2) + Math.pow(pzero_y - mouse_y, 2));
                    var angle = Math.acos((AB + AC + BC) / (2 * AC * AB));
                    var angle2 = Math.acos((mouse_x - center_x) / 50);
                    var perc = -(mouse_x - center_x - 50) * 0.005;
                    if (mouse_y < center_y) perc = 0.5 + (0.5 - perc);
                    if (!(is_flashplayer == true && is_firefox()) && AB > 20) {
                        seek_to_perc(perc);
                        return
                    }
                }
                if (playing == false) play_media();
                else pause_media()
            }

            function init_loaded() {
                if (is_flashplayer ==
                    false) totalDuration = _cmedia.duration;
                else if (_cmedia.fn_getSoundDuration) eval("totalDuration = parseFloat(_cmedia.fn_getSoundDuration" + cthisId + "())");
                clearTimeout(inter_checkReady);
                setup_listeners();
                if (is_ie8()) cthis.addClass("lte-ie8");
                if (is_ie8() == false && o.autoplay == "on") play_media();
                if (is_ie8())
                    if (!Array.prototype.indexOf) Array.prototype.indexOf = function (elt) {
                        var len = this.length >>> 0;
                        var from = Number(arguments[1]) || 0;
                        from = from < 0 ? Math.ceil(from) : Math.floor(from);
                        if (from < 0) from += len;
                        for (; from < len; from++)
                            if (from in
                                this && this[from] === elt) return from;
                        return -1
                    };
                if (dzsap_list.indexOf(cthis) == -1) dzsap_list.push(cthis);
                loaded = true
            }

            function resize_player() {
                tw = cthis.width();
                th = cthis.height()
            }

            function handleResize() {
                ww = $(window).width();
                tw = cthis.width();
                if (o.design_skin == "skin-default") sw = tw;
                if (o.design_skin == "skin-wave") sw = _scrubbar.outerWidth(false);
                check_time();
                _scrubbar.find(".scrub-bg-img").eq(0).css({
                    "width": _scrubbar.children(".scrub-bg").width()
                });
                _scrubbar.find(".scrub-prog-img").eq(0).css({
                    "width": _scrubbar.children(".scrub-bg").width()
                })
            }

            function mouse_volumebar(e) {
                var _t = jQuery(this);
                if (e.type == "mousemove");
                if (e.type == "mouseleave");
                if (e.type == "click") {
                    aux = (e.pageX - _controlsVolume.children(".volume_static").offset().left) / _controlsVolume.children(".volume_static").width();
                    set_volume(aux);
                    muted = false
                }
            }

            function mouse_scrubbar(e) {
                var mousex = e.pageX;
                if (e.type == "mousemove") _scrubbar.children(".scrubBox-hover").css({
                    "left": mousex - _scrubbar.offset().left
                });
                if (e.type == "mouseleave");
                if (e.type == "click") {
                    var aux = (e.pageX - _scrubbar.offset().left) /
                        sw * time_total;
                    if (is_flashplayer == true) aux = (e.pageX - _scrubbar.offset().left) / sw;
                    seek_to(aux)
                }
            }

            function seek_to_perc(argperc) {
                seek_to(argperc * time_total)
            }

            function seek_to(arg) {
              
                if (o.type == "audio")
                    if (is_flashplayer == true) {
                        eval("_cmedia.fn_seek_to" + cthisId + "(" + arg + ")");
                        play_media()
                    } else _cmedia.currentTime = arg
            }

            function set_volume(arg) {
               
                if (o.type == "audio")
                    if (is_flashplayer == true) eval("_cmedia.fn_volumeSet" + cthisId + "(arg)");
                    else _cmedia.volume = arg;
                _controlsVolume.children(".volume_active").css({
                    "width": _controlsVolume.children(".volume_static").width() * arg
                });
                last_vol = arg
            }

            function click_mute() {
                if (muted == false) {
                    last_vol_before_mute = last_vol;
                    set_volume(0);
                    muted = true
                } else {
                    set_volume(last_vol_before_mute);
                    muted = false
                }
            }

            function pause_media() {
                _conPlayPause.children(".playbtn").css({
                    "display": "block"
                });
                _conPlayPause.children(".pausebtn").css({
                    "display": "none"
                });
               
                if (o.type == "audio")
                    if (is_flashplayer ==
                        true) eval("_cmedia.fn_pauseMedia" + cthisId + "()");
                    else if (_cmedia)
                    if (_cmedia.pause != undefined) _cmedia.pause();
                playing = false
            }

            function play_media() {
                for (i = 0; i < dzsap_list.length; i++)
                    if (!is_ie8() && dzsap_list[i].get(0) != undefined && dzsap_list[i].get(0).fn_pause_media != undefined) dzsap_list[i].get(0).fn_pause_media();
                _conPlayPause.children(".playbtn").css({
                    "display": "none"
                });
                _conPlayPause.children(".pausebtn").css({
                    "display": "block"
                });
                
                if (o.type == "audio")
                    if (is_flashplayer ==
                        true) eval("_cmedia.fn_playMedia" + cthisId + "()");
                    else if (_cmedia)
                    if (_cmedia.play != undefined) _cmedia.play();
                playing = true
            }
            return this
        })
    };
    window.dzsap_init = function (selector, settings) {
        $(selector).audioplayer(settings)
    }
})(jQuery);

function is_ios() {
    return navigator.platform.indexOf("iPhone") != -1 || navigator.platform.indexOf("iPod") != -1 || navigator.platform.indexOf("iPad") != -1
}

function is_android() {
    var ua = navigator.userAgent.toLowerCase();
    return ua.indexOf("android") > -1
}

function is_ie() {
    if (navigator.appVersion.indexOf("MSIE") != -1) return true;
    return false
}

function is_firefox() {
    if (navigator.userAgent.indexOf("Firefox") != -1) return true;
    return false
}

function is_opera() {
    if (navigator.userAgent.indexOf("Opera") != -1) return true;
    return false
}

function is_chrome() {
    return navigator.userAgent.toLowerCase().indexOf("chrome") > -1
}

function is_safari() {
    return navigator.userAgent.toLowerCase().indexOf("safari") > -1
}

function version_ie() {
    return parseFloat(navigator.appVersion.split("MSIE")[1])
}

function version_firefox() {
    if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
        var aversion = new Number(RegExp.$1);
        return aversion
    }
}

function version_opera() {
    if (/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
        var aversion = new Number(RegExp.$1);
        return aversion
    }
}

function is_ie8() {
    if (is_ie() && version_ie() < 9) return true;
    return false
}

function is_ie9() {
    if (is_ie() && version_ie() == 9) return true;
    return false
}

function can_playmp3() {
    var a = document.createElement("audio");
    return !!(a.canPlayType && a.canPlayType("audio/mpeg;").replace(/no/, ""))
}

function can_canvas() {
    var oCanvas = document.createElement("canvas");
    if (oCanvas.getContext("2d")) return true;
    return false
}


window.requestAnimFrame = function () {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback, element) {
        window.setTimeout(callback, 1E3 / 60)
    }
}();