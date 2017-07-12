jQuery ( function() 
    { 
		var $params = jQuery;
		var $scripts = ajax_script.ajax_url;
		  
		/**
        * wp media upload javascript function
        **/

        function wp_media_upload ( $input_attr, $image_attr, $elm ) 
        {
            var $frame;
            var $input = $params($input_attr);
            var $image = $params($image_attr);

            $elm.preventDefault();

            if ( $frame ) {
                  $frame.open();
                  return;
            }

            $frame = wp.media(
                {
                    title: 'Select or Upload Media',
                    button: {
                        text: 'Use this media'
                    },
                    multiple: false
                }

            );

            $frame.on( 'select', function() 
                {
                    var $attachment = $frame.state().get('selection').first().toJSON();
                    $image.attr( 'src', $attachment.url );
                    $input.val( $attachment.url );

                }
            );

            $frame.open();
        }

        /**
        * wp media upload javascript function - END
        **/

        $params( "a#upload-test" ).on( 'click', function(e) 
            {
                wp_media_upload( '.widget-inside #images-input', '.widget-inside #images-test', e );
            }
        );
		
		$params( "a#remove-test" ).on( 'click', function(e) 
            {
               $params(this).next().attr( 'src','' );
            }
        );
		
		$params( "a#upload-img" ).on( 'click', function(e) 
            {
                wp_media_upload( '.wp-customslider__pad #images-input', '.wp-customslider__pad #images-src', e );
            }
        );
		
		$params( "a#remove-img" ).live( 'click', function(e) 
            {
               $params(this).next().attr( 'src','' );
               $params(this).next().next().next().attr( 'value','' );
            }
        );

        $params('input#delete_all').live('click', function(){
          if( $params(this).is(':checked') ){  
                $params('input.delete_selected').attr('checked', true);
                var num_check = $params('input.delete_selected:checked').length; 
                $params('input#delete_submit').attr('value', 'Delete - ' + num_check );
          } else {
                $params('input.delete_selected').attr('checked', false); 
                $params('input#delete_submit').attr('value', 'Delete' );
          }
        });

        jQuery('input.delete_selected').live('click', function(){
          var num_check = jQuery('input.delete_selected:checked').length;          
          if( num_check != 0 ){
             jQuery('input#delete_submit').attr('value', 'Delete - ' + num_check );
          } else {
             jQuery('input#delete_submit').attr('value', 'Delete' );
          }  
     });
    }
);

