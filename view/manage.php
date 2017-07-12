<?php

/**
 * @author charly capillanes
 * @copyright 2016-2017
 */

$userdata = get_userdata( get_current_user_id() );

?>

<div id="wp-mvc__wrap">
	
	<div class="wp-customslider__pad">
		<?php
			echo input::form_open( array( 'method' => 'post' ) );
		?>
		<?php
			echo ( form::custom_slider_form() );
		?>
		<?php
			echo input::form_close(true);
		?>
	</div>
	
</div>

