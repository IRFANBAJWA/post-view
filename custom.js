(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(function () {
        jQuery(document).ready(function () {
            jQuery( "#vuser" ).click(function() {
               
                jQuery("#popmake-1384").css("display:none !important;");
                
                if( ajax_user_object.user_ip === ajax_user_object.cookies_ip){ //#pum-1384
                    jQuery("#pum-1384").toggleClass("hide");
                    window.location.href = ajax_user_object.redirecturl;
                }                   
              });
           
    });
    });

})(jQuery);
