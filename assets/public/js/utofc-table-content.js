/* Table Of Content */
(function ($) {
	"use strict";
	var WidgetTableOfContentHandler = function ($scope, $) {
		var container = $scope.find('.utofc-table-content');

		if (container.length) {
			var settings = container.data('settings');
			tocbot.init({
				...settings
			});

			if ($scope.find('.utofc-table-content.utofc-toc-hash-tag').length) {
				var conselector = settings['contentSelector'],
					headselector = settings['headingSelector'],
					hashtagtext = settings['hashtagtext'];

				var strarray = headselector.split(',');
				for (var i = 0; i < strarray.length; i++) {
					$(conselector + ' ' + strarray[i]).each(function () {
						var id = $(this).attr('id');
						if ($scope.find('.utofc-table-content.utofc-toc-hash-tag.utofc-toc-hash-tag-hover').length) {
							var data = '<a href="#' + id + '" class="utofc-toc-hash-tag utofc-on-hover">' + hashtagtext + '</a><span class="utofc-copy-hash" style="opacity: 0;">Copied</span>';
						} else {
							var data = '<a href="#' + id + '" class="utofc-toc-hash-tag">' + hashtagtext + '</a><span class="utofc-copy-hash" style="opacity: 0;">Copied</span>';
						}
						$(this).append(data);
					});
				}

				$('.utofc-toc-hash-tag').on('click', function (e) {
					e.preventDefault();
					$(this).next().css("opacity", "1");
					var toccopyText = $(this).attr('href'),
						winurl = window.location.href + toccopyText;
					var $temp = $('<input style="height:0">');
					$("body").append($temp);
					$temp.val(winurl).select();
					document.execCommand("copy");
					$temp.remove();
					setTimeout(function () {
						$('.utofc-copy-hash').css("opacity", "0");
					}, 1500);

					// Smooth scroll to the target section
					var target = $(toccopyText);
					if (target.length) {
						$('html, body').animate({
							scrollTop: target.offset().top
						}, 1000);
					}
				});
			}

			if ($scope.find('.utofc-table-content .table-toggle-wrap').length) {
				$('.table-toggle-wrap').each(function () {
					var defaultToggle = $(this).data('default-toggle');
					var Width = window.innerWidth;

					if ((Width > 1200 && defaultToggle.md) || (Width < 1201 && Width >= 768 && defaultToggle.sm) || (Width < 768 && defaultToggle.xs)) {
						$(this).addClass("active");
						$('.utofc-toc', this).slideDown(500);

					} else {
						$(this).removeClass("active");
						$('.utofc-toc', this).slideUp(500);
					}
					$('.utofc-toc-heading', this).on('click', function () {
						var togglewrap = $(this).closest('.table-toggle-wrap');
						if (togglewrap.hasClass('active')) {
							togglewrap.removeClass("active");
							togglewrap.find('.utofc-toc').slideUp(500);
							togglewrap.find('.table-toggle-icon').empty();
							togglewrap.find('.table-toggle-icon').html($(this).closest('.utofc-toc-wrap').data("close"));
						} else {
							togglewrap.addClass("active");
							togglewrap.find('.utofc-toc').slideDown(500);
							togglewrap.find('.table-toggle-icon').empty();
							togglewrap.find('.table-toggle-icon').html($(this).closest('.utofc-toc-wrap').data("open"));
						}
					});
				});
			}
		}
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/UsefulTableOfContent.default', WidgetTableOfContentHandler);
	});
})(jQuery);
