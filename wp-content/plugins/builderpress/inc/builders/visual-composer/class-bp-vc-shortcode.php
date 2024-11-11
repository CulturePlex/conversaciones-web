<?php
/**
 * BuilderPress VC Shortcode
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_VC_Shortcode' ) ) {
	/**
	 * Class BuilderPress_VC_Shortcode
	 */
	class BuilderPress_VC_Shortcode {
		/**
		 * @var string
		 */
		protected $base = '';

		/**
		 * @var string
		 */
		protected $name = '';

		/**
		 * @var string
		 */
		protected $desc = '';

		/**
		 * @var string
		 */
		protected $group = '';

		/**
		 * @var string
		 */
		protected $assets_url = '';

		/**
		 * @var string
		 */
		protected $assets_path = '';

		/**
		 * @var null
		 */
		protected $config_class = null;

		/**
		 * @var BuilderPress_Abstract_Config
		 */
		protected $config_obj;

		/**
		 * @var array
		 */
		protected $params = array();

		/**
		 * @var array
		 */
		protected $styles = array();

		/**
		 * @var array
		 */
		protected $scripts = array();

		/**
		 * BuilderPress_Abstract_Shortcode constructor.
		 */
		public function __construct() {
			if ( ! class_exists( $this->config_class ) ) {
				return;
			}

			$config_class     = new $this->config_class();
			$this->config_obj = $config_class;

			// config
			$this->base        = $config_class->base;
			$this->name        = $config_class->name;
			$this->desc        = $config_class->desc;
			$this->group       = $config_class->group;
			$this->assets_url  = $config_class->assets_url;
			$this->assets_path = $config_class->assets_path;
			$this->styles      = $config_class->styles;
			$this->scripts     = $config_class->scripts;

			// setup to vc_map
			$this->setup_shortcode();

			add_shortcode( 'thim-' . $this->base, array( $this, 'shortcode' ) );

			// enqueue scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		}

		/**
		 * Setup to VC_map
		 */
		public function setup_shortcode() {

			// shortcode params
			$this->params = $this->config_obj->options;

			// get global icon for shortcode not defined icon
			$icon = file_exists( $this->assets_path . 'images/icon.png' ) ? $this->assets_url . 'images/icon.png' : BUILDER_PRESS_URL . 'assets/images/icon.png';

			vc_map(
				array(
					'name'        => $this->name,
					'base'        => 'thim-' . $this->base,
					'category'    => __( 'BuilderPress', 'builderpress' ),
					'description' => $this->desc,
					'icon'        => $icon,
					'params'      => $this->params
				)
			);
		}

		/**
		 * Handle shortcode attrs, merge input and default attrs
		 *
		 * @param       $atts
		 * @param array $params
		 *
		 * @return array
		 */
		protected function _handle_attrs( $atts, $params = array() ) {
			$default = array();

			if ( ! $params ) {
				$params = $this->params;
			}

			foreach ( $params as $param ) {
				$type = $param['type'];
				$name = $param['param_name'];

				if ( $type == 'param_group' ) {
					if ( isset( $atts[ $name ] ) ) {
						$default[ $name ] = $this->_handle_attrs( $atts[ $name ], $param['params'] );
					}
				} else {
					$default[ $name ] = ! empty( $param['std'] ) ? $param['std'] : '';
				}
			}

			$shortcode_atts = shortcode_atts( $default, $atts );

			return $shortcode_atts;
		}

		/**
		 * @param $atts
		 *
		 * @return string
		 */
		public function shortcode( $atts ) {
			// get params form shortcode atts
			$atts = apply_filters( "builder-press/vc/$this->base/shorcode_attrs", $this->_handle_attrs( $atts ) );

			// re-handle VC parse variables
			$atts = $this->_parse_atts( $atts );

			return $this->output( $atts );
		}

		/**
		 * Re-handle VC parse atts likes: vc_build_link, vc_param_group_parse_atts, so on
		 *
		 * @param        $atts
		 * @param string $params
		 *
		 * @return mixed
		 */
		protected function _parse_atts( $atts, $params = '' ) {
			if ( ! $params ) {
				$params = $this->params;
			}

			foreach ( $params as $param ) {
				$type = $param['type'];
				$name = $param['param_name'];

				if ( isset( $atts[ $name ] ) ) {
					switch ( $type ) {
						case 'param_group':
							$atts[ $name ] = vc_param_group_parse_atts( $atts[ $name ] );

							// array values of param group
							$values = $atts[ $name ];
							if ( $values ) {
								foreach ( $values as $key => $value ) {
									$atts[ $name ][ $key ] = $this->_parse_atts( $atts[ $name ][ $key ], $param['params'] );
								}
							}
							break;

						case 'vc_link':
							$atts[ $name ] = $atts[ $name ] ? vc_build_link( $atts[ $name ] ) : array();
							break;
						case 'textarea_raw_html':
							$atts[ $name ] = $atts[ $name ] ? rawurldecode( base64_decode( wp_strip_all_tags( $atts[ $name ] ) ) ) : '';
							break;
						default:
							break;
					}
				}
			}

			return $atts;
		}

		/**
		 * Enqueue scripts
		 */
		public function register_scripts() {
			$this->config_obj->register_scripts();
		}

		/**
		 * @param $atts
		 *
		 * @return false|string
		 */
		public function output( $atts ) {
			$this->config_obj->enqueue_scripts();

			$atts = array_merge( $atts, array(
				'base'          => $this->base,
				'group'         => $this->group,
				'template_path' => $this->group . '/' . $this->base . '/tpl/'
			) );

			// allow hook before template
			do_action( 'builder-press/before-element-template', $this->base );

			ob_start();
			builder_press_get_template( $this->base, array( 'params' => $atts ), $atts['template_path'] );
			$html = ob_get_clean();

			return $html;
		}
	}

}
