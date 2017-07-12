<?php if( !class_exists( 'wp_customslider' ) ) 
{    
    class wp_customslider extends config
    {
        private static $instance; 
        
        public static function getInstance()  
        { 
              if( !self::$instance ) self::$instance = new self(); 
              return self::$instance;
        } 

        public function __get( $key ) { return $this->values[$key]; }
        public function __set( $key, $value ){ $this->values[$key] = $value; }
        public function __isset( $key ){ $this->values[$key]; }
        public function __unset( $key ){ $this->values[$key]; }
        
        /**
         * load construct
         * auto file call
         * wp structure hook
         * wpdb querys - etc   
        **/

        public function admin_page () 
        {
            global $wp_roles;
            
            $userdata=  get_userdata( get_current_user_id() );

            $menu[] = array( self::$name, self::$name, 1, self::$plugin_slug, array( $this,  self::$plugin_slug.'_function'), self::$icon );
			$menu[] = array( 'Manage', 'Manage', 1, self::$plugin_slug, 'list_'.self::$plugin_slug, array( $this, 'list_'.self::$plugin_slug.'_function' ) );
            $menu[] = array( 'Help?', 'Help?', 1, self::$plugin_slug, 'help_'.self::$plugin_slug, array( $this, 'help_'.self::$plugin_slug.'_function' ) );
            
            if( is_array( $menu ) ) add::load_menu_page( $menu );
        }
        
        public function update_db_check () 
        {
            global $db_version;
            if ( get_site_option( 'db_version' ) != $db_version ) self::install();
        }
        
        /** view structure ( include ) **/
        
        public function wp_customslider_function() 
        {
            load::view( 'manage' );
        }
		
		 public function list_wp_customslider_function()
        {
            load::view( 'list' );
        }
        
        public function help_wp_customslider_function()
        {
            load::view( 'help' );
        }
        
        /** shortcode structure ( include ) **/
        
        public function wp_customslider_shortcode () 
        {
            load::view( 'shortcode/shortcode' );
            return shortcode::page();
        }
        
        /** ajaxs structures ( load-file ) **/
        
        public function ajaxs_functions () 
        {
            // test function
        }
        
    }

}  

new wp_customslider( true );
?>