<?php
/**
 * BuilderPress Elementor widget class
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, leehld
 */

//namespace Builderpress;

use \Elementor\Widget_Base;

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_El_Widget' ) ) {
	/**
	 * Class BuilderPress_El_Widget
	 */
	abstract class BuilderPress_El_Widget extends Widget_Base {

		/**
		 * @var string
		 */
		protected $config_class = '';

		/**
		 * @var BuilderPress_Abstract_Config
		 */
		protected $config_obj = '';

		/**
		 * @var null
		 */
		protected $keywords = array();

		/**
		 * @var null
		 */
		protected $class = null;

		/**
		 * BuilderPress_El_Widget constructor.
		 *
		 * @param array $data
		 * @param array|null $args
		 *
		 * @throws Exception
		 */
		public function __construct( array $data = [], array $args = null ) {

			if ( ! $this->config_class ) {
				return;
			}
			/**
			 * @var $config_class BuilderPress_Abstract_Config
			 */
			wp_enqueue_style( 'builderpress-fontend', BUILDER_PRESS_URL . 'assets/css/builderpress.css', array(), BUILDER_PRESS_VER );
			$config_class = new $this->config_class();
			$config_class->register_scripts();
			$this->config_obj = $config_class;
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_scripts' ) );
			add_action( 'elementor/preview/enqueue_scripts', array( $this, 'preview_scripts' ) );

			parent::__construct( $data, $args );
		}

		public function preview_scripts() {
			$this->config_obj->register_scripts();
//  		    $config_class::enqueue_scripts();

		}

		/**
		 * Register scripts
		 */

		/**
		 * @return mixed|string
		 */
		public function get_name() {
			return 'thim-' . $this->config_obj->base;
		}

		/**
		 * @return string
		 */
		public function get_base() {
			return $this->config_obj->base;
		}

		/**
		 * @return mixed|string
		 */
		public function get_title() {
			return $this->config_obj->name;
		}

		/**
		 * @return string
		 */
		public function get_group() {
			return $this->config_obj->group;
		}

		/**
		 * @return array
		 */
		public function get_categories() {
			return array( 'builder-press' );
		}

		/**
		 * @return array
		 */
		public function get_keywords() {
			$keywords = array_merge( $this->keywords, array( $this->get_name(), 'builderpress' ) );

			return $keywords;
		}

		/**
		 * @return array
		 */
		public function get_script_depends() {
			$assets = $this->config_obj->_get_assets();

			$depends = array();
			if ( ! empty( $assets['scripts'] ) ) {
				foreach ( $assets['scripts'] as $key => $script ) {
					$depends[] = $key;
				}
			}

			return $depends;
		}

		/**
		 * @return array
		 */
		public function get_style_depends() {
			$assets = $this->config_obj->_get_assets();

			$depends = array();
			if ( ! empty( $assets['styles'] ) ) {
				foreach ( $assets['styles'] as $key => $style ) {
					$depends[] = $key;
				}
			}

			return $depends;
		}

		/**
		 * Render.
		 */
		protected function render() {
			// allow hook before template
			do_action( 'builder-press/before-element-template', $this->get_name() );

			// get settings
			$settings = $this->get_settings_for_display();

			// handle settings
			$settings = $this->_handle_settings( $settings );

			$settings = array_merge( $settings, array(
				'group'         => $this->get_group(),
				'base'          => $this->get_base(),
				'template_path' => $this->get_group() . '/' . $this->get_base() . '/tpl/'
			) );

			builder_press_get_template( $this->get_base(), array( 'params' => $settings ), $settings['template_path'] );
		}

		/**
		 * @param      $settings
		 * @param null $controls
		 *
		 * @return mixed
		 */
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
							if ( isset( $value ) && is_array( $value ) ) {
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

		/**
		 * @return array
		 */
		public function options() {
			// config class
			$options      = $this->config_obj->options;
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
									'param_name' => 'horizon_line' . ' #' . $i
								);
								if ( $i === 1 ) {
									$default_hidden[] = $value_lv3['param_name'];
									$hidden           = array(
										'type'       => 'bp_hidden',
										'param_name' => $value_lv2['param_name'],
										'std'        => $value_lv2['max_el_items'] . '|' . implode( ',', $default_hidden )
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

		/**
		 * @return string
		 */
		public function assets_url() {
			return $this->config_obj->assets_url;
		}
	}

}
