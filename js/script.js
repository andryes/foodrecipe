(function( $ ) {

	$( 'document' ).ready( function(){

		/* button which close collapsed menu */
		$( '.menu-close' ).click( function(){
			$( '.navbar-toggle' ).trigger( 'click' );
		} );

		/* quantity of blog posts ("show items" select box) */
        $( '.count-display select' ).change( function(){
            $( '.ajax-loader' ).trigger( 'click' );
            $.ajax({
                url: fodrecipe_script.ajax_url,
                method: "POST",
                data: { count : $(this).val(), action : 'count_display', url: window.location.href },
                dataType: 'json',
                success: function (data) {
                    if( 'success' == data.action ) {
                        window.location.href = data.url;
                    }
                }
            });
        });

		/* post sorting ("sort by" select box) */
		$( '.sort-display select' ).change( function(){
			$( '.ajax-loader' ).trigger( 'click' );
			$.ajax({
				url: fodrecipe_script.ajax_url,
				method: "POST",
				data: { sort : $( this ).val(), action: 'sort_display' },
				success: function (data) {
					if ( 'Success' == data ) {
						window.location.href = window.location.href;
					}
				}
			});
		});

		/* scroll-to-top button */
        $( function() {
            $ (window ).scroll( function() {
                if ( $( this ) . scrollTop() != 0 ) {
                    $( '#toTop' ).fadeIn();
                } else {
                    $( '#toTop' ).fadeOut();
                }
            });
            $( '#toTop' ).click( function() {
                $( 'body,html' ).animate( { scrollTop : 0 }, 800 );
            });
        });

	});

})( jQuery );
