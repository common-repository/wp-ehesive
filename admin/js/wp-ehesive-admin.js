(function( $ ) {
	'use strict';

	$(function() {
		$( "body" ).on('change', '#shortcode_zone', function () {
			$('#shortcode_zone option:selected').each(function(e) {
				var width = $(this).data('width'),
						height = $(this).data('height');

				width = width !== undefined ?
								width + 'px' :
								'';
				height = height !== undefined ?
								 height + 'px':
								 '';

				$('#shortcode_width').val(width);
				$('#shortcode_height').val(height);
			});
		});

		$( "body" ).on('change', '.shortcode_zone', function (e) {
			e.preventDefault();

			$(this).find('option:selected').each(function() {
				var width = $(this).data('width'),
						height = $(this).data('height'),
						wrapp = $(this).parents(".widget-content");

				width = width !== undefined ?
								width + 'px' :
								'';

				height = height !== undefined ?
								 height + 'px':
								 '';

				$(wrapp).find('.shortcode_width').val(width);
				$(wrapp).find('.shortcode_height').val(height);
			});
		});

		$('#generate-shortcode').on('click', function(){
			var shortcode_zone = $('#shortcode_zone').val(),
					shortcode_zone_width = $('#shortcode_zone')
						.find('option[value="'+shortcode_zone+'"]')
						.data('width'),
					shortcode_zone_height = $('#shortcode_zone')
						.find('option[value="'+shortcode_zone+'"]')
						.data('height'),
					shortcode_width = $('#shortcode_width').val(),
					shortcode_height = $('#shortcode_height').val(),
					custom_css = $('#custom_css').val(),
					shortcode_attr,
					shortcode;

			shortcode_attr = shortcode_zone ?
				'zone="' + shortcode_zone + '"' :
				'';

			shortcode_attr = shortcode_width ?
				shortcode_attr + ' width="' + shortcode_width + '"' :
				shortcode_zone_width ?
				shortcode_attr + ' width="' + shortcode_zone_width + 'px"' :
				shortcode_attr + '';

			shortcode_attr = shortcode_height ?
				shortcode_attr + ' height="' + shortcode_height + '"' :
				shortcode_zone_height ?
				shortcode_attr + ' height="' + shortcode_zone_height + 'px"' :
				shortcode_attr + '';

			shortcode_attr = custom_css ?
				shortcode_attr + ' custom_css="' + custom_css + '"' :
				shortcode_attr + '';

			shortcode = '[wp-ehesive-ads-shortcode ' + shortcode_attr + ']';
			$('#result-shortcode').val(shortcode);
			$('#shortcode-result-row').show();
		});

		$('#flying_banner #wp_ehesive_flying_banner_position_vertical').on('change', function(e){
			e.preventDefault();
			$(this).find('option:selected').each(function() {
				if ($(this).val() != '') {
					$('#vertical_value').show();
				} else {
					$('#vertical_value').hide();
				}
			});
		});

		$('#flying_banner #wp_ehesive_flying_banner_position_horizontal').on('change', function(e){
			e.preventDefault();
			$(this).find('option:selected').each(function() {
				if($(this).val() != '') {
					$('#horizontal_value').show();
				} else {
					$('#horizontal_value').hide();
				}
			});
		});

		$('#flying_banner #wp_ehesive_flying_banner_zone_id').on('change', function(e){
			e.preventDefault();
			
			$(this).find('option:selected').each(function() {
				if ($(this).val() != '') {
					var width = $(this).data('width'),
							height = $(this).data('height');

					width = width !== undefined ? width + 'px' : '';
					height = height !== undefined ? height + 'px': '';

					$('#wp_ehesive_flying_banner_width').val(width);
					$('#wp_ehesive_flying_banner_height').val(height);

					$('#flying_banner_body').show();
				} else {
					$('#flying_banner_body').hide();
				}
			});
		});

		$('.modal-btn').click( function(e){
			e.preventDefault();
			var selector = $(this).data('modal') ?
					$(this).data('modal') :
					'#modal_select_site';

			$('#overlay').fadeIn(400, function() {
				$(selector)
					.css('display', 'block')
					.animate({opacity: 1, top: '50%'}, 200);
				});
		});

		$('#authenticate, #site-select, #modal_close, #overlay').click( function(){
			var selector = $(this).data('modal') ?
					$(this).data('modal') :
					'#modal_select_site';

			$(selector)
				.animate({opacity: 0, top: '45%'}, 200,
					function() {
						$(this).css('display', 'none');
						$('#overlay').fadeOut(400);
					}
				);
		});

		$('#site-select').on('click', function(e){
			e.preventDefault();
			var selected = $('#sites').find('input[type=radio]:checked');

			$('#wp_ehesive_site_id').val($(selected).val());
			$('#wp_ehesive_site_public_id').val($(selected).data('public-id'));
			$('#wp_ehesive_network_type').val($(selected).data('network'));
			$('#wp_ehesive_site_name').val($(selected).data('name'));
			$('#general-settings-form').submit();
		});

		$('#authenticate').on('click', function(e){
			e.preventDefault();
			var api_key = $('#api_key').val(),
					api_secret = $('#api_secret').val();

			$('#wp_ehesive_api_key').val(api_key);
			$('#wp_ehesive_api_secret').val(api_secret);
			$('#wp_ehesive_network_type').val('');
			$('#wp_ehesive_site_id').val('');
			$('#wp_ehesive_site_public_id').val('');
			$('#general-settings-form').submit();
		});

		$('#copy-to-clipboard').on('click', function(e) {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($('#result-shortcode').val()).select();
			document.execCommand("copy");
			$temp.remove();
			$(this).find('span').addClass('show');
		});

	});
})( jQuery );
