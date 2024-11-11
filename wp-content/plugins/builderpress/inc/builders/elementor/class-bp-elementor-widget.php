<?php
/**
 * BuilderPress Elementor widget class
 *
 * @version 1.0.0
 * @since 1.3.0
 * @author ThimPress
 */

use \Elementor\Widget_Base;

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_Elementor_Widget' ) ) {
	/**
	 * Class BuilderPress_El_Widget
	 */
	abstract class BuilderPress_Elementor_Widget extends Widget_Base {
		protected $config_class;
		/**
		 * @var BuilderPress_Abstract_Config
		 */
		public $config_obj;

		public function __construct( $data = [], $args = null ) {
			if ( ! is_null( $this->config_class ) ) {
				$this->config_obj = new $this->config_class();
			}

			add_action( 'elementor/preview/enqueue_styles', array( $this, 'load_assets' ) );
			add_action( 'elementor/preview/enqueue_scripts', array( $this, 'load_assets' ) );
			//add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'load_assets' ) );
			//add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'load_assets' ) );

			parent::__construct( $data, $args );
		}

		public function get_name() {
			return $this->config_obj->base;
		}

		public function get_title() {
			return $this->config_obj->name;
		}

		public function get_icon() {
			return ! empty( $this->config_obj->icon ) ? $this->config_obj->icon : 'fa fa-plug';
		}

		public function get_categories() {
			return $this->config_obj->categories;
		}

		public function load_assets() {
			$base       = $this->config_obj->base;
			$group      = $this->config_obj->group;
			$url_source = BUILDER_PRESS_URL . "inc/elements/$group/$base/assets/";

			$styles = $this->config_obj->get_styles();
			foreach ( $styles as $k => $style ) {
				wp_enqueue_style( 'builder-press-' . $k, $url_source . 'css/' . $style['src'] ?? '', $style['ver'] ?? BUILDER_PRESS_VER );
			}

			$scripts = $this->config_obj->get_scripts();
			foreach ( $scripts as $k => $script ) {
				wp_enqueue_script(
					'builder-press-' . $k,
					$url_source . 'js/' . $script['src'] ?? '',
					$script['deps'] ?? [],
					$script['ver'] ?? BUILDER_PRESS_VER,
					$script['in_footer'] ?? true
				);
			}
		}

		protected function render() {
			$base          = $this->config_obj->base;
			$group         = $this->config_obj->group;
			$template_path = "$group/$base/tpl/";

			$this->load_assets();

			// get settings
			$settings = $this->get_settings_for_display();

			// handle settings
			$settings = $this->_handle_settings( $settings );

			$settings = array_merge(
				$settings,
				array(
					'group'         => $group,
					'base'          => $base,
					'template_path' => $template_path,
				)
			);

			builder_press_get_template( $base, array( 'params' => $settings ), $template_path );
		}

		// Method old of BuilderPress_El_Widget
		private function _handle_settings( $settings, $controls = null ) {

			if ( ! $controls ) {
				$controls = $this->config_obj->options;
			}

			foreach ( $controls as $key => $control ) {
				if ( array_key_exists( $control['param_name'], $settings ) ) {

					$type  = $control['type'];
					$value = $settings[ $control['param_name'] ];
					switch ( $type ) {
						case 'param_group':
							if ( isset( $value ) ) {
								foreach ( $value as $_key => $_value ) {
									$settings[ $control['param_name'] ][ $_key ] = $this->_handle_settings( $_value, $control['params'] );
								}
							}
							break;
						case 'vc_link':
							$settings[ $control['param_name'] ] = array(
								'url'    => $value['url'] ?? '',
								'target' => ( isset( $value['is_external'] ) && $value['is_external'] == 'on' ) ? '_blank' : '',
								'rel'    => ( isset( $value['nofollow'] ) && $value['nofollow'] == 'on' ) ? 'nofollow' : '',
								'title'  => '',
							);
							break;
						case 'attach_image':
							$settings[ $control['param_name'] ] = isset( $value ) ? $value['id'] : '';
							break;
						default:
							break;
					}
				} elseif ( isset( $control['std'] ) ) {
					$settings[ $control['param_name'] ] = $control['std'] ?? '';
				}
			}

			return $settings;
		}

		// Method old of BuilderPress_El_Widget
		public function options() {
			$options = $this->config_obj->options;
			foreach ( $options as $key_lv1 => $value_lv1 ) {
				if ( $value_lv1['type'] != 'param_group' ) {
					continue;
				}
				$params_lv1 = $value_lv1['params'];
				foreach ( $params_lv1 as $key_lv2 => $value_lv2 ) {
					if ( $value_lv2['type'] != 'param_group' ) {
						continue;
					}
					if ( isset( $value_lv2['max_el_items'] ) && $value_lv2['max_el_items'] > 0 ) {
						$params_lv2    = $value_lv2['params'];
						$separate_text = $params_lv1[ $key_lv2 ]['heading'];
						unset( $params_lv1[ $key_lv2 ] );
						$params_lv1 = array_values( $params_lv1 );
						$i          = 0;
						while ( $i < $value_lv2['max_el_items'] ) {
							$i ++;
							$default_hidden = array();
							foreach ( $params_lv2 as $key_lv3 => $value_lv3 ) {
								$horizon = array(
									'type'       => 'bp_heading',
									'heading'    => $separate_text . ' #' . $i,
									'param_name' => 'horizon_line' . ' #' . $i,
								);
								if ( $i === 1 ) {
									$default_hidden[] = $value_lv3['param_name'];
									$hidden           = array(
										'type'       => 'bp_hidden',
										'param_name' => $value_lv2['param_name'],
										'std'        => $value_lv2['max_el_items'] . '|' . implode( ',', $default_hidden ),
									);
									$params_lv1[]     = $hidden;
								}
								$params_lv1[]            = $horizon;
								$value_lv3['param_name'] = $value_lv3['param_name'] . $i;
								if ( isset( $value_lv3['dependency'] ) && $value_lv3['dependency']['element'] != '' ) {
									$value_lv3['dependency']['element'] = $value_lv3['dependency']['element'] . $i;
								}
								$params_lv1[] = $value_lv3;
							}
						}
					}
				}
				$options[ $key_lv1 ]['params'] = $params_lv1;
			}

			return $options;
		}
	}
}
