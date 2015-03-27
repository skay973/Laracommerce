(function($) {
    $.fn.lightbox_me = function(options) {
        return this.each(function() {
            var
                opts = $.extend({}, $.fn.lightbox_me.defaults, options),
                $overlay = $('<div class="' + opts.classPrefix + '_overlay"/>'),
                $self = $(this),
                $iframe = $('<iframe id="foo" style="z-index: ' + (opts.zIndex + 1) + '; display: none; border: none; margin: 0; padding: 0; position: absolute; width: 100%; height: 100%; top: 0; left: 0;"/>'),
                ie6 = ($.browser.msie && $.browser.version < 7);
            if (ie6) {
                var src = /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank';
                $iframe.attr('src', src);
                $('body').append($iframe);
            }
            $('body').append($self).append($overlay);
            setSelfPosition();
            $self.css({
                left: '50%',
                marginLeft: ($self.outerWidth() / 2) * -1,
                zIndex: (opts.zIndex + 3)
            });
            setOverlayHeight();
            $overlay.css({
                position: 'absolute',
                width: '100%',
                top: 0,
                left: 0,
                right: 0,
                bottom: 0,
                zIndex: (opts.zIndex + 2),
                display: 'none'
            }).css(opts.overlayCSS);
            $overlay.fadeIn(opts.overlaySpeed, function() {
                $self[opts.appearEffect](opts.lightboxSpeed, function() {
                    setOverlayHeight();
                    opts.onLoad()
                });
            });
            $(window).resize(setOverlayHeight).resize(setSelfPosition).scroll(setSelfPosition).keypress(observeEscapePress);
            $self.find(opts.closeSelector).add($overlay).click(function() {
                closeLightbox();
                return false;
            });
            $self.bind('close', closeLightbox);
            $self.bind('resize', setSelfPosition);

            function closeLightbox() {
                if (opts.destroyOnClose) {
                    $self.add($overlay).remove();
                } else {
                    $self.add($overlay).hide();
                }
                $iframe.remove();
                $(window).unbind('resize', setOverlayHeight);
                $(window).unbind('resize', setSelfPosition);
                opts.onClose();
            }

            function observeEscapePress(e) {
                if (e.keyCode == 27 || (e.DOM_VK_ESCAPE == 27 && e.which == 0)) closeLightbox();
            }

            function setOverlayHeight() {
                if ($(window).height() < $(document).height()) {
                    $overlay.css({
                        height: $(document).height() + 'px'
                    });
                } else {
                    $overlay.css({
                        height: '100%'
                    });
                    if (ie6) {
                        $('html,body').css('height', '100%');
                    }
                }
            }

            function setSelfPosition() {
                var s = $self[0].style;
                if (($self.height() + 80 >= $(window).height()) && ($self.css('position') != 'absolute' || ie6)) {
                    var topOffset = $(document).scrollTop() + 40;
                    $self.css({
                        position: 'absolute',
                        top: topOffset + 'px',
                        marginTop: 0
                    })
                    if (ie6) {
                        s.removeExpression('top');
                    }
                } else if ($self.height() + 80 < $(window).height()) {
                    if (ie6) {
                        s.position = 'absolute';
                        if (opts.centered) {
                            s.setExpression('top', '(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"')
                            s.marginTop = 0;
                        } else {
                            var top = (opts.modalCSS && opts.modalCSS.top) ? parseInt(opts.modalCSS.top) : 0;
                            s.setExpression('top', '((blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + ' + top + ') + "px"')
                        }
                    } else {
                        if (opts.centered) {
                            $self.css({
                                position: 'fixed',
                                top: '50%',
                                marginTop: ($self.outerHeight() / 2) * -1
                            })
                        } else {
                            $self.css({
                                position: 'fixed'
                            }).css(opts.modalCSS);
                        }
                    }
                }
            }
        });
    };
    $.fn.lightbox_me.defaults = {
        appearEffect: "fadeIn",
        overlaySpeed: 300,
        lightboxSpeed: "fast",
        closeSelector: ".close",
        closeClick: true,
        closeEsc: true,
        destroyOnClose: false,
        onLoad: function() {},
        onClose: function() {},
        classPrefix: 'lb',
        zIndex: 999,
        centered: false,
        modalCSS: {
            top: '40px'
        },
        overlayCSS: {
            background: 'black',
            opacity: .6
        }
    }
})(jQuery);;
var json_parse = (function() {
    var at, ch, escapee = {
            '"': '"',
            '\\': '\\',
            '/': '/',
            b: '\b',
            f: '\f',
            n: '\n',
            r: '\r',
            t: '\t'
        },
        text, error = function(m) {
            throw {
                name: 'SyntaxError',
                message: m,
                at: at,
                text: text
            };
        },
        next = function(c) {
            if (c && c !== ch) {
                error("Expected '" + c + "' instead of '" + ch + "'");
            }
            ch = text.charAt(at);
            at += 1;
            return ch;
        },
        number = function() {
            var number, string = '';
            if (ch === '-') {
                string = '-';
                next('-');
            }
            while (ch >= '0' && ch <= '9') {
                string += ch;
                next();
            }
            if (ch === '.') {
                string += '.';
                while (next() && ch >= '0' && ch <= '9') {
                    string += ch;
                }
            }
            if (ch === 'e' || ch === 'E') {
                string += ch;
                next();
                if (ch === '-' || ch === '+') {
                    string += ch;
                    next();
                }
                while (ch >= '0' && ch <= '9') {
                    string += ch;
                    next();
                }
            }
            number = +string;
            if (isNaN(number)) {
                error("Bad number");
            } else {
                return number;
            }
        },
        string = function() {
            var hex, i, string = '',
                uffff;
            if (ch === '"') {
                while (next()) {
                    if (ch === '"') {
                        next();
                        return string;
                    } else if (ch === '\\') {
                        next();
                        if (ch === 'u') {
                            uffff = 0;
                            for (i = 0; i < 4; i += 1) {
                                hex = parseInt(next(), 16);
                                if (!isFinite(hex)) {
                                    break;
                                }
                                uffff = uffff * 16 + hex;
                            }
                            string += String.fromCharCode(uffff);
                        } else if (typeof escapee[ch] === 'string') {
                            string += escapee[ch];
                        } else {
                            break;
                        }
                    } else {
                        string += ch;
                    }
                }
            }
            error("Bad string");
        },
        white = function() {
            while (ch && ch <= ' ') {
                next();
            }
        },
        word = function() {
            switch (ch) {
                case 't':
                    next('t');
                    next('r');
                    next('u');
                    next('e');
                    return true;
                case 'f':
                    next('f');
                    next('a');
                    next('l');
                    next('s');
                    next('e');
                    return false;
                case 'n':
                    next('n');
                    next('u');
                    next('l');
                    next('l');
                    return null;
            }
            error("Unexpected '" + ch + "'");
        },
        value, array = function() {
            var array = [];
            if (ch === '[') {
                next('[');
                white();
                if (ch === ']') {
                    next(']');
                    return array;
                }
                while (ch) {
                    array.push(value());
                    white();
                    if (ch === ']') {
                        next(']');
                        return array;
                    }
                    next(',');
                    white();
                }
            }
            error("Bad array");
        },
        object = function() {
            var key, object = {};
            if (ch === '{') {
                next('{');
                white();
                if (ch === '}') {
                    next('}');
                    return object;
                }
                while (ch) {
                    key = string();
                    white();
                    next(':');
                    if (Object.hasOwnProperty.call(object, key)) {
                        error('Duplicate key "' + key + '"');
                    }
                    object[key] = value();
                    white();
                    if (ch === '}') {
                        next('}');
                        return object;
                    }
                    next(',');
                    white();
                }
            }
            error("Bad object");
        };
    value = function() {
        white();
        switch (ch) {
            case '{':
                return object();
            case '[':
                return array();
            case '"':
                return string();
            case '-':
                return number();
            default:
                return ch >= '0' && ch <= '9' ? number() : word();
        }
    };
    return function(source, reviver) {
        var result;
        text = source;
        at = 0;
        ch = ' ';
        result = value();
        white();
        if (ch) {
            error("Syntax error");
        }
        return typeof reviver === 'function' ? (function walk(holder, key) {
            var k, v, value = holder[key];
            if (value && typeof value === 'object') {
                for (k in value) {
                    if (Object.hasOwnProperty.call(value, k)) {
                        v = walk(value, k);
                        if (v !== undefined) {
                            value[k] = v;
                        } else {
                            delete value[k];
                        }
                    }
                }
            }
            return reviver.call(holder, key, value);
        }({
            '': result
        }, '')) : result;
    };
}());;
(function(C) {
    function A(F, D, E) {
        this.dec = F;
        this.group = D;
        this.neg = E
    }

    function B(D) {
        var G = ".";
        var E = ",";
        var F = "-";
        if (D == "us" || D == "ae" || D == "eg" || D == "il" || D == "jp" || D == "sk" || D == "th" || D == "cn" || D == "hk" || D == "tw" || D == "au" || D == "ca" || D == "gb" || D == "in") {
            G = ".";
            E = ","
        } else {
            if (D == "de" || D == "vn" || D == "es" || D == "dk" || D == "at" || D == "gr" || D == "br") {
                G = ",";
                E = "."
            } else {
                if (D == "cz" || D == "fr" || D == "fi" || D == "ru" || D == "se") {
                    E = " ";
                    G = ","
                } else {
                    if (D == "ch") {
                        E = "'";
                        G = "."
                    }
                }
            }
        }
        return new A(G, E, F)
    }
    C.formatNumber = function(F, E) {
        var E = C.extend({}, C.fn.parse.defaults, E);
        var H = B(E.locale.toLowerCase());
        var J = H.dec;
        var G = H.group;
        var I = H.neg;
        var D = new String(F);
        D = D.replace(".", J).replace("-", I);
        return D
    };
    C.fn.parse = function(D) {
        var D = C.extend({}, C.fn.parse.defaults, D);
        var G = B(D.locale.toLowerCase());
        var J = G.dec;
        var F = G.group;
        var I = G.neg;
        var E = "1234567890.-";
        var H = [];
        this.each(function() {
            var O = new String(C(this).text());
            if (C(this).is(":input")) {
                O = new String(C(this).val())
            }
            while (O.indexOf(F) > -1) {
                O = O.replace(F, "")
            }
            O = O.replace(J, ".").replace(I, "-");
            var N = "";
            var K = false;
            if (O.charAt(O.length - 1) == "%") {
                K = true
            }
            for (var L = 0; L < O.length; L++) {
                if (E.indexOf(O.charAt(L)) > -1) {
                    N = N + O.charAt(L)
                }
            }
            var M = new Number(N);
            if (K) {
                M = M / 100;
                M = M.toFixed(N.length - 1)
            }
            H.push(M)
        });
        return H
    };
    C.fn.format = function(D) {
        var D = C.extend({}, C.fn.format.defaults, D);
        var F = B(D.locale.toLowerCase());
        var I = F.dec;
        var E = F.group;
        var H = F.neg;
        var G = "0#-,.";
        return this.each(function() {
            var U = new String(C(this).text());
            if (C(this).is(":input")) {
                U = new String(C(this).val())
            }
            var Y = "";
            var O = false;
            for (var Z = 0; Z < D.format.length; Z++) {
                if (G.indexOf(D.format.charAt(Z)) == -1) {
                    Y = Y + D.format.charAt(Z)
                } else {
                    if (Z == 0 && D.format.charAt(Z) == "-") {
                        O = true;
                        continue
                    } else {
                        break
                    }
                }
            }
            var K = "";
            for (var Z = D.format.length - 1; Z >= 0; Z--) {
                if (G.indexOf(D.format.charAt(Z)) == -1) {
                    K = D.format.charAt(Z) + K
                } else {
                    break
                }
            }
            D.format = D.format.substring(Y.length);
            D.format = D.format.substring(0, D.format.length - K.length);
            while (U.indexOf(E) > -1) {
                U = U.replace(E, "")
            }
            var J = new Number(U.replace(I, ".").replace(H, "-"));
            if (K == "%") {
                J = J * 100
            }
            var T = "";
            var S = J % 1;
            if (D.format.indexOf(".") > -1) {
                var X = I;
                var P = D.format.substring(D.format.lastIndexOf(".") + 1);
                var V = new String(S.toFixed(P.length));
                V = V.substring(V.lastIndexOf(".") + 1);
                for (var Z = 0; Z < P.length; Z++) {
                    if (P.charAt(Z) == "#" && V.charAt(Z) != "0") {
                        X += V.charAt(Z);
                        continue
                    } else {
                        if (P.charAt(Z) == "#" && V.charAt(Z) == "0") {
                            var N = V.substring(Z);
                            if (N.match("[1-9]")) {
                                X += V.charAt(Z);
                                continue
                            } else {
                                break
                            }
                        } else {
                            if (P.charAt(Z) == "0") {
                                X += V.charAt(Z)
                            }
                        }
                    }
                }
                T += X
            } else {
                J = Math.round(J)
            }
            var Q = Math.floor(J);
            if (J < 0) {
                Q = Math.ceil(J)
            }
            var a = "";
            if (Q == 0) {
                a = "0"
            } else {
                var W = "";
                if (D.format.indexOf(".") == -1) {
                    W = D.format
                } else {
                    W = D.format.substring(0, D.format.indexOf("."))
                }
                var R = new String(Math.abs(Q));
                var M = 9999;
                if (W.lastIndexOf(",") != -1) {
                    M = W.length - W.lastIndexOf(",") - 1
                }
                var L = 0;
                for (var Z = R.length - 1; Z > -1; Z--) {
                    a = R.charAt(Z) + a;
                    L++;
                    if (L == M && Z != 0) {
                        a = E + a;
                        L = 0
                    }
                }
            }
            T = a + T;
            if (J < 0 && O && Y.length > 0) {
                Y = H + Y
            } else {
                if (J < 0) {
                    T = H + T
                }
            }
            if (!D.decimalSeparatorAlwaysShown) {
                if (T.lastIndexOf(I) == T.length - 1) {
                    T = T.substring(0, T.length - 1)
                }
            }
            T = Y + T + K;
            if (C(this).is(":input")) {
                C(this).val(T)
            } else {
                C(this).text(T)
            }
        })
    };
    C.fn.parse.defaults = {
        locale: "us",
        decimalSeparatorAlwaysShown: false
    };
    C.fn.format.defaults = {
        format: "#,###.00",
        locale: "us",
        decimalSeparatorAlwaysShown: false
    }
})(jQuery);;
(function(a) {
    var b = "input.mask",
        c = window.orientation != undefined;
    a.mask = {
        definitions: {
            9: "[0-9]",
            a: "[A-Za-z]",
            "*": "[A-Za-z0-9]"
        },
        dataName: "rawMaskFn"
    }, a.fn.extend({
        caret: function(a, b) {
            if (this.length != 0) {
                if (typeof a == "number") {
                    b = typeof b == "number" ? b : a;
                    return this.each(function() {
                        if (this.setSelectionRange) this.setSelectionRange(a, b);
                        else if (this.createTextRange) {
                            var c = this.createTextRange();
                            c.collapse(!0), c.moveEnd("character", b), c.moveStart("character", a), c.select()
                        }
                    })
                }
                if (this[0].setSelectionRange) a = this[0].selectionStart, b = this[0].selectionEnd;
                else if (document.selection && document.selection.createRange) {
                    var c = document.selection.createRange();
                    a = 0 - c.duplicate().moveStart("character", -1e5), b = a + c.text.length
                }
                return {
                    begin: a,
                    end: b
                }
            }
        },
        unmask: function() {
            return this.trigger("unmask")
        },
        mask: function(d, e) {
            if (!d && this.length > 0) {
                var f = a(this[0]);
                return f.data(a.mask.dataName)()
            }
            e = a.extend({
                placeholder: "_",
                completed: null
            }, e);
            var g = a.mask.definitions,
                h = [],
                i = d.length,
                j = null,
                k = d.length;
            a.each(d.split(""), function(a, b) {
                b == "?" ? (k--, i = a) : g[b] ? (h.push(new RegExp(g[b])), j == null && (j = h.length - 1)) : h.push(null)
            });
            return this.trigger("unmask").each(function() {
                function v(a) {
                    var b = f.val(),
                        c = -1;
                    for (var d = 0, g = 0; d < k; d++)
                        if (h[d]) {
                            l[d] = e.placeholder;
                            while (g++ < b.length) {
                                var m = b.charAt(g - 1);
                                if (h[d].test(m)) {
                                    l[d] = m, c = d;
                                    break
                                }
                            }
                            if (g > b.length) break
                        } else l[d] == b.charAt(g) && d != i && (g++, c = d);
                    if (!a && c + 1 < i) f.val(""), t(0, k);
                    else if (a || c + 1 >= i) u(), a || f.val(f.val().substring(0, c + 1));
                    return i ? d : j
                }

                function u() {
                    return f.val(l.join("")).val()
                }

                function t(a, b) {
                    for (var c = a; c < b && c < k; c++) h[c] && (l[c] = e.placeholder)
                }

                function s(a) {
                    var b = a.which,
                        c = f.caret();
                    if (a.ctrlKey || a.altKey || a.metaKey || b < 32) return !0;
                    if (b) {
                        c.end - c.begin != 0 && (t(c.begin, c.end), p(c.begin, c.end - 1));
                        var d = n(c.begin - 1);
                        if (d < k) {
                            var g = String.fromCharCode(b);
                            if (h[d].test(g)) {
                                q(d), l[d] = g, u();
                                var i = n(d);
                                f.caret(i), e.completed && i >= k && e.completed.call(f)
                            }
                        }
                        return !1
                    }
                }

                function r(a) {
                    var b = a.which;
                    if (b == 8 || b == 46 || c && b == 127) {
                        var d = f.caret(),
                            e = d.begin,
                            g = d.end;
                        g - e == 0 && (e = b != 46 ? o(e) : g = n(e - 1), g = b == 46 ? n(g) : g), t(e, g), p(e, g - 1);
                        return !1
                    }
                    if (b == 27) {
                        f.val(m), f.caret(0, v());
                        return !1
                    }
                }

                function q(a) {
                    for (var b = a, c = e.placeholder; b < k; b++)
                        if (h[b]) {
                            var d = n(b),
                                f = l[b];
                            l[b] = c;
                            if (d < k && h[d].test(f)) c = f;
                            else break
                        }
                }

                function p(a, b) {
                    if (!(a < 0)) {
                        for (var c = a, d = n(b); c < k; c++)
                            if (h[c]) {
                                if (d < k && h[c].test(l[d])) l[c] = l[d], l[d] = e.placeholder;
                                else break;
                                d = n(d)
                            }
                        u(), f.caret(Math.max(j, a))
                    }
                }

                function o(a) {
                    while (--a >= 0 && !h[a]);
                    return a
                }

                function n(a) {
                    while (++a <= k && !h[a]);
                    return a
                }
                var f = a(this),
                    l = a.map(d.split(""), function(a, b) {
                        if (a != "?") return g[a] ? e.placeholder : a
                    }),
                    m = f.val();
                f.data(a.mask.dataName, function() {
                    return a.map(l, function(a, b) {
                        return h[b] && a != e.placeholder ? a : null
                    }).join("")
                }), f.attr("readonly") || f.one("unmask", function() {
                    f.unbind(".mask").removeData(a.mask.dataName)
                }).bind("focus.mask", function() {
                    m = f.val();
                    var b = v();
                    u();
                    var c = function() {
                        b == d.length ? f.caret(0, b) : f.caret(b)
                    };
                    (function() {
                        setTimeout(c, 0)
                    })()
                }).bind("blur.mask", function() {
                    v(), f.val() != m && f.change()
                }).bind("keydown.mask", r).bind("keypress.mask", s).bind(b, function() {
                    setTimeout(function() {
                        f.caret(v(!0))
                    }, 0)
                }), v()
            })
        }
    })
})(jQuery);

$(document).ready(function() {
    $('input.default-value').addClass('default-value-inactive');
    var default_values = new Array();
    $('input.default-value').on('focus', function() {
        if (!default_values[this.id]) {
            default_values[this.id] = this.value;
        }
        if (this.value == default_values[this.id]) {
            this.value = '';
            $(this).removeClass('default-value-inactive');
        }
        $(this).blur(function() {
            if (this.value == '' || this.value == '                                       ') {
                $(this).addClass('default-value-inactive');
                this.value = default_values[this.id];
            }
        });
    });
});

var regions_departements = { "42" : [ { "67" : "Bas-rhin" }, { "68" : "Haut-rhin" } ],
							 "72" : [ { "24" : "Dordogne" }, { "33" : "Gironde" }, { "40" : "Landes" }, { "47" : "Lot-et-garonne" }, { "64" : "Pyrénées-Atlantiques" } ],
							 "83" : [ { "03" : "Allier" }, { "15" : "Cantal" }, { "43" : "Haute-Loire" }, { "63" : "Puy-de-Dôme" } ],
							 "26" : [ { "21" : "Côte d'Or" }, { "58" : "Nièvre" }, { "71" : "Saône-et-Loire" }, { "89" : "Yonne" } ],
							 "53" : [ { "22" : "Côtes-d'Armor" }, { "29" : "Finistère" }, { "35" : "Ille-et-Vilaine" }, { "56" : "Morbihan" } ],
							 "24" : [ { "18" : "Cher" }, { "28" : "Eure-et-Loir" }, { "36" : "Indre" }, { "37" : "Indre-et-Loire" }, { "41" : "Loir-et-Cher" }, { "45" : "Loiret" } ],
							 "21" : [ { "08" : "Ardennes" }, { "10" : "Aube" }, { "51" : "Marne" }, { "52" : "Haute-Marne" } ],
							 "94" : [ { "2A" : "Corse-du-sud" }, { "2B" : "Haute-Corse" } ],
							 "43" : [ { "25" : "Doubs" }, { "39" : "Jura" }, { "70" : "Haute-Saône" }, { "90" : "Territoire de Belfort" } ],
							 "11" : [ { "75" : "Paris" }, { "77" : "Seine-et-Marne" }, { "78" : "Yvelines" }, { "91" : "Essonne" }, { "92" : "Hauts-de-Seine" }, { "93" : "Seine-Saint-Denis" }, { "94" : "Val-de-Marne" }, { "95" : "Val-d'Oise" } ],
							 "91" : [ { "11" : "Aude" }, { "30" : "Gard" }, { "34" : "Hérault" }, { "48" : "Lozère" }, { "66" : "Pyrénées-Orientales" } ],
							 "74" : [ { "19" : "Corrèze" }, { "23" : "Creuse" }, { "87" : "Haute-vienne" } ],
							 "41" : [ { "54" : "Meurthe-et-Moselle" }, { "55" : "Meuse" }, { "57" : "Moselle" }, { "88" : "Vosges" } ],
							 "73" : [ { "09" : "Ariège" }, { "12" : "Aveyron" }, { "31" : "Haute-Garonne" }, { "32" : "Gers" }, { "46" : "Lot" }, { "65" : "Hautes-Pyrénées" }, { "81" : "Tarn" }, { "82" : "Tarn-et-Garonne" } ],
							 "31" : [ { "59" : "Nord" }, { "62" : "Pas-de-Calais" } ],
							 "25" : [ { "14" : "Calvados" }, { "50" : "Manche" }, { "61" : "Orne" } ],
							 "23" : [ { "27" : "Eure" }, { "76" : "Seine-Maritime" } ],
							 "52" : [ { "44" : "Loire-Atlantique" }, { "49" : "Maine-et-Loire" }, { "53" : "Mayenne" }, { "72" : "Sarthe" }, { "85" : "Vendée" } ],
							 "22" : [ { "02" : "Aisne" }, { "60" : "Somme" }, { "80" : "Oise" } ],
							 "54" : [ { "16" : "Charente" }, { "17" : "Charente-Maritime" }, { "79" : "Deux-Sèvres" }, { "86" : "Vienne" } ],
							 "93" : [ { "04" : "Ales-de-Haute-Provence" }, { "05" : "Hautes-Alpes" }, { "06" : "Alpes-Maritimes" }, { "13" : "Bouches-du-Rhône" }, { "83" : "Var" }, { "84" : "Vaucluse" } ],
							 "82" : [ { "01" : "Ain" }, { "07" : "Ardèche" }, { "26" : "Drôme" }, { "38" : "Isère" }, { "42" : "Loire" }, { "69" : "Rhône" }, { "73" : "Savoie" }, { "74" : "Haute-Savoie" } ],
							 "971" : [ { "971" : "Guadeloupe" } ],
							 "972" : [ { "972" : "Martinique" } ],
							 "973" : [ { "973" : "Réunion" } ],
							 "974" : [ { "974" : "Guyane" } ],
							 "976" : [ { "976" : "Mayotte" } ] };

function update_region(numero) {
    $('#region_input').attr('src', '/assets/images/eplaque/regions/' + numero + '.png');
    $('#regions .region').removeClass('selected');
    $('#region-' + numero).addClass('selected');

    $('input[name=logo_right]').val(numero);
}

function update_departement(numero) {
	if (numero != '00') {
        $('#departement_input').text(numero);
    } else {
        $('#departement_input').text('');
    }
    $('#departement_select').val(numero);
    $('#departements_list .action').removeClass('selected');
    $('#departement-' + numero).addClass('selected');

    $('input[name=number_right]').val(numero);
}

function update_liste_departement(region, departements, dep) {
    var list = $('#departements_list');
    list.text('');
    var numero = 0;
    if (region != '00') {
        $.each(departements, function(i, obj) {
        	$.each(obj, function(key, value) {
        		numero = key;
            	list.append('<span class="action curved" id="departement-' + key + '" title="' + value + '">' + key + '</span>');
        	});
        });
    }
    if (dep != 0) {
    	numero = dep;
    }
    update_region(region);
    update_departement(numero);
    $('#departements_none').hide();
    $('#departements').show();
}

function update_prix_plaque() {
    var prix = 0;
    var materiau = $('#fieldset_materiaux input:radio:checked[name=material]').val();
    var type = $('input[name=type]').val();
    $('#plaque').css('background-image', 'url(/assets/images/eplaque/plaques/plaque_' + type + '_' + materiau + '.png)');
    prix += parseFloat($('#prix_' + materiau).val());
    var qty = $('#qty').val();
    prix *= qty;
    if (!isNaN(prix)) {
        $('#prix').text(prix);
    } else {
        $('#prix').text(0);
    }
    $('#prix').format({
        format: "#.##",
        locale: "fr"
    });
}

function update_photo_plaque() {
    var materiau = $('#fieldset_materiaux input:radio:checked[name=material]').val();
    var type = $('input[name=type]').val();
    $('#plaque').css('background-image', 'url(/assets/images/eplaque/plaques/plaque_' + type + '_' + materiau + '.png)');
}

$(document).ready(function() {
    $('fieldset .radio_block_pl').click(function() {
    	$('fieldset .radio_block_pl input:radio:checked').prop('checked', false);
        $(this).find('input').prop('checked', true);
        $('.radio_block_pl').removeClass('selected');
        $(this).addClass('selected');
        update_photo_plaque();
    });
    $.mask.definitions['s'] = '[a-zA-Z0-9\.,;\+=\? \-]';
    $('#numero_input_auto').mask('aa-999-aa', {
        placeholder: "  "
    });
    $('#numero_input_moto1').mask('aa-', {
        placeholder: "  "
    });
    $('#numero_input_moto2').mask('999-aa', {
        placeholder: "  "
    });
    $('#numero_input_cyclo1').mask('aa ', {
        placeholder: "  "
    });
    $('#numero_input_cyclo2').mask('999 a', {
        placeholder: "  "
    });
    $('#departement_input').mask('**', {
        placeholder: "  "
    });
    $('#rs_input').mask('sssssssssssssssssssssssssssssssssssssss', {
        placeholder: "  "
    });
    $('#departement_input, #departements_block #departement_select').bind('keyup change', function() { // a remplacer par du full js
        var val = $(this).val();
        var region = "";
        var departements = [];

        if (val != "00") {
        	$.each(regions_departements, function(number, departements_list) {
	        	$.each(departements_list, function(i, obj) {
	        		$.each(obj, function(key, value) {
	        			if (key == val) {
	        				region = number;
	        				departements = departements_list;
	        			}
	        		});
	        	});
	        });
	        update_liste_departement(region, departements, val);
        }
    });
    $('#fieldset_regions .region').click(function() { // a remplacer par du full js
        var ri = $(this).attr('id').split('-', 2);
        var val = ri[1];
        if (regions_departements[val] != undefined) {
        	update_liste_departement(val, regions_departements[val], 0)
        }
    });

    $('body').on('click', '#departements_list .action', function() {
	    var val = $(this).text();
        var region = "";
        var departements = [];

        if (val != "00") {
        	$.each(regions_departements, function(number, departements_list) {
	        	$.each(departements_list, function(i, obj) {
	        		$.each(obj, function(key, value) {
	        			if (key == val) {
	        				region = number;
	        				departements = departements_list;
	        			}
	        		});
	        	});
	        });
	        update_liste_departement(region, departements, val);
        }
	});

    $('#rs_input').val('Inscrivez votre texte personnalisé ici');
    $('#rs_input').addClass('default-value');
    $('#rs_input').addClass('default-value-inactive');

    update_photo_plaque();
});
