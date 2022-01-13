/*!
 * froala_editor v3.0.0-rc.2 (https://www.froala.com/wysiwyg-editor)
 * License https://froala.com/wysiwyg-editor/terms/
 * Copyright 2014-2019 Froala Labs
 */

!function (c, E) {
    "object" == typeof exports && "undefined" != typeof module ? E(require("froala-editor")) : "function" == typeof define && define.amd ? define(["froala-editor"], E) : E(c.FroalaEditor)
}

    (this, function (t) {
        "use strict";
        t = t && t.hasOwnProperty("default") ? t["default"] : t, Object.assign(t.DEFAULTS, {
            specialCharactersSets: [{
                title: "Greek", "char": "&Alpha;", list: [{
                    "char": "&Alpha;", desc: "GREEK CAPITAL LETTER ALPHA"
                }
                    , {
                    "char": "&Beta;", desc: "GREEK CAPITAL LETTER BETA"
                }
                    , {
                    "char": "&Gamma;", desc: "GREEK CAPITAL LETTER GAMMA"
                }
                    , {
                    "char": "&Delta;", desc: "GREEK CAPITAL LETTER DELTA"
                }
                    , {
                    "char": "&Epsilon;", desc: "GREEK CAPITAL LETTER EPSILON"
                }
                    , {
                    "char": "&Zeta;", desc: "GREEK CAPITAL LETTER ZETA"
                }
                    , {
                    "char": "&Eta;", desc: "GREEK CAPITAL LETTER ETA"
                }
                    , {
                    "char": "&Theta;", desc: "GREEK CAPITAL LETTER THETA"
                }
                    , {
                    "char": "&Iota;", desc: "GREEK CAPITAL LETTER IOTA"
                }
                    , {
                    "char": "&Kappa;", desc: "GREEK CAPITAL LETTER KAPPA"
                }
                    , {
                    "char": "&Lambda;", desc: "GREEK CAPITAL LETTER LAMBDA"
                }
                    , {
                    "char": "&Mu;", desc: "GREEK CAPITAL LETTER MU"
                }
                    , {
                    "char": "&Nu;", desc: "GREEK CAPITAL LETTER NU"
                }
                    , {
                    "char": "&Xi;", desc: "GREEK CAPITAL LETTER XI"
                }
                    , {
                    "char": "&Omicron;", desc: "GREEK CAPITAL LETTER OMICRON"
                }
                    , {
                    "char": "&Pi;", desc: "GREEK CAPITAL LETTER PI"
                }
                    , {
                    "char": "&Rho;", desc: "GREEK CAPITAL LETTER RHO"
                }
                    , {
                    "char": "&Sigma;", desc: "GREEK CAPITAL LETTER SIGMA"
                }
                    , {
                    "char": "&Tau;", desc: "GREEK CAPITAL LETTER TAU"
                }
                    , {
                    "char": "&Upsilon;", desc: "GREEK CAPITAL LETTER UPSILON"
                }
                    , {
                    "char": "&Phi;", desc: "GREEK CAPITAL LETTER PHI"
                }
                    , {
                    "char": "&Chi;", desc: "GREEK CAPITAL LETTER CHI"
                }
                    , {
                    "char": "&Psi;", desc: "GREEK CAPITAL LETTER PSI"
                }
                    , {
                    "char": "&Omega;", desc: "GREEK CAPITAL LETTER OMEGA"
                }
                    , {
                    "char": "&alpha;", desc: "GREEK SMALL LETTER ALPHA"
                }
                    , {
                    "char": "&beta;", desc: "GREEK SMALL LETTER BETA"
                }
                    , {
                    "char": "&gamma;", desc: "GREEK SMALL LETTER GAMMA"
                }
                    , {
                    "char": "&delta;", desc: "GREEK SMALL LETTER DELTA"
                }
                    , {
                    "char": "&epsilon;", desc: "GREEK SMALL LETTER EPSILON"
                }
                    , {
                    "char": "&zeta;", desc: "GREEK SMALL LETTER ZETA"
                }
                    , {
                    "char": "&eta;", desc: "GREEK SMALL LETTER ETA"
                }
                    , {
                    "char": "&theta;", desc: "GREEK SMALL LETTER THETA"
                }
                    , {
                    "char": "&iota;", desc: "GREEK SMALL LETTER IOTA"
                }
                    , {
                    "char": "&kappa;", desc: "GREEK SMALL LETTER KAPPA"
                }
                    , {
                    "char": "&lambda;", desc: "GREEK SMALL LETTER LAMBDA"
                }
                    , {
                    "char": "&mu;", desc: "GREEK SMALL LETTER MU"
                }
                    , {
                    "char": "&nu;", desc: "GREEK SMALL LETTER NU"
                }
                    , {
                    "char": "&xi;", desc: "GREEK SMALL LETTER XI"
                }
                    , {
                    "char": "&omicron;", desc: "GREEK SMALL LETTER OMICRON"
                }
                    , {
                    "char": "&pi;", desc: "GREEK SMALL LETTER PI"
                }
                    , {
                    "char": "&rho;", desc: "GREEK SMALL LETTER RHO"
                }
                    , {
                    "char": "&sigmaf;", desc: "GREEK SMALL LETTER FINAL SIGMA"
                }
                    , {
                    "char": "&sigma;", desc: "GREEK SMALL LETTER SIGMA"
                }
                    , {
                    "char": "&tau;", desc: "GREEK SMALL LETTER TAU"
                }
                    , {
                    "char": "&upsilon;", desc: "GREEK SMALL LETTER UPSILON"
                }
                    , {
                    "char": "&phi;", desc: "GREEK SMALL LETTER PHI"
                }
                    , {
                    "char": "&chi;", desc: "GREEK SMALL LETTER CHI"
                }
                    , {
                    "char": "&psi;", desc: "GREEK SMALL LETTER PSI"
                }
                    , {
                    "char": "&omega;", desc: "GREEK SMALL LETTER OMEGA"
                }
                    , {
                    "char": "&thetasym;", desc: "GREEK THETA SYMBOL"
                }
                    , {
                    "char": "&upsih;", desc: "GREEK UPSILON WITH HOOK SYMBOL"
                }
                    , {
                    "char": "&straightphi;", desc: "GREEK PHI SYMBOL"
                }
                    , {
                    "char": "&piv;", desc: "GREEK PI SYMBOL"
                }
                    , {
                    "char": "&Gammad;", desc: "GREEK LETTER DIGAMMA"
                }
                    , {
                    "char": "&gammad;", desc: "GREEK SMALL LETTER DIGAMMA"
                }
                    , {
                    "char": "&varkappa;", desc: "GREEK KAPPA SYMBOL"
                }
                    , {
                    "char": "&varrho;", desc: "GREEK RHO SYMBOL"
                }
                    , {
                    "char": "&straightepsilon;", desc: "GREEK LUNATE EPSILON SYMBOL"
                }
                    , {
                    "char": "&backepsilon;", desc: "GREEK REVERSED LUNATE EPSILON SYMBOL"
                }
                ]
            }

            ], specialCharButtons: ["specialCharBack", "|"]
        }
        ), Object.assign(t.POPUP_TEMPLATES, {
            specialCharacters: "[_BUTTONS_][_CUSTOM_LAYER_]"
        }
        ), t.PLUGINS.specialCharacters = function (W) {
            var N = W.$, T = W.opts.specialCharactersSets[0], L = W.opts.specialCharactersSets, a = "";
            function I() {
                return '\n        <div class="fr-buttons fr-tabs fr-tabs-scroll">\n          '.concat(function E(c, T) {
                    var R = "";
                    return c.forEach(function (c) {
                        var E = {
                            elementClass: c.title === T.title ? "fr-active fr-active-tab" : "", title: c.title, dataParam1: c.title, desc: c["char"]
                        }
                            ;
                        R += '<button class="fr-command fr-btn fr-special-character-category '.concat(E.elementClass, '" title="').concat(E.title, '" data-cmd="setSpecialCharacterCategory" data-param1="').concat(E.dataParam1, '"><span>').concat(E.desc, "</span></button>")
                    }
                    ), R
                }
                    (L, T), '\n        </div>\n        <div class="fr-icon-container fr-sc-container">\n          ').concat(function R(c) {
                        var T = "";
                        return c.list.forEach(function (c) {
                            var E = {
                                dataParam1: c["char"], title: c.desc, splCharValue: c["char"]
                            }
                                ;
                            T += '<span class="fr-command fr-special-character fr-icon" role="button" \n      data-cmd="insertSpecialCharacter" data-param1="'.concat(E.dataParam1, '" \n      title="').concat(E.title, '">').concat(E.splCharValue, "</span>")
                        }
                        ), T
                    }
                        (T), "\n        </div>")
            }
            return {
                setSpecialCharacterCategory: function R(E) {
                    T = L.filter(function (c) {
                        return c.title === E
                    }
                    )[0], function c() {
                        W.popups.get("specialCharacters").html(a + I())
                    }
                            ()
                }
                , showSpecialCharsPopup: function e() {
                    var c = W.popups.get("specialCharacters");
                    if (c || (c = function A() {
                        W.opts.toolbarInline && 0 < W.opts.specialCharButtons.length && (a = '<div class="fr-buttons fr-tabs">'.concat(W.button.buildList(W.opts.specialCharButtons), "</div>"));
                        var c = {
                            buttons: a, custom_layer: I()
                        }
                            , E = W.popups.create("specialCharacters", c);
                        return function T(S) {
                            W.events.on("popup.tab", function (c) {
                                var E = N(c.currentTarget);
                                if (!W.popups.isVisible("specialCharacters") || !E.is("span, a")) return !0;
                                var T, R, L, A = c.which;
                                if (t.KEYCODE.TAB == A) {
                                    if (E.is("span.fr-icon") && c.shiftKey || E.is("a") && !c.shiftKey) {
                                        var a = S.find(".fr-buttons");
                                        T = !W.accessibility.focusToolbar(a, !!c.shiftKey)
                                    }
                                    if (!1 !== T) {
                                        var I = S.find("span.fr-icon:focus").first().concat(S.findVisible(" span.fr-icon").first().concat(S.find("a")));
                                        E.is("span.fr-icon") && (I = I.not("span.fr-icon:not(:focus)")), R = I.index(E), R = c.shiftKey ? ((R - 1) % I.length + I.length) % I.length : (R + 1) % I.length, L = I.get(R), W.events.disableBlur(), L.focus(), T = !1
                                    }
                                }
                                else if (t.KEYCODE.ARROW_UP == A || t.KEYCODE.ARROW_DOWN == A || t.KEYCODE.ARROW_LEFT == A || t.KEYCODE.ARROW_RIGHT == A) {
                                    if (E.is("span.fr-icon")) {
                                        var e = E.parent().find("span.fr-icon");
                                        R = e.index(E);
                                        var r = 11, s = Math.floor(e.length / r), h = R % r, d = Math.floor(R / r), C = d * r + h, O = s * r;
                                        t.KEYCODE.ARROW_UP == A ? C = ((C - r) % O + O) % O : t.KEYCODE.ARROW_DOWN == A ? C = (C + r) % O : t.KEYCODE.ARROW_LEFT == A ? C = ((C - 1) % O + O) % O : t.KEYCODE.ARROW_RIGHT == A && (C = (C + 1) % O), L = N(e.get(C)), W.events.disableBlur(), L.focus(), T = !1
                                    }
                                }
                                else t.KEYCODE.ENTER == A && (E.is("a") ? E[0].click() : W.button.exec(E), T = !1);
                                return !1 === T && (c.preventDefault(), c.stopPropagation()), T
                            }
                                , !0)
                        }
                            (E), E
                    }
                        ()), !c.hasClass("fr-active")) {
                        W.popups.refresh("specialCharacters"), W.popups.setContainer("specialCharacters", W.$tb);
                        var E = W.$tb.find('.fr-command[data-cmd="specialCharacters"]'), T = W.button.getPosition(E), R = T.left, L = T.top;
                        W.popups.show("specialCharacters", R, L, outerHeight)
                    }
                }
                , back: function c() {
                    W.popups.hide("specialCharacters"), W.toolbar.showInline()
                }
            }
        }
            , t.DefineIcon("specialCharacters", {
                NAME: "dollar-sign", SVG_KEY: "symbols"
            }
            ), t.RegisterCommand("specialCharacters", {
                title: "Special Characters", icon: "specialCharacters", undo: !1, focus: !1, popup: !0, refreshAfterCallback: !1, plugin: "specialCharacters", showOnMobile: !0, callback: function () {
                    this.popups.isVisible("specialCharacters") ? (this.$el.find(".fr-marker") && (this.events.disableBlur(), this.selection.restore()), this.popups.hide("specialCharacters")) : this.specialCharacters.showSpecialCharsPopup()
                }
            }
            ), t.RegisterCommand("insertSpecialCharacter", {
                callback: function (c, E) {
                    this.undo.saveStep(), this.html.insert(E), this.undo.saveStep(), this.popups.hide("specialCharacters")
                }
            }
            ), t.RegisterCommand("setSpecialCharacterCategory", {
                undo: !1, focus: !1, callback: function (c, E) {
                    this.specialCharacters.setSpecialCharacterCategory(E)
                }
            }
            ), t.DefineIcon("specialCharBack", {
                NAME: "arrow-left", SVG_KEY: "back"
            }
            ), t.RegisterCommand("specialCharBack", {
                title: "Back", undo: !1, focus: !1, back: !0, refreshAfterCallback: !1, callback: function () {
                    this.specialCharacters.back()
                }
            }
            )
    }

    );