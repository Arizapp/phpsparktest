/*! For license information please see index.js.LICENSE.txt */
!function (t, e) {
    if ("object" == typeof exports && "object" == typeof module) module.exports = e(); else if ("function" == typeof define && define.amd) define([], e); else {
        var n = e();
        for (var i in n) ("object" == typeof exports ? exports : t)[i] = n[i]
    }
}(window, (function () {
    return function (t) {
        var e = {};

        function n(i) {
            if (e[i]) return e[i].exports;
            var r = e[i] = {i: i, l: !1, exports: {}};
            return t[i].call(r.exports, r, r.exports, n), r.l = !0, r.exports
        }

        return n.m = t, n.c = e, n.d = function (t, e, i) {
            n.o(t, e) || Object.defineProperty(t, e, {enumerable: !0, get: i})
        }, n.r = function (t) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(t, "__esModule", {value: !0})
        }, n.t = function (t, e) {
            if (1 & e && (t = n(t)), 8 & e) return t;
            if (4 & e && "object" == typeof t && t && t.__esModule) return t;
            var i = Object.create(null);
            if (n.r(i), Object.defineProperty(i, "default", {
                enumerable: !0,
                value: t
            }), 2 & e && "string" != typeof t) for (var r in t) n.d(i, r, function (e) {
                return t[e]
            }.bind(null, r));
            return i
        }, n.n = function (t) {
            var e = t && t.__esModule ? function () {
                return t.default
            } : function () {
                return t
            };
            return n.d(e, "a", e), e
        }, n.o = function (t, e) {
            return Object.prototype.hasOwnProperty.call(t, e)
        }, n.p = "/", n(n.s = 4)
    }([function (t, e, n) {
        var i = n(2), r = n(8);
        "string" == typeof (r = r.__esModule ? r.default : r) && (r = [[t.i, r, ""]]);
        var a = {insert: "head", singleton: !1};
        i(r, a);
        t.exports = r.locals || {}
    }, function (t, e, n) {
        "use strict";
        t.exports = function (t) {
            var e = [];
            return e.toString = function () {
                return this.map((function (e) {
                    var n = function (t, e) {
                        var n = t[1] || "", i = t[3];
                        if (!i) return n;
                        if (e && "function" == typeof btoa) {
                            var r = (o = i, s = btoa(unescape(encodeURIComponent(JSON.stringify(o)))), p = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(s), "/*# ".concat(p, " */")),
                                a = i.sources.map((function (t) {
                                    return "/*# sourceURL=".concat(i.sourceRoot || "").concat(t, " */")
                                }));
                            return [n].concat(a).concat([r]).join("\n")
                        }
                        var o, s, p;
                        return [n].join("\n")
                    }(e, t);
                    return e[2] ? "@media ".concat(e[2], " {").concat(n, "}") : n
                })).join("")
            }, e.i = function (t, n, i) {
                "string" == typeof t && (t = [[null, t, ""]]);
                var r = {};
                if (i) for (var a = 0; a < this.length; a++) {
                    var o = this[a][0];
                    null != o && (r[o] = !0)
                }
                for (var s = 0; s < t.length; s++) {
                    var p = [].concat(t[s]);
                    i && r[p[0]] || (n && (p[2] ? p[2] = "".concat(n, " and ").concat(p[2]) : p[2] = n), e.push(p))
                }
            }, e
        }
    }, function (t, e, n) {
        "use strict";
        var i, r = function () {
            return void 0 === i && (i = Boolean(window && document && document.all && !window.atob)), i
        }, a = function () {
            var t = {};
            return function (e) {
                if (void 0 === t[e]) {
                    var n = document.querySelector(e);
                    if (window.HTMLIFrameElement && n instanceof window.HTMLIFrameElement) try {
                        n = n.contentDocument.head
                    } catch (t) {
                        n = null
                    }
                    t[e] = n
                }
                return t[e]
            }
        }(), o = [];

        function s(t) {
            for (var e = -1, n = 0; n < o.length; n++) if (o[n].identifier === t) {
                e = n;
                break
            }
            return e
        }

        function p(t, e) {
            for (var n = {}, i = [], r = 0; r < t.length; r++) {
                var a = t[r], p = e.base ? a[0] + e.base : a[0], c = n[p] || 0, h = "".concat(p, " ").concat(c);
                n[p] = c + 1;
                var l = s(h), d = {css: a[1], media: a[2], sourceMap: a[3]};
                -1 !== l ? (o[l].references++, o[l].updater(d)) : o.push({
                    identifier: h,
                    updater: m(d, e),
                    references: 1
                }), i.push(h)
            }
            return i
        }

        function c(t) {
            var e = document.createElement("style"), i = t.attributes || {};
            if (void 0 === i.nonce) {
                var r = n.nc;
                r && (i.nonce = r)
            }
            if (Object.keys(i).forEach((function (t) {
                e.setAttribute(t, i[t])
            })), "function" == typeof t.insert) t.insert(e); else {
                var o = a(t.insert || "head");
                if (!o) throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
                o.appendChild(e)
            }
            return e
        }

        var h, l = (h = [], function (t, e) {
            return h[t] = e, h.filter(Boolean).join("\n")
        });

        function d(t, e, n, i) {
            var r = n ? "" : i.media ? "@media ".concat(i.media, " {").concat(i.css, "}") : i.css;
            if (t.styleSheet) t.styleSheet.cssText = l(e, r); else {
                var a = document.createTextNode(r), o = t.childNodes;
                o[e] && t.removeChild(o[e]), o.length ? t.insertBefore(a, o[e]) : t.appendChild(a)
            }
        }

        function A(t, e, n) {
            var i = n.css, r = n.media, a = n.sourceMap;
            if (r ? t.setAttribute("media", r) : t.removeAttribute("media"), a && btoa && (i += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a)))), " */")), t.styleSheet) t.styleSheet.cssText = i; else {
                for (; t.firstChild;) t.removeChild(t.firstChild);
                t.appendChild(document.createTextNode(i))
            }
        }

        var u = null, f = 0;

        function m(t, e) {
            var n, i, r;
            if (e.singleton) {
                var a = f++;
                n = u || (u = c(e)), i = d.bind(null, n, a, !1), r = d.bind(null, n, a, !0)
            } else n = c(e), i = A.bind(null, n, e), r = function () {
                !function (t) {
                    if (null === t.parentNode) return !1;
                    t.parentNode.removeChild(t)
                }(n)
            };
            return i(t), function (e) {
                if (e) {
                    if (e.css === t.css && e.media === t.media && e.sourceMap === t.sourceMap) return;
                    i(t = e)
                } else r()
            }
        }

        t.exports = function (t, e) {
            (e = e || {}).singleton || "boolean" == typeof e.singleton || (e.singleton = r());
            var n = p(t = t || [], e);
            return function (t) {
                if (t = t || [], "[object Array]" === Object.prototype.toString.call(t)) {
                    for (var i = 0; i < n.length; i++) {
                        var r = s(n[i]);
                        o[r].references--
                    }
                    for (var a = p(t, e), c = 0; c < n.length; c++) {
                        var h = s(n[c]);
                        0 === o[h].references && (o[h].updater(), o.splice(h, 1))
                    }
                    n = a
                }
            }
        }
    }, function (t, e, n) {
        t.exports = function () {
            "use strict";

            function t(e) {
                return (t = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
                    return typeof t
                } : function (t) {
                    return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
                })(e)
            }

            function e(t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }

            function n(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var i = e[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
                }
            }

            function i(t, e, n) {
                return e in t ? Object.defineProperty(t, e, {
                    value: n,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : t[e] = n, t
            }

            function r(t, e) {
                var n = Object.keys(t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(t);
                    e && (i = i.filter((function (e) {
                        return Object.getOwnPropertyDescriptor(t, e).enumerable
                    }))), n.push.apply(n, i)
                }
                return n
            }

            function a(t) {
                for (var e = 1; e < arguments.length; e++) {
                    var n = null != arguments[e] ? arguments[e] : {};
                    e % 2 ? r(Object(n), !0).forEach((function (e) {
                        i(t, e, n[e])
                    })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(n)) : r(Object(n)).forEach((function (e) {
                        Object.defineProperty(t, e, Object.getOwnPropertyDescriptor(n, e))
                    }))
                }
                return t
            }

            function o(t) {
                return function (t) {
                    if (Array.isArray(t)) return s(t)
                }(t) || function (t) {
                    if ("undefined" != typeof Symbol && Symbol.iterator in Object(t)) return Array.from(t)
                }(t) || function (t, e) {
                    if (t) {
                        if ("string" == typeof t) return s(t, e);
                        var n = Object.prototype.toString.call(t).slice(8, -1);
                        return "Object" === n && t.constructor && (n = t.constructor.name), "Map" === n || "Set" === n ? Array.from(t) : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n) ? s(t, e) : void 0
                    }
                }(t) || function () {
                    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
                }()
            }

            function s(t, e) {
                (null == e || e > t.length) && (e = t.length);
                for (var n = 0, i = new Array(e); n < e; n++) i[n] = t[n];
                return i
            }

            var p = "undefined" != typeof window && void 0 !== window.document, c = p ? window : {},
                h = !(!p || !c.document.documentElement) && "ontouchstart" in c.document.documentElement,
                l = !!p && "PointerEvent" in c, d = "".concat("cropper", "-crop"),
                A = "".concat("cropper", "-disabled"), u = "".concat("cropper", "-hidden"),
                f = "".concat("cropper", "-hide"), m = "".concat("cropper", "-invisible"),
                g = "".concat("cropper", "-modal"), v = "".concat("cropper", "-move"),
                b = "".concat("cropper", "Action"), C = "".concat("cropper", "Preview"),
                w = h ? "touchstart" : "mousedown", x = h ? "touchmove" : "mousemove",
                E = h ? "touchend touchcancel" : "mouseup", y = l ? "pointerdown" : w, B = l ? "pointermove" : x,
                M = l ? "pointerup pointercancel" : E, k = /^e|w|s|n|se|sw|ne|nw|all|crop|move|zoom$/, D = /^data:/,
                O = /^data:image\/jpeg;base64,/, S = /^img|canvas$/i, W = {
                    viewMode: 0,
                    dragMode: "crop",
                    initialAspectRatio: NaN,
                    aspectRatio: NaN,
                    data: null,
                    preview: "",
                    responsive: !0,
                    restore: !0,
                    checkCrossOrigin: !0,
                    checkOrientation: !0,
                    modal: !0,
                    guides: !0,
                    center: !0,
                    highlight: !0,
                    background: !0,
                    autoCrop: !0,
                    autoCropArea: .8,
                    movable: !0,
                    rotatable: !0,
                    scalable: !0,
                    zoomable: !0,
                    zoomOnTouch: !0,
                    zoomOnWheel: !0,
                    wheelZoomRatio: .1,
                    cropBoxMovable: !0,
                    cropBoxResizable: !0,
                    toggleDragModeOnDblclick: !0,
                    minCanvasWidth: 0,
                    minCanvasHeight: 0,
                    minCropBoxWidth: 0,
                    minCropBoxHeight: 0,
                    minContainerWidth: 200,
                    minContainerHeight: 100,
                    ready: null,
                    cropstart: null,
                    cropmove: null,
                    cropend: null,
                    crop: null,
                    zoom: null
                }, T = Number.isNaN || c.isNaN;

            function Y(t) {
                return "number" == typeof t && !T(t)
            }

            var z = function (t) {
                return t > 0 && t < 1 / 0
            };

            function j(t) {
                return void 0 === t
            }

            function N(e) {
                return "object" === t(e) && null !== e
            }

            var R = Object.prototype.hasOwnProperty;

            function U(t) {
                if (!N(t)) return !1;
                try {
                    var e = t.constructor, n = e.prototype;
                    return e && n && R.call(n, "isPrototypeOf")
                } catch (t) {
                    return !1
                }
            }

            function H(t) {
                return "function" == typeof t
            }

            var X = Array.prototype.slice;

            function L(t) {
                return Array.from ? Array.from(t) : X.call(t)
            }

            function I(t, e) {
                return t && H(e) && (Array.isArray(t) || Y(t.length) ? L(t).forEach((function (n, i) {
                    e.call(t, n, i, t)
                })) : N(t) && Object.keys(t).forEach((function (n) {
                    e.call(t, t[n], n, t)
                }))), t
            }

            var P = Object.assign || function (t) {
                for (var e = arguments.length, n = new Array(e > 1 ? e - 1 : 0), i = 1; i < e; i++) n[i - 1] = arguments[i];
                return N(t) && n.length > 0 && n.forEach((function (e) {
                    N(e) && Object.keys(e).forEach((function (n) {
                        t[n] = e[n]
                    }))
                })), t
            }, Z = /\.\d*(?:0|9){12}\d*$/;

            function _(t) {
                var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1e11;
                return Z.test(t) ? Math.round(t * e) / e : t
            }

            var Q = /^width|height|left|top|marginLeft|marginTop$/;

            function F(t, e) {
                var n = t.style;
                I(e, (function (t, e) {
                    Q.test(e) && Y(t) && (t = "".concat(t, "px")), n[e] = t
                }))
            }

            function q(t, e) {
                if (e) if (Y(t.length)) I(t, (function (t) {
                    q(t, e)
                })); else if (t.classList) t.classList.add(e); else {
                    var n = t.className.trim();
                    n ? n.indexOf(e) < 0 && (t.className = "".concat(n, " ").concat(e)) : t.className = e
                }
            }

            function $(t, e) {
                e && (Y(t.length) ? I(t, (function (t) {
                    $(t, e)
                })) : t.classList ? t.classList.remove(e) : t.className.indexOf(e) >= 0 && (t.className = t.className.replace(e, "")))
            }

            function V(t, e, n) {
                e && (Y(t.length) ? I(t, (function (t) {
                    V(t, e, n)
                })) : n ? q(t, e) : $(t, e))
            }

            var G = /([a-z\d])([A-Z])/g;

            function J(t) {
                return t.replace(G, "$1-$2").toLowerCase()
            }

            function K(t, e) {
                return N(t[e]) ? t[e] : t.dataset ? t.dataset[e] : t.getAttribute("data-".concat(J(e)))
            }

            function tt(t, e, n) {
                N(n) ? t[e] = n : t.dataset ? t.dataset[e] = n : t.setAttribute("data-".concat(J(e)), n)
            }

            var et = /\s\s*/, nt = function () {
                var t = !1;
                if (p) {
                    var e = !1, n = function () {
                    }, i = Object.defineProperty({}, "once", {
                        get: function () {
                            return t = !0, e
                        }, set: function (t) {
                            e = t
                        }
                    });
                    c.addEventListener("test", n, i), c.removeEventListener("test", n, i)
                }
                return t
            }();

            function it(t, e, n) {
                var i = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {}, r = n;
                e.trim().split(et).forEach((function (e) {
                    if (!nt) {
                        var a = t.listeners;
                        a && a[e] && a[e][n] && (r = a[e][n], delete a[e][n], 0 === Object.keys(a[e]).length && delete a[e], 0 === Object.keys(a).length && delete t.listeners)
                    }
                    t.removeEventListener(e, r, i)
                }))
            }

            function rt(t, e, n) {
                var i = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {}, r = n;
                e.trim().split(et).forEach((function (e) {
                    if (i.once && !nt) {
                        var a = t.listeners, o = void 0 === a ? {} : a;
                        r = function () {
                            delete o[e][n], t.removeEventListener(e, r, i);
                            for (var a = arguments.length, s = new Array(a), p = 0; p < a; p++) s[p] = arguments[p];
                            n.apply(t, s)
                        }, o[e] || (o[e] = {}), o[e][n] && t.removeEventListener(e, o[e][n], i), o[e][n] = r, t.listeners = o
                    }
                    t.addEventListener(e, r, i)
                }))
            }

            function at(t, e, n) {
                var i;
                return H(Event) && H(CustomEvent) ? i = new CustomEvent(e, {
                    detail: n,
                    bubbles: !0,
                    cancelable: !0
                }) : (i = document.createEvent("CustomEvent")).initCustomEvent(e, !0, !0, n), t.dispatchEvent(i)
            }

            function ot(t) {
                var e = t.getBoundingClientRect();
                return {
                    left: e.left + (window.pageXOffset - document.documentElement.clientLeft),
                    top: e.top + (window.pageYOffset - document.documentElement.clientTop)
                }
            }

            var st = c.location, pt = /^(\w+:)\/\/([^:/?#]*):?(\d*)/i;

            function ct(t) {
                var e = t.match(pt);
                return null !== e && (e[1] !== st.protocol || e[2] !== st.hostname || e[3] !== st.port)
            }

            function ht(t) {
                var e = "timestamp=".concat((new Date).getTime());
                return t + (-1 === t.indexOf("?") ? "?" : "&") + e
            }

            function lt(t) {
                var e = t.rotate, n = t.scaleX, i = t.scaleY, r = t.translateX, a = t.translateY, o = [];
                Y(r) && 0 !== r && o.push("translateX(".concat(r, "px)")), Y(a) && 0 !== a && o.push("translateY(".concat(a, "px)")), Y(e) && 0 !== e && o.push("rotate(".concat(e, "deg)")), Y(n) && 1 !== n && o.push("scaleX(".concat(n, ")")), Y(i) && 1 !== i && o.push("scaleY(".concat(i, ")"));
                var s = o.length ? o.join(" ") : "none";
                return {WebkitTransform: s, msTransform: s, transform: s}
            }

            function dt(t, e) {
                var n = t.pageX, i = t.pageY, r = {endX: n, endY: i};
                return e ? r : a({startX: n, startY: i}, r)
            }

            function At(t) {
                var e = t.aspectRatio, n = t.height, i = t.width,
                    r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "contain", a = z(i), o = z(n);
                if (a && o) {
                    var s = n * e;
                    "contain" === r && s > i || "cover" === r && s < i ? n = i / e : i = n * e
                } else a ? n = i / e : o && (i = n * e);
                return {width: i, height: n}
            }

            function ut(t, e, n, i) {
                var r = e.aspectRatio, a = e.naturalWidth, s = e.naturalHeight, p = e.rotate, c = void 0 === p ? 0 : p,
                    h = e.scaleX, l = void 0 === h ? 1 : h, d = e.scaleY, A = void 0 === d ? 1 : d, u = n.aspectRatio,
                    f = n.naturalWidth, m = n.naturalHeight, g = i.fillColor, v = void 0 === g ? "transparent" : g,
                    b = i.imageSmoothingEnabled, C = void 0 === b || b, w = i.imageSmoothingQuality,
                    x = void 0 === w ? "low" : w, E = i.maxWidth, y = void 0 === E ? 1 / 0 : E, B = i.maxHeight,
                    M = void 0 === B ? 1 / 0 : B, k = i.minWidth, D = void 0 === k ? 0 : k, O = i.minHeight,
                    S = void 0 === O ? 0 : O, W = document.createElement("canvas"), T = W.getContext("2d"),
                    Y = At({aspectRatio: u, width: y, height: M}),
                    z = At({aspectRatio: u, width: D, height: S}, "cover"), j = Math.min(Y.width, Math.max(z.width, f)),
                    N = Math.min(Y.height, Math.max(z.height, m)), R = At({aspectRatio: r, width: y, height: M}),
                    U = At({aspectRatio: r, width: D, height: S}, "cover"), H = Math.min(R.width, Math.max(U.width, a)),
                    X = Math.min(R.height, Math.max(U.height, s)), L = [-H / 2, -X / 2, H, X];
                return W.width = _(j), W.height = _(N), T.fillStyle = v, T.fillRect(0, 0, j, N), T.save(), T.translate(j / 2, N / 2), T.rotate(c * Math.PI / 180), T.scale(l, A), T.imageSmoothingEnabled = C, T.imageSmoothingQuality = x, T.drawImage.apply(T, [t].concat(o(L.map((function (t) {
                    return Math.floor(_(t))
                }))))), T.restore(), W
            }

            var ft = String.fromCharCode, mt = /^data:.*,/;

            function gt(t) {
                var e, n = new DataView(t);
                try {
                    var i, r, a;
                    if (255 === n.getUint8(0) && 216 === n.getUint8(1)) for (var o = n.byteLength, s = 2; s + 1 < o;) {
                        if (255 === n.getUint8(s) && 225 === n.getUint8(s + 1)) {
                            r = s;
                            break
                        }
                        s += 1
                    }
                    if (r) {
                        var p = r + 10;
                        if ("Exif" === function (t, e, n) {
                            var i = "";
                            n += e;
                            for (var r = e; r < n; r += 1) i += ft(t.getUint8(r));
                            return i
                        }(n, r + 4, 4)) {
                            var c = n.getUint16(p);
                            if (((i = 18761 === c) || 19789 === c) && 42 === n.getUint16(p + 2, i)) {
                                var h = n.getUint32(p + 4, i);
                                h >= 8 && (a = p + h)
                            }
                        }
                    }
                    if (a) {
                        var l, d, A = n.getUint16(a, i);
                        for (d = 0; d < A; d += 1) if (l = a + 12 * d + 2, 274 === n.getUint16(l, i)) {
                            l += 8, e = n.getUint16(l, i), n.setUint16(l, 1, i);
                            break
                        }
                    }
                } catch (t) {
                    e = 1
                }
                return e
            }

            var vt = {
                render: function () {
                    this.initContainer(), this.initCanvas(), this.initCropBox(), this.renderCanvas(), this.cropped && this.renderCropBox()
                }, initContainer: function () {
                    var t = this.element, e = this.options, n = this.container, i = this.cropper;
                    q(i, u), $(t, u);
                    var r = {
                        width: Math.max(n.offsetWidth, Number(e.minContainerWidth) || 200),
                        height: Math.max(n.offsetHeight, Number(e.minContainerHeight) || 100)
                    };
                    this.containerData = r, F(i, {width: r.width, height: r.height}), q(t, u), $(i, u)
                }, initCanvas: function () {
                    var t = this.containerData, e = this.imageData, n = this.options.viewMode,
                        i = Math.abs(e.rotate) % 180 == 90, r = i ? e.naturalHeight : e.naturalWidth,
                        a = i ? e.naturalWidth : e.naturalHeight, o = r / a, s = t.width, p = t.height;
                    t.height * o > t.width ? 3 === n ? s = t.height * o : p = t.width / o : 3 === n ? p = t.width / o : s = t.height * o;
                    var c = {aspectRatio: o, naturalWidth: r, naturalHeight: a, width: s, height: p};
                    c.left = (t.width - s) / 2, c.top = (t.height - p) / 2, c.oldLeft = c.left, c.oldTop = c.top, this.canvasData = c, this.limited = 1 === n || 2 === n, this.limitCanvas(!0, !0), this.initialImageData = P({}, e), this.initialCanvasData = P({}, c)
                }, limitCanvas: function (t, e) {
                    var n = this.options, i = this.containerData, r = this.canvasData, a = this.cropBoxData,
                        o = n.viewMode, s = r.aspectRatio, p = this.cropped && a;
                    if (t) {
                        var c = Number(n.minCanvasWidth) || 0, h = Number(n.minCanvasHeight) || 0;
                        o > 1 ? (c = Math.max(c, i.width), h = Math.max(h, i.height), 3 === o && (h * s > c ? c = h * s : h = c / s)) : o > 0 && (c ? c = Math.max(c, p ? a.width : 0) : h ? h = Math.max(h, p ? a.height : 0) : p && (c = a.width, (h = a.height) * s > c ? c = h * s : h = c / s));
                        var l = At({aspectRatio: s, width: c, height: h});
                        c = l.width, h = l.height, r.minWidth = c, r.minHeight = h, r.maxWidth = 1 / 0, r.maxHeight = 1 / 0
                    }
                    if (e) if (o > (p ? 0 : 1)) {
                        var d = i.width - r.width, A = i.height - r.height;
                        r.minLeft = Math.min(0, d), r.minTop = Math.min(0, A), r.maxLeft = Math.max(0, d), r.maxTop = Math.max(0, A), p && this.limited && (r.minLeft = Math.min(a.left, a.left + (a.width - r.width)), r.minTop = Math.min(a.top, a.top + (a.height - r.height)), r.maxLeft = a.left, r.maxTop = a.top, 2 === o && (r.width >= i.width && (r.minLeft = Math.min(0, d), r.maxLeft = Math.max(0, d)), r.height >= i.height && (r.minTop = Math.min(0, A), r.maxTop = Math.max(0, A))))
                    } else r.minLeft = -r.width, r.minTop = -r.height, r.maxLeft = i.width, r.maxTop = i.height
                }, renderCanvas: function (t, e) {
                    var n = this.canvasData, i = this.imageData;
                    if (e) {
                        var r = function (t) {
                                var e = t.width, n = t.height, i = t.degree;
                                if (90 == (i = Math.abs(i) % 180)) return {width: n, height: e};
                                var r = i % 90 * Math.PI / 180, a = Math.sin(r), o = Math.cos(r), s = e * o + n * a,
                                    p = e * a + n * o;
                                return i > 90 ? {width: p, height: s} : {width: s, height: p}
                            }({
                                width: i.naturalWidth * Math.abs(i.scaleX || 1),
                                height: i.naturalHeight * Math.abs(i.scaleY || 1),
                                degree: i.rotate || 0
                            }), a = r.width, o = r.height, s = n.width * (a / n.naturalWidth),
                            p = n.height * (o / n.naturalHeight);
                        n.left -= (s - n.width) / 2, n.top -= (p - n.height) / 2, n.width = s, n.height = p, n.aspectRatio = a / o, n.naturalWidth = a, n.naturalHeight = o, this.limitCanvas(!0, !1)
                    }
                    (n.width > n.maxWidth || n.width < n.minWidth) && (n.left = n.oldLeft), (n.height > n.maxHeight || n.height < n.minHeight) && (n.top = n.oldTop), n.width = Math.min(Math.max(n.width, n.minWidth), n.maxWidth), n.height = Math.min(Math.max(n.height, n.minHeight), n.maxHeight), this.limitCanvas(!1, !0), n.left = Math.min(Math.max(n.left, n.minLeft), n.maxLeft), n.top = Math.min(Math.max(n.top, n.minTop), n.maxTop), n.oldLeft = n.left, n.oldTop = n.top, F(this.canvas, P({
                        width: n.width,
                        height: n.height
                    }, lt({
                        translateX: n.left,
                        translateY: n.top
                    }))), this.renderImage(t), this.cropped && this.limited && this.limitCropBox(!0, !0)
                }, renderImage: function (t) {
                    var e = this.canvasData, n = this.imageData, i = n.naturalWidth * (e.width / e.naturalWidth),
                        r = n.naturalHeight * (e.height / e.naturalHeight);
                    P(n, {
                        width: i,
                        height: r,
                        left: (e.width - i) / 2,
                        top: (e.height - r) / 2
                    }), F(this.image, P({width: n.width, height: n.height}, lt(P({
                        translateX: n.left,
                        translateY: n.top
                    }, n)))), t && this.output()
                }, initCropBox: function () {
                    var t = this.options, e = this.canvasData, n = t.aspectRatio || t.initialAspectRatio,
                        i = Number(t.autoCropArea) || .8, r = {width: e.width, height: e.height};
                    n && (e.height * n > e.width ? r.height = r.width / n : r.width = r.height * n), this.cropBoxData = r, this.limitCropBox(!0, !0), r.width = Math.min(Math.max(r.width, r.minWidth), r.maxWidth), r.height = Math.min(Math.max(r.height, r.minHeight), r.maxHeight), r.width = Math.max(r.minWidth, r.width * i), r.height = Math.max(r.minHeight, r.height * i), r.left = e.left + (e.width - r.width) / 2, r.top = e.top + (e.height - r.height) / 2, r.oldLeft = r.left, r.oldTop = r.top, this.initialCropBoxData = P({}, r)
                }, limitCropBox: function (t, e) {
                    var n = this.options, i = this.containerData, r = this.canvasData, a = this.cropBoxData,
                        o = this.limited, s = n.aspectRatio;
                    if (t) {
                        var p = Number(n.minCropBoxWidth) || 0, c = Number(n.minCropBoxHeight) || 0,
                            h = o ? Math.min(i.width, r.width, r.width + r.left, i.width - r.left) : i.width,
                            l = o ? Math.min(i.height, r.height, r.height + r.top, i.height - r.top) : i.height;
                        p = Math.min(p, i.width), c = Math.min(c, i.height), s && (p && c ? c * s > p ? c = p / s : p = c * s : p ? c = p / s : c && (p = c * s), l * s > h ? l = h / s : h = l * s), a.minWidth = Math.min(p, h), a.minHeight = Math.min(c, l), a.maxWidth = h, a.maxHeight = l
                    }
                    e && (o ? (a.minLeft = Math.max(0, r.left), a.minTop = Math.max(0, r.top), a.maxLeft = Math.min(i.width, r.left + r.width) - a.width, a.maxTop = Math.min(i.height, r.top + r.height) - a.height) : (a.minLeft = 0, a.minTop = 0, a.maxLeft = i.width - a.width, a.maxTop = i.height - a.height))
                }, renderCropBox: function () {
                    var t = this.options, e = this.containerData, n = this.cropBoxData;
                    (n.width > n.maxWidth || n.width < n.minWidth) && (n.left = n.oldLeft), (n.height > n.maxHeight || n.height < n.minHeight) && (n.top = n.oldTop), n.width = Math.min(Math.max(n.width, n.minWidth), n.maxWidth), n.height = Math.min(Math.max(n.height, n.minHeight), n.maxHeight), this.limitCropBox(!1, !0), n.left = Math.min(Math.max(n.left, n.minLeft), n.maxLeft), n.top = Math.min(Math.max(n.top, n.minTop), n.maxTop), n.oldLeft = n.left, n.oldTop = n.top, t.movable && t.cropBoxMovable && tt(this.face, b, n.width >= e.width && n.height >= e.height ? "move" : "all"), F(this.cropBox, P({
                        width: n.width,
                        height: n.height
                    }, lt({
                        translateX: n.left,
                        translateY: n.top
                    }))), this.cropped && this.limited && this.limitCanvas(!0, !0), this.disabled || this.output()
                }, output: function () {
                    this.preview(), at(this.element, "crop", this.getData())
                }
            }, bt = {
                initPreview: function () {
                    var t = this.element, e = this.crossOrigin, n = this.options.preview,
                        i = e ? this.crossOriginUrl : this.url, r = t.alt || "The image to preview",
                        a = document.createElement("img");
                    if (e && (a.crossOrigin = e), a.src = i, a.alt = r, this.viewBox.appendChild(a), this.viewBoxImage = a, n) {
                        var o = n;
                        "string" == typeof n ? o = t.ownerDocument.querySelectorAll(n) : n.querySelector && (o = [n]), this.previews = o, I(o, (function (t) {
                            var n = document.createElement("img");
                            tt(t, C, {
                                width: t.offsetWidth,
                                height: t.offsetHeight,
                                html: t.innerHTML
                            }), e && (n.crossOrigin = e), n.src = i, n.alt = r, n.style.cssText = 'display:block;width:100%;height:auto;min-width:0!important;min-height:0!important;max-width:none!important;max-height:none!important;image-orientation:0deg!important;"', t.innerHTML = "", t.appendChild(n)
                        }))
                    }
                }, resetPreview: function () {
                    I(this.previews, (function (t) {
                        var e = K(t, C);
                        F(t, {width: e.width, height: e.height}), t.innerHTML = e.html, function (t, e) {
                            if (N(t[e])) try {
                                delete t[e]
                            } catch (n) {
                                t[e] = void 0
                            } else if (t.dataset) try {
                                delete t.dataset[e]
                            } catch (n) {
                                t.dataset[e] = void 0
                            } else t.removeAttribute("data-".concat(J(e)))
                        }(t, C)
                    }))
                }, preview: function () {
                    var t = this.imageData, e = this.canvasData, n = this.cropBoxData, i = n.width, r = n.height,
                        a = t.width, o = t.height, s = n.left - e.left - t.left, p = n.top - e.top - t.top;
                    this.cropped && !this.disabled && (F(this.viewBoxImage, P({
                        width: a,
                        height: o
                    }, lt(P({translateX: -s, translateY: -p}, t)))), I(this.previews, (function (e) {
                        var n = K(e, C), c = n.width, h = n.height, l = c, d = h, A = 1;
                        i && (d = r * (A = c / i)), r && d > h && (l = i * (A = h / r), d = h), F(e, {
                            width: l,
                            height: d
                        }), F(e.getElementsByTagName("img")[0], P({
                            width: a * A,
                            height: o * A
                        }, lt(P({translateX: -s * A, translateY: -p * A}, t))))
                    })))
                }
            }, Ct = {
                bind: function () {
                    var t = this.element, e = this.options, n = this.cropper;
                    H(e.cropstart) && rt(t, "cropstart", e.cropstart), H(e.cropmove) && rt(t, "cropmove", e.cropmove), H(e.cropend) && rt(t, "cropend", e.cropend), H(e.crop) && rt(t, "crop", e.crop), H(e.zoom) && rt(t, "zoom", e.zoom), rt(n, y, this.onCropStart = this.cropStart.bind(this)), e.zoomable && e.zoomOnWheel && rt(n, "wheel", this.onWheel = this.wheel.bind(this), {
                        passive: !1,
                        capture: !0
                    }), e.toggleDragModeOnDblclick && rt(n, "dblclick", this.onDblclick = this.dblclick.bind(this)), rt(t.ownerDocument, B, this.onCropMove = this.cropMove.bind(this)), rt(t.ownerDocument, M, this.onCropEnd = this.cropEnd.bind(this)), e.responsive && rt(window, "resize", this.onResize = this.resize.bind(this))
                }, unbind: function () {
                    var t = this.element, e = this.options, n = this.cropper;
                    H(e.cropstart) && it(t, "cropstart", e.cropstart), H(e.cropmove) && it(t, "cropmove", e.cropmove), H(e.cropend) && it(t, "cropend", e.cropend), H(e.crop) && it(t, "crop", e.crop), H(e.zoom) && it(t, "zoom", e.zoom), it(n, y, this.onCropStart), e.zoomable && e.zoomOnWheel && it(n, "wheel", this.onWheel, {
                        passive: !1,
                        capture: !0
                    }), e.toggleDragModeOnDblclick && it(n, "dblclick", this.onDblclick), it(t.ownerDocument, B, this.onCropMove), it(t.ownerDocument, M, this.onCropEnd), e.responsive && it(window, "resize", this.onResize)
                }
            }, wt = {
                resize: function () {
                    if (!this.disabled) {
                        var t, e, n = this.options, i = this.container, r = this.containerData,
                            a = i.offsetWidth / r.width;
                        1 === a && i.offsetHeight === r.height || (n.restore && (t = this.getCanvasData(), e = this.getCropBoxData()), this.render(), n.restore && (this.setCanvasData(I(t, (function (e, n) {
                            t[n] = e * a
                        }))), this.setCropBoxData(I(e, (function (t, n) {
                            e[n] = t * a
                        })))))
                    }
                }, dblclick: function () {
                    var t, e;
                    this.disabled || "none" === this.options.dragMode || this.setDragMode((t = this.dragBox, e = d, (t.classList ? t.classList.contains(e) : t.className.indexOf(e) > -1) ? "move" : "crop"))
                }, wheel: function (t) {
                    var e = this, n = Number(this.options.wheelZoomRatio) || .1, i = 1;
                    this.disabled || (t.preventDefault(), this.wheeling || (this.wheeling = !0, setTimeout((function () {
                        e.wheeling = !1
                    }), 50), t.deltaY ? i = t.deltaY > 0 ? 1 : -1 : t.wheelDelta ? i = -t.wheelDelta / 120 : t.detail && (i = t.detail > 0 ? 1 : -1), this.zoom(-i * n, t)))
                }, cropStart: function (t) {
                    var e = t.buttons, n = t.button;
                    if (!(this.disabled || ("mousedown" === t.type || "pointerdown" === t.type && "mouse" === t.pointerType) && (Y(e) && 1 !== e || Y(n) && 0 !== n || t.ctrlKey))) {
                        var i, r = this.options, a = this.pointers;
                        t.changedTouches ? I(t.changedTouches, (function (t) {
                            a[t.identifier] = dt(t)
                        })) : a[t.pointerId || 0] = dt(t), i = Object.keys(a).length > 1 && r.zoomable && r.zoomOnTouch ? "zoom" : K(t.target, b), k.test(i) && !1 !== at(this.element, "cropstart", {
                            originalEvent: t,
                            action: i
                        }) && (t.preventDefault(), this.action = i, this.cropping = !1, "crop" === i && (this.cropping = !0, q(this.dragBox, g)))
                    }
                }, cropMove: function (t) {
                    var e = this.action;
                    if (!this.disabled && e) {
                        var n = this.pointers;
                        t.preventDefault(), !1 !== at(this.element, "cropmove", {
                            originalEvent: t,
                            action: e
                        }) && (t.changedTouches ? I(t.changedTouches, (function (t) {
                            P(n[t.identifier] || {}, dt(t, !0))
                        })) : P(n[t.pointerId || 0] || {}, dt(t, !0)), this.change(t))
                    }
                }, cropEnd: function (t) {
                    if (!this.disabled) {
                        var e = this.action, n = this.pointers;
                        t.changedTouches ? I(t.changedTouches, (function (t) {
                            delete n[t.identifier]
                        })) : delete n[t.pointerId || 0], e && (t.preventDefault(), Object.keys(n).length || (this.action = ""), this.cropping && (this.cropping = !1, V(this.dragBox, g, this.cropped && this.options.modal)), at(this.element, "cropend", {
                            originalEvent: t,
                            action: e
                        }))
                    }
                }
            }, xt = {
                change: function (t) {
                    var e, n = this.options, i = this.canvasData, r = this.containerData, o = this.cropBoxData,
                        s = this.pointers, p = this.action, c = n.aspectRatio, h = o.left, l = o.top, d = o.width,
                        A = o.height, f = h + d, m = l + A, g = 0, v = 0, b = r.width, C = r.height, w = !0;
                    !c && t.shiftKey && (c = d && A ? d / A : 1), this.limited && (g = o.minLeft, v = o.minTop, b = g + Math.min(r.width, i.width, i.left + i.width), C = v + Math.min(r.height, i.height, i.top + i.height));
                    var x = s[Object.keys(s)[0]], E = {x: x.endX - x.startX, y: x.endY - x.startY}, y = function (t) {
                        switch (t) {
                            case"e":
                                f + E.x > b && (E.x = b - f);
                                break;
                            case"w":
                                h + E.x < g && (E.x = g - h);
                                break;
                            case"n":
                                l + E.y < v && (E.y = v - l);
                                break;
                            case"s":
                                m + E.y > C && (E.y = C - m)
                        }
                    };
                    switch (p) {
                        case"all":
                            h += E.x, l += E.y;
                            break;
                        case"e":
                            if (E.x >= 0 && (f >= b || c && (l <= v || m >= C))) {
                                w = !1;
                                break
                            }
                            y("e"), (d += E.x) < 0 && (p = "w", h -= d = -d), c && (A = d / c, l += (o.height - A) / 2);
                            break;
                        case"n":
                            if (E.y <= 0 && (l <= v || c && (h <= g || f >= b))) {
                                w = !1;
                                break
                            }
                            y("n"), A -= E.y, l += E.y, A < 0 && (p = "s", l -= A = -A), c && (d = A * c, h += (o.width - d) / 2);
                            break;
                        case"w":
                            if (E.x <= 0 && (h <= g || c && (l <= v || m >= C))) {
                                w = !1;
                                break
                            }
                            y("w"), d -= E.x, h += E.x, d < 0 && (p = "e", h -= d = -d), c && (A = d / c, l += (o.height - A) / 2);
                            break;
                        case"s":
                            if (E.y >= 0 && (m >= C || c && (h <= g || f >= b))) {
                                w = !1;
                                break
                            }
                            y("s"), (A += E.y) < 0 && (p = "n", l -= A = -A), c && (d = A * c, h += (o.width - d) / 2);
                            break;
                        case"ne":
                            if (c) {
                                if (E.y <= 0 && (l <= v || f >= b)) {
                                    w = !1;
                                    break
                                }
                                y("n"), A -= E.y, l += E.y, d = A * c
                            } else y("n"), y("e"), E.x >= 0 ? f < b ? d += E.x : E.y <= 0 && l <= v && (w = !1) : d += E.x, E.y <= 0 ? l > v && (A -= E.y, l += E.y) : (A -= E.y, l += E.y);
                            d < 0 && A < 0 ? (p = "sw", l -= A = -A, h -= d = -d) : d < 0 ? (p = "nw", h -= d = -d) : A < 0 && (p = "se", l -= A = -A);
                            break;
                        case"nw":
                            if (c) {
                                if (E.y <= 0 && (l <= v || h <= g)) {
                                    w = !1;
                                    break
                                }
                                y("n"), A -= E.y, l += E.y, d = A * c, h += o.width - d
                            } else y("n"), y("w"), E.x <= 0 ? h > g ? (d -= E.x, h += E.x) : E.y <= 0 && l <= v && (w = !1) : (d -= E.x, h += E.x), E.y <= 0 ? l > v && (A -= E.y, l += E.y) : (A -= E.y, l += E.y);
                            d < 0 && A < 0 ? (p = "se", l -= A = -A, h -= d = -d) : d < 0 ? (p = "ne", h -= d = -d) : A < 0 && (p = "sw", l -= A = -A);
                            break;
                        case"sw":
                            if (c) {
                                if (E.x <= 0 && (h <= g || m >= C)) {
                                    w = !1;
                                    break
                                }
                                y("w"), d -= E.x, h += E.x, A = d / c
                            } else y("s"), y("w"), E.x <= 0 ? h > g ? (d -= E.x, h += E.x) : E.y >= 0 && m >= C && (w = !1) : (d -= E.x, h += E.x), E.y >= 0 ? m < C && (A += E.y) : A += E.y;
                            d < 0 && A < 0 ? (p = "ne", l -= A = -A, h -= d = -d) : d < 0 ? (p = "se", h -= d = -d) : A < 0 && (p = "nw", l -= A = -A);
                            break;
                        case"se":
                            if (c) {
                                if (E.x >= 0 && (f >= b || m >= C)) {
                                    w = !1;
                                    break
                                }
                                y("e"), A = (d += E.x) / c
                            } else y("s"), y("e"), E.x >= 0 ? f < b ? d += E.x : E.y >= 0 && m >= C && (w = !1) : d += E.x, E.y >= 0 ? m < C && (A += E.y) : A += E.y;
                            d < 0 && A < 0 ? (p = "nw", l -= A = -A, h -= d = -d) : d < 0 ? (p = "sw", h -= d = -d) : A < 0 && (p = "ne", l -= A = -A);
                            break;
                        case"move":
                            this.move(E.x, E.y), w = !1;
                            break;
                        case"zoom":
                            this.zoom(function (t) {
                                var e = a({}, t), n = [];
                                return I(t, (function (t, i) {
                                    delete e[i], I(e, (function (e) {
                                        var i = Math.abs(t.startX - e.startX), r = Math.abs(t.startY - e.startY),
                                            a = Math.abs(t.endX - e.endX), o = Math.abs(t.endY - e.endY),
                                            s = Math.sqrt(i * i + r * r), p = (Math.sqrt(a * a + o * o) - s) / s;
                                        n.push(p)
                                    }))
                                })), n.sort((function (t, e) {
                                    return Math.abs(t) < Math.abs(e)
                                })), n[0]
                            }(s), t), w = !1;
                            break;
                        case"crop":
                            if (!E.x || !E.y) {
                                w = !1;
                                break
                            }
                            e = ot(this.cropper), h = x.startX - e.left, l = x.startY - e.top, d = o.minWidth, A = o.minHeight, E.x > 0 ? p = E.y > 0 ? "se" : "ne" : E.x < 0 && (h -= d, p = E.y > 0 ? "sw" : "nw"), E.y < 0 && (l -= A), this.cropped || ($(this.cropBox, u), this.cropped = !0, this.limited && this.limitCropBox(!0, !0))
                    }
                    w && (o.width = d, o.height = A, o.left = h, o.top = l, this.action = p, this.renderCropBox()), I(s, (function (t) {
                        t.startX = t.endX, t.startY = t.endY
                    }))
                }
            }, Et = {
                crop: function () {
                    return !this.ready || this.cropped || this.disabled || (this.cropped = !0, this.limitCropBox(!0, !0), this.options.modal && q(this.dragBox, g), $(this.cropBox, u), this.setCropBoxData(this.initialCropBoxData)), this
                }, reset: function () {
                    return this.ready && !this.disabled && (this.imageData = P({}, this.initialImageData), this.canvasData = P({}, this.initialCanvasData), this.cropBoxData = P({}, this.initialCropBoxData), this.renderCanvas(), this.cropped && this.renderCropBox()), this
                }, clear: function () {
                    return this.cropped && !this.disabled && (P(this.cropBoxData, {
                        left: 0,
                        top: 0,
                        width: 0,
                        height: 0
                    }), this.cropped = !1, this.renderCropBox(), this.limitCanvas(!0, !0), this.renderCanvas(), $(this.dragBox, g), q(this.cropBox, u)), this
                }, replace: function (t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
                    return !this.disabled && t && (this.isImg && (this.element.src = t), e ? (this.url = t, this.image.src = t, this.ready && (this.viewBoxImage.src = t, I(this.previews, (function (e) {
                        e.getElementsByTagName("img")[0].src = t
                    })))) : (this.isImg && (this.replaced = !0), this.options.data = null, this.uncreate(), this.load(t))), this
                }, enable: function () {
                    return this.ready && this.disabled && (this.disabled = !1, $(this.cropper, A)), this
                }, disable: function () {
                    return this.ready && !this.disabled && (this.disabled = !0, q(this.cropper, A)), this
                }, destroy: function () {
                    var t = this.element;
                    return t.cropper ? (t.cropper = void 0, this.isImg && this.replaced && (t.src = this.originalUrl), this.uncreate(), this) : this
                }, move: function (t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : t, n = this.canvasData,
                        i = n.left, r = n.top;
                    return this.moveTo(j(t) ? t : i + Number(t), j(e) ? e : r + Number(e))
                }, moveTo: function (t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : t, n = this.canvasData,
                        i = !1;
                    return t = Number(t), e = Number(e), this.ready && !this.disabled && this.options.movable && (Y(t) && (n.left = t, i = !0), Y(e) && (n.top = e, i = !0), i && this.renderCanvas(!0)), this
                }, zoom: function (t, e) {
                    var n = this.canvasData;
                    return t = (t = Number(t)) < 0 ? 1 / (1 - t) : 1 + t, this.zoomTo(n.width * t / n.naturalWidth, null, e)
                }, zoomTo: function (t, e, n) {
                    var i = this.options, r = this.canvasData, a = r.width, o = r.height, s = r.naturalWidth,
                        p = r.naturalHeight;
                    if ((t = Number(t)) >= 0 && this.ready && !this.disabled && i.zoomable) {
                        var c = s * t, h = p * t;
                        if (!1 === at(this.element, "zoom", {ratio: t, oldRatio: a / s, originalEvent: n})) return this;
                        if (n) {
                            var l = this.pointers, d = ot(this.cropper), A = l && Object.keys(l).length ? function (t) {
                                var e = 0, n = 0, i = 0;
                                return I(t, (function (t) {
                                    var r = t.startX, a = t.startY;
                                    e += r, n += a, i += 1
                                })), {pageX: e /= i, pageY: n /= i}
                            }(l) : {pageX: n.pageX, pageY: n.pageY};
                            r.left -= (c - a) * ((A.pageX - d.left - r.left) / a), r.top -= (h - o) * ((A.pageY - d.top - r.top) / o)
                        } else U(e) && Y(e.x) && Y(e.y) ? (r.left -= (c - a) * ((e.x - r.left) / a), r.top -= (h - o) * ((e.y - r.top) / o)) : (r.left -= (c - a) / 2, r.top -= (h - o) / 2);
                        r.width = c, r.height = h, this.renderCanvas(!0)
                    }
                    return this
                }, rotate: function (t) {
                    return this.rotateTo((this.imageData.rotate || 0) + Number(t))
                }, rotateTo: function (t) {
                    return Y(t = Number(t)) && this.ready && !this.disabled && this.options.rotatable && (this.imageData.rotate = t % 360, this.renderCanvas(!0, !0)), this
                }, scaleX: function (t) {
                    var e = this.imageData.scaleY;
                    return this.scale(t, Y(e) ? e : 1)
                }, scaleY: function (t) {
                    var e = this.imageData.scaleX;
                    return this.scale(Y(e) ? e : 1, t)
                }, scale: function (t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : t, n = this.imageData,
                        i = !1;
                    return t = Number(t), e = Number(e), this.ready && !this.disabled && this.options.scalable && (Y(t) && (n.scaleX = t, i = !0), Y(e) && (n.scaleY = e, i = !0), i && this.renderCanvas(!0, !0)), this
                }, getData: function () {
                    var t, e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0], n = this.options,
                        i = this.imageData, r = this.canvasData, a = this.cropBoxData;
                    if (this.ready && this.cropped) {
                        t = {x: a.left - r.left, y: a.top - r.top, width: a.width, height: a.height};
                        var o = i.width / i.naturalWidth;
                        if (I(t, (function (e, n) {
                            t[n] = e / o
                        })), e) {
                            var s = Math.round(t.y + t.height), p = Math.round(t.x + t.width);
                            t.x = Math.round(t.x), t.y = Math.round(t.y), t.width = p - t.x, t.height = s - t.y
                        }
                    } else t = {x: 0, y: 0, width: 0, height: 0};
                    return n.rotatable && (t.rotate = i.rotate || 0), n.scalable && (t.scaleX = i.scaleX || 1, t.scaleY = i.scaleY || 1), t
                }, setData: function (t) {
                    var e = this.options, n = this.imageData, i = this.canvasData, r = {};
                    if (this.ready && !this.disabled && U(t)) {
                        var a = !1;
                        e.rotatable && Y(t.rotate) && t.rotate !== n.rotate && (n.rotate = t.rotate, a = !0), e.scalable && (Y(t.scaleX) && t.scaleX !== n.scaleX && (n.scaleX = t.scaleX, a = !0), Y(t.scaleY) && t.scaleY !== n.scaleY && (n.scaleY = t.scaleY, a = !0)), a && this.renderCanvas(!0, !0);
                        var o = n.width / n.naturalWidth;
                        Y(t.x) && (r.left = t.x * o + i.left), Y(t.y) && (r.top = t.y * o + i.top), Y(t.width) && (r.width = t.width * o), Y(t.height) && (r.height = t.height * o), this.setCropBoxData(r)
                    }
                    return this
                }, getContainerData: function () {
                    return this.ready ? P({}, this.containerData) : {}
                }, getImageData: function () {
                    return this.sized ? P({}, this.imageData) : {}
                }, getCanvasData: function () {
                    var t = this.canvasData, e = {};
                    return this.ready && I(["left", "top", "width", "height", "naturalWidth", "naturalHeight"], (function (n) {
                        e[n] = t[n]
                    })), e
                }, setCanvasData: function (t) {
                    var e = this.canvasData, n = e.aspectRatio;
                    return this.ready && !this.disabled && U(t) && (Y(t.left) && (e.left = t.left), Y(t.top) && (e.top = t.top), Y(t.width) ? (e.width = t.width, e.height = t.width / n) : Y(t.height) && (e.height = t.height, e.width = t.height * n), this.renderCanvas(!0)), this
                }, getCropBoxData: function () {
                    var t, e = this.cropBoxData;
                    return this.ready && this.cropped && (t = {
                        left: e.left,
                        top: e.top,
                        width: e.width,
                        height: e.height
                    }), t || {}
                }, setCropBoxData: function (t) {
                    var e, n, i = this.cropBoxData, r = this.options.aspectRatio;
                    return this.ready && this.cropped && !this.disabled && U(t) && (Y(t.left) && (i.left = t.left), Y(t.top) && (i.top = t.top), Y(t.width) && t.width !== i.width && (e = !0, i.width = t.width), Y(t.height) && t.height !== i.height && (n = !0, i.height = t.height), r && (e ? i.height = i.width / r : n && (i.width = i.height * r)), this.renderCropBox()), this
                }, getCroppedCanvas: function () {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                    if (!this.ready || !window.HTMLCanvasElement) return null;
                    var e = this.canvasData, n = ut(this.image, this.imageData, e, t);
                    if (!this.cropped) return n;
                    var i = this.getData(), r = i.x, a = i.y, s = i.width, p = i.height,
                        c = n.width / Math.floor(e.naturalWidth);
                    1 !== c && (r *= c, a *= c, s *= c, p *= c);
                    var h = s / p, l = At({aspectRatio: h, width: t.maxWidth || 1 / 0, height: t.maxHeight || 1 / 0}),
                        d = At({aspectRatio: h, width: t.minWidth || 0, height: t.minHeight || 0}, "cover"), A = At({
                            aspectRatio: h,
                            width: t.width || (1 !== c ? n.width : s),
                            height: t.height || (1 !== c ? n.height : p)
                        }), u = A.width, f = A.height;
                    u = Math.min(l.width, Math.max(d.width, u)), f = Math.min(l.height, Math.max(d.height, f));
                    var m = document.createElement("canvas"), g = m.getContext("2d");
                    m.width = _(u), m.height = _(f), g.fillStyle = t.fillColor || "transparent", g.fillRect(0, 0, u, f);
                    var v = t.imageSmoothingEnabled, b = void 0 === v || v, C = t.imageSmoothingQuality;
                    g.imageSmoothingEnabled = b, C && (g.imageSmoothingQuality = C);
                    var w, x, E, y, B, M, k = n.width, D = n.height, O = r, S = a;
                    O <= -s || O > k ? (O = 0, w = 0, E = 0, B = 0) : O <= 0 ? (E = -O, O = 0, B = w = Math.min(k, s + O)) : O <= k && (E = 0, B = w = Math.min(s, k - O)), w <= 0 || S <= -p || S > D ? (S = 0, x = 0, y = 0, M = 0) : S <= 0 ? (y = -S, S = 0, M = x = Math.min(D, p + S)) : S <= D && (y = 0, M = x = Math.min(p, D - S));
                    var W = [O, S, w, x];
                    if (B > 0 && M > 0) {
                        var T = u / s;
                        W.push(E * T, y * T, B * T, M * T)
                    }
                    return g.drawImage.apply(g, [n].concat(o(W.map((function (t) {
                        return Math.floor(_(t))
                    }))))), m
                }, setAspectRatio: function (t) {
                    var e = this.options;
                    return this.disabled || j(t) || (e.aspectRatio = Math.max(0, t) || NaN, this.ready && (this.initCropBox(), this.cropped && this.renderCropBox())), this
                }, setDragMode: function (t) {
                    var e = this.options, n = this.dragBox, i = this.face;
                    if (this.ready && !this.disabled) {
                        var r = "crop" === t, a = e.movable && "move" === t;
                        t = r || a ? t : "none", e.dragMode = t, tt(n, b, t), V(n, d, r), V(n, v, a), e.cropBoxMovable || (tt(i, b, t), V(i, d, r), V(i, v, a))
                    }
                    return this
                }
            }, yt = c.Cropper, Bt = function () {
                function t(n) {
                    var i = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                    if (e(this, t), !n || !S.test(n.tagName)) throw new Error("The first argument is required and must be an <img> or <canvas> element.");
                    this.element = n, this.options = P({}, W, U(i) && i), this.cropped = !1, this.disabled = !1, this.pointers = {}, this.ready = !1, this.reloading = !1, this.replaced = !1, this.sized = !1, this.sizing = !1, this.init()
                }

                var i, r, a;
                return i = t, a = [{
                    key: "noConflict", value: function () {
                        return window.Cropper = yt, t
                    }
                }, {
                    key: "setDefaults", value: function (t) {
                        P(W, U(t) && t)
                    }
                }], (r = [{
                    key: "init", value: function () {
                        var t, e = this.element, n = e.tagName.toLowerCase();
                        if (!e.cropper) {
                            if (e.cropper = this, "img" === n) {
                                if (this.isImg = !0, t = e.getAttribute("src") || "", this.originalUrl = t, !t) return;
                                t = e.src
                            } else "canvas" === n && window.HTMLCanvasElement && (t = e.toDataURL());
                            this.load(t)
                        }
                    }
                }, {
                    key: "load", value: function (t) {
                        var e = this;
                        if (t) {
                            this.url = t, this.imageData = {};
                            var n = this.element, i = this.options;
                            if (i.rotatable || i.scalable || (i.checkOrientation = !1), i.checkOrientation && window.ArrayBuffer) if (D.test(t)) O.test(t) ? this.read((r = t.replace(mt, ""), a = atob(r), o = new ArrayBuffer(a.length), I(s = new Uint8Array(o), (function (t, e) {
                                s[e] = a.charCodeAt(e)
                            })), o)) : this.clone(); else {
                                var r, a, o, s, p = new XMLHttpRequest, c = this.clone.bind(this);
                                this.reloading = !0, this.xhr = p, p.onabort = c, p.onerror = c, p.ontimeout = c, p.onprogress = function () {
                                    "image/jpeg" !== p.getResponseHeader("content-type") && p.abort()
                                }, p.onload = function () {
                                    e.read(p.response)
                                }, p.onloadend = function () {
                                    e.reloading = !1, e.xhr = null
                                }, i.checkCrossOrigin && ct(t) && n.crossOrigin && (t = ht(t)), p.open("GET", t), p.responseType = "arraybuffer", p.withCredentials = "use-credentials" === n.crossOrigin, p.send()
                            } else this.clone()
                        }
                    }
                }, {
                    key: "read", value: function (t) {
                        var e = this.options, n = this.imageData, i = gt(t), r = 0, a = 1, o = 1;
                        if (i > 1) {
                            this.url = function (t, e) {
                                for (var n = [], i = new Uint8Array(t); i.length > 0;) n.push(ft.apply(null, L(i.subarray(0, 8192)))), i = i.subarray(8192);
                                return "data:".concat(e, ";base64,").concat(btoa(n.join("")))
                            }(t, "image/jpeg");
                            var s = function (t) {
                                var e = 0, n = 1, i = 1;
                                switch (t) {
                                    case 2:
                                        n = -1;
                                        break;
                                    case 3:
                                        e = -180;
                                        break;
                                    case 4:
                                        i = -1;
                                        break;
                                    case 5:
                                        e = 90, i = -1;
                                        break;
                                    case 6:
                                        e = 90;
                                        break;
                                    case 7:
                                        e = 90, n = -1;
                                        break;
                                    case 8:
                                        e = -90
                                }
                                return {rotate: e, scaleX: n, scaleY: i}
                            }(i);
                            r = s.rotate, a = s.scaleX, o = s.scaleY
                        }
                        e.rotatable && (n.rotate = r), e.scalable && (n.scaleX = a, n.scaleY = o), this.clone()
                    }
                }, {
                    key: "clone", value: function () {
                        var t = this.element, e = this.url, n = t.crossOrigin, i = e;
                        this.options.checkCrossOrigin && ct(e) && (n || (n = "anonymous"), i = ht(e)), this.crossOrigin = n, this.crossOriginUrl = i;
                        var r = document.createElement("img");
                        n && (r.crossOrigin = n), r.src = i || e, r.alt = t.alt || "The image to crop", this.image = r, r.onload = this.start.bind(this), r.onerror = this.stop.bind(this), q(r, f), t.parentNode.insertBefore(r, t.nextSibling)
                    }
                }, {
                    key: "start", value: function () {
                        var t = this, e = this.image;
                        e.onload = null, e.onerror = null, this.sizing = !0;
                        var n = c.navigator && /(?:iPad|iPhone|iPod).*?AppleWebKit/i.test(c.navigator.userAgent),
                            i = function (e, n) {
                                P(t.imageData, {
                                    naturalWidth: e,
                                    naturalHeight: n,
                                    aspectRatio: e / n
                                }), t.sizing = !1, t.sized = !0, t.build()
                            };
                        if (!e.naturalWidth || n) {
                            var r = document.createElement("img"), a = document.body || document.documentElement;
                            this.sizingImage = r, r.onload = function () {
                                i(r.width, r.height), n || a.removeChild(r)
                            }, r.src = e.src, n || (r.style.cssText = "left:0;max-height:none!important;max-width:none!important;min-height:0!important;min-width:0!important;opacity:0;position:absolute;top:0;z-index:-1;", a.appendChild(r))
                        } else i(e.naturalWidth, e.naturalHeight)
                    }
                }, {
                    key: "stop", value: function () {
                        var t = this.image;
                        t.onload = null, t.onerror = null, t.parentNode.removeChild(t), this.image = null
                    }
                }, {
                    key: "build", value: function () {
                        if (this.sized && !this.ready) {
                            var t = this.element, e = this.options, n = this.image, i = t.parentNode,
                                r = document.createElement("div");
                            r.innerHTML = '<div class="cropper-container" touch-action="none"><div class="cropper-wrap-box"><div class="cropper-canvas"></div></div><div class="cropper-drag-box"></div><div class="cropper-crop-box"><span class="cropper-view-box"></span><span class="cropper-dashed dashed-h"></span><span class="cropper-dashed dashed-v"></span><span class="cropper-center"></span><span class="cropper-face"></span><span class="cropper-line line-e" data-cropper-action="e"></span><span class="cropper-line line-n" data-cropper-action="n"></span><span class="cropper-line line-w" data-cropper-action="w"></span><span class="cropper-line line-s" data-cropper-action="s"></span><span class="cropper-point point-e" data-cropper-action="e"></span><span class="cropper-point point-n" data-cropper-action="n"></span><span class="cropper-point point-w" data-cropper-action="w"></span><span class="cropper-point point-s" data-cropper-action="s"></span><span class="cropper-point point-ne" data-cropper-action="ne"></span><span class="cropper-point point-nw" data-cropper-action="nw"></span><span class="cropper-point point-sw" data-cropper-action="sw"></span><span class="cropper-point point-se" data-cropper-action="se"></span></div></div>';
                            var a = r.querySelector(".".concat("cropper", "-container")),
                                o = a.querySelector(".".concat("cropper", "-canvas")),
                                s = a.querySelector(".".concat("cropper", "-drag-box")),
                                p = a.querySelector(".".concat("cropper", "-crop-box")),
                                c = p.querySelector(".".concat("cropper", "-face"));
                            this.container = i, this.cropper = a, this.canvas = o, this.dragBox = s, this.cropBox = p, this.viewBox = a.querySelector(".".concat("cropper", "-view-box")), this.face = c, o.appendChild(n), q(t, u), i.insertBefore(a, t.nextSibling), this.isImg || $(n, f), this.initPreview(), this.bind(), e.initialAspectRatio = Math.max(0, e.initialAspectRatio) || NaN, e.aspectRatio = Math.max(0, e.aspectRatio) || NaN, e.viewMode = Math.max(0, Math.min(3, Math.round(e.viewMode))) || 0, q(p, u), e.guides || q(p.getElementsByClassName("".concat("cropper", "-dashed")), u), e.center || q(p.getElementsByClassName("".concat("cropper", "-center")), u), e.background && q(a, "".concat("cropper", "-bg")), e.highlight || q(c, m), e.cropBoxMovable && (q(c, v), tt(c, b, "all")), e.cropBoxResizable || (q(p.getElementsByClassName("".concat("cropper", "-line")), u), q(p.getElementsByClassName("".concat("cropper", "-point")), u)), this.render(), this.ready = !0, this.setDragMode(e.dragMode), e.autoCrop && this.crop(), this.setData(e.data), H(e.ready) && rt(t, "ready", e.ready, {once: !0}), at(t, "ready")
                        }
                    }
                }, {
                    key: "unbuild", value: function () {
                        this.ready && (this.ready = !1, this.unbind(), this.resetPreview(), this.cropper.parentNode.removeChild(this.cropper), $(this.element, u))
                    }
                }, {
                    key: "uncreate", value: function () {
                        this.ready ? (this.unbuild(), this.ready = !1, this.cropped = !1) : this.sizing ? (this.sizingImage.onload = null, this.sizing = !1, this.sized = !1) : this.reloading ? (this.xhr.onabort = null, this.xhr.abort()) : this.image && this.stop()
                    }
                }]) && n(i.prototype, r), a && n(i, a), t
            }();
            return P(Bt.prototype, vt, bt, Ct, wt, xt, Et), Bt
        }()
    }, function (t, e, n) {
        t.exports = n(9)
    }, function (t, e, n) {
        var i = n(2), r = n(6);
        "string" == typeof (r = r.__esModule ? r.default : r) && (r = [[t.i, r, ""]]);
        var a = {insert: "head", singleton: !1};
        i(r, a);
        t.exports = r.locals || {}
    }, function (t, e, n) {
        "use strict";
        n.r(e);
        var i = n(1), r = n.n(i)()(!0);
        r.push([t.i, "/*!\n * Cropper.js v1.5.7\n * https://fengyuanchen.github.io/cropperjs\n *\n * Copyright 2015-present Chen Fengyuan\n * Released under the MIT license\n *\n * Date: 2020-05-23T05:22:57.283Z\n */\n\n.cropper-container {\n  direction: ltr;\n  font-size: 0;\n  line-height: 0;\n  position: relative;\n  -ms-touch-action: none;\n  touch-action: none;\n  -webkit-user-select: none;\n  -moz-user-select: none;\n  -ms-user-select: none;\n  user-select: none;\n}\n\n.cropper-container img {\n  display: block;\n  height: 100%;\n  image-orientation: 0deg;\n  max-height: none !important;\n  max-width: none !important;\n  min-height: 0 !important;\n  min-width: 0 !important;\n  width: 100%;\n}\n\n.cropper-wrap-box,\n.cropper-canvas,\n.cropper-drag-box,\n.cropper-crop-box,\n.cropper-modal {\n  bottom: 0;\n  left: 0;\n  position: absolute;\n  right: 0;\n  top: 0;\n}\n\n.cropper-wrap-box,\n.cropper-canvas {\n  overflow: hidden;\n}\n\n.cropper-drag-box {\n  background-color: #fff;\n  opacity: 0;\n}\n\n.cropper-modal {\n  background-color: #000;\n  opacity: 0.5;\n}\n\n.cropper-view-box {\n  display: block;\n  height: 100%;\n  outline: 1px solid #39f;\n  outline-color: rgba(51, 153, 255, 0.75);\n  overflow: hidden;\n  width: 100%;\n}\n\n.cropper-dashed {\n  border: 0 dashed #eee;\n  display: block;\n  opacity: 0.5;\n  position: absolute;\n}\n\n.cropper-dashed.dashed-h {\n  border-bottom-width: 1px;\n  border-top-width: 1px;\n  height: calc(100% / 3);\n  left: 0;\n  top: calc(100% / 3);\n  width: 100%;\n}\n\n.cropper-dashed.dashed-v {\n  border-left-width: 1px;\n  border-right-width: 1px;\n  height: 100%;\n  left: calc(100% / 3);\n  top: 0;\n  width: calc(100% / 3);\n}\n\n.cropper-center {\n  display: block;\n  height: 0;\n  left: 50%;\n  opacity: 0.75;\n  position: absolute;\n  top: 50%;\n  width: 0;\n}\n\n.cropper-center::before,\n.cropper-center::after {\n  background-color: #eee;\n  content: ' ';\n  display: block;\n  position: absolute;\n}\n\n.cropper-center::before {\n  height: 1px;\n  left: -3px;\n  top: 0;\n  width: 7px;\n}\n\n.cropper-center::after {\n  height: 7px;\n  left: 0;\n  top: -3px;\n  width: 1px;\n}\n\n.cropper-face,\n.cropper-line,\n.cropper-point {\n  display: block;\n  height: 100%;\n  opacity: 0.1;\n  position: absolute;\n  width: 100%;\n}\n\n.cropper-face {\n  background-color: #fff;\n  left: 0;\n  top: 0;\n}\n\n.cropper-line {\n  background-color: #39f;\n}\n\n.cropper-line.line-e {\n  cursor: ew-resize;\n  right: -3px;\n  top: 0;\n  width: 5px;\n}\n\n.cropper-line.line-n {\n  cursor: ns-resize;\n  height: 5px;\n  left: 0;\n  top: -3px;\n}\n\n.cropper-line.line-w {\n  cursor: ew-resize;\n  left: -3px;\n  top: 0;\n  width: 5px;\n}\n\n.cropper-line.line-s {\n  bottom: -3px;\n  cursor: ns-resize;\n  height: 5px;\n  left: 0;\n}\n\n.cropper-point {\n  background-color: #39f;\n  height: 5px;\n  opacity: 0.75;\n  width: 5px;\n}\n\n.cropper-point.point-e {\n  cursor: ew-resize;\n  margin-top: -3px;\n  right: -3px;\n  top: 50%;\n}\n\n.cropper-point.point-n {\n  cursor: ns-resize;\n  left: 50%;\n  margin-left: -3px;\n  top: -3px;\n}\n\n.cropper-point.point-w {\n  cursor: ew-resize;\n  left: -3px;\n  margin-top: -3px;\n  top: 50%;\n}\n\n.cropper-point.point-s {\n  bottom: -3px;\n  cursor: s-resize;\n  left: 50%;\n  margin-left: -3px;\n}\n\n.cropper-point.point-ne {\n  cursor: nesw-resize;\n  right: -3px;\n  top: -3px;\n}\n\n.cropper-point.point-nw {\n  cursor: nwse-resize;\n  left: -3px;\n  top: -3px;\n}\n\n.cropper-point.point-sw {\n  bottom: -3px;\n  cursor: nesw-resize;\n  left: -3px;\n}\n\n.cropper-point.point-se {\n  bottom: -3px;\n  cursor: nwse-resize;\n  height: 20px;\n  opacity: 1;\n  right: -3px;\n  width: 20px;\n}\n\n@media (min-width: 768px) {\n  .cropper-point.point-se {\n    height: 15px;\n    width: 15px;\n  }\n}\n\n@media (min-width: 992px) {\n  .cropper-point.point-se {\n    height: 10px;\n    width: 10px;\n  }\n}\n\n@media (min-width: 1200px) {\n  .cropper-point.point-se {\n    height: 5px;\n    opacity: 0.75;\n    width: 5px;\n  }\n}\n\n.cropper-point.point-se::before {\n  background-color: #39f;\n  bottom: -50%;\n  content: ' ';\n  display: block;\n  height: 200%;\n  opacity: 0;\n  position: absolute;\n  right: -50%;\n  width: 200%;\n}\n\n.cropper-invisible {\n  opacity: 0;\n}\n\n.cropper-bg {\n  background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCSVQICAjb4U/gAAAABlBMVEXMzMz////TjRV2AAAACXBIWXMAAArrAAAK6wGCiw1aAAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC');\n}\n\n.cropper-hide {\n  display: block;\n  height: 0;\n  position: absolute;\n  width: 0;\n}\n\n.cropper-hidden {\n  display: none !important;\n}\n\n.cropper-move {\n  cursor: move;\n}\n\n.cropper-crop {\n  cursor: crosshair;\n}\n\n.cropper-disabled .cropper-drag-box,\n.cropper-disabled .cropper-face,\n.cropper-disabled .cropper-line,\n.cropper-disabled .cropper-point {\n  cursor: not-allowed;\n}\n", "", {
            version: 3,
            sources: ["cropper.css"],
            names: [],
            mappings: "AAAA;;;;;;;;EAQE;;AAEF;EACE,cAAc;EACd,YAAY;EACZ,cAAc;EACd,kBAAkB;EAClB,sBAAsB;EACtB,kBAAkB;EAClB,yBAAyB;EACzB,sBAAsB;EACtB,qBAAqB;EACrB,iBAAiB;AACnB;;AAEA;EACE,cAAc;EACd,YAAY;EACZ,uBAAuB;EACvB,2BAA2B;EAC3B,0BAA0B;EAC1B,wBAAwB;EACxB,uBAAuB;EACvB,WAAW;AACb;;AAEA;;;;;EAKE,SAAS;EACT,OAAO;EACP,kBAAkB;EAClB,QAAQ;EACR,MAAM;AACR;;AAEA;;EAEE,gBAAgB;AAClB;;AAEA;EACE,sBAAsB;EACtB,UAAU;AACZ;;AAEA;EACE,sBAAsB;EACtB,YAAY;AACd;;AAEA;EACE,cAAc;EACd,YAAY;EACZ,uBAAuB;EACvB,uCAAuC;EACvC,gBAAgB;EAChB,WAAW;AACb;;AAEA;EACE,qBAAqB;EACrB,cAAc;EACd,YAAY;EACZ,kBAAkB;AACpB;;AAEA;EACE,wBAAwB;EACxB,qBAAqB;EACrB,sBAAsB;EACtB,OAAO;EACP,mBAAmB;EACnB,WAAW;AACb;;AAEA;EACE,sBAAsB;EACtB,uBAAuB;EACvB,YAAY;EACZ,oBAAoB;EACpB,MAAM;EACN,qBAAqB;AACvB;;AAEA;EACE,cAAc;EACd,SAAS;EACT,SAAS;EACT,aAAa;EACb,kBAAkB;EAClB,QAAQ;EACR,QAAQ;AACV;;AAEA;;EAEE,sBAAsB;EACtB,YAAY;EACZ,cAAc;EACd,kBAAkB;AACpB;;AAEA;EACE,WAAW;EACX,UAAU;EACV,MAAM;EACN,UAAU;AACZ;;AAEA;EACE,WAAW;EACX,OAAO;EACP,SAAS;EACT,UAAU;AACZ;;AAEA;;;EAGE,cAAc;EACd,YAAY;EACZ,YAAY;EACZ,kBAAkB;EAClB,WAAW;AACb;;AAEA;EACE,sBAAsB;EACtB,OAAO;EACP,MAAM;AACR;;AAEA;EACE,sBAAsB;AACxB;;AAEA;EACE,iBAAiB;EACjB,WAAW;EACX,MAAM;EACN,UAAU;AACZ;;AAEA;EACE,iBAAiB;EACjB,WAAW;EACX,OAAO;EACP,SAAS;AACX;;AAEA;EACE,iBAAiB;EACjB,UAAU;EACV,MAAM;EACN,UAAU;AACZ;;AAEA;EACE,YAAY;EACZ,iBAAiB;EACjB,WAAW;EACX,OAAO;AACT;;AAEA;EACE,sBAAsB;EACtB,WAAW;EACX,aAAa;EACb,UAAU;AACZ;;AAEA;EACE,iBAAiB;EACjB,gBAAgB;EAChB,WAAW;EACX,QAAQ;AACV;;AAEA;EACE,iBAAiB;EACjB,SAAS;EACT,iBAAiB;EACjB,SAAS;AACX;;AAEA;EACE,iBAAiB;EACjB,UAAU;EACV,gBAAgB;EAChB,QAAQ;AACV;;AAEA;EACE,YAAY;EACZ,gBAAgB;EAChB,SAAS;EACT,iBAAiB;AACnB;;AAEA;EACE,mBAAmB;EACnB,WAAW;EACX,SAAS;AACX;;AAEA;EACE,mBAAmB;EACnB,UAAU;EACV,SAAS;AACX;;AAEA;EACE,YAAY;EACZ,mBAAmB;EACnB,UAAU;AACZ;;AAEA;EACE,YAAY;EACZ,mBAAmB;EACnB,YAAY;EACZ,UAAU;EACV,WAAW;EACX,WAAW;AACb;;AAEA;EACE;IACE,YAAY;IACZ,WAAW;EACb;AACF;;AAEA;EACE;IACE,YAAY;IACZ,WAAW;EACb;AACF;;AAEA;EACE;IACE,WAAW;IACX,aAAa;IACb,UAAU;EACZ;AACF;;AAEA;EACE,sBAAsB;EACtB,YAAY;EACZ,YAAY;EACZ,cAAc;EACd,YAAY;EACZ,UAAU;EACV,kBAAkB;EAClB,WAAW;EACX,WAAW;AACb;;AAEA;EACE,UAAU;AACZ;;AAEA;EACE,+QAA+Q;AACjR;;AAEA;EACE,cAAc;EACd,SAAS;EACT,kBAAkB;EAClB,QAAQ;AACV;;AAEA;EACE,wBAAwB;AAC1B;;AAEA;EACE,YAAY;AACd;;AAEA;EACE,iBAAiB;AACnB;;AAEA;;;;EAIE,mBAAmB;AACrB",
            file: "cropper.css",
            sourcesContent: ["/*!\n * Cropper.js v1.5.7\n * https://fengyuanchen.github.io/cropperjs\n *\n * Copyright 2015-present Chen Fengyuan\n * Released under the MIT license\n *\n * Date: 2020-05-23T05:22:57.283Z\n */\n\n.cropper-container {\n  direction: ltr;\n  font-size: 0;\n  line-height: 0;\n  position: relative;\n  -ms-touch-action: none;\n  touch-action: none;\n  -webkit-user-select: none;\n  -moz-user-select: none;\n  -ms-user-select: none;\n  user-select: none;\n}\n\n.cropper-container img {\n  display: block;\n  height: 100%;\n  image-orientation: 0deg;\n  max-height: none !important;\n  max-width: none !important;\n  min-height: 0 !important;\n  min-width: 0 !important;\n  width: 100%;\n}\n\n.cropper-wrap-box,\n.cropper-canvas,\n.cropper-drag-box,\n.cropper-crop-box,\n.cropper-modal {\n  bottom: 0;\n  left: 0;\n  position: absolute;\n  right: 0;\n  top: 0;\n}\n\n.cropper-wrap-box,\n.cropper-canvas {\n  overflow: hidden;\n}\n\n.cropper-drag-box {\n  background-color: #fff;\n  opacity: 0;\n}\n\n.cropper-modal {\n  background-color: #000;\n  opacity: 0.5;\n}\n\n.cropper-view-box {\n  display: block;\n  height: 100%;\n  outline: 1px solid #39f;\n  outline-color: rgba(51, 153, 255, 0.75);\n  overflow: hidden;\n  width: 100%;\n}\n\n.cropper-dashed {\n  border: 0 dashed #eee;\n  display: block;\n  opacity: 0.5;\n  position: absolute;\n}\n\n.cropper-dashed.dashed-h {\n  border-bottom-width: 1px;\n  border-top-width: 1px;\n  height: calc(100% / 3);\n  left: 0;\n  top: calc(100% / 3);\n  width: 100%;\n}\n\n.cropper-dashed.dashed-v {\n  border-left-width: 1px;\n  border-right-width: 1px;\n  height: 100%;\n  left: calc(100% / 3);\n  top: 0;\n  width: calc(100% / 3);\n}\n\n.cropper-center {\n  display: block;\n  height: 0;\n  left: 50%;\n  opacity: 0.75;\n  position: absolute;\n  top: 50%;\n  width: 0;\n}\n\n.cropper-center::before,\n.cropper-center::after {\n  background-color: #eee;\n  content: ' ';\n  display: block;\n  position: absolute;\n}\n\n.cropper-center::before {\n  height: 1px;\n  left: -3px;\n  top: 0;\n  width: 7px;\n}\n\n.cropper-center::after {\n  height: 7px;\n  left: 0;\n  top: -3px;\n  width: 1px;\n}\n\n.cropper-face,\n.cropper-line,\n.cropper-point {\n  display: block;\n  height: 100%;\n  opacity: 0.1;\n  position: absolute;\n  width: 100%;\n}\n\n.cropper-face {\n  background-color: #fff;\n  left: 0;\n  top: 0;\n}\n\n.cropper-line {\n  background-color: #39f;\n}\n\n.cropper-line.line-e {\n  cursor: ew-resize;\n  right: -3px;\n  top: 0;\n  width: 5px;\n}\n\n.cropper-line.line-n {\n  cursor: ns-resize;\n  height: 5px;\n  left: 0;\n  top: -3px;\n}\n\n.cropper-line.line-w {\n  cursor: ew-resize;\n  left: -3px;\n  top: 0;\n  width: 5px;\n}\n\n.cropper-line.line-s {\n  bottom: -3px;\n  cursor: ns-resize;\n  height: 5px;\n  left: 0;\n}\n\n.cropper-point {\n  background-color: #39f;\n  height: 5px;\n  opacity: 0.75;\n  width: 5px;\n}\n\n.cropper-point.point-e {\n  cursor: ew-resize;\n  margin-top: -3px;\n  right: -3px;\n  top: 50%;\n}\n\n.cropper-point.point-n {\n  cursor: ns-resize;\n  left: 50%;\n  margin-left: -3px;\n  top: -3px;\n}\n\n.cropper-point.point-w {\n  cursor: ew-resize;\n  left: -3px;\n  margin-top: -3px;\n  top: 50%;\n}\n\n.cropper-point.point-s {\n  bottom: -3px;\n  cursor: s-resize;\n  left: 50%;\n  margin-left: -3px;\n}\n\n.cropper-point.point-ne {\n  cursor: nesw-resize;\n  right: -3px;\n  top: -3px;\n}\n\n.cropper-point.point-nw {\n  cursor: nwse-resize;\n  left: -3px;\n  top: -3px;\n}\n\n.cropper-point.point-sw {\n  bottom: -3px;\n  cursor: nesw-resize;\n  left: -3px;\n}\n\n.cropper-point.point-se {\n  bottom: -3px;\n  cursor: nwse-resize;\n  height: 20px;\n  opacity: 1;\n  right: -3px;\n  width: 20px;\n}\n\n@media (min-width: 768px) {\n  .cropper-point.point-se {\n    height: 15px;\n    width: 15px;\n  }\n}\n\n@media (min-width: 992px) {\n  .cropper-point.point-se {\n    height: 10px;\n    width: 10px;\n  }\n}\n\n@media (min-width: 1200px) {\n  .cropper-point.point-se {\n    height: 5px;\n    opacity: 0.75;\n    width: 5px;\n  }\n}\n\n.cropper-point.point-se::before {\n  background-color: #39f;\n  bottom: -50%;\n  content: ' ';\n  display: block;\n  height: 200%;\n  opacity: 0;\n  position: absolute;\n  right: -50%;\n  width: 200%;\n}\n\n.cropper-invisible {\n  opacity: 0;\n}\n\n.cropper-bg {\n  background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCSVQICAjb4U/gAAAABlBMVEXMzMz////TjRV2AAAACXBIWXMAAArrAAAK6wGCiw1aAAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC');\n}\n\n.cropper-hide {\n  display: block;\n  height: 0;\n  position: absolute;\n  width: 0;\n}\n\n.cropper-hidden {\n  display: none !important;\n}\n\n.cropper-move {\n  cursor: move;\n}\n\n.cropper-crop {\n  cursor: crosshair;\n}\n\n.cropper-disabled .cropper-drag-box,\n.cropper-disabled .cropper-face,\n.cropper-disabled .cropper-line,\n.cropper-disabled .cropper-point {\n  cursor: not-allowed;\n}\n"]
        }]), e.default = r
    }, function (t, e, n) {
        "use strict";
        var i = n(0);
        n.n(i).a
    }, function (t, e, n) {
        "use strict";
        n.r(e);
        var i = n(1), r = n.n(i)()(!0);
        r.push([t.i, ".avatar-cropper .avatar-cropper-overlay {\n  text-align: center;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  position: fixed;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  z-index: 99999;\n}\n.avatar-cropper .avatar-cropper-img-input {\n  display: none;\n}\n.avatar-cropper .avatar-cropper-close {\n  float: right;\n  padding: 20px;\n  font-size: 3rem;\n  color: #fff;\n  font-weight: 100;\n  text-shadow: 0px 1px rgba(40, 40, 40, 0.3);\n}\n.avatar-cropper .avatar-cropper-mark {\n  position: fixed;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  background: rgba(0, 0, 0, 0.1);\n}\n.avatar-cropper .avatar-cropper-container {\n  background: #fff;\n  z-index: 999;\n  box-shadow: 1px 1px 5px rgba(100, 100, 100, 0.14);\n}\n.avatar-cropper .avatar-cropper-container .avatar-cropper-image-container {\n  position: relative;\n  max-width: 400px;\n  height: 300px;\n}\n.avatar-cropper .avatar-cropper-container img {\n  max-width: 100%;\n  height: 100%;\n}\n.avatar-cropper .avatar-cropper-container .avatar-cropper-footer {\n  display: flex;\n  align-items: stretch;\n  align-content: stretch;\n  justify-content: space-between;\n}\n.avatar-cropper .avatar-cropper-container .avatar-cropper-footer .avatar-cropper-btn {\n  width: 50%;\n  padding: 15px 0;\n  cursor: pointer;\n  border: none;\n  background: transparent;\n  outline: none;\n}\n.avatar-cropper .avatar-cropper-container .avatar-cropper-footer .avatar-cropper-btn:hover {\n  background-color: #2aabd2;\n  color: #fff;\n}\n", "", {
            version: 3,
            sources: ["AvatarCropper.vue"],
            names: [],
            mappings: "AAAA;EACE,kBAAkB;EAClB,aAAa;EACb,mBAAmB;EACnB,uBAAuB;EACvB,eAAe;EACf,MAAM;EACN,OAAO;EACP,QAAQ;EACR,SAAS;EACT,cAAc;AAChB;AACA;EACE,aAAa;AACf;AACA;EACE,YAAY;EACZ,aAAa;EACb,eAAe;EACf,WAAW;EACX,gBAAgB;EAChB,0CAA0C;AAC5C;AACA;EACE,eAAe;EACf,MAAM;EACN,OAAO;EACP,QAAQ;EACR,SAAS;EACT,8BAA8B;AAChC;AACA;EACE,gBAAgB;EAChB,YAAY;EACZ,iDAAiD;AACnD;AACA;EACE,kBAAkB;EAClB,gBAAgB;EAChB,aAAa;AACf;AACA;EACE,eAAe;EACf,YAAY;AACd;AACA;EACE,aAAa;EACb,oBAAoB;EACpB,sBAAsB;EACtB,8BAA8B;AAChC;AACA;EACE,UAAU;EACV,eAAe;EACf,eAAe;EACf,YAAY;EACZ,uBAAuB;EACvB,aAAa;AACf;AACA;EACE,yBAAyB;EACzB,WAAW;AACb",
            file: "AvatarCropper.vue",
            sourcesContent: [".avatar-cropper .avatar-cropper-overlay {\n  text-align: center;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  position: fixed;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  z-index: 99999;\n}\n.avatar-cropper .avatar-cropper-img-input {\n  display: none;\n}\n.avatar-cropper .avatar-cropper-close {\n  float: right;\n  padding: 20px;\n  font-size: 3rem;\n  color: #fff;\n  font-weight: 100;\n  text-shadow: 0px 1px rgba(40, 40, 40, 0.3);\n}\n.avatar-cropper .avatar-cropper-mark {\n  position: fixed;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  background: rgba(0, 0, 0, 0.1);\n}\n.avatar-cropper .avatar-cropper-container {\n  background: #fff;\n  z-index: 999;\n  box-shadow: 1px 1px 5px rgba(100, 100, 100, 0.14);\n}\n.avatar-cropper .avatar-cropper-container .avatar-cropper-image-container {\n  position: relative;\n  max-width: 400px;\n  height: 300px;\n}\n.avatar-cropper .avatar-cropper-container img {\n  max-width: 100%;\n  height: 100%;\n}\n.avatar-cropper .avatar-cropper-container .avatar-cropper-footer {\n  display: flex;\n  align-items: stretch;\n  align-content: stretch;\n  justify-content: space-between;\n}\n.avatar-cropper .avatar-cropper-container .avatar-cropper-footer .avatar-cropper-btn {\n  width: 50%;\n  padding: 15px 0;\n  cursor: pointer;\n  border: none;\n  background: transparent;\n  outline: none;\n}\n.avatar-cropper .avatar-cropper-container .avatar-cropper-footer .avatar-cropper-btn:hover {\n  background-color: #2aabd2;\n  color: #fff;\n}\n"]
        }]), e.default = r
    }, function (t, e, n) {
        "use strict";
        n.r(e);
        n(5);
        var i = n(3), r = n.n(i);

        function a(t) {
            return (a = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
                return typeof t
            } : function (t) {
                return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
            })(t)
        }

        var o = {
            props: {
                trigger: {type: [String, Element], required: !0},
                uploadHandler: {type: Function},
                uploadUrl: {type: String},
                requestMethod: {type: String, default: "POST"},
                uploadHeaders: {type: Object},
                uploadFormName: {type: String, default: "file"},
                uploadFormData: {
                    type: Object, default: function () {
                        return {}
                    }
                },
                cropperOptions: {
                    type: Object, default: function () {
                        return {aspectRatio: 1, autoCropArea: 1, viewMode: 1, movable: !1, zoomable: !1}
                    }
                },
                outputOptions: {type: Object},
                outputMime: {type: String, default: null},
                outputQuality: {type: Number, default: .9},
                mimes: {type: String, default: "image/png, image/gif, image/jpeg, image/bmp, image/x-icon"},
                labels: {
                    type: Object, default: function () {
                        return {submit: "提交", cancel: "取消"}
                    }
                },
                withCredentials: {type: Boolean, default: !1}
            }, data: function () {
                return {cropper: void 0, dataUrl: void 0, filename: void 0}
            }, methods: {
                destroy: function () {
                    this.cropper.destroy(), this.$refs.input.value = "", this.dataUrl = void 0
                }, submit: function () {
                    this.$emit("submit"), this.uploadUrl ? this.uploadImage() : this.uploadHandler ? this.uploadHandler(this.cropper) : this.$emit("error", "No upload handler found.", "user"), this.destroy()
                }, pickImage: function (t) {
                    this.$refs.input.click(), t.preventDefault(), t.stopPropagation()
                }, createCropper: function () {
                    this.cropper = new r.a(this.$refs.img, this.cropperOptions)
                }, uploadImage: function () {
                    var t = this;
                    this.cropper.getCroppedCanvas(this.outputOptions).toBlob((function (e) {
                        var n = new FormData, i = new XMLHttpRequest, r = Object.assign({}, t.uploadFormData);
                        for (var a in i.withCredentials = t.withCredentials, r) n.append(a, r[a]);
                        for (var o in n.append(t.uploadFormName, e, t.filename), t.$emit("uploading", n, i), i.open(t.requestMethod, t.uploadUrl, !0), t.uploadHeaders) i.setRequestHeader(o, t.uploadHeaders[o]);
                        i.onreadystatechange = function () {
                            if (4 === i.readyState) {
                                var e = "";
                                try {
                                    e = JSON.parse(i.responseText)
                                } catch (t) {
                                    e = i.responseText
                                }
                                t.$emit("completed", e, n, i), [200, 201, 204].indexOf(i.status) > -1 ? t.$emit("uploaded", e, n, i) : t.$emit("error", "Image upload fail.", "upload", i)
                            }
                        }, i.send(n)
                    }), this.outputMime, this.outputQuality)
                }
            }, mounted: function () {
                var t = this, e = "object" == a(this.trigger) ? this.trigger : document.querySelector(this.trigger);
                e ? e.addEventListener("click", this.pickImage) : this.$emit("error", "No avatar make trigger found.", "user");
                var n = this.$refs.input;
                n.addEventListener("change", (function () {
                    if (null != n.files && null != n.files[0]) {
                        var e = new FileReader;
                        e.onload = function (e) {
                            t.dataUrl = e.target.result
                        }, e.readAsDataURL(n.files[0]), t.filename = n.files[0].name || "unknown", t.mimeType = t.mimeType || n.files[0].type, t.$emit("changed", n.files[0], e)
                    }
                }))
            }
        };
        n(7);
        var s = function (t, e, n, i, r, a, o, s) {
            var p, c = "function" == typeof t ? t.options : t;
            if (e && (c.render = e, c.staticRenderFns = n, c._compiled = !0), i && (c.functional = !0), a && (c._scopeId = "data-v-" + a), o ? (p = function (t) {
                (t = t || this.$vnode && this.$vnode.ssrContext || this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) || "undefined" == typeof __VUE_SSR_CONTEXT__ || (t = __VUE_SSR_CONTEXT__), r && r.call(this, t), t && t._registeredComponents && t._registeredComponents.add(o)
            }, c._ssrRegister = p) : r && (p = s ? function () {
                r.call(this, (c.functional ? this.parent : this).$root.$options.shadowRoot)
            } : r), p) if (c.functional) {
                c._injectStyles = p;
                var h = c.render;
                c.render = function (t, e) {
                    return p.call(e), h(t, e)
                }
            } else {
                var l = c.beforeCreate;
                c.beforeCreate = l ? [].concat(l, p) : [p]
            }
            return {exports: t, options: c}
        }(o, (function () {
            var t = this, e = t.$createElement, n = t._self._c || e;
            return n("div", {staticClass: "avatar-cropper"}, [t.dataUrl ? n("div", {staticClass: "avatar-cropper-overlay"}, [n("div", {staticClass: "avatar-cropper-mark"}, [n("a", {
                staticClass: "avatar-cropper-close",
                attrs: {href: "javascript:;"},
                on: {click: t.destroy}
            }, [t._v("×")])]), t._v(" "), n("div", {staticClass: "avatar-cropper-container"}, [n("div", {staticClass: "avatar-cropper-image-container"}, [n("img", {
                ref: "img",
                attrs: {src: t.dataUrl, alt: ""},
                on: {
                    load: function (e) {
                        return e.stopPropagation(), t.createCropper(e)
                    }
                }
            })]), t._v(" "), n("div", {staticClass: "avatar-cropper-footer"}, [n("button", {
                staticClass: "avatar-cropper-btn",
                domProps: {textContent: t._s(t.labels.cancel)},
                on: {
                    click: function (e) {
                        return e.stopPropagation(), e.preventDefault(), t.destroy(e)
                    }
                }
            }, [t._v("Cancel")]), t._v(" "), n("button", {
                staticClass: "avatar-cropper-btn",
                domProps: {textContent: t._s(t.labels.submit)},
                on: {
                    click: function (e) {
                        return e.stopPropagation(), e.preventDefault(), t.submit(e)
                    }
                }
            }, [t._v("Submit")])])])]) : t._e(), t._v(" "), n("input", {
                ref: "input",
                staticClass: "avatar-cropper-img-input",
                attrs: {accept: t.mimes, type: "file"}
            })])
        }), [], !1, null, null, null).exports;
        e.default = s
    }])
}));