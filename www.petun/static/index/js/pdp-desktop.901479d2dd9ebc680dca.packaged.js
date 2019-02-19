(window.webpackJsonp = window.webpackJsonp || []).push([
	[13], {
		42: function(t, e, i) {
			"use strict";
			i.d(e, "b", function() {
				return a
			});
			var a = function(t, e) {
				$.ajax({
					url: "/app/rest/interestLists/FAVORITES/interestItems?catalogEntryId=".concat(t),
					type: "GET",
					cache: !1,
					contentType: "application/json",
					dataType: "json",
					timeout: 12e3
				}).then(e, function(t) {
					window.Raven && (window.io_last_error && window.Raven.setExtraContent({
						ioLastError: window.io_last_error
					}), window.Raven.captureMessage("Failed to load Favorites item ".concat(JSON.stringify(t)), {
						level: "error",
						logger: "favorites.getFavoriteItem"
					}), console.error("Failed to get Favorites item"))
				})
			};
			e.a = function() {
				$.subscribe("addToFavorites:delete", function(t, e) {
					var i = e.data.itemId;
					$.ajax({
						url: "/app/rest/interestLists/interestItems/".concat(i),
						type: "DELETE"
					}).then(e.callback, function(t) {
						window.Raven && (window.io_last_error && window.Raven.setExtraContent({
							ioLastError: window.io_last_error
						}), window.Raven.captureMessage("Failed to delete Favorites item ".concat(JSON.stringify(t)), {
							level: "error",
							logger: "favorites.deleteFavoriteItem"
						}), console.error("Failed to delete Favorites item"))
					}), window.dataLayer && dataLayer.push({
						event: "analyticsEvent",
						eventAction: "unfavorite",
						eventCategory: "favorite",
						eventLabel: window.chewy && window.chewy.pageType
					})
				}), $.subscribe("addToFavorites:post", function(t, e) {
					$.ajax({
						url: "/app/rest/interestLists/FAVORITES/interestItems",
						type: "POST",
						contentType: "application/json",
						dataType: "json",
						data: JSON.stringify(e.data),
						timeout: 5e3
					}).then(e.callback, function(t) {
						var i = "Oops! We were unable to save to your favorites.";
						if(400 === t.status) t.responseJSON.errors.filter(function(t) {
							if("limit exceeded" === t.message) return i = "Oops! No more than 250 items can be added to your favorites.", t
						}), e.err && setTimeout(function() {
							console.log(i), e.err(i)
						}, 1e3);
						else if(window.Raven && (window.io_last_error && window.Raven.setExtraContent({
								ioLastError: window.io_last_error
							}), window.Raven.captureMessage("Failed to post Favorites item ".concat(JSON.stringify(t)), {
								level: "error",
								logger: "favorites.postFavoriteItem"
							}), console.error("Failed to post Favorites item"), e.err)) return e.err(t)
					}), window.dataLayer && dataLayer.push({
						event: "analyticsEvent",
						eventAction: "favorite",
						eventCategory: "favorite",
						eventLabel: window.chewy && window.chewy.pageType
					})
				})
			}
		},
		532: function(t, e, i) {
			"use strict";

			function a(t) {
				return function(t) {
					if(Array.isArray(t)) {
						for(var e = 0, i = new Array(t.length); e < t.length; e++) i[e] = t[e];
						return i
					}
				}(t) || function(t) {
					if(Symbol.iterator in Object(t) || "[object Arguments]" === Object.prototype.toString.call(t)) return Array.from(t)
				}(t) || function() {
					throw new TypeError("Invalid attempt to spread non-iterable instance")
				}()
			}
			i.r(e);
			var o, n, r = {
					init: function() {
						var t = this,
							e = $("#Zoomer"),
							i = $(".product-top").height(),
							o = $("#right-column").width();
						window.mzOptions = {
							zoomPosition: "#zoom-container",
							zoomWidth: o,
							zoomHeight: i,
							selectorTrigger: "click",
							transitionEffect: !1,
							cssClass: "dark-bg no-expand-thumbnails",
							hint: "off",
							onUpdate: function() {
								$("a[data-wistia-vid]").removeClass("active"), $("#product-image [data-wistia-vid]").css({
									visibility: "hidden"
								}), e.css({
									visibility: "visible"
								}), $("#media-selector").find("a").removeClass("active")
							},
							onExpandOpen: function() {
								"function" == typeof t.onExpandOpenCallback && t.onExpandOpenCallback(), a(document.querySelectorAll(".mz-button-prev, .mz-button-next")).forEach(function(e) {
									e.removeEventListener("click", t.analyticsTagging), e.addEventListener("click", t.analyticsTagging)
								})
							},
							onExpandClose: function() {
								"function" == typeof t.onExpandCloseCallback && t.onExpandCloseCallback()
							}
						}
					},
					analyticsTagging: function() {
						var t = 0;
						$(".bx-viewport > div > a").each(function(e, i) {
							$(i).hasClass("mz-thumb-selected") && (t = e + 1)
						}), window.dataLayer && dataLayer.push({
							event: "analyticsEvent",
							eventAction: "product-thumbnails",
							eventCategory: "pdp",
							eventLabel: "".concat(t, ":photo")
						})
					},
					zoomTooltip: function() {
						var t, e = $(".zoom-info"),
							i = ["翻转图像放大", "单击以展开展开视图", "触摸图像放大", "点击播放视频", "点击播放视频"];
						t = !!("ontouchstart" in window || navigator.maxTouchPoints) && !navigator.maxTouchPoints, e.show(), t ? e.text(i[2]) : (e.text(i[0]), $(".MagicZoom").on("mouseover", function() {
							e.text(i[1])
						}).on("mouseleave", function() {
							e.text(i[0])
						})), $("#media-selector a").on("mouseenter touchend", function() {
							$(this).hasClass("trigger-video") ? t ? e.text(i[4]) : e.text(i[3]) : t ? e.text(i[2]) : e.text(i[0])
						})
					},
					quickImageSwap: function(t, e) {
						var i = new Image;
						i.onload = function() {
							var e = $("#Zoomer"),
								i = e.innerHeight();
							e.height(i), e.find("img").attr("src", t).css({
								"max-height": "400px"
							}), $("#product-image [data-wistia-vid]").removeClass("is-on-focus"), e.height("auto")
						}, i.src = t, window.MagicZoom.update("Zoomer", e, t)
					},
					refresh: function() {
						window.MagicZoom.refresh()
					}
				},
				s = i(10);

			function d() {
				var t = $("#media-selector"),
					e = s.a.getWindowWidth(),
					i = $(".product-top"),
					a = {
						infiniteLoop: !1,
						hideControlOnEnd: !0,
						touchEnabled: !1
					};
				e < 1200 ? (i.removeClass("is-vertical").addClass("is-horizontal"), n = $.extend({}, a, {
					minSlides: 3,
					maxSlides: 5,
					slideWidth: 70,
					slideMargin: 4
				})) : e >= 1200 && (i.removeClass("is-horizontal").addClass("is-vertical"), n = $.extend({}, a, {
					mode: "vertical",
					minSlides: 6,
					maxSlides: 6,
					slideWidth: 90,
					slideMargin: 6
				})), t.removeClass("no-padd"), o && "function" == typeof o.reloadSlider ? o.reloadSlider(n) : o = t.find("> div").bxSlider(n), t.find(".bx-pager-item").length <= 1 && (t.find(".bx-controls-direction").hide(), i.hasClass("is-vertical") && t.addClass("no-padd")), t.css({
					visibility: "visible"
				})
			}
			var c = function() {
					var t, e = $("#media-selector"),
						i = $("#Zoomer"),
						a = s.a.getWindowWidth(),
						o = window.chewy.debounce(function() {
							a !== s.a.getWindowWidth() && (a = s.a.getWindowWidth(), d())
						}, 500),
						n = e.find("a");
					$(window).on("resize.mediaSlider", o), d(), r.init(), r.zoomTooltip(), r.onExpandOpenCallback = function() {
						t = e.find(".mz-thumb-selected")
					}, r.onExpandCloseCallback = function() {
						n.removeClass("active"), r.quickImageSwap(t.data("image"), t.attr("href"))
					}, n.on("mouseenter touchend", function(t) {
						var e = $(t.currentTarget),
							a = $("#image-overlays .sale-overlay"),
							o = $("#product-image [data-wistia-vid]");
						n.removeClass("active").removeClass("mz-thumb-selected"), e.addClass("active"), e.is("[data-wistia-vid]") ? (a.hide(), i.css({
							visibility: "hidden"
						}), o.css({
							visibility: "hidden"
						}).filter("[data-wistia-vid=".concat(e.data("wistia-vid"), "]")).css({
							visibility: "visible"
						})) : (i.css({
							visibility: "visible"
						}), o.css({
							visibility: "hidden"
						}), r.quickImageSwap(e.data("image"), e.attr("href"))), i.attr("data-ga-index", e.data("ga-index")), i.attr("data-ga-media", e.data("ga-media")), e.hasClass("main-img") ? a.show() : a.hide()
					})
				},
				l = function() {
					o && "function" == typeof o.destroySlider && o.destroySlider(), o = void 0, $(window).off("resize.mediaSlider")
				},
				u = function(t) {
					var e = $("#vidcaption_".concat(t.hashedId())).parent(),
						i = e.find(".wistia-popover-content"),
						a = e.find(".wistia-popover-title"),
						o = $(t._embedContainer);
					window.vid = t, i.addClass("notransition"), i.css("transform", "translate(0px, -".concat(o.innerHeight() + i.innerHeight(), "px")), a.width(o.innerWidth() - 25)
				};
			window.wistiaEmbedShepherdReady = function() {
				window.wistiaEmbeds.onFind(function(t) {
					t.embedded(function() {
						var e = $(".alt-vid[data-wistia-vid=".concat(t.hashedId(), "]")).is(".alt-vid-main");
						if(0 === $(".pdp-video-callout img").length && e) {
							var i = "".concat(window.wistiaUtils.extractThumbnailUrl(t.data), "?image_crop_resized=450x250"),
								a = $("<img src='".concat(i, "' class='pdp-callout-thumbnail'>")),
								o = $(".pdp-video-callout");
							a.load(function() {
								$(".pdp-video-callout .video-play").show()
							}), o.find(".thumbnail-placeholder").hide(), o.find("a").click(function(e) {
								e.preventDefault(), t.popover.show(), t.play()
							}), o.find("a .img-wrap").prepend(a), o.show()
						}
					}), t.bind("popovershow", function() {
						return u(t)
					}), t.bind("widthchange", function() {
						return u(t)
					}), t.bind("heightchange", function() {
						return u(t)
					}), t.bind("play", function() {
						for(var e = window.Wistia.api.all(), i = 0; i < e.length; i += 1) e[i].hashedId() !== t.hashedId() && e[i].pause()
					})
				})
			};
			var p = function() {
					$("[data-wistia-vid]").length && ($("#imageblock-feature").parent().on("click", "#media-selector .alt-vid", function(t) {
						var e = $(this).data("wistia-vid"),
							i = window.Wistia.api(e);
						t.preventDefault(), i && (i.popover.show(), i.play())
					}), $("body").on("click", ".wistia-popover-close", function(t) {
						t.preventDefault();
						for(var e = window.Wistia.api.all(), i = 0; i < e.length; i += 1) {
							var a = e[i];
							a.popover && a.popover.hide()
						}
					}))
				},
				h = function() {
					if($(".pdp-video-callout").hide().find("img").remove(), void 0 !== window.Wistia)
						for(var t = window.Wistia.api.all(), e = 0; e < t.length; e += 1) t[e].remove(), t[e] = null
				},
				f = {
					init: function() {
						c(), p()
					},
					tearDown: function() {
						l(), h()
					}
				},
				w = (i(2), {
					$autoshipModal: null,
					$modalTarget: $("#autoship-modal .cw-modal-content"),
					init: function() {
						this.$autoshipModal = $("#autoship-modal .cw-modal-content iframe"), this.setupAutoShip(), this.setupAddtoCart()
					},
					setupAddtoCart: function() {
						var t = this;
						$(".js-add-cart").on("click", function(e) {
							e.preventDefault(), t.handleBuy(e.target)
						})
					},
					handleBuy: function(t) {
						var e, i, a = t.form;
						if(window.blockMultiClick(t, 1e3), window.chewy && window.chewy.gaHelper && (e = window.chewy.gaHelper.buildAddToCartEvent(), !$.isEmptyObject(e) && (window.chewy.gaHelper.pushEnhancedEcomEvent("addToCart", e), window.chewy.gaHelper.pushFacebookEvent("AddToCart", "product"), i = $(".ga-eec__id").filter(":first").text().trim(), window.chewy.gaHelper.pushAdwordsRemarketing(i, "cart"), e.add && e.add.products && e.add.products.length > 0))) {
							var o = e.add.products[0],
								n = parseFloat(o.price),
								r = parseInt(o.quantity, 10),
								s = [],
								d = [],
								c = [];
							s.push(n * r * 100), d.push(o.id), c.push(r), window.chewy.gaHelper.pushNanigansUserEvent("add_to_cart", s, d, c)
						}
						a.submit()
					},
					setIframeWidth: function() {
						var t = $(window).width();
						return t > 960 ? 900 : t - 80
					},
					setupAutoShip: function() {
						var t = this;
						$("#buybox").find(".btn-autoship").on("click", function(e) {
							var i, a = $(e.target).parents("form:first"),
								o = "/app/subs/add-items?dialog=1&".concat(a.serialize());
							e.preventDefault(), window.blockMultiClick(e, 1e3), t.$modalTarget.html('<iframe src="'.concat(o, '" height="500" width="').concat(t.setIframeWidth(), '">')), $.publish("cwModal.launch", {
								target: "#autoship-modal"
							}), window.chewy && window.chewy.gaHelper && (i = window.chewy.gaHelper.buildAddToCartEvent(), $.isEmptyObject(i) || window.chewy.gaHelper.pushEnhancedEcomEvent("addToAutoship", i))
						}), $(window).on("orientationchange", function() {
							setTimeout(function() {
								this.$autoshipModal && this.$autoshipModal.attr("width", this.setIframeWidth()), $.publish("cwModal.setPosition")
							}, 200)
						}), $(window).on("message", function(t) {
							"cwModal.close" !== t.data && "cwModal.close" !== t.originalEvent.data || $.publish("cwModal.close")
						})
					}
				}),
				v = {},
				g = ["#product-title", "#imageblock-feature", "#afterimageblock-feature", "#brand", ".ugc-head", "#pricing", "#featured-promotions", "#availability", "#sku-selector", "#buybox", "#detailed-info", ".js-alternate", ".js-badges"];

			function m() {
				var t = [];
				$.each($("#sku-selector").find("li.selected, li.hover"), function(e, i) {
					($(i).hasClass("hover") || $(i).hasClass("selected") && 0 === $(i).siblings(".hover").length) && t.push(parseInt($(i).attr("dim-value-id"), 10))
				});
				var e = Object.keys(window.variationsItemMap).filter(function(e) {
					return 0 === window.variationsItemMap[e].filter(function(e) {
						return -1 === t.indexOf(e)
					}).length
				});
				return e.length ? e[0] : -1
			}

			function b(t) {
				var e, i, a, o;
				$(".ugc-head").css({
					opacity: 1
				});
				for(var n = 0; n < g.length; n += 1) ".ugc-head" !== g[n] && (e = $("<output>").append($.parseHTML(t.responseText)), (i = $(e).find(g[n])) && $(g[n]).replaceWith(i));
				window.chewy && window.chewy.gaHelper && (window.chewy.gaHelper.pushFacebookEvent("ViewContent", "product"), a = window.chewy.gaHelper.buildEcommerce("detail", $(document)), $.isEmptyObject(a) || (o = $(".ga-eec__availability").text().trim(), window.chewy.gaHelper.pushEnhancedEcomEvent("detail", a, o)), window.chewy.gaHelper.refreshAnalyticsData()), $.publish("mda.productRefresh"), $.publish("pdp.replaceContent")
			}

			function y(t) {
				for(var e = window.itemData[t].ajaxURL, i = 0; i < g.length; i += 1) "#sku-selector" !== g[i] && $(g[i]).css({
					opacity: .5
				});
				v[e] ? b(v[e]) : $.ajax({
					url: e,
					complete: function(t) {
						v[e] = t, b(t)
					}
				})
			}
			var _, x = {
					init: function() {
						var t = $("#sku-selector"),
							e = $(".js-swap-overlay"),
							i = e.find("img"),
							a = {};
						t.find(".variation").each(function(t, e) {
							var i = parseInt($(e).attr("dim-id"), 10);
							a[i] = $(e).find(".js-selection-value").text()
						}), t.find("li:not(.selected)").hover(function() {
							var t = $(this).parent().parent().find(".js-selection-value"),
								a = $(this).find("span").html();
							$(this).addClass("hover");
							var o = m();
							if(t.html(a), -1 !== o) {
								var n = window.itemData[o].images[0];
								i.attr("src", n), e.show()
							}
						}, function() {
							var t = $(this).parent().parent().find(".js-selection-value"),
								i = t.parent().parent().attr("dim-id");
							$(this).removeClass("hover"), t.html(a[i]), e.hide()
						}), t.find("li:not(.selected)").on("click touchstart", function(t) {
							$(this).siblings().removeClass("selected"), $(this).addClass("selected");
							var e, i, o, n, r = m();
							if(t.preventDefault(), -1 !== r) e = $(this).closest("[dim-id]").attr("dim-id"), a[e] = $(this).text().trim(), y(r);
							else
								for(n in i = parseInt($(this).attr("dim-value-id"), 10), window.variationsItemMap)
									if(Object.hasOwnProperty.call(window.variationsItemMap, n) && -1 !== window.variationsItemMap[n].indexOf(i)) {
										y(n);
										break
									}
							r && window.itemData[r] && window.chewy && window.chewy.gaHelper && (o = String(window.itemData[r].sku), window.chewy.gaHelper.pushAdwordsRemarketing(o, "product"))
						})
					}
				},
				C = {
					init: function() {
						var t = $(".js-popover");
						if(t.length) {
							var e = $("body");
							e.popover({
								selector: ".js-popover"
							}), t.on("show.bs.popover", function() {
								$(this).addClass("popover-trigger--active")
							}).on("hidden.bs.popover", function(t) {
								$(this).removeClass("popover-trigger--active"), $(t.target).data("bs.popover").inState.click = !1
							}), e.on("click touchstart", function(t) {
								$("[data-toggle=popover]").each(function() {
									$(this).is(t.target) || 0 !== $(this).has(t.target).length || 0 !== $(".popover").has(t.target).length || $(this).popover("hide")
								})
							})
						}
					}
				};

			function E() {
				return {
					minSlides: $(".js-alternate .cw-slider li").length >= 2 && $(window).width() < 970 ? 2 : 3,
					maxSlides: 3,
					slideWidth: 460,
					slideMargin: 20,
					pager: !1,
					infiniteLoop: !1,
					hideControlOnEnd: !0
				}
			}
			var j = {
					init: function() {
						var t = $(".js-alternate").find(".alternate");
						if(t.length > 0 && !t.hasClass("alternate--one")) {
							var e = window.chewy.throttle(function() {
								_ ? _.reloadSlider(E()) : _ = $(".alternate .cw-slider").bxSlider(E())
							}, 500);
							$(window).on("resize.alternateSlider", e);
							var i = $(".js-alternate .cw-slider li");
							$(window).width() <= 970 && i.length > 2 ? _ = $(".alternate .cw-slider").bxSlider(E()) : $(window).width() > 970 && i.length > 3 && (_ = $(".alternate .cw-slider").bxSlider(E()))
						}
					},
					tearDown: function() {
						_ && "function" == typeof _.destroySlider && _.destroySlider(), _ = void 0, $(window).off("resize.alternateSlider")
					}
				},
				k = i(42),
				T = {
					init: function() {
						this.setupAddtoFavorites()
					},
					setupAddtoFavorites: function() {
						var t = $(".js-buybox__favorite"),
							e = window.location.search,
							i = t.data("user-id") > 0,
							a = function(t, e) {
								e ? t.addClass("buybox__favorite--added").find(".js-cw-icon--favorite").addClass("cw-icon--favorite-added").find(".cw-icon__label").text(t.find(".cw-icon__label").text().replace(/(?!Added)(Add)/g, "Added")) : t.removeClass("buybox__favorite--added").find(".js-cw-icon--favorite").removeClass("cw-icon--favorite-added").find(".cw-icon__label").text(t.find(".cw-icon__label").text().replace(/(Added)/g, "Add"))
							},
							o = function(t, e, i) {
								if(e) {
									if(t.addClass("js-buybox__favorite--disabled buybox__favorite--error"), i && i.length) {
										var a = $("<p/>");
										a.addClass("buybox__favorite__error js-buybox__favorite__error"), a.text(i), t.append(a).find(".js-cw-icon--favorite").css("display", "none")
									}
								} else t.removeClass("js-buybox__favorite--disabled").find(".js-cw-icon--favorite").css("display", "").parent().find(".js-buybox__favorite__error").remove()
							},
							n = function(t, e) {
								e ? t.addClass("js-buybox__favorite--disabled").append('<span class="cw-loader cw-loader--btn"></span>').find(".js-cw-icon--favorite").css("display", "none") : t.removeClass("js-buybox__favorite--disabled").find(".js-cw-icon--favorite").css("display", "").parent().find(".cw-loader").remove()
							},
							r = {
								_showLoader: !1,
								_showError: !1,
								_showAdded: !1,
								$favoritesEl: $(".js-buybox__favorite"),
								setError: function(t) {
									t && t.length && (this.errorMessage = t), this.showError = !0
								}
							};
						Object.defineProperty(r, "showLoader", {
							enumerable: !0,
							configurable: !0,
							get: function() {
								return this._showLoader
							},
							set: function(t) {
								this._showLoader = t, !0 === t ? (this.showError = !1, this.showAdded = !1, n(this.$favoritesEl, !0)) : n(this.$favoritesEl, !1)
							}
						}), Object.defineProperty(r, "showError", {
							enumerable: !0,
							configurable: !0,
							get: function() {
								return this._showError
							},
							set: function(t) {
								this._showError = t, !0 === t ? (this.showLoader = !1, this.showAdded = !1, this.errorMessage ? o(this.$favoritesEl, !0, this.errorMessage) : o(this.$favoritesEl, !0)) : o(this.$favoritesEl, !1)
							}
						}), Object.defineProperty(r, "showAdded", {
							enumerable: !0,
							configurable: !0,
							get: function() {
								return this._showAdded
							},
							set: function(t) {
								this._showAdded = t, !0 === t ? (this.showLoader = !1, this.showError = !1, a(this.$favoritesEl, !0)) : a(this.$favoritesEl, !1)
							}
						});
						$(".js-buybox__favorite").off("click").on("click", function(t) {
							t.preventDefault();
							var e = $(t.currentTarget),
								a = encodeURIComponent("".concat(window.location.pathname, "?addToFavorites"));
							r.$favoritesEl = e, i ? e.hasClass("js-buybox__favorite--disabled") || (e.hasClass("buybox__favorite--added") ? (e.removeClass("buybox__favorite--added"), $.publish("addToFavorites:delete", {
								data: {
									itemId: $(".js-buybox__favorite").attr("data-item-id")
								},
								callback: function(t) {
									r.showLoader = !0, setTimeout(function() {
										r.showLoader = !1, r.showAdded = !1, $(".js-buybox__favorite").attr("data-item-id", "")
									}, 500)
								}
							})) : (r.showLoader = !0, $.publish("addToFavorites:post", {
								data: {
									catalogEntryId: e.data("catalog-entry-id")
								},
								callback: function(t) {
									setTimeout(function() {
										r.showAdded = !0, $(".js-buybox__favorite").attr("data-item-id", t.itemId)
									}, 500)
								},
								err: function(t) {
									r.setError(t)
								}
							}))) : window.location.href = "/app/login?targetUrl=".concat(a)
						});
						var s = function() {
							return Object(k.b)($(".js-buybox__favorite").data("catalog-entry-id"), function(t) {
								var i = $(".js-buybox__favorite");
								t && t.items && t.items.length && (i.attr("data-item-id", t.items[0].id), r.showAdded = !0), -1 === e.indexOf("addToFavorites") || i.hasClass("buybox__favorite--added") || i.trigger("click")
							})
						};
						$(window).on("popstate", function() {
							i && s()
						}), i && s()
					}
				},
				S = i(79),
				O = i(3),
				L = i(80),
				A = document.getElementById("vue-mount__sfw-page-product");

			function I() {
				f.init(), C.init(), j.init(), w.init(), x.init(), T.init(), S.a.init()
			}
			A && new O.default({
				el: A,
				render: function(t) {
					return t(L.a)
				}
			}), $(function() {
				$.subscribe("mda.productRefresh", function() {
					$.publish("cwTab.set"), j.tearDown(), f.tearDown(), I(), r.refresh()
				}), Object(k.a)(), I()
			})
		},
		79: function(t, e, i) {
			"use strict";
			var a = i(2),
				o = function(t) {
					var e = $(t.target).attr("data-ga-action") ? $(t.target) : $(t.target).closest("[data-ga-action]"),
						i = e.attr("data-ga-action") || "",
						o = e.attr("data-ga-category") || "",
						n = "";
					n = e.attr("data-ga-type") && "thumbnail" === e.attr("data-ga-type") ? "".concat(parseInt(e.attr("data-ga-index")) + 1, ":").concat(e.attr("data-ga-media")) : e.attr("data-ga-label") || "", Object(a.c)({
						context: {
							action: i,
							category: o,
							label: n
						}
					})
				};
			e.a = {
				isMobile: function() {
					return "mobile" === window.chewy.deviceType()
				},
				init: function() {
					var t = this;
					this.initializePxTags(), $.subscribe("pdp.replaceContent", function() {
						t.initializePdpTags(), t.initializePxTags()
					})
				},
				initializePdpTags: function() {
					var t;
					window.dataLayer && dataLayer.push({
						product_part_number: $(".js-ugc-qna--pdp").attr("data-part-number")
					}), $(".js-quantity-dropdown").on("focus", function(e) {
						t = e.target.value
					}).change(function(e) {
						Object(a.c)({
							context: {
								action: "change-quantity",
								category: "pdp",
								label: "".concat(t, ":").concat(e.target.value)
							}
						}), t = e.target.value
					}), this.isMobile() ? $(".pdp-carousel-slider li").each(function(t, e) {
						$(e).find(".pdp-media-img").attr("data-ga-index", t)
					}) : $(".bx-viewport > div > a").each(function(t, e) {
						$(e).attr("data-ga-index", t)
					}), $("[data-ga-action][data-ga-category]").off("click", o), $("[data-ga-action][data-ga-category]").on("click", o)
				},
				initializePxTags: function() {
					if($(".js-pharmaceutical").length) {
						var t = function(t) {
							var e;
							switch($(t.target).closest(".variation").attr("dim-identifier")) {
								case "Count":
									e = "size";
									break;
								case "Size":
									e = "dosage"
							}
							return e
						};
						this.isMobile() ? $(".variation-options__option").on("click touchstart", function(e) {
							var i = $(e.target).closest(".variation-options__option").find(".variation-options__dimension").html().trim();
							Object(a.c)({
								context: {
									action: t(e),
									category: "modify-pharmacy-item",
									label: i
								}
							})
						}) : $(".cw-dropdown__menu li").on("click touchstart", function(e) {
							var i = $(e.target).closest(".variation").find(".selected .js-drop-text").html().trim();
							Object(a.c)({
								context: {
									action: t(e),
									category: "modify-pharmacy-item",
									label: i
								}
							})
						}), $(".js-rx-link").on("click touchstart", function(t) {
							var e = $(t.target).attr("href");
							Object(a.c)({
								context: {
									action: "additional-info",
									category: "pharmacy-content",
									label: e
								}
							})
						}), $(".js-rx-pdf").on("click touchstart", function(t) {
							var e = $(t.target).attr("href");
							Object(a.c)({
								context: {
									action: "pdf",
									category: "pharmacy-content",
									label: e
								}
							})
						})
					}
				}
			}
		},
		80: function(t, e, i) {
			"use strict";
			var a = i(3),
				o = i(15),
				n = i.n(o),
				r = i(7),
				s = i(57),
				d = i(26);
			a.default.use(n.a);
			var c = {
					components: {
						ReviewGallery: s.a,
						CwProductList: d.a
					},
					data: function() {
						return {
							reviewGalleryProps: null,
							productListProps: null
						}
					},
					computed: {
						hasGallery: function() {
							return !!this.reviewGalleryProps
						},
						hasProductList: function() {
							return !!this.productListProps
						}
					},
					beforeMount: function() {
						var t = this.$parent.$el.parentNode,
							e = t.querySelector("#vue-portal__review-gallery");
						e && (this.reviewGalleryProps = Object(r.a)(e));
						var i = t.querySelector("#vue-portal__cw-product-list");
						i && (this.productListProps = Object(r.a)(i))
					}
				},
				l = i(0),
				u = Object(l.a)(c, function() {
					var t = this,
						e = t.$createElement,
						i = t._self._c || e;
					return i("div", [t.hasGallery ? i("portal", {
						attrs: {
							"target-el": "#vue-portal__review-gallery"
						}
					}, [i("review-gallery", t._b({}, "review-gallery", t.reviewGalleryProps, !1))], 1) : t._e(), t._v(" "), t.hasProductList ? i("portal", {
						attrs: {
							"target-el": "#vue-portal__cw-product-list"
						}
					}, [i("cw-product-list", t._b({}, "cw-product-list", t.productListProps, !1))], 1) : t._e()], 1)
				}, [], !1, null, null, null);
			u.options.__file = "sfw-page-product.vue";
			e.a = u.exports
		}
	},
	[
		[532, 0, 1]
	]
]);
//# sourceMappingURL=pdp-desktop.901479d2dd9ebc680dca.packaged.js.map