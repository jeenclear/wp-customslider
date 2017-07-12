<?php if( !class_exists( 'form' ) ) 
{    
    class form extends input
    {
          var $html = null;
                
          public function __construct() 
          {
               parent::__construct(); 
          }
		  
		  public static function custom_slider_form_holder ( $key=null ) 
		  {
				$inputs = input::post_is_array();
				return isset ( $inputs[$key] ) ? $inputs[$key] : null;
		  }

		  public static function custom_slider_form_validate ( $key=null, $type=null )
		  {
			  $inputs = input::post_is_array();
			  
			  $error_image = array(
									"name"  => array ( 
											'empty' => "Empty fields detected." . __( $key ) 
										),				
									"image" => array ( 
											'empty' => "Empty fields detected." . __( $key )
										)				
								);
			  
			  if( isset( $error_image[$key][$type] ) AND $type == 'empty' ) 
			  {
				 $value = empty( $inputs[$key] ) ? $error_image[$key][$type] : null;
			  } else {
				 $value = false; 
			  }

			  return $value;		
		  }	
		  
		  public static function custom_slider_form () 
		  {
				$html = null;
				$inputs = input::post_is_array();
				$gets = input::get_is_object();
				
				$submit = empty( $gets->modify ) ? 'submit_slider' : 'submit_update_slider';
				$submit_value = empty( $gets->modify ) ? 'Save' : 'Update';

				if( isset( $inputs[ $submit ] ) ) :
					
				foreach( $inputs as $key => $value ) :

					$html .= "<p class='error'>";
					$html .= self::custom_slider_form_validate( $key, 'empty' );
					$html .= "</p>";
				
				endforeach;

			    endif;

			    $is_where = 'WHERE slider_id=' . __( $gets->modify ) ;
			    $select = db::query('_customslider', false, $is_where, false);

				if( !is_array( $select ) ) {

					$name = $select->slider_name;
				    $image = $select->slider_image;
				    $desc = $select->slider_desc;

				}

				$name_con = empty( $gets->modify ) ? self::custom_slider_form_holder( 'name' ) : $name;
				$image_con = empty( $gets->modify ) ? self::custom_slider_form_holder( 'image' ) : $image;
				$desc_con = empty( $gets->modify ) ? self::custom_slider_form_holder( 'desc' ) : $desc;

				$html .= '<p>';
				$html .= html::label( array('text' => 'Name:') );
				$html .= self::text( array('name'=> 'name', 'value'=> $name_con, 'id'=> 'name', 'class'=>'' ) );
				$html .= '</p>';

				$html .= '<div class="form-uploadimage__wrap">';
				$html .= '<a href="#" id="upload-img">Upload</a><a href="#" id="remove-img">x</a>';
				$html .= '<img src="'. $image_con .'" id="images-src" />';

				$url = plugins_url('widget-gallery/assets/images/icon-image-64.png');
				$html .= '<div class="no-image"></div>';
				$html .= self::hidden( array('name'=> 'image', 'value'=> $image_con, 'id'=> 'images-input', 'class'=>'' ) );
				$html .= '</div>';

				$html .= '<p>';
				$html .= html::label( array('text' => 'Description:') );
				$html .= html::textarea( array('name'=> 'desc', 'text'=> $desc_con, 'class'=>'customslider-textarea' ) );
				$html .= '</p>';

				$html .= '<p>';
				$html .= self::submit( array('name'=> $submit, 'value'=> $submit_value, 'text'=> '', 'class'=>'' ) );
				$html .= '</p>';
			  
				return $html;
		  }
		  
		  public static function custom_slider_list ()
		  {
				$html = null;
				$html .= '<div class="manage-slider__wrap">';
				
				$html .= '<div class="manage-slider__option">';
				$html .= '<div class="manage-slider__deleteall">Check All'. self::checkbox( array('name'=> 'delete_all', 'value'=> '', 'id'=> 'delete_all', 'class'=>'delete_all' ) )  .'</div>';
				$html .= '<div class="manage-slider__deletesubmit">'. self::submit( array('name'=> 'delete_pl_pd_opp', 'value'=> 'Delete', 'id'=> 'delete_submit', 'class'=>'delete-by-checked' ) )  .'</div>';
				$html .= '</div>';
				
				$html .= '<div class="manage-slider__pad">';
				
				$select = db::query('_customslider', true, '', false);
				
				foreach( $select as $list ) {

					$html .= '<div class="manage-slider__entry '. $color .'">';
					$html .= '<div class="manage-slider__checkbox">'. self::checkbox( array('name'=> 'delete_selected[]', 'value'=> intval( $list->slider_id ), 'id'=> 'delete_selected', 'class'=>'delete_selected' ) ) .'</div>';
					$html .= '<div class="manage-slider__name">'. $list->slider_name .'</div>';
					$html .= '<div class="manage-slider__image"><img src="'. $list->slider_image .'" height="50" width="50" alt="slider-image"/></div>';
					$html .= '<div class="manage-slider__desc">'. $list->slider_desc .'</div>';
					
					$delete = page_rounter::url( 'list_wp_customslider', array( 'delete' => intval( $list->slider_id ) ) );	
					$html .= '<div class="manage-slider__delete"><a href="'. __( $delete ) .'">Delete</a></div>';
					$modify = page_rounter::url( 'wp_customslider', array( 'modify' => intval( $list->slider_id ) ) );	
					$html .= '<div class="manage-slider__delete"><a href="'. __( $modify ) .'">Modify</a></div>';
					$html .= '</div>';
				}
				
				$html .= '</div>';
				$html .= '</div>';
				
				return $html;
		  }
    }
}
?>