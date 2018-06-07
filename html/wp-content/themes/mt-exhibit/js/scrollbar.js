jQuery(document).ready(function($) {
	$(function() {
		$('.horizontal-slider').perfectScrollbar(
			{
				suppressScrollY: true,
				wheelPropagation: true,
				minScrollbarLength: 20
			});
	});
});