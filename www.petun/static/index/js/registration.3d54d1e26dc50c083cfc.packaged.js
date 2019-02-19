(window.webpackJsonp = window.webpackJsonp || []).push([
	[53], {
		510: function(e, s) {
			$.subscribe("validation.ready", function() {
				var e = window.chewy.FormValidator;
				e.validate($("#registration-form"), {
					rules: {
						fullName: e.commonOpts.rules.fullName,
						email: e.commonOpts.rules.email,
						password: e.commonOpts.rules.password,
						passwordVerify: e.commonOpts.rules.passwordVerify
					},
					messages: {
						fullName: e.commonOpts.messages.fullName,
						email: e.commonOpts.messages.email,
						password: e.commonOpts.messages.password,
						passwordVerify: e.commonOpts.messages.passwordVerify
					}
				})
			}), $(function() {
				"use strict";
				var e = {
						event: "analyticsEvent",
						eventCategory: "authenticate",
						ecommerce: void 0
					},
					s = $.extend({}, e, {
						eventAction: "create-account",
						eventLabel: "view"
					});
				dataLayer.push(s), $(".js-create-account").click(function() {
					s = $.extend({}, e, {
						eventAction: "create-account",
						eventLabel: "submit"
					}), dataLayer.push(s)
				}), $(".js-sign-in").click(function() {
					s = $.extend({}, e, {
						eventAction: "sign-in",
						eventLabel: "click"
					}), dataLayer.push(s)
				}), $(".checkout-chat-dd").on("click", function(e) {
					e.preventDefault()
				}), $("body").on("touchstart", function() {
					$(".js-dropdown, .chewckout-chat, .checkout-chat-dd").blur()
				})
			})
		}
	},
	[
		[510, 0]
	]
]);
//# sourceMappingURL=registration.3d54d1e26dc50c083cfc.packaged.js.map