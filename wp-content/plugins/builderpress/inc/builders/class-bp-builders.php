<?php
/**
 * BuilderPress Builders Class
 *
 * @version     1.0.0
 * @author      leehld
 * @package     BuilderPress/Classes
 * @category    Classes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_Builders' ) ) {
	/**
	 * Class BuilderPress_Builders
	 */
	class BuilderPress_Builders {

		/**
		 * BuilderPress_Builders constructor.
		 */
		public function __construct() {

			// add Extra class field for widget
			if ( is_admin() ) {
				// Add necessary input on widget configuration form
				add_action( 'in_widget_form', array( $this, '_input_fields' ), 10, 3 );

				// Save widget attributes
				add_filter( 'widget_update_callback', array( $this, '_save_attributes' ), 10, 4 );
			} else {
				// Insert attributes into widget markup
				add_filter( 'dynamic_sidebar_params', array( $this, '_insert_attributes' ) );
			}
		}

		/**
		 * @param $widget WP_Widget
		 * @param $return
		 * @param $instance
		 *
		 * @return null
		 */
		public function _input_fields( $widget, $return, $instance ) {

			if ( strpos( $widget->id_base, 'builderpress' ) !== false ) {
				return;
			}

			$instance = self::_get_attributes( $instance );
			?>
            <p>
				<?php printf(
					'<label for="%s">%s</label>',
					esc_attr( $widget->get_field_id( 'widget-class' ) ),
					esc_html__( 'Extra Class', 'builderpress' )
				) ?>
				<?php printf(
					'<input type="text" class="widefat" id="%s" name="%s" value="%s" />',
					esc_attr( $widget->get_field_id( 'widget-class' ) ),
					esc_attr( $widget->get_field_name( 'widget-class' ) ),
					esc_attr( $instance['widget-class'] )
				) ?>
            </p>
			<?php
			return null;
		}

		/**
		 * @param $instance
		 * @param $new_instance
		 * @param $old_instance
		 * @param $widget
		 *
		 * @return mixed
		 */
		public function _save_attributes( $instance, $new_instance, $old_instance, $widget ) {
			$instance['widget-class'] = '';

			// Classes
			if ( ! empty( $new_instance['widget-class'] ) ) {
				$instance['widget-class'] = apply_filters(
					'widget_attribute_classes',
					implode(
						' ',
						array_map(
							'sanitize_html_class',
							explode( ' ', $new_instance['widget-class'] )
						)
					)
				);
			} else {
				$instance['widget-class'] = '';
			}

			return $instance;
		}

		/**
		 * Insert attributes into widget markup
		 *
		 * @param $params
		 *
		 * @return mixed
		 */
		public function _insert_attributes( $params ) {
			global $wp_registered_widgets;

			$widget_id  = $params[0]['widget_id'];
			$widget_obj = $wp_registered_widgets[ $widget_id ];

			if (
				! isset( $widget_obj['callback'][0] )
				|| ! is_object( $widget_obj['callback'][0] )
			) {
				return $params;
			}

			$widget_options = get_option( $widget_obj['callback'][0]->option_name );
			if ( empty( $widget_options ) ) {
				return $params;
			}

			$widget_num = $widget_obj['params'][0]['number'];
			if ( empty( $widget_options[ $widget_num ] ) ) {
				return $params;
			}

			$instance = $widget_options[ $widget_num ];

			// Classes
			if ( ! empty( $instance['widget-class'] ) ) {
				$params[0]['before_widget'] = preg_replace(
					'/class="/',
					sprintf( 'class="%s ', $instance['widget-class'] ),
					$params[0]['before_widget'],
					1
				);
			}

			return $params;
		}

		/**
		 * @param $instance
		 *
		 * @return array
		 */
		private static function _get_attributes( $instance ) {
			$instance = wp_parse_args(
				$instance,
				array(
					'widget-class' => '',
				)
			);

			return $instance;
		}
	}
}

new BuilderPress_Builders();