<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shopping Cart Widget.
 *
 * Displays shopping cart widget.
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class Thim_Custom_WC_Widget_Cart extends WC_Widget_Cart {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;
	var $settings;

	function widget( $args, $instance ) {
		extract( $args );

		if ( is_cart() || is_checkout() ) {
			return;
		}

		$class         = '';
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;

		if ( $hide_if_empty == 1 ) {
			$class = ' hide';
		}

		wp_enqueue_script('wc-cart-fragments');
		echo ent2ncr( $before_widget );
		echo '<div class="minicart_hover" id="header-mini-cart">';
		list( $cart_items ) = thim_get_current_cart_info();
		if(! empty($instance['title'])) {
			echo '<span class="cart-items-number"><span class="text">' . $instance['title'] . '</span> <i class="ion ion-android-cart"></i><span class="wrapper-items-number ' . $class . '"><span class="items-number">' . $cart_items . '</span></span></span>';
		} else {
			echo '<span class="cart-items-number"><i class="ion ion-android-cart"></i><span class="wrapper-items-number ' . $class . '"><span class="items-number">' . $cart_items . '</span></span></span>';
		}
		

		echo '<div class="clear"></div>';
		echo '</div>';
		if ( $hide_if_empty ) {
			echo '<div class="hide_cart_widget_if_empty">';
		}
		echo '<div class="widget_shopping_cart_content" style="display: none;"></div>';
		if ( $hide_if_empty ) {
			echo '</div>';
		}
		echo ent2ncr( $after_widget );
	}


	/**
	 * update function.
	 *
	 * @see    WP_Widget->update
	 * @access public
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance['hide_if_empty'] = empty( $new_instance['hide_if_empty'] ) ? 0 : 1;
		$instance['title'] = empty( $new_instance['title'] ) ? $instance['title'] : $new_instance['title'];

		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see    WP_Widget->form
	 * @access public
	 *
	 * @param array $instance
	 *
	 * @return void
	 */
	function form( $instance ) {
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		$minicart_title = empty( $instance['title'] ) ? '' : $instance['title'];

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'ivy-school'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $minicart_title ); ?>" />
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide_if_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_if_empty' ) ); ?>"<?php checked( $hide_if_empty ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'hide_if_empty' ) ); ?>"><?php esc_html_e( 'Hide if cart is empty', 'ivy-school' ); ?></label>
		</p>
		<?php

	}
}