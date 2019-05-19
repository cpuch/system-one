(function( $ ) {
	'use strict';
    $(function(){
        // Clear cache ajax call.
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

		// Code editor.
		if( $('#system-one-custom_css').length ) {
			var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
			editorSettings.codemirror = _.extend(
				{},
				editorSettings.codemirror,
				{
					indentUnit: 2,
					tabSize: 2,
					mode: 'css',
				}
			);
			var editor = wp.codeEditor.initialize( $('#system-one-custom_css'), editorSettings );
		}
    });
})( jQuery );
