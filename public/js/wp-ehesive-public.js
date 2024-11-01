(function( $ ) {
	'use strict';

	$(function() {

		$(document).ready(function() {
			if ($('#wp_ehesive_flying_banner_wrapper').length) {
				var timeoutTime = $('#wp_ehesive_flying_banner_wrapper').data('timeout'),
						closeTime = $('#wp_ehesive_flying_banner_wrapper').data('close'),
						closeIn = document.createElement('span'),
						closeEnd = '<span class="close">close x</span>',
						closeText = 'close in ',
						t = closeTime;

				setTimeout(function() {
					var intervalClose;

					$('#wp_ehesive_flying_banner_wrapper').show();

					intervalClose = setInterval(function() {
						$(closeIn).text(closeText + t);
						$('#wp_ehesive_flying_banner_wrapper .flying-top').children().replaceWith(closeIn);
						
						if (t <= 0) {
							clearInterval(intervalClose);
							$('#wp_ehesive_flying_banner_wrapper .flying-top').children().replaceWith(closeEnd);
						}
						t--;
					}, 1000);

				}, timeoutTime * 1000);
			}
		});

		$('body').on('click', '#wp_ehesive_flying_banner_wrapper .close', function(){
			$(this).parents('#wp_ehesive_flying_banner_wrapper').hide();
		});

	});

})( jQuery );
