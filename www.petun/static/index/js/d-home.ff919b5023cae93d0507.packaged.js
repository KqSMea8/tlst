(window.webpackJsonp = window.webpackJsonp || []).push([
	[47], {
		504: function(e, o) {
			! function(e) {
				var o, i, n, r = function(o, i) {
						var n = e(o),
							r = e(window),
							t = r.scrollTop(),
							c = r.scrollTop() + r.height(),
							a = n.offset().top,
							l = a + n.outerHeight(),
							s = n.outerHeight();
						return 1 !== (i = i || 1) && (a += Math.ceil(s * i)), a >= t && l <= c
					},
					t = function() {
						o = e(".cw-hero-slider").bxSlider({
							auto: !0,
							autoHover: !0,
							pause: 6e3,
							onSlideAfter: function(e, o, i) {
								var n = {
									name: "home-hero-carousel",
									position: i + 1,
									creative: e.data("promo-creative") || ""
								};
								window.chewy && window.chewy.gaHelper && r(e, .5) && window.chewy.gaHelper.pushEecPromotionEvent("impression", "promoView", "home-hero-carousel", n)
							},
							onSliderLoad: function(o) {
								var i = e(this.getCurrentSlideElement()),
									n = {
										name: "home-hero-carousel",
										position: o + 1,
										creative: i.data("promo-creative") || ""
									};
								window.chewy && window.chewy.gaHelper && r(i, .5) && window.chewy.gaHelper.pushEecPromotionEvent("impression", "promoView", "home-hero-carousel", n), e(".cw-hero li").css("visibility", "visible")
							}
						})
					},
					c = function() {
						i = e(".watch-learn ul").bxSlider({
							minSlides: 2,
							maxSlides: 4,
							slideMargin: 25,
							slideWidth: 300,
							pager: !1,
							infiniteLoop: !1,
							hideControlOnEnd: !0
						})
					};

				function a() {
					o.destroySlider(), i.destroySlider(), c(), t()
				}
				e(document).ready(function() {
					t(), e(".autoship-brands ul, .top-rated-brands ul").bxSlider({
						minSlides: 6,
						maxSlides: 7,
						slideWidth: 160,
						slideMargin: 25,
						pager: !1,
						infiniteLoop: !1,
						responsive: !0,
						hideControlOnEnd: !0
					}), c()
				}), e(window).on("orientationchange", function() {
					clearTimeout(n), n = setTimeout(a, 500)
				}), e(".js-home-carousel a").click(function() {
					var o, i, n = e(this).closest(".cw-slide"),
						r = n.closest(".cw-slider");
					n.length && r.length && (o = n.data("promo-creative") || "", i = {
						name: "home-hero-carousel",
						position: r.find(".cw-slide").not(".bx-clone").index(n) + 1,
						creative: o
					}, window.chewy && window.chewy.gaHelper && window.chewy.gaHelper.pushEecPromotionEvent("click", "promoClick", "home-hero-carousel", i))
				})
			}(window.jQuery)
		}
	},
	[
		[504, 0]
	]
]);
//# sourceMappingURL=d-home.ff919b5023cae93d0507.packaged.js.map