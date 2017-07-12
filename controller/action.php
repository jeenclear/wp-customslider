<?php if( ! class_exists( 'action' ) ) 
{
    
     class action extends db_action
     {
          
          var $tbls = array();
          
          // action event submit
          // user the querys at the top
		  
		  public static function form_action_insert () 
		  {
			  global $wpdb;

			  $prefix = $wpdb->prefix;
			  $inputs = input::post_is_object();
			  
			  $name = $inputs->name;
			  $image= $inputs->image;
			  $desc = $inputs->desc;
			  
			  $validate[] = self::form_action_empty_validate( 'name', 'empty' );
			  $validate[] = self::form_action_empty_validate( 'image', 'empty' );

			  if( isset( $inputs->submit_slider ) ) 
			  {
				
				if( ! in_array( false, $validate ) ) 
				{
				
				  self::inserts( '_customslider',  
									 array( 'slider_name' => $name, 'slider_image' => $image, 'slider_desc' => $desc  ), 
									 array( '%s', '%s', '%s' ) 
				  );

				}
			  }
		  }

		  public static function form_action_update () 
		  {
			  global $wpdb;

			  $prefix = $wpdb->prefix;
			  $inputs = input::post_is_object();
			  $get = input::get_is_object();
			  
			  $name = $inputs->name;
			  $image= $inputs->image;
			  $desc = $inputs->desc;
			  
			  $validate[] = self::form_action_empty_validate( 'name', 'empty' );
			  $validate[] = self::form_action_empty_validate( 'image', 'empty' );

			  if( isset( $inputs->submit_update_slider ) ) 
			  {
				
				if( ! in_array( false, $validate ) ) 
				{
				
				  self::updates( '_customslider',  
									 array( 'slider_name' => $name, 'slider_image' => $image, 'slider_desc' => $desc  ),
									 array( 'slider_id' => $get->modify ), 
									 array( '%s', '%s', '%s' ),
									 array( '%d' )
				  );

				}
			  }
		  }
		  
		  public static function form_action_empty_validate ( $key=null, $type=null )
		  {
			  $inputs = input::post_is_array();

			  if( isset( $inputs[$key] ) AND $type == 'empty' ) 
			  {
				 $value = ! empty( $inputs[$key] ) ? true : false;
			  } else {
				 $value = null; 
			  }

			  return $value;		
		  }
		  
		  public static function form_action_delete () 
		  {
			  $get = input::get_is_object();
			  
			  self::deletes('_customslider', array( 'slider_id' => $get->delete ), array( '%d' ));
		  } 

		  public static function form_action_delete_multi () 
		  {
			  $inputs = input::post_is_object();
			 
			 if( isset( $inputs->delete_pl_pd_opp ) ) 
			  {	
			  	if( is_array( $inputs->delete_selected ) ) 
			  	{

				  $check_selected = $inputs->delete_selected;
				  
				  foreach( $check_selected as $checked) {
				  	
				  	self::deletes('_customslider', array( 'slider_id' => $checked ), array( '%d' ));

				  }

				} 

			  }
			   
		  } 
			
		  
		  // END
     }
}
?>