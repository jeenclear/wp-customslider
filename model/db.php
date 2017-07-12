<?php if( !class_exists( 'db' ) ) {
    
    class db 
    {
    
        public function __construct() 
        {
            parent::__construct();
        }
		
		/**
        * wpdb query function 
        * @param name (string)
        * @param keyword (true or false)
        * @param where (string)
        * @param sort (true or false)
        */ 
        
        public static function query ( $tbl=null, $is_get=true, $is_where='', $is_sort=true ) 
        {
            global $wpdb;
            
            if( ! is_null( $tbl ) ) 
            {
                $tbl_val = $wpdb->prefix . $tbl;
                $tbl_active = true;
            } else {
                $tbl_val = $wpdb->prefix;
                $tbl_active = false;
            }
        
            $is_sort_val = $is_sort == true ? "ORDER BY `sort` ASC" : $sort = '';
            $is_where_val = is_string( $is_where ) ? $is_where : '';
        
            if( $tbl_active == true ) 
            { 
            
                if( $is_get == true ) 
                {
                    $sql = $wpdb->get_results("SELECT * FROM $tbl_val $is_where_val $is_sort_val");
                } else {
                    if( $is_get == false ) 
                    {
                        $sql = $wpdb->get_row("SELECT * FROM $tbl_val $is_where_val");
                    }
                } 
            
            } 
        
            if( is_array( $sql ) or is_object( $sql ) )
            {
                return $sql;
            } 
        
        }

        /**
        * wpdb selects function 
        * @param tbl (string)
        */
        
        public static function selects ( $tbl=null ) 
        {
            global $wpdb;

            $tbls = $wpdb->prefix . __( $tbl, 'wpdb' );
            if( ! is_null( $tbls ) ) return $wpdb->get_results( "SELECT * FROM {$tbls}", OBJECT );  
        } 
        
        /**
        * wpdb counts function 
        * @param tbl (string)
        */

        public static function counts ( $tbl=null ) 
        {
            global $wpdb;

            $tbls = $wpdb->prefix . __( $tbl, 'wpdb' );
            if( ! is_null( $tbls ) ) return $wpdb->get_var( "SELECT COUNT(*) FROM {$tbls}" );
        }
    }     
	
	
}