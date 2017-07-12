jQuery( function() 
    {
        var $params  = jQuery;
        var $scripts = ajax_script.ajax_url; 
        
        function ajax_results_classes ( $this, $flts )
        {
            if( $flts == 'before' ){
               $params( $this ).addClass( 'before--ajax' );
            } else if ( $flts == 'error' ){
               $params( $this ).removeClass( 'before--ajax' );
               $params( $this ).addClass( 'error--ajax' );  
            } else if ( $flts == 'success' ){
               $params( $this ).removeClass( 'before--ajax' );
               $params( $this ).addClass( 'success--ajax' );   
            } else if ( $flts == 'done' ) {
               $params( $this ).removeClass( 'before--ajax' );
               $params( $this ).removeClass( 'success--ajax' );
               $params( $this ).addClass( 'done--ajax' );  
            }      
        }
        
    }
);