jQuery(document).ready(function( $ ) {
    function set_height() {
        var ht = $("#db-switcher").height();
        $("#frame-area").attr("height", $(window).height() - ht + "px")
    }
    $(window).resize(function() {
    	set_height()
    }).resize();
    set_height();
    $("#header-bar").hide();

    $("#dropdown").on("click", function(e){
    	if($(this).hasClass("open")) {
    		$(this).removeClass("open");
    		$(this).children("ul").slideUp("fast");
    	} else {
    		$(this).addClass("open");
    		$(this).children("ul").slideDown("fast");
    	}
    });
})
