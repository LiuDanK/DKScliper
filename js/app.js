var baguetteBox = function () {
    function t(t, n) {
        H.transforms = f(), H.svg = g(), e(), j = document.querySelectorAll(t), [].forEach.call(j, function (t) {
            n && n.filter && (A = n.filter);
            var e = t.getElementsByTagName("a");
            e = [].filter.call(e, function (t) {
                return A.test(t.href)
            });
            var o = D.length;
            D.push(e), D[o].options = n, [].forEach.call(D[o], function (t, e) {
                m(t, "click", function (t) {
                    t.preventDefault ? t.preventDefault() : t.returnValue = !1, i(o), a(e)
                })
            })
        })
    }

    function e() {
        return (b = v("baguetteBox-overlay")) ? (k = v("baguetteBox-slider"), w = v("previous-button"), C = v("next-button"), T = v("close-button"), void 0) : (b = y("div"), b.id = "baguetteBox-overlay", document.getElementsByTagName("body")[0].appendChild(b), k = y("div"), k.id = "baguetteBox-slider", b.appendChild(k), w = y("button"), w.id = "previous-button", w.innerHTML = H.svg ? E : "<", b.appendChild(w), C = y("button"), C.id = "next-button", C.innerHTML = H.svg ? x : ">", b.appendChild(C), T = y("button"), T.id = "close-button", T.innerHTML = H.svg ? B : "X", b.appendChild(T), w.className = C.className = T.className = "baguetteBox-button", n(), void 0)
    }

    function n() {
        m(b, "click", function (t) {
            t.target && "IMG" !== t.target.nodeName && "FIGCAPTION" !== t.target.nodeName && r()
        }), m(w, "click", function (t) {
            t.stopPropagation ? t.stopPropagation() : t.cancelBubble = !0, c()
        }), m(C, "click", function (t) {
            t.stopPropagation ? t.stopPropagation() : t.cancelBubble = !0, u()
        }), m(T, "click", function (t) {
            t.stopPropagation ? t.stopPropagation() : t.cancelBubble = !0, r()
        }), m(b, "touchstart", function (t) {
            N = t.changedTouches[0].pageX
        }), m(b, "touchmove", function (t) {
            S || (t.preventDefault ? t.preventDefault() : t.returnValue = !1, touch = t.touches[0] || t.changedTouches[0], touch.pageX - N > 40 ? (S = !0, c()) : touch.pageX - N < -40 && (S = !0, u()))
        }), m(b, "touchend", function () {
            S = !1
        }), m(document, "keydown", function (t) {
            switch (t.keyCode) {
                case 37:
                    c();
                    break;
                case 39:
                    u();
                    break;
                case 27:
                    r()
            }
        })
    }

    function i(t) {
        if (M !== t) {
            for (M = t, o(D[t].options); k.firstChild;) k.removeChild(k.firstChild);
            X.length = 0;
            for (var e, n = 0; n < D[t].length; n++) e = y("div"), e.className = "full-image", e.id = "baguette-img-" + n, X.push(e), k.appendChild(X[n])
        }
    }

    function o(t) {
        t || (t = {});
        for (var e in P) I[e] = P[e], "undefined" != typeof t[e] && (I[e] = t[e]);
        k.style.transition = k.style.webkitTransition = "fadeIn" === I.animation ? "opacity .4s ease" : "slideIn" === I.animation ? "" : "none", "auto" === I.buttons && ("ontouchstart" in window || 1 === D[M].length) && (I.buttons = !1), w.style.display = C.style.display = I.buttons ? "" : "none"
    }

    function a(t) {
        "block" !== b.style.display && (L = t, s(L, function () {
            p(L), h(L)
        }), d(), b.style.display = "block", setTimeout(function () {
            b.className = "visible", I.afterShow && I.afterShow()
        }, 50), I.onChange && I.onChange(L, X.length))
    }

    function r() {
        "none" !== b.style.display && (b.className = "", setTimeout(function () {
            b.style.display = "none", I.afterHide && I.afterHide()
        }, 500))
    }

    function s(t, e) {
        var n = X[t];
        if ("undefined" != typeof n) {
            if (n.getElementsByTagName("img")[0]) return e && e(), void 0;
            imageElement = D[M][t], imageCaption = "function" == typeof I.captions ? I.captions.call(D[M], imageElement) : imageElement.getAttribute("data-caption") || imageElement.title, imageSrc = l(imageElement);
            var i = y("figure"),
                o = y("img"),
                a = y("figcaption");
            n.appendChild(i), i.innerHTML = '<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>', o.onload = function () {
                var n = document.querySelector("#baguette-img-" + t + " .spinner");
                i.removeChild(n), !I.async && e && e()
            }, o.setAttribute("src", imageSrc), i.appendChild(o), I.captions && imageCaption && (a.innerHTML = imageCaption, i.appendChild(a)), I.async && e && e()
        }
    }

    function l(t) {
        var e = imageElement.href;
        if (t.dataset) {
            var n = [];
            for (var i in t.dataset) "at-" !== i.substring(0, 3) || isNaN(i.substring(3)) || (n[i.replace("at-", "")] = t.dataset[i]);
            keys = Object.keys(n).sort(function (t, e) {
                return parseInt(t) < parseInt(e) ? -1 : 1
            });
            for (var o = window.innerWidth * window.devicePixelRatio, a = 0; a < keys.length - 1 && keys[a] < o;) a++;
            e = n[keys[a]] || e
        }
        return e
    }

    function u() {
        var t;
        return L <= X.length - 2 ? (L++, d(), p(L), t = !0) : I.animation && (k.className = "bounce-from-right", setTimeout(function () {
            k.className = ""
        }, 400), t = !1), I.onChange && I.onChange(L, X.length), t
    }

    function c() {
        var t;
        return L >= 1 ? (L--, d(), h(L), t = !0) : I.animation && (k.className = "bounce-from-left", setTimeout(function () {
            k.className = ""
        }, 400), t = !1), I.onChange && I.onChange(L, X.length), t
    }

    function d() {
        var t = 100 * -L + "%";
        "fadeIn" === I.animation ? (k.style.opacity = 0, setTimeout(function () {
            H.transforms ? k.style.transform = k.style.webkitTransform = "translate3d(" + t + ",0,0)" : k.style.left = t, k.style.opacity = 1
        }, 400)) : H.transforms ? k.style.transform = k.style.webkitTransform = "translate3d(" + t + ",0,0)" : k.style.left = t
    }

    function f() {
        var t = y("div");
        return "undefined" != typeof t.style.perspective || "undefined" != typeof t.style.webkitPerspective
    }

    function g() {
        var t = y("div");
        return t.innerHTML = "<svg/>", "http://www.w3.org/2000/svg" == (t.firstChild && t.firstChild.namespaceURI)
    }

    function p(t) {
        t - L >= I.preload || s(t + 1, function () {
            p(t + 1)
        })
    }

    function h(t) {
        L - t >= I.preload || s(t - 1, function () {
            h(t - 1)
        })
    }

    function m(t, e, n) {
        t.addEventListener ? t.addEventListener(e, n, !1) : t.attachEvent("on" + e, n)
    }

    function v(t) {
        return document.getElementById(t)
    }

    function y(t) {
        return document.createElement(t)
    }
    var b, k, w, C, T, N, E = '<svg width="44" height="60"><polyline points="30 10 10 30 30 50" stroke="rgba(255,255,255,.8)" stroke-width="4"stroke-linecap="butt" fill="none" stroke-linejoin="round"/></svg>',
        x = '<svg width="44" height="60"><polyline points="14 10 34 30 14 50" stroke="rgba(255,255,255,.8)" stroke-width="4"stroke-linecap="butt" fill="none" stroke-linejoin="round"/></svg>',
        B = '<svg width="30" height="30"><g stroke="rgba(255,255,255,.8)" stroke-width="4"><line x1="5" y1="5" x2="25" y2="25"/><line x1="5" y1="25" x2="25" y2="5"/></g></svg>',
        I = {},
        P = {
            captions: !0,
            buttons: "auto",
            async: !1,
            preload: 2,
            animation: "slideIn",
            afterShow: null,
            afterHide: null,
            onChange: null
        },
        H = {},
        L = 0,
        M = -1,
        S = !1,
        A = /.+\.(gif|jpe?g|png|webp)/i,
        j = [],
        D = [],
        X = [];
    return [].forEach || (Array.prototype.forEach = function (t, e) {
        for (var n = 0; n < this.length; n++) t.call(e, this[n], n, this)
    }), [].filter || (Array.prototype.filter = function (t, e, n, i, o) {
        for (n = this, i = [], o = 0; o < n.length; o++) t.call(e, n[o], o, n) && i.push(n[o]);
        return i
    }), {
        run: t,
        showNext: u,
        showPrevious: c
    }
}();
var home = location.href,
    s = $('#bgvideo')[0],
    Siren = {
        MN: function () {
            $('.iconflat').on('click', function () {
                $('body').toggleClass('navOpen');
                $('#main-container,#mo-nav,.openNav').toggleClass('open');
            });
        },
        MNH: function () {
            if ($('body').hasClass('navOpen')) {
                $('body').toggleClass('navOpen');
                $('#main-container,#mo-nav,.openNav').toggleClass('open');
            }
        },
        splay: function () {
            $('#video-btn').addClass('video-pause').removeClass('video-play').show();
            $('.video-stu').css({
                "bottom": "-100px"
            });
            $('.focusinfo').css({
                "top": "-999px"
            });
            s.play();
        },
        spause: function () {
            $('#video-btn').addClass('video-play').removeClass('video-pause');
            $('.focusinfo').css({
                "top": "49.3%"
            });
            s.pause();
        },
        liveplay: function () {
            if (s.oncanplay != undefined && $('.haslive').length > 0) {
                if ($('.videolive').length > 0) {
                    Siren.splay();
                }
            }
        },
        livepause: function () {
            if (s.oncanplay != undefined && $('.haslive').length > 0) {
                Siren.spause();
                $('.video-stu').css({
                    "bottom": "0px"
                }).html('已暂停 ...');
            }
        },
        addsource: function () {
            $('.video-stu').html('正在载入视频 ...').css({
                "bottom": "0px"
            });
            var t = Poi.movies.name.split(","),
                _t = t[Math.floor(Math.random() * t.length)];
            $('#bgvideo').attr('src', Poi.movies.url + '/' + _t + '.mp4');
            $('#bgvideo').attr('video-name', _t);
        },
        LV: function () {
            var _btn = $('#video-btn');
            _btn.on('click', function () {
                if ($(this).hasClass('loadvideo')) {
                    $(this).addClass('video-pause').removeClass('loadvideo').hide();
                    Siren.addsource();
                    s.oncanplay = function () {
                        Siren.splay();
                        $('#video-add').show();
                        _btn.addClass('videolive');
                        _btn.addClass('haslive');
                    }
                } else {
                    if ($(this).hasClass('video-pause')) {
                        Siren.spause();
                        _btn.removeClass('videolive');
                        $('.video-stu').css({
                            "bottom": "0px"
                        }).html('已暂停 ...');
                    } else {
                        Siren.splay();
                        _btn.addClass('videolive');
                    }
                }
                s.onended = function () {
                    $('#bgvideo').attr('src', '');
                    $('#video-add').hide();
                    _btn.addClass('loadvideo').removeClass('video-pause');
                    _btn.removeClass('videolive');
                    _btn.removeClass('haslive');
                    $('.focusinfo').css({
                        "top": "49.3%"
                    });
                }
            });
            $('#video-add').on('click', function () {
                Siren.addsource();
            });
        },
        AH: function () {
            if (Poi.windowheight == 'auto') {
                if ($('h1.main-title').length > 0) {
                    var _height = $(window).height();
                    $('#centerbg').css({
                        'height': _height
                    });
                    $('#bgvideo').css({
                        'min-height': _height
                    });
                    $(window).resize(function () {
                        Siren.AH();
                    });
                }
            } else {
                $('.headertop').addClass('headertop-bar');
            }
        },
        PE: function () {
            if ($('.headertop').length > 0) {
                if ($('h1.main-title').length > 0) {
                    $('.blank').css({
                        "padding-top": "0px"
                    });
                    $('.headertop').css({
                        "height": "auto"
                    }).show();
                    if (Poi.movies.live == 'open') Siren.liveplay();
                } else {
                    $('.blank').css({
                        "padding-top": "80px"
                    });
                    $('.headertop').css({
                        "height": "0px"
                    }).hide();
                    Siren.livepause();
                }
            }
        },
        CE: function () {
            $('.comments-hidden').show();
            $('.comments-main').hide();
            $('.comments-hidden').click(function () {
                $('.comments-main').slideDown(500);
                $('.comments-hidden').hide();
            });
            $('.archives').hide();
            $('.archives:first').show();
            $('#archives-temp h3').click(function () {
                $(this).next().slideToggle('fast');
                return false;
            });
            baguetteBox.run('.entry-content', {
                captions: function (element) {
                    return element.getElementsByTagName('img')[0].alt;
                }
            });
            $('.js-toggle-search').on('click', function () {
                $('.js-toggle-search').toggleClass('is-active');
                $('.js-search').toggleClass('is-visible');
            });
            $('.search_close').on('click', function () {
                if ($('.js-search').hasClass('is-visible')) {
                    $('.js-toggle-search').toggleClass('is-active');
                    $('.js-search').toggleClass('is-visible');
                }
            });
            $('#show-nav').on('click', function () {
                if ($('#show-nav').hasClass('showNav')) {
                    $('#show-nav').removeClass('showNav').addClass('hideNav');
                    $('.site-top .lower nav').addClass('navbar');
                } else {
                    $('#show-nav').removeClass('hideNav').addClass('showNav');
                    $('.site-top .lower nav').removeClass('navbar');
                }
            });
            $("#loading").click(function () {
                $("#loading").fadeOut(500);
            });
        },
        NH: function () {
            var h1 = 0,
                h2 = 50,
                ss = $(document).scrollTop();
            $(window).scroll(function () {
                var s = $(document).scrollTop();
                if (s == h1) {
                    $('.site-header').removeClass('yya');
                }
                if (s > h1) {
                    $('.site-header').addClass('yya');
                }
                if (s > h2) {
                    $('.site-header').addClass('gizle');
                    if (s > ss) {
                        $('.site-header').removeClass('sabit');
                    } else {
                        $('.site-header').addClass('sabit');
                    }
                    ss = s;
                }
            });
        },
        XLS: function () {
            $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
            $('body').on('click', '#pagination a', function () {
                $(this).addClass("loading").text("");
                $.ajax({
                    type: "POST",
                    url: $(this).attr("href") + "#main",
                    success: function (data) {
                        result = $(data).find("#main .post");
                        nextHref = $(data).find("#pagination a").attr("href");
                        $("#main").append(result.fadeIn(500));
                        $("#pagination a").removeClass("loading").text("Previous");
                        if (nextHref != undefined) {
                            $("#pagination a").attr("href", nextHref);
                        } else {
                            $("#pagination").html("<span>Don't have more ...</span>");
                        }
                    }
                });
                return false;
            });
        },
        XCS: function () {
            var __cancel = jQuery('#cancel-comment-reply-link'),
                __cancel_text = __cancel.text(),
                __list = 'commentwrap';
            jQuery(document).on("submit", "#commentform", function () {
                jQuery.ajax({
                    url: Poi.ajaxurl,
                    data: jQuery(this).serialize() + "&action=ajax_comment",
                    type: jQuery(this).attr('method'),
                    beforeSend: addComment.createButterbar("机器人正在验证评论.."),
                    error: function (request) {
                        var t = addComment;
                        t.createButterbar(request.responseText);
                    },
                    success: function (data) {
                        jQuery('textarea').each(function () {
                            this.value = ''
                        });
                        var t = addComment,
                            cancel = t.I('cancel-comment-reply-link'),
                            temp = t.I('wp-temp-form-div'),
                            respond = t.I(t.respondId),
                            post = t.I('comment_post_ID').value,
                            parent = t.I('comment_parent').value;
                        if (parent != '0') {
                            jQuery('#respond').before('<ol class="children">' + data + '</ol>');
                        } else if (!jQuery('.' + __list).length) {
                            if (Poi.formpostion == 'bottom') {
                                jQuery('#respond').before('<ol class="' + __list + '">' + data + '</ol>');
                            } else {
                                jQuery('#respond').after('<ol class="' + __list + '">' + data + '</ol>');
                            }
                        } else {
                            if (Poi.order == 'asc') {
                                jQuery('.' + __list).append(data);
                            } else {
                                jQuery('.' + __list).prepend(data);
                            }
                        }
                        t.createButterbar("提交成功！");
                        cancel.style.display = 'none';
                        cancel.onclick = null;
                        t.I('comment_parent').value = '0';
                        if (temp && respond) {
                            temp.parentNode.insertBefore(respond, temp);
                            temp.parentNode.removeChild(temp)
                        }
                    }
                });
                return false;
            });
            addComment = {
                moveForm: function (commId, parentId, respondId) {
                    var t = this,
                        div, comm = t.I(commId),
                        respond = t.I(respondId),
                        cancel = t.I('cancel-comment-reply-link'),
                        parent = t.I('comment_parent'),
                        post = t.I('comment_post_ID');
                    __cancel.text(__cancel_text);
                    t.respondId = respondId;
                    if (!t.I('wp-temp-form-div')) {
                        div = document.createElement('div');
                        div.id = 'wp-temp-form-div';
                        div.style.display = 'none';
                        respond.parentNode.insertBefore(div, respond)
                    }!comm ? (temp = t.I('wp-temp-form-div'), t.I('comment_parent').value = '0', temp.parentNode.insertBefore(respond, temp), temp.parentNode.removeChild(temp)) : comm.parentNode.insertBefore(respond, comm.nextSibling);
                    jQuery("body").animate({
                        scrollTop: jQuery('#respond').offset().top - 180
                    }, 400);
                    parent.value = parentId;
                    cancel.style.display = '';
                    cancel.onclick = function () {
                        var t = addComment,
                            temp = t.I('wp-temp-form-div'),
                            respond = t.I(t.respondId);
                        t.I('comment_parent').value = '0';
                        if (temp && respond) {
                            temp.parentNode.insertBefore(respond, temp);
                            temp.parentNode.removeChild(temp);
                        }
                        this.style.display = 'none';
                        this.onclick = null;
                        return false;
                    };
                    try {
                        t.I('comment').focus();
                    } catch (e) {}
                    return false;
                },
                I: function (e) {
                    return document.getElementById(e);
                },
                clearButterbar: function (e) {
                    if (jQuery(".butterBar").length > 0) {
                        jQuery(".butterBar").remove();
                    }
                },
                createButterbar: function (message) {
                    var t = this;
                    t.clearButterbar();
                    jQuery("body").append('<div class="butterBar butterBar--center"><p class="butterBar-message">' + message + '</p></div>');
                    setTimeout("jQuery('.butterBar').remove()", 3000);
                }
            };
        },
        XCP: function () {
            $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
            $('body').on('click', '#comments-navi a', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: $(this).attr('href'),
                    beforeSend: function () {
                        $('#comments-navi').remove();
                        $('ul.commentwrap').remove();
                        $('#loading-comments').slideDown();
                        $body.animate({
                            scrollTop: $('#comments-list-title').offset().top - 65
                        }, 800);
                    },
                    dataType: "html",
                    success: function (out) {
                        result = $(out).find('ul.commentwrap');
                        nextlink = $(out).find('#comments-navi');
                        $('#loading-comments').slideUp('fast');
                        $('#loading-comments').after(result.fadeIn(500));
                        $('ul.commentwrap').after(nextlink);
                    }
                });
            });
        },
        IA: function () {
            POWERMODE.colorful = true;
            POWERMODE.shake = false;
            document.body.addEventListener('input', POWERMODE)
        },
        AN: function () {
            function tableOfContentScroll(flag) {
                if (document.body.clientWidth <= 1200) {
                    return;
                } else if ($("div").hasClass("have-toc") == false && $("div").hasClass("has-toc") == false) {
                    $(".toc-container").remove();
                } else {
                    $(document).ready(function () {
                        if ($("div").hasClass("toc")) {
                            $(".toc-container").css("height", $(".site-content").outerHeight());
                            setTimeout(function () {
                                $(".toc-container").css("height", $(".site-content").outerHeight());
                            }, 1000);
                            setTimeout(function () {
                                $(".toc-container").css("height", $(".site-content").outerHeight());
                            }, 6000);
                        }
                    });
                    if (flag) {
                        var id = 1;
                        $(".entry-content , .links").children("h1,h2,h3,h4,h5").each(function () {
                            var hyphenated = "toc-head-" + id;
                            $(this).attr('id', hyphenated);
                            id++;
                        });
                        tocbot.init({
                            tocSelector: '.toc',
                            contentSelector: ['.entry-content', '.links'],
                            headingSelector: 'h1, h2, h3, h4, h5',
                        });
                    }
                }
            }
            tableOfContentScroll(flag = true);
        },
        GT: function () {
            var offset = 200,
                offset_opacity = 1200,
                scroll_top_duration = 700,
                $back_to_top = $('.cd-top');
            $(window).scroll(function () {
                ($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible'): $back_to_top.removeClass('cd-is-visible cd-fade-out');
                if ($(this).scrollTop() > offset_opacity) {
                    $back_to_top.addClass('cd-fade-out');
                }
            });
            $back_to_top.on('click', function (event) {
                event.preventDefault();
                $('body,html').animate({
                    scrollTop: 0,
                }, scroll_top_duration);
            });
        },
        GRT: function () {
            $("input#email").blur(function () {
                var _email = $(this).val();
                if (_email != '') {
                    $.ajax({
                        type: 'GET',
                        data: {
                            action: 'ajax_avatar_get',
                            form: 'https://secure.gravatar.com/avatar/' + _email + '?s=42&d=mm&r=g',
                            email: _email
                        },
                        success: function (data) {
                            $('.avatar_visitor').attr('src', data);
                        }
                    });
                }
                return false;
            });
        },
        HIT: function () {
            fetch('https://v1.hitokoto.cn').then(function (res) {
                return res.json();
            }).then(function (data) {
                $("#comment").attr('placeholder', data.hitokoto + "--" + data.from);
            }).catch(function (err) {
                console.error(err);
            })
        }
    };
$(function () {
    Siren.AH();
    Siren.PE();
    Siren.NH();
    Siren.AN();
    Siren.GT();
    Siren.HIT();
    Siren.GRT();
    Siren.XLS();
    Siren.XCS();
    Siren.XCP();
    Siren.CE();
    Siren.MN();
    Siren.IA();
    Siren.LV();
    if (Poi.pjax) {
        jQuery(document).pjax("a[target!=_top][data-pjax!='0'][class!='download']", '#page', {
            fragment: '#page',
            timeout: 8000,
        }).on('pjax:send', function () {
            $('#loading').fadeIn(300);
            Siren.MNH();
        }).on('pjax:complete', function () {
            Siren.AH();
            Siren.PE();
            Siren.CE();
            Siren.AN();
            Siren.HIT();
            Siren.GRT();
            emojiInit();
            add_copyright();
            home = location.href;
            $("#loading").fadeOut(500);
            if (Poi.codelamp == 'open') {
                self.Prism.highlightAll(event)
            };
            if ($('.ds-thread').length > 0) {
                if (typeof DUOSHUO !== 'undefined') {
                    DUOSHUO.EmbedThread('.ds-thread');
                } else {
                    $.getScript("//static.duoshuo.com/embed.js");
                }
            };
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
        }).on('submit', '.search-form,.s-search', function (event) {
            event.preventDefault();
            $.pjax.submit(event, '#page', {
                fragment: '#page',
                timeout: 8000,
            });
            if ($('.js-search.is-visible').length > 0) {
                $('.js-toggle-search').toggleClass('is-active');
                $('.js-search').toggleClass('is-visible');
            }
        });
        window.addEventListener('popstate', function (e) {
            Siren.AH();
            Siren.PE();
            Siren.CE();
            Siren.AN();
        }, false);
    }
    $.fn.postLike = function () {
        if ($(this).hasClass('done')) {
            return false;
        } else {
            $(this).addClass('done');
            var id = $(this).data("id"),
                action = $(this).data('action'),
                rateHolder = $(this).children('.count');
            var ajax_data = {
                action: "specs_zan",
                um_id: id,
                um_action: action
            };
            $.post(Poi.ajaxurl, ajax_data, function (data) {
                $(rateHolder).html(data);
            });
            return false;
        }
    };
    $(document).on("click", ".specsZan", function () {
        $(this).postLike();
    });
    $.fn.extend({
        animateCss: function (animationName, callback) {
            var animationEnd = (function (el) {
                var animations = {
                    animation: 'animationend',
                    OAnimation: 'oAnimationEnd',
                    MozAnimation: 'mozAnimationEnd',
                    WebkitAnimation: 'webkitAnimationEnd',
                };
                for (var t in animations) {
                    if (el.style[t] !== undefined) {
                        return animations[t];
                    }
                }
            })(document.createElement('div'));
            this.addClass('animated ' + animationName).one(animationEnd, function () {
                $(this).removeClass('animated ' + animationName);
                if (typeof callback === 'function') callback();
            });
            return this;
        }
    });
});
var isWebkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
    isOpera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
    isIe = navigator.userAgent.toLowerCase().indexOf('msie') > -1;
if ((isWebkit || isOpera || isIe) && document.getElementById && window.addEventListener) {
    window.addEventListener('hashchange', function () {
        var id = location.hash.substring(1),
            element;
        if (!(/^[A-z0-9_-]+$/.test(id))) {
            return;
        }
        element = document.getElementById(id);
        if (element) {
            if (!(/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
                element.tabIndex = -1;
            }
            element.focus();
        }
    }, false);
};
hljs.initHighlightingOnLoad();

function emojiInit() {
    $(".smli-button").click(function () {
        $("#smilies-box").fadeToggle("fast");
    });
}

function grin(tag) {
    var myField;
    tag = ' ' + tag + ' ';
    if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
        myField = document.getElementById('comment');
    } else {
        return false;
    }
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
    } else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var cursorPos = endPos;
        myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
    } else {
        myField.value += tag;
        myField.focus();
    }
}
emojiInit();

function add_copyright() {
    document.body.addEventListener("copy", function (e) {
        if (window.getSelection().toString().length > 30 && scilper_option.clipboardCopyright) {
            setClipboardText(e);
        } else {
            addComment.createButterbar("复制成功！<br>Copy to the clipboard success! ", 800);
        }
    });

    function setClipboardText(event) {
        event.preventDefault();
        var htmlData = "" + window.getSelection().toString().replace(/\r\n/g, "<br>") + "<br><br>" + "著作权归原作者所有。<br>" + "商业转载请联系作者获得授权，非商业转载请注明出处。<br>" + "来源：" + scilper_option.site_name + "<br>" + "链接：" + window.location.href;
        var textData = "" + window.getSelection().toString().replace(/\r\n/g, "\n") + "\n\n" + "著作权归原作者所有。\n" + "商业转载请联系作者获得授权，非商业转载请注明出处。\n" + "来源：" + scilper_option.site_name + "\n" + "链接：" + window.location.href;
        if (event.clipboardData) {
            event.clipboardData.setData("text/html", htmlData);
            event.clipboardData.setData("text/plain", textData);
            addComment.createButterbar("复制成功！若要转载请务必保留原文链接，申明来源，谢谢合作！<br>Copy to the clipboard success! Please declare the source, thank you.", 1000);
        } else if (window.clipboardData) {
            return window.clipboardData.setData("text", textData);
        }
    }
}
add_copyright();
var typing = function (r) {
    function t() {
        return b[Math.floor(Math.random() * b.length)]
    }

    function e() {
        return String.fromCharCode(94 * Math.random() + 33)
    }

    function n(r) {
        for (var n = document.createDocumentFragment(), i = 0; r > i; i++) {
            var l = document.createElement("span");
            l.textContent = e(), l.style.color = t(), n.appendChild(l)
        }
        return n
    }

    function i() {
        var t = o[c.skillI];
        c.step ? c.step-- : (c.step = g, c.prefixP < l.length ? (c.prefixP >= 0 && (c.text += l[c.prefixP]), c.prefixP++) : "forward" === c.direction ? c.skillP < t.length ? (c.text += t[c.skillP], c.skillP++) : c.delay ? c.delay-- : (c.direction = "backward", c.delay = a) : c.skillP > 0 ? (c.text = c.text.slice(0, -1), c.skillP--) : (c.skillI = (c.skillI + 1) % o.length, c.direction = "forward")), r.textContent = c.text, r.appendChild(n(c.prefixP < l.length ? Math.min(s, s + c.prefixP) : Math.min(s, t.length - c.skillP))), setTimeout(i, d)
    }
    var l = "",
        o = ["欢迎来到" + scilper_option.site_name, scilper_option.admin_des].map(function (r) {
            return r + "."
        }),
        a = 2,
        g = 1,
        s = 5,
        d = 75,
        b = ["rgb(110,64,170)", "rgb(150,61,179)", "rgb(191,60,175)", "rgb(228,65,157)", "rgb(254,75,131)", "rgb(255,94,99)", "rgb(255,120,71)", "rgb(251,150,51)", "rgb(226,183,47)", "rgb(198,214,60)", "rgb(175,240,91)", "rgb(127,246,88)", "rgb(82,246,103)", "rgb(48,239,130)", "rgb(29,223,163)", "rgb(26,199,194)", "rgb(35,171,216)", "rgb(54,140,225)", "rgb(76,110,219)", "rgb(96,84,200)"],
        c = {
            text: "",
            prefixP: -s,
            skillI: 0,
            skillP: 0,
            direction: "forward",
            delay: a,
            step: g
        };
    i()
};
typing(document.getElementById('typing'));
window.onload = function () {
    var TimeShow = document.getElementById("TimeShow");
    if (TimeShow != undefined) {
        TimeShow.innerHTML = "页面加载生成所用时间 ：" + (new Date().getTime() - t1) + " 毫秒";
    } else {
        return false;
    }
};