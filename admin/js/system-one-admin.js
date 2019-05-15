(function( $ ) {
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

    $(function(){
        // Clear cache ajax call
        $("input[name='clear-cache']").click(function() {
            $.ajax(
                ajaxurl,
                {
                    type: 'POST',
                    data: {
                        action: 'clear_system_one_cache'
                    },
                    success: function() {
                        // Display admin notice
                        $("#plugin-notice").html('<div id="clear-cache-notice" class="notice notice-success is-dismissible"><p><strong>Cache cleared.</strong></p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>');
                        // Dismiss the notice
                        $("#clear-cache-notice .notice-dismiss").click(function() {
                            $("#clear-cache-notice").fadeTo(100, 0, function() {
                                $("#clear-cache-notice").slideUp(100, function() {
                                    $("#clear-cache-notice").remove();
                                });
                            });
                        });
                    }
                }
            );
        });

    });
})( jQuery );
