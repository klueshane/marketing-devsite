jQuery.noConflict();

jQuery.fn.quickEach = (function() {
   var jq = jQuery([1]);
   return function(c) {
    var i = -1,
        el, len = this.length;
    try {
     while (++i < len && (el = jq[0] = this[i]) && c.call(jq, i, el) !== false);
    } catch (e) {
     delete jq[0];
     throw e;
    }
    delete jq[0];
    return this;
   };
}());

(function($){
    
    $(window).on('load', function(){
        stickyFooter();
        columnConform();
    });

    $(window).on('resize', function(){
        stickyFooter();
        columnConform();
    });

    $(window).on('keydown', function(e){
        // 37 = < and 39 = >
        if( e.keyCode == 37 ){
            var postURL = $('.feature-image .next').attr('href');
            if( postURL ){
                window.location = postURL;
            }
        } else if( e.keyCode == 39 ) {
            var postURL = $('.feature-image .prev').attr('href');
            if( postURL ){
                window.location = postURL;
            }
        }
    });

})(jQuery);

function stickyFooter(){
    jQuery('footer.primary').css('position', 'relative');
    
    if( jQuery('body').height() < jQuery(window).height() ){
        jQuery('footer.primary').css({
            'position': 'fixed',
            'bottom': 0,
            'width': '100%'
        });
    }
}

var currentTallest = 0,
    currentRowStart = 0,
    rowDivs = [];

function setConformingHeight(el, newHeight) {
    // set the height to something new, but remember the original height in case things change
    el.data("originalHeight", (el.data("originalHeight") === undefined) ? (el.height()) : (el.data("originalHeight")));
    el.css('minHeight', newHeight);
}

function getOriginalHeight(el) {
    // if the height has changed, send the originalHeight
    return (el.data("originalHeight") === undefined) ? (el.height()) : (el.data("originalHeight"));
}

function columnConform() {
    // find the tallest DIV in the row, and set the heights of all of the DIVs to match it.
    jQuery('.posts article').each(function() {
    
        // "caching"
        var $el = jQuery(this);
        
        var topPosition = $el.position().top;

        if (currentRowStart != topPosition) {

            // we just came to a new row.  Set all the heights on the completed row
            for(currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);

            // set the variables for the new row
            rowDivs.length = 0; // empty the array
            currentRowStart = topPosition;
            currentTallest = getOriginalHeight($el);
            rowDivs.push($el);

        } else {

            // another div on the current row.  Add it to the list and check if it's taller
            rowDivs.push($el);
            currentTallest = (currentTallest < getOriginalHeight($el)) ? (getOriginalHeight($el)) : (currentTallest);

        }
        // do the last row
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);

    });

}

jQuery(document).ready(function() {	

	jQuery('.mobile-icon').live('click', function(e){
		e.preventDefault();
		jQuery('.mobile-nav').slideToggle();
	});

});

jQuery( window ).resize(function() {
  jQuery('.mobile-nav').hide();
});
