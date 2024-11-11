<?php
/**
 * BuilderPress Admin Helper Export Data class
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

if ( ! class_exists( 'BuilderPress_Helper_Export_Data' ) ) {
	/**
	 * Class BuilderPress_Helper_Export_Data
	 */
	class BuilderPress_Helper_Export_Data {

		/**
		 * @var string
		 */
		protected $_pattern = '';

		/**
		 * @var null
		 */
		protected $_panels_data = null;

		/**
		 * @var null
		 */
		protected $_elementor_data = null;

		/**
		 * BuilderPress_Helper_Export_Data constructor.
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'plugins_loaded' ), 1000 );
		}

		/**
		 * Plugin loaded.
		 */
		public function plugins_loaded() {

			// handle content
			add_filter( 'wp_import_post_data_processed', array( $this, 'filter_content' ), 10, 2 );

			// handle post meta
			add_action( 'wp_import_insert_post', array( $this, 'filter_meta_data' ), 10, 4 );
		}

		/**
		 * @param $postdata
		 * @param $post
		 *
		 * @return mixed
		 */
		public function filter_content( $postdata, $post ) {

			$builder = 'elementor';

			$content = $postdata['post_content'];

			if ( $content ) {
				if ( $builder == 'siteorigin' ) {
					$panels_data        = $this->_panels_data( $content );
					$this->_panels_data = SiteOrigin_Panels_Styles_Admin::single()->sanitize_all( $panels_data );

					ob_start();
					SiteOrigin_Panels_Post_Content_Filters::add_filters();
					$GLOBALS['SITEORIGIN_PANELS_POST_CONTENT_RENDER'] = true;
					echo SiteOrigin_Panels::renderer()->render( $postdata['import_id'], true, $panels_data );
					SiteOrigin_Panels_Post_Content_Filters::remove_filters();
					unset( $GLOBALS['SITEORIGIN_PANELS_POST_CONTENT_RENDER'] );

					$content = ob_get_clean();
				} else if ( $builder == 'elementor' ) {
					$this->_elementor_data = $this->_elementor_data( $content );
				}

				$postdata['post_content'] = $content;
			}

			return $postdata;
		}

		/**
		 * Handle import content
		 *
		 * @param $post_id
		 * @param $original_post_ID
		 * @param $postdata
		 * @param $post
		 */
		public function filter_meta_data( $post_id, $original_post_ID, $postdata, $post ) {

			if ( $this->_panels_data ) {
				update_post_meta( $post_id, 'panels_data', $this->_panels_data );
			} else if ( $this->_elementor_data ) {
				update_post_meta( $post_id, '_elementor_data', $this->_elementor_data );
				update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
				update_post_meta( $post_id, '_elementor_version', '0.4' );
			}
			update_post_meta( $post_id, '_builderpress_oldid', $original_post_ID );
		}

		/**
		 * Get Elementor data
		 *
		 * @param $content
		 *
		 * @return array|string
		 */
		public function _elementor_data( $content ) {
			$shortcodes = $this->_get_shortcodes( $content );

			$elementor_data = $this->_convert_el_data( $shortcodes );

			return wp_slash( wp_json_encode( $elementor_data ) );
		}

		/**
		 * @param $sections
		 *
		 * @return array
		 */
		public function _convert_el_data( $sections ) {

			$_elementor_data = array();
			if ( ! is_array( $sections ) ) {
				return $_elementor_data;
			}

			foreach ( $sections as $section_key => $section ) {
				$type = ( $section['base'] == 'vc_row' || $section['base'] == 'vc_row_inner' ) ? 'section' : ( $section['base'] == 'vc_column' || $section['base'] == 'vc_column_inner' ? 'column' : 'widget' );

				$settings = ! empty( $section['atts'] ) ? $section['atts'] : array();

				// handle extra id, extra class
				if ( isset( $settings['el_id'] ) ) {
					$settings['_element_id'] = $settings['el_id'];
					unset( $settings['el_id'] );
				}
				if ( isset( $settings['el_class'] ) ) {
					if ( $type == 'section' ) {
						$settings['css_classes'] = $settings['el_class'];
					} else if ( $type == 'widget' ) {
						$settings['_css_classes'] = $settings['el_class'];
					}

					unset( $settings['el_class'] );
				}

				// add section layout
				if ( $type == 'section' ) {
					if ( isset( $settings['full_width'] ) ) {
						$layout = $settings['full_width'];

						if ( $layout == 'stretch_row' ) {
							$settings['stretch_section'] = 'section-stretched';
						} else if ( $layout == 'stretch_row_content' ) {
							$settings['layout'] = 'full_width';
						} else if ( $layout == 'stretch_row_content_no_spaces' ) {
							$settings['stretch_section'] = 'section-stretched';
							$settings['layout']          = 'full_width';
						}
					}
				}

				// parse widget settings
				if ( $type == 'widget' ) {
					if ( strpos( $section['base'], 'thim-' ) !== false ) {
						$settings = $this->_parse_settings( $section['base'], $settings );
					} else {

						$_settings = '';
						// not yet handle array $value
						foreach ( $settings as $key => $value ) {
							if ( ! is_array( $value ) ) {
								$_settings .= ' ' . $key . '=' . esc_attr( $value );
							}
						}

						$settings = array( 'shortcode' => '[' . $section['base'] . $_settings . ']' );
					}
				}

				$_elementor_data[ $section_key ] = array(
					'id'                  => dechex( rand() ),
					'elType'              => $type,
					'isInner'             => false,
					'settings'            => $settings,
					'defaultEditSettings' => array(),
					'elements'            => array()
				);

				// set with for column
				if ( $type == 'column' ) {
					$column_atts = $section['atts'];
					$width       = 1;

					if ( $column_atts && isset( $column_atts['width'] ) ) {
						eval( '$width=' . $column_atts['width'] . ';' );
					}

					$_elementor_data[ $section_key ]['settings']['_column_size'] = $width * 100;
				}

				// set child elements
				if ( $type != 'widget' ) {
					if ( $section['nodes'] ) {
						$_elementor_data[ $section_key ]['elements'] = $this->_convert_el_data( $section['nodes'] );
					}
				} else {
					$widget_type = strpos( $section['base'], 'thim-' ) !== false ? $section['base'] : 'shortcode';

					$_elementor_data[ $section_key ]['widgetType'] = $widget_type;
				}
			}

			return $_elementor_data;
		}

		/**
		 * @param $widget_name
		 * @param $settings
		 *
		 * @return mixed
		 */
		public function _parse_settings( $widget_name, $settings ) {
			$config_class = 'BuilderPress_Config_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', str_replace( 'thim-', '', $widget_name ) ) ) );

			if ( class_exists( $config_class ) ) {
				$config = new $config_class();

				/**
				 * @var $config BuilderPress_Abstract_Config
				 */
				$options = $config->get_options();

				foreach ( $options as $key => $option ) {
					if ( $option['type'] == 'param_group' ) {
						if ( isset( $settings[ $option['param_name'] ] ) ) {
							$settings[ $option['param_name'] ] = json_decode( urldecode( $settings[ $option['param_name'] ] ), true );

							if ( $settings[ $option['param_name'] ] ) {
								foreach ( $settings[ $option['param_name'] ] as $_key => $value ) {
									$settings[ $option['param_name'] ][ $_key ] = array_merge( $value, array( '_id' => dechex( rand() ) ) );
								}
							}
						}
					} else if ( $option['type'] == 'vc_link' ) {
						if ( isset( $settings[ $option['param_name'] ] ) ) {
							$settings[ $option['param_name'] ] = $this->_parse_link( $settings[ $option['param_name'] ] );
						}
					}
				}
			}

			return $settings;
		}

		/**
		 * Get SO Widgets panels data
		 *
		 * @param $content
		 *
		 * @return array|string
		 */
		public function _panels_data( $content ) {
			// get shortcodes
			$shortcodes = $this->_get_shortcodes( $content );

			$panels_data = $this->_convert_so_data( $shortcodes );

			return $panels_data;
		}

		/**
		 * @param $content
		 *
		 * @return array|string
		 */
		public function _get_shortcodes( $content ) {
			global $shortcode_tags;

			$shortcode_keys = array_merge( array_keys( $shortcode_tags ), array(
				'vc_row',
				'vc_column',
				'vc_row_inner',
				'vc_column_inner',
				'rev_slider_vc'
			) );

			// Find all registered tag names in $content.
			preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
//			$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
			$tagnames = array_intersect( $shortcode_keys, $matches[1] );

			if ( empty( $tagnames ) ) {
				return $content;
			}

			$content = do_shortcodes_in_html_tags( $content, false, $tagnames );

			$this->_pattern = '/' . get_shortcode_regex( $tagnames ) . '/';

			$shortcodes = $this->_parse_shortcodes( $content );

			return $shortcodes;
		}

		/**
		 * Parse VC shortcodes from page content
		 *
		 * @param $content
		 *
		 * @return array
		 */
		public function _parse_shortcodes( $content ) {

			if ( ! $this->_pattern ) {
				return array();
			}

			preg_match_all( $this->_pattern, $content, $matches_shortcodes );

			$elements   = array();
			$shortcodes = $matches_shortcodes[2];
			$atts       = $matches_shortcodes[3];
			$nested     = $matches_shortcodes[5];

			foreach ( $shortcodes as $key => $shortcode ) {

				$elements[ $key ] = array(
					'base' => $shortcode,
					'atts' => shortcode_parse_atts( $atts[ $key ] )
				);

				if ( in_array( $shortcode, array( 'vc_row', 'vc_column', 'vc_row_inner', 'vc_column_inner' ) ) ) {
					$elements[ $key ]['nodes'] = $this->_parse_shortcodes( $nested[ $key ] );
				}
			}

			return $elements;

		}

		/**
		 * Convert VC shortcodes structure to SO widgets data
		 *
		 * @param $rows
		 *
		 * @return array
		 */
		public function _convert_so_data( $rows ) {

			$panels_data = array();

			$widget_id = 0;
			foreach ( $rows as $key_row => $row ) {

				foreach ( $row['nodes'] as $key_column => $column ) {

					$column_atts = $column['atts'];
					$width       = 1;

					if ( $column_atts && isset( $column_atts['width'] ) ) {
						eval( '$width=' . $column_atts['width'] . ';' );
					}

					if ( ! empty( $column['nodes'] ) ) {

						foreach ( $column['nodes'] as $key_shortcode => $shortcode ) {

							$shortcode_name = $shortcode['base'];

							if ( $shortcode_name == 'vc_row_inner' ) {
								$widget_atts = array(
									'panels_data' => $this->_convert_so_data( array( $shortcode ) ),
									'panels_info' => array(
										'class'     => 'SiteOrigin_Panels_Widgets_Layout',
										'raw'       => false,
										'raw'       => false,
										'grid'      => $key_row,
										'cell'      => $key_column,
										'id'        => $widget_id ++,
										'widget_id' => $key_row * $key_column + $key_shortcode + $widget_id,
										'style'     => $this->_parse_style( $shortcode['atts'] )
									)
								);

								$panels_data['widgets'][] = $widget_atts;
							} else {
								$widget_class = 'BuilderPress_SO_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', str_replace( 'thim-', '', $shortcode_name ) ) ) );
								$widget_atts  = $this->_parse_atts( $shortcode_name, $shortcode['atts'] );

								if ( ! class_exists( $widget_class ) ) {
									$widget_class = apply_filters( 'builder-press-default-so-widget', 'WP_Widget_Text', $shortcode );

									$atts = '';
									foreach ( $shortcode['atts'] as $key => $_att ) {
										// not yet handle array $_att
										if ( ! is_array( $_att ) ) {
											$atts .= ' ' . $key . '=' . esc_attr( $_att );
										}
									}

									$widget_atts = array(
										'title' => '',
										'text'  => "[$shortcode_name $atts]"
									);
								}

								$widget_atts['panels_info'] = array(
									'class'     => $widget_class,
									'raw'       => false,
									'grid'      => $key_row,
									'cell'      => $key_column,
									'id'        => $widget_id ++,
									'widget_id' => $key_row * $key_column + $key_shortcode + $widget_id,
									'style'     => $this->_parse_style( $shortcode['atts'] )
								);

								$panels_data['widgets'][] = $widget_atts;
							}
						}
					}

					$cell_atts = array(
						'grid'   => $key_row,
						'index'  => $key_column,
						'weight' => $width,
						'style'  => array()
					);

					$panels_data['grid_cells'][] = $cell_atts;
				}

				$grid_atts = array(
					'cells'       => count( $row['nodes'] ),
					'style'       => $this->_parse_style( $row['atts'], 'row' ),
//					'ratio'           => 1,
//					'ratio_direction' => 'right',
					'color_label' => '',
					'label'       => ''
				);

				$panels_data['grids'][] = $grid_atts;
			}

			return $panels_data;
		}

		/**
		 * Parse VC string
		 *
		 * @param        $atts
		 * @param string $type
		 *
		 * @return array
		 */
		protected function _parse_style( $atts, $type = 'widget' ) {
			$style = array();

			if ( is_array( $atts ) ) {
				// add css attrs
				if ( isset( $atts['css'] ) ) {
					preg_match( '/{(.*?)}/', $atts['css'], $matches );

					if ( $matches ) {
						if ( $type == 'row' ) {
							$style['row_css'] = $matches[1];
						} else {
							$style['widget_css'] = $matches[1];
						}
					}
				}

				// add row layout
				if ( isset( $atts['full_width'] ) ) {
					$mapping_row_layout = array(
						''                              => '',
						'stretch_row'                   => 'full',
						'stretch_row_content'           => 'full-stretched',
						'stretch_row_content_no_spaces' => 'full-stretched-padded'
					);

					$style['row_stretch'] = $mapping_row_layout[ $atts['full_width'] ];
				}

				// add extra id, extra class
				if ( isset( $atts['el_id'] ) ) {
					$style['id'] = $atts['el_id'];
				}
				if ( isset( $atts['el_class'] ) ) {
					$style['class'] = $atts['el_class'];
				}
			}

			return $style;
		}

		/**
		 * @param $shortcode_name
		 * @param $atts
		 *
		 * @return array|mixed
		 */
		public function _parse_atts( $shortcode_name, $atts ) {

			$so_widget_class = 'BuilderPress_SO_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', str_replace( 'thim-', '', $shortcode_name ) ) ) );

			if ( class_exists( $so_widget_class ) ) {
				$class = new $so_widget_class();

				/**
				 * @var $class BuilderPress_SO_Widget
				 */
				$form_options = $class->form_options();

				foreach ( $form_options as $key => $option ) {
					if ( $option['type'] == 'section' ) {
						foreach ( $option['fields'] as $field_name => $field ) {
							if ( isset( $atts[ $field_name ] ) ) {
								$atts[ $key ][ $field_name ] = $atts[ $field_name ];
								unset( $atts[ $field_name ] );
							}
						}
					} else if ( $option['type'] == 'so_link' ) {
						if ( isset( $atts[ $key ] ) ) {
							$atts[ $key ]            = $this->_parse_link( $atts[ $key ] );
							$atts[ $key ]['exclude'] = true;
						}
					} else if ( $option['type'] == 'repeater' ) {
						if ( isset( $atts[ $key ] ) ) {
							$atts[ $key ]            = json_decode( urldecode( $atts[ $key ] ), true );
							$atts[ $key ]['exclude'] = true;
						}
					}
				}

				return $this->_merge_atts( $class->get_options(), $atts );
			}

			return array();
		}

		public function _parse_link( $link ) {
			$result = array( 'url' => '', 'title' => '', 'target' => '', 'rel' => '' );

			$params_pairs = explode( '|', $link );

			if ( ! empty( $params_pairs ) ) {
				foreach ( $params_pairs as $pair ) {
					$param = preg_split( '/\:/', $pair );
					if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
						$result[ $param[0] ] = rawurldecode( $param[1] );
					}
				}
			}

			return $result;
		}

		/**
		 * @param $options
		 * @param $atts
		 *
		 * @return mixed
		 */
		public function _merge_atts( $options, $atts ) {

			if ( ! is_array( $atts ) ) {
				return $options;
			}

			foreach ( $atts as $key => $att ) {
				if ( is_array( $att ) && empty( $att['exclude'] ) ) {
					$options[ $key ] = $this->_merge_atts( $options[ $key ], $att );
				} else {
					$options[ $key ] = $att;
				}
				if ( ! empty( $att['exclude'] ) ) {
					unset( $options[ $key ]['exclude'] );
				}
			}

			return $options;
		}
	}
}


//new BuilderPress_Helper_Export_Data();