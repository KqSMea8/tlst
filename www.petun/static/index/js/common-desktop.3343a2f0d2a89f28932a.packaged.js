(window.webpackJsonp = window.webpackJsonp || []).push([
	[8], {
		159: function(t, e, n) {
			"use strict";
			t.exports = n(160).polyfill()
		},
		160: function(t, e, n) {
			(function(e, n) {
				/*!
				 * @overview es6-promise - a tiny implementation of Promises/A+.
				 * @copyright Copyright (c) 2014 Yehuda Katz, Tom Dale, Stefan Penner and contributors (Conversion to ES6 API by Jake Archibald)
				 * @license   Licensed under MIT license
				 *            See https://raw.githubusercontent.com/stefanpenner/es6-promise/master/LICENSE
				 * @version   v4.2.5+7f2b526d
				 */
				! function(e, n) {
					t.exports = n()
				}(0, function() {
					"use strict";

					function t(t) {
						return "function" == typeof t
					}
					var i = Array.isArray ? Array.isArray : function(t) {
							return "[object Array]" === Object.prototype.toString.call(t)
						},
						o = 0,
						a = void 0,
						r = void 0,
						s = function(t, e) {
							v[o] = t, v[o + 1] = e, 2 === (o += 2) && (r ? r(f) : w())
						};
					var c = "undefined" != typeof window ? window : void 0,
						l = c || {},
						u = l.MutationObserver || l.WebKitMutationObserver,
						d = "undefined" == typeof self && void 0 !== e && "[object process]" === {}.toString.call(e),
						p = "undefined" != typeof Uint8ClampedArray && "undefined" != typeof importScripts && "undefined" != typeof MessageChannel;

					function h() {
						var t = setTimeout;
						return function() {
							return t(f, 1)
						}
					}
					var v = new Array(1e3);

					function f() {
						for(var t = 0; t < o; t += 2) {
							(0, v[t])(v[t + 1]), v[t] = void 0, v[t + 1] = void 0
						}
						o = 0
					}
					var w = void 0;

					function m(t, e) {
						var n = this,
							i = new this.constructor(g);
						void 0 === i[b] && N(i);
						var o = n._state;
						if(o) {
							var a = arguments[o - 1];
							s(function() {
								return L(o, i, a, n._result)
							})
						} else H(n, i, t, e);
						return i
					}

					function y(t) {
						if(t && "object" == typeof t && t.constructor === this) return t;
						var e = new this(g);
						return j(e, t), e
					}
					w = d ? function() {
						return e.nextTick(f)
					} : u ? function() {
						var t = 0,
							e = new u(f),
							n = document.createTextNode("");
						return e.observe(n, {
								characterData: !0
							}),
							function() {
								n.data = t = ++t % 2
							}
					}() : p ? function() {
						var t = new MessageChannel;
						return t.port1.onmessage = f,
							function() {
								return t.port2.postMessage(0)
							}
					}() : void 0 === c ? function() {
						try {
							var t = Function("return this")().require("vertx");
							return void 0 !== (a = t.runOnLoop || t.runOnContext) ? function() {
								a(f)
							} : h()
						} catch(t) {
							return h()
						}
					}() : h();
					var b = Math.random().toString(36).substring(2);

					function g() {}
					var _ = void 0,
						$ = 1,
						C = 2,
						k = {
							error: null
						};

					function A(t) {
						try {
							return t.then
						} catch(t) {
							return k.error = t, k
						}
					}

					function x(e, n, i) {
						n.constructor === e.constructor && i === m && n.constructor.resolve === y ? function(t, e) {
							e._state === $ ? T(t, e._result) : e._state === C ? S(t, e._result) : H(e, void 0, function(e) {
								return j(t, e)
							}, function(e) {
								return S(t, e)
							})
						}(e, n) : i === k ? (S(e, k.error), k.error = null) : void 0 === i ? T(e, n) : t(i) ? function(t, e, n) {
							s(function(t) {
								var i = !1,
									o = function(t, e, n, i) {
										try {
											t.call(e, n, i)
										} catch(t) {
											return t
										}
									}(n, e, function(n) {
										i || (i = !0, e !== n ? j(t, n) : T(t, n))
									}, function(e) {
										i || (i = !0, S(t, e))
									}, t._label);
								!i && o && (i = !0, S(t, o))
							}, t)
						}(e, n, i) : T(e, n)
					}

					function j(t, e) {
						t === e ? S(t, new TypeError("You cannot resolve a promise with itself")) : ! function(t) {
							var e = typeof t;
							return null !== t && ("object" === e || "function" === e)
						}(e) ? T(t, e) : x(t, e, A(e))
					}

					function E(t) {
						t._onerror && t._onerror(t._result), P(t)
					}

					function T(t, e) {
						t._state === _ && (t._result = e, t._state = $, 0 !== t._subscribers.length && s(P, t))
					}

					function S(t, e) {
						t._state === _ && (t._state = C, t._result = e, s(E, t))
					}

					function H(t, e, n, i) {
						var o = t._subscribers,
							a = o.length;
						t._onerror = null, o[a] = e, o[a + $] = n, o[a + C] = i, 0 === a && t._state && s(P, t)
					}

					function P(t) {
						var e = t._subscribers,
							n = t._state;
						if(0 !== e.length) {
							for(var i = void 0, o = void 0, a = t._result, r = 0; r < e.length; r += 3) i = e[r], o = e[r + n], i ? L(n, i, o, a) : o(a);
							t._subscribers.length = 0
						}
					}

					function L(e, n, i, o) {
						var a = t(i),
							r = void 0,
							s = void 0,
							c = void 0,
							l = void 0;
						if(a) {
							if((r = function(t, e) {
									try {
										return t(e)
									} catch(t) {
										return k.error = t, k
									}
								}(i, o)) === k ? (l = !0, s = r.error, r.error = null) : c = !0, n === r) return void S(n, new TypeError("A promises callback cannot return that same promise."))
						} else r = o, c = !0;
						n._state !== _ || (a && c ? j(n, r) : l ? S(n, s) : e === $ ? T(n, r) : e === C && S(n, r))
					}
					var B = 0;

					function N(t) {
						t[b] = B++, t._state = void 0, t._result = void 0, t._subscribers = []
					}
					var D = function() {
						function t(t, e) {
							this._instanceConstructor = t, this.promise = new t(g), this.promise[b] || N(this.promise), i(e) ? (this.length = e.length, this._remaining = e.length, this._result = new Array(this.length), 0 === this.length ? T(this.promise, this._result) : (this.length = this.length || 0, this._enumerate(e), 0 === this._remaining && T(this.promise, this._result))) : S(this.promise, new Error("Array Methods must be provided an Array"))
						}
						return t.prototype._enumerate = function(t) {
							for(var e = 0; this._state === _ && e < t.length; e++) this._eachEntry(t[e], e)
						}, t.prototype._eachEntry = function(t, e) {
							var n = this._instanceConstructor,
								i = n.resolve;
							if(i === y) {
								var o = A(t);
								if(o === m && t._state !== _) this._settledAt(t._state, e, t._result);
								else if("function" != typeof o) this._remaining--, this._result[e] = t;
								else if(n === M) {
									var a = new n(g);
									x(a, t, o), this._willSettleAt(a, e)
								} else this._willSettleAt(new n(function(e) {
									return e(t)
								}), e)
							} else this._willSettleAt(i(t), e)
						}, t.prototype._settledAt = function(t, e, n) {
							var i = this.promise;
							i._state === _ && (this._remaining--, t === C ? S(i, n) : this._result[e] = n), 0 === this._remaining && T(i, this._result)
						}, t.prototype._willSettleAt = function(t, e) {
							var n = this;
							H(t, void 0, function(t) {
								return n._settledAt($, e, t)
							}, function(t) {
								return n._settledAt(C, e, t)
							})
						}, t
					}();
					var M = function() {
						function e(t) {
							this[b] = B++, this._result = this._state = void 0, this._subscribers = [], g !== t && ("function" != typeof t && function() {
								throw new TypeError("You must pass a resolver function as the first argument to the promise constructor")
							}(), this instanceof e ? function(t, e) {
								try {
									e(function(e) {
										j(t, e)
									}, function(e) {
										S(t, e)
									})
								} catch(e) {
									S(t, e)
								}
							}(this, t) : function() {
								throw new TypeError("Failed to construct 'Promise': Please use the 'new' operator, this object constructor cannot be called as a function.")
							}())
						}
						return e.prototype.catch = function(t) {
							return this.then(null, t)
						}, e.prototype.finally = function(e) {
							var n = this.constructor;
							return t(e) ? this.then(function(t) {
								return n.resolve(e()).then(function() {
									return t
								})
							}, function(t) {
								return n.resolve(e()).then(function() {
									throw t
								})
							}) : this.then(e, e)
						}, e
					}();
					return M.prototype.then = m, M.all = function(t) {
						return new D(this, t).promise
					}, M.race = function(t) {
						var e = this;
						return i(t) ? new e(function(n, i) {
							for(var o = t.length, a = 0; a < o; a++) e.resolve(t[a]).then(n, i)
						}) : new e(function(t, e) {
							return e(new TypeError("You must pass an array to race."))
						})
					}, M.resolve = y, M.reject = function(t) {
						var e = new this(g);
						return S(e, t), e
					}, M._setScheduler = function(t) {
						r = t
					}, M._setAsap = function(t) {
						s = t
					}, M._asap = s, M.polyfill = function() {
						var t = void 0;
						if(void 0 !== n) t = n;
						else if("undefined" != typeof self) t = self;
						else try {
							t = Function("return this")()
						} catch(t) {
							throw new Error("polyfill failed because global object is unavailable in this environment")
						}
						var e = t.Promise;
						if(e) {
							var i = null;
							try {
								i = Object.prototype.toString.call(e.resolve())
							} catch(t) {}
							if("[object Promise]" === i && !e.cast) return
						}
						t.Promise = M
					}, M.Promise = M, M
				})
			}).call(this, n(83), n(11))
		},
		534: function(t, e, n) {
			"use strict";
			n.r(e);
			n(159);
			var i, o, a, r, s, c = function() {
					var t = window.chewy || {};
					t.viewType = "desktop", t.breakpoints = {
						tablet: 768,
						desktopsm: 970
					};
					var e = function() {
						var t = $("body");
						window.innerWidth < window.chewy.breakpoints.desktopsm ? (t.removeClass("is-desktop"), t.addClass("is-tablet")) : (t.removeClass("is-tablet"), t.addClass("is-desktop"))
					};
					$(function() {
						e()
					}), $(window).on("resize.bodyClass", function() {
						e()
					})
				},
				l = n(76),
				u = n(77),
				d = n(54),
				p = $("body"),
				h = $(".pet-drop-left li a"),
				v = $(".js-dropdown > li:not(.nav-button)"),
				f = $(".trigger-menu"),
				w = $(".nav-drop-pet .is-selected"),
				m = !1,
				y = !1,
				b = !1,
				g = {
					open: function(t) {
						chewy.optimizelyClient && t.hasClass("js-nav-brand") && chewy.optimizelyClient.safeTrack("nav_brand_open"), t.addClass("is-active"), t.find(".cw-drop").show(), p.addClass("nav-is-open"), t.hasClass("nav-drop-pet") && p.addClass("nav-pet-is-open")
					},
					close: function() {
						$(".js-dropdown .is-active").removeClass("is-active"), $(".cw-drop").hide(), p.removeClass("nav-is-open nav-pet-is-open")
					},
					toggle: function(t) {
						t.preventDefault(), p.toggleClass("nav-is-open nav-pet-is-open"), $(".drop-pet").toggle()
					},
					touch: function(t) {
						t.hasClass("is-active") ? this.close() : (event.preventDefault(), $.publish("menus.init"), this.close(), this.open(t))
					}
				};

			function _(t) {
				if(t) {
					var e = $(".".concat(t)).find(".js-nav-banner");
					if(e.length) {
						var n = e.data("event-name") || "",
							i = {
								name: n,
								creative: e.data("promo-creative") || ""
							};
						window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushEecPromotionEvent("impression", "promoView", n, i)
					}
				}
			}
			var C = function() {
				window.chewy.optimizelyClient && (chewy.optimizelyClient.safeActivate("AATEST_2"), chewy.optimizelyClient.safeActivate("BRANDS_MENU")), $.ajax({
					url: "".concat(window.location.search),
					dataType: "html",
					cache: !1,
					timeout: 1e4
				}).then(function(t) {
					$(".js-pet-drop-right").removeClass("pet-drop-right--loading").find(".js-pet-drop-right__content").replaceWith(t), $(".js-pet-drop-left, .js-pet-drop-right").on("click", function(t) {
						window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushBrowseNavEvent({
							eventAction: "pet"
						}, t)
					}), h.hasClass("is-selected") && (a = $(".nav-drop-pet .is-selected").data("target"), $(".pet-drop-category").hide(), $(".".concat(a)).show()), $(".js-nav-banner a").click(function(t) {
						var e = $(t.currentTarget).closest(".js-nav-banner");
						if(e.length) {
							var n = e.data("event-name") || "",
								i = {
									name: n,
									creative: e.data("promo-creative") || ""
								};
							window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushEecPromotionEvent("click", "promoClick", n, i)
						}
					})
				}, function(t) {
					window.Raven && window.Raven.captureMessage("Unable to load pet subnavigation", {
						level: "error",
						logger: "subnav.pet",
						extra: {
							error: JSON.stringify(t)
						}
					})
				}), h.hasClass("is-selected") ? (a = $(".nav-drop-pet .is-selected").data("target"), $(".pet-drop-category").hide(), $(".".concat(a)).show()) : (a = $(".pet-drop-left li:first a").data("target"), $(".pet-drop-left li:first a").addClass("is-selected")), s = a, w = $(".nav-drop-pet .is-selected"), v.find(".cw-drop").hide(), ("ontouchstart" in window || navigator.maxTouchPoints) && (y = !0), $(".js-load-dynamicmenu").on("mouseover", function() {
					return $.publish("menus.init")
				}), y && v.on("touchstart click", "> a", function() {
					var t = $(this).parent("li");
					m || (m = !0, g.touch(t), setTimeout(function() {
						m = !1
					}, 500))
				}), v.on("mouseenter", function() {
					var t = $(this);
					(i = setTimeout(function() {
						return g.open(t)
					}, 250), t.is(".nav-drop-pet")) && _(t.find(".pet-drop-left a.is-selected").data("target"))
				}).on("mouseleave", function() {
					clearTimeout(i), g.close()
				}), $(".trigger-menu, .cw-logo").mouseleave(function() {
					o = setTimeout(function() {
						g.close()
					}, 10)
				}), $(".trigger-menu, .drop-pet, .cw-logo").mouseenter(function() {
					clearTimeout(o)
				}), f.on("mouseenter", function() {
					g.open($(".nav-drop-pet"))
				}), f.on("touchstart click", function(t) {
					t.preventDefault(), b || (b = !0, p.hasClass("nav-is-open") && p.hasClass("nav-pet-is-open") ? g.close() : g.open($(".nav-drop-pet")), setTimeout(function() {
						b = !1
					}, 500))
				}), $(".nav-mask").on("touchstart click", g.close);
				var t = y ? "touchstart click" : "mouseenter";
				h.on(t, function(t) {
					var e = $(this);
					r = !0, e.hasClass("is-selected") || (t.preventDefault(), setTimeout(function() {
						r && function(t) {
							var e = t.data("target");
							t.hasClass("is-selected") || ($(".pet-drop-category").hide(), $(".".concat(e)).show(), h.removeClass("is-selected"), t.addClass("is-selected"), _(e))
						}(e)
					}, 160))
				}), y || h.on("mouseleave", function() {
					r = !1
				}), $(".drop-pet").on("mouseleave", function() {
					h.removeClass("is-selected"), w.addClass("is-selected"), $(".pet-drop-category").hide(), $(".".concat(s)).show()
				}), $.subscribe("cwDropdown.open", function(t, e) {
					g.open($(e.target))
				}), $.subscribe("cwDropdown.close", function(t, e) {
					g.close($(e.target))
				})
			};
			var k, A, x = function() {
					var t = $(".js-brand-dropdown");
					if(!(t.length < 1)) {
						var e = "";
						$.ajax({
							url: e,
							dataType: "html",
							cache: !1,
							timeout: 1e4
						}).then(function(e) {
							t.removeClass("brand-list--loading").replaceWith(e),
								function() {
									var t = $(".drop-brand-letters li"),
										e = $(".brand-list");
									t.first().addClass("is-selected"), t.on("click", "a", function(n) {
										if(n.preventDefault(), !$(this).parent().hasClass("disabled")) {
											var i = $(this).attr("href"),
												o = $(i)[0].offsetTop;
											t.removeClass("is-selected"), $(this).parent().addClass("is-selected"), e.addClass("clicked"), "#brands-A" === i && (o = 0), e.stop(!0).animate({
												scrollTop: o
											}, 100, function() {
												setTimeout(function() {
													e.removeClass("clicked")
												}, 101)
											})
										}
									}), e.on("scroll", function() {
										e.find(".brand-list-item").each(function() {
											var t = $(this);
											if(t.position().top < e.height() - e.height() + 20) {
												var n = t.attr("id").substring(0);
												e.hasClass("clicked") || ($(".drop-brand-letters li").removeClass("is-selected"), $(".".concat(n)).addClass("is-selected")), window.agent.iPad || t.find("span").addClass("is-fixed")
											} else window.agent.iPad || t.find("span").removeClass("is-fixed")
										})
									})
								}(), $(".brand-list, .brand-logos").on("click", function(t) {
									window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushBrowseNavEvent({
										eventAction: "brand"
									}, t)
								})
						}, function(t, n) {
							window.logAjaxError("Unable to load brands subnavigation", t, n, e)
						})
					}
				},
				j = $("#minicart"),
				E = $("#gaCartDomParent"),
				T = !1;

			function S() {
				A || $.ajax({
					url: "",
					dataType: "json",
					cache: !1,
					timeout: 1e4,
					complete: function() {
						A = !1
					},
					success: function(t) {
						t = $.extend({
							cartCount: 0,
							cartAmount: "$0.00",
							cart: [],
							autoship: []
						}, t), $.publish("cart", t);
						var e = function(t, e) {
								return '\n        <section class="ga-eec__container ga-eec__item-'.concat(e + 1, ' hidden">\n          <div class="ga-eec__currencyCode">').concat(t.currency, '</div>\n          <div class="ga-eec__name">').concat(t.name, '</div>\n          <div class="ga-eec__id">').concat(t.id, '</div>\n          <div class="ga-eec__brand">').concat(t.brand, '</div>\n          <div class="ga-eec__category">').concat(t.category, '</div>\n          <div class="ga-eec__quantity">').concat(t.quantity, '</div>\n          <div class="ga-eec__price">').concat(t.unitPrice, '</div>\n          <div class="ga-eec__position">').concat(e + 1, '</div>\n          <div class="ga-eec__variant">').concat(function(t) {
									return t && t.value || ""
								}(function(t) {
									return t.length && t[0]
								}(t.attributes)), "</div>\n        </section>\n      ")
							},
							n = function(t, e) {
								0 === e.length ? t.addClass("nav-empty").removeClass("nav-full") : t.addClass("nav-full").removeClass("nav-empty")
							};
						n(j, t.cart), j.find(".ajax-content").html(function(t) {
							var e = t.cart,
								n = t.cartAmount,
								i = t.cartCount;
							return '\n        <div class="summary">\n          <div class="left">\n            Cart Subtotal: <span class="subtotal">'.concat(n, '</span>\n          </div>\n          <div class="right">\n            <a href="/app/cart">Edit Cart</a>\n          </div>\n          <a href="/app/checkout" class="cw-btn cw-btn--action cw-btn--full js-gtm-proceed-to-checkout-dynamic">Proceed to Checkout</a>\n        </div>\n        ').concat(i > 3 ? '<p class="cart-extra">Recently Added: <span>Total Items ('.concat(i, ")</span></p>") : "", "\n        <ul>\n          ").concat(e.reduce(function(t, e) {
								return "".concat(t, '\n            <li>\n              <a href="').concat(e.url, '">\n                <img src="').concat(e.thumbnail, '" alt="').concat(e.brand, " ").concat(e.brand ? e.description.substring(e.brand.length + 1) : e.description, '">\n                <p>').concat(e.brand, " ").concat(e.brand ? e.description.substring(e.brand.length + 1).substr(0, 65) : e.description.substr(0, 65), '</p>\n                <p>\n                  <span class="price">\n                    <span class="').concat(e.freeGift ? "original" : "", '">\n                      ').concat(e.unitPriceAsString, "\n                    </span>\n                    ").concat(e.freeGift ? "FREE" : "", "\n                  </span> (Qty: ").concat(e.quantity, ")\n                </p>\n              </a>\n            </li>")
							}, ""), "\n        </ul>\n      ")
						}(t)), n(k, t.autoship), k.find(".ajax-content").html(function(t) {
							var e = t.autoship,
								n = t.autoshipCount;
							return "\n        ".concat(n > 2 ? '<a class="more" href="/app/subs" class="show-more">view all ('.concat(n, ")</a>") : "", "\n\n        ").concat(e.reduce(function(t, e) {
								return "".concat(t, '\n          <div class="autoship">\n            <span class="image">\n              <a href="/app/subs/manager/view/').concat(e.id, '">\n                <img src="').concat(e.thumbnail, '" width="65" height="65">\n              </a>\n            </span>\n            <div class="autoship-r">\n              <p class="next-ffm">\n                <span class="description">').concat(e.description, '</span>\n                Next order ships on <span class="date">').concat(e.nextFulfillmentDate, '</span>\n              </p>\n              <div class="buttons">\n                <a href="/app/subs/manager/view/').concat(e.id, '" class="cw-btn cw-btn--default cw-btn--xs">Ship Now</a>\n                <a href="/app/subs/manager/view/').concat(e.id, '" class="cw-btn cw-btn--default cw-btn--xs">Edit</a>\n              </div>\n            </div>\n          </div>\n        ')
							}, ""), "\n      ")
						}(t)), E.html(function(t) {
							return t.cart.map(e).join("")
						}(t)), t.autoship ? ($(".autoship-off").hide(), $(".autoship-on").show()) : ($(".autoship-off").show(), $(".autoship-on").hide())
					}
				})
			}
			var H = function() {
					k = $(".cw-drop-account"), j.add(k), $.subscribe("menus", function() {
						S(), T = !0
					}), $.subscribe("menus.init", function() {
						T || (S(), T = !0)
					})
				},
				P = n(78);
			var L = function() {
					var t = $("#header-main");
					t.length && (d.a.init(), C(), x(), H(), P.a.init(), function(t) {
						var e = $(window).scrollTop(),
							n = $(window).width(),
							i = $(window),
							o = "cw-fixed-nav",
							a = $(".sub-nav"),
							r = window.agent.iPad ? 100 : 150,
							s = function() {
								e = i.scrollTop(), n = i.width(), (t.hasClass("header-minimal") || n >= 970) && (e > r ? t.hasClass(o) || (t.addClass(o), a.addClass(o)) : t.hasClass(o) && (t.removeClass(o), a.removeClass(o)))
							},
							c = function() {
								e = i.scrollTop(), i.width() <= 970 ? (t.removeClass(o), a.removeClass(o)) : e > r ? (t.addClass(o), a.addClass(o)) : t.hasClass(o) && (t.removeClass(o), a.removeClass(o))
							},
							l = window.chewy || window.chewy.throttle ? window.chewy.throttle(s, 250) : s,
							u = window.chewy || window.chewy.throttle ? window.chewy.throttle(c, 500) : c;
						$(window).on("scroll", l), t.hasClass("header-minimal") || $(window).on("resize", u)
					}(t))
				},
				B = n(55),
				N = n(27);
			window.isAdblocked = (new u.a).check(), window.logAjaxError = l.a, $(function() {
				L(), c(), B.a.init(), Object(N.c)()
			})
		},
		76: function(t, e, n) {
			"use strict";
			e.a = function(t, e, n, i) {
				window.Raven && e.getAllResponseHeaders() && window.Raven.captureMessage(t, {
					level: "error",
					logger: "ajaxLoadError",
					extra: {
						targetUrl: i,
						adBlock: window.isAdblocked,
						jqXHR: JSON.stringify(e),
						textStatus: n
					}
				})
			}
		},
		77: function(t, e, n) {
			"use strict";

			function i(t, e) {
				for(var n = 0; n < e.length; n++) {
					var i = e[n];
					i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
				}
			}
			n.d(e, "a", function() {
				return a
			});
			var o = null,
				a = function() {
					function t() {
						return function(t, e) {
							if(!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
						}(this, t), o || (o = this), this.bait = null, this.baitClass = "pub_300x250 pub_300x250m pub_728x90 text-ad textAd text_ad text_ads text-ads text-ad-links", this.baitStyle = "width: 1px !important; height: 1px !important; position: absolute !important; left: -10000px !important; top: -1000px !important;", o
					}
					return function(t, e, n) {
						e && i(t.prototype, e), n && i(t, n)
					}(t, [{
						key: "createBait",
						value: function() {
							var t = document.createElement("div");
							t.setAttribute("class", this.baitClass), t.setAttribute("style", this.baitStyle), this.bait = window.document.body.appendChild(t)
						}
					}, {
						key: "destroyBait",
						value: function() {
							window.document.body.removeChild(this.bait), this.bait = null
						}
					}, {
						key: "check",
						value: function() {
							var t = !1;
							if(this.createBait(), null !== this.bait && null === window.document.body.getAttribute("abp") && null !== this.bait.offsetParent && 0 !== this.bait.offsetHeight && 0 !== this.bait.offsetLeft && 0 !== this.bait.offsetTop && 0 !== this.bait.offsetWidth && 0 !== this.bait.clientHeight && 0 !== this.bait.clientWidth || (t = !0), void 0 !== window.getComputedStyle) {
								var e = window.getComputedStyle(this.bait, null);
								!e || "none" !== e.getPropertyValue("display") && "hidden" !== e.getPropertyValue("visibility") || (t = !0)
							}
							return t && this.destroyBait(), t
						}
					}]), t
				}()
		},
		78: function(t, e, n) {
			"use strict";
			e.a = {
				init: function() {
					var t, e = $(".js-header-autoship-modal"),
						n = {
							name: "header-autoship-banner",
							position: 1,
							creative: "autoship-20-off"
						},
						i = {
							event: "analyticsEvent",
							eventCategory: "authenticate",
							eventLabel: "click",
							ecommerce: void 0
						};
					e.length && (dataLayer.push({
						event: "analyticsEvent",
						eventCategory: "eec",
						eventAction: "impression",
						eventLabel: "header-autoship-banner",
						ecommerce: {
							promoView: {
								promotions: [n]
							}
						}
					}), e.click(function() {
						dataLayer.push({
							event: "analyticsEvent",
							eventCategory: "eec",
							eventAction: "click",
							eventLabel: "header-autoship-banner",
							ecommerce: {
								promoClick: {
									promotions: [n]
								}
							}
						})
					})), $(".js-giftguide").click(function() {
						dataLayer.push({
							event: "analyticsEvent",
							eventCategory: "browse-nav",
							eventAction: "promo",
							eventLabel: "holiday-shop",
							ecommerce: void 0
						})
					}), $(".js-cyber-deals").click(function() {
						dataLayer.push({
							event: "analyticsEvent",
							eventCategory: "browse-nav",
							eventAction: "promo",
							eventLabel: "cyber-deals",
							ecommerce: void 0
						})
					}), $(".js-header-sign-in").click(function() {
						t = $.extend({}, i, {
							eventAction: "sign-in"
						}), dataLayer.push(t)
					}), $(".js-header-sign-out").click(function() {
						t = $.extend({}, i, {
							eventAction: "sign-out"
						}), dataLayer.push(t)
					}), $(".js-header-create-account").click(function() {
						t = $.extend({}, i, {
							eventAction: "create-account"
						}), dataLayer.push(t)
					}), $(".drop-pharmacy, .pharmacy-label").click(function(t) {
						window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushBrowseNavEvent({
							eventAction: "pharmacy"
						}, t)
					}), $(".sale-label").click(function(t) {
						window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushBrowseNavEvent({
							eventAction: "promo"
						}, t)
					}), $('#shop-rx-pharmacy a:not(.js-nav-drilldown), [data-nav-lv="3"]').click(function(t) {
						window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushBrowseNavEvent({
							eventAction: "pet"
						}, t)
					}), $(".js-ga-hierarchy").click(function(t) {
						window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushBrowseNavEvent({
							eventAction: "brand"
						}, t)
					})
				}
			}
		}
	},
	[
		[534, 0, 1]
	]
]);
//# sourceMappingURL=common-desktop.3343a2f0d2a89f28932a.packaged.js.map