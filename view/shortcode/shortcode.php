<?php if( !class_exists( 'shortcode' ) ) 
{    
    class shortcode 
    {
        public static function page ()
        {
            // load::view( 'shortcode/template/page' );
            
            $select = db::query('_customslider', true, '', false);

            $html = null;
            $html .= '<div class="wp-customslider__wrap">';
            $html .= '<div class="wp-customslider__pad">';

                foreach( $select as $list ) {

                    $html .= '<div class="wp-customslider__entry">';

                        $html .= '<div class="wp-customslider__img"><img src="'. $list->slider_image .'" /></div>';
                        $html .= '<div class="wp-customslider__title">'. $list->slider_name .'</div>';
                        $html .= '<div class="wp-customslider__desc">'. $list->slider_desc .'</div>';

                    $html .= '</div>';

                }
            
            $html .= '</div>';
            $html .= '</div>';

            return $html;
        }
        
    }
}

new shortcode();

?>