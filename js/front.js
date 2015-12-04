var theme_list_open = false;
jQuery(document).ready(function( $ ) {
    function set_height() {
        var ht = $("#db-switcher").height();
        $("#iframe").attr("height", $(window).height() - ht + "px")
    }
    $(window).resize(function() {
        set_height()
    }).resize();
    set_height();
    $("#header-bar").hide();
})
