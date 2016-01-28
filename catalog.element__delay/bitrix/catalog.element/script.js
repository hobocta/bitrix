(function($) {
	$(document).ready(function() {


		/**
		 * Delay product
		 */

		$('.catalog-element__delay').on('click', function(event) {
			event.preventDefault();
			var delayLink = $(this);
			var delayedLink = $('.catalog-element__delayed');
			$.ajax({
				url: $(this).attr('href'),
				success: function(data) {
					result = parseInt(data);
					if (!result) {
						alert("Can't add to basket delay product");
					} else {
						delayLink.hide();
						delayedLink.show();
					}
				}
			});
		});

	});
})(jQuery);
