<?php if( !class_exists( 'Add_Widget' ) ) {
    
    /**
     * Adds Add_Widget widget.
     */
    class Add_Widget extends WP_Widget 
    {
    
    	/**
    	 * Register widget with WordPress.
    	 */
    	function __construct() 
        {
    		parent::__construct(
    			'add_widget', // Base ID
    			esc_html__( 'Widget Title', 'text_domain' ), // Name
    			array( 'description' => esc_html__( 'A Add Widget', 'text_domain' ), ) // Args
    		);
    	}
    
    	/**
    	 * Front-end display of widget.
    	 *
    	 * @see WP_Widget::widget()
    	 *
    	 * @param array $args     Widget arguments.
    	 * @param array $instance Saved values from database.
    	 */
    	public function widget( $args, $instance ) 
        {
    		echo $args['before_widget'];
    		if ( ! empty( $instance['title'] ) ) {
    			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    		}
			$img = esc_html__( $instance['gallery-image'], 'text_domain' );
    		echo "<p><img src='$img' /></p>";
			
			
			echo esc_html__( $instance['description'], 'text_domain' );
			
    		echo $args['after_widget'];
    	}
    
    	/**
    	 * Back-end widget form.
    	 *
    	 * @see WP_Widget::form()
    	 *
    	 * @param array $instance Previously saved values from database.
    	 */
    	public function form( $instance ) 
        {
    		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
			$description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'New description', 'text_domain' );
			$gallery_image = ! empty( $instance['gallery-image'] ) ? $instance['gallery-image'] : esc_html__( 'New gallery image', 'text_domain' );
			?>
			<div class="widget-uploadimage__wrap">
				<a href="#" id="upload-test">Upload</a><a href="#" id="remove-test">x</a>
				<img src="<?php echo esc_attr( $gallery_image ); ?>" id="images-test" />
				<?php $url = plugins_url('widget-gallery/assets/images/icon-image-64.png'); ?>
				<div class="no-image"></div>
				<?php echo input::hidden( array('name'=> esc_attr( $this->get_field_name( 'gallery-image' ) ), 'value'=> esc_attr( $gallery_image ), 'id'=>'images-input', 'class'=>'widefat' ) ); ?>
			</div>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
				<?php echo input::text( array('name'=> esc_attr( $this->get_field_name( 'title' ) ), 'value'=> esc_attr( $title ), 'id'=> esc_attr( $this->get_field_id( 'title' ) ), 'class'=>'widefat' ) ); ?>
			</p>
			
			<p>
				<label>Description:</label>
				<?php echo html::textarea( array('name'=> esc_attr( $this->get_field_name( 'description' ) ), 'text'=> esc_attr( $description ), 'class'=>'widefat' ) ); ?>
			</p>
    		<?php 
    	}
    
    	/**
    	 * Sanitize widget form values as they are saved.
    	 *
    	 * @see WP_Widget::update()
    	 *
    	 * @param array $new_instance Values just sent to be saved.
    	 * @param array $old_instance Previously saved values from database.
    	 *
    	 * @return array Updated safe values to be saved.
    	 */
    	public function update( $new_instance, $old_instance ) 
        {
    		$instance = array();
			$instance['gallery-image'] = ( ! empty( $new_instance['gallery-image'] ) ) ? strip_tags( $new_instance['gallery-image'] ) : '';
    		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
    
    		return $instance;
    	}
    
    } // class Foo_Widget
}
?>