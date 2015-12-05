jQuery(document).ready(function( $ ) {
    function set_height() {
        var ht = $("#db-switcher").height();
        $("#frame-area").attr("height", $(window).height() - ht + "px")
    }
    $(window).resize(function() {
    	set_height()
    }).resize();
    set_height();

    $("#dropdown").on("click", function(e){
    	if($(this).hasClass("open")) {
    		$(this).removeClass("open");
    		$(this).children("ul").slideUp("fast");
    	} else {
    		$(this).addClass("open");
    		$(this).children("ul").slideDown("fast");
    	}
    });

    // Responsive.
    $('#responsive a').on( 'click', function(e){
    	e.preventDefault();
    	var $this = $(this);
    	var current_class = $this.attr('rel');
    	var sizes = {
    	    'resp-desktop': "100%",
    	    'resp-tablet-landscape': 1040,
    	    'resp-tablet-portrait': 788,
    	    'resp-mobile-landscape': 500,
    	    'resp-mobile-portrait': 340
    	};
    	$('#frame-area').width( sizes[current_class] );
    	// Current active class.
    	$this.addClass('current').siblings().removeClass('current');
    });

})
