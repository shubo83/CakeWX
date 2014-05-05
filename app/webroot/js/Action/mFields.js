jQuery(function($) {
	$('.dd').nestable({'maxDepth':2});
		
	$('.dd').on('change', function() {
		console.log($('.dd').nestable('serialize'));

	    /* on change event */
	});	
});
