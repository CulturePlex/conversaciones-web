<?php
/**
 * BuilderPress Abstract Config
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes/Abstract
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_Abstract_Config' ) ) {

	/**
	 * Class BuilderPress_Abstract_Config
	 */
	abstract class BuilderPress_Abstract_Config {

		/**
		 * @var string
		 */
		public $group = '';

		/**
		 * @var string
		 */
		public $base = '';

		/**
		 * @var string
		 */
		public $name = '';

		/**
		 * @var string
		 */
		public $desc = '';

		/**
		 * @var array
		 */
		public $options = array();

		/**
		 * @var string
		 */
		public $assets_url = '';

		/**
		 * @var string
		 */
		public $assets_path = '';

		/**
		 * @var array
		 */
		public $styles = array();

		/**
		 * @var array
		 */
		public $scripts = array();

		/**
		 * @var array
		 */
		public $queue_assets = array();

		/**
		 * @var array
		 */
		public $localize = array();

		/**
		 * BuilderPress_Abstract_Config constructor.
		 */
		public function __construct() {

			// set group
			$this->group = builder_press_get_group( $this->base );

			$this->assets_url  = BUILDER_PRESS_URL . 'inc/elements/' . $this->group . '/' . $this->base . '/assets/';
			$this->assets_path = BUILDER_PRESS_INC . 'elements/' . $this->group . '/' . $this->base . '/assets/';

			// set options
			$options = is_array( $this->get_options() ) ? $this->get_options() : array();
			// handle std, add default options
			$options_merge_default = array_merge( $options, $this->_default_options() );
			$this->options = apply_filters( "builder-press/" . $this->base . '/config-options', $this->_handle_options( $options_merge_default ) );

			// set styles
			$this->styles = apply_filters( 'builder-press/' . $this->base . '/styles', $this->get_styles() );
			// set scripts
			$this->scripts = apply_filters( 'builder-press/' . $this->base . '/scripts', $this->get_scripts() );
			// set localize
			$this->localize = apply_filters( 'builder-press/' . $this->base . '/localize', $this->get_localize() );
		}

		/**
		 * @param $options
		 *
		 * @return mixed
		 */
		protected function _handle_options( $options ) {

			foreach ( $options as $key => $option ) {
				if ( ! isset( $option['std'] ) ) {
					$type = $option['type'];

					switch ( $type ) {
						case 'dropdown':
							$values                 = ( ! empty( $option['value'] ) && is_array( $option['value'] ) ) ? array_values( $option['value'] ) : '';
							$options[ $key ]['std'] = $values ? reset( $values ) : '';
							break;
						case 'param_group':
							$options[ $key ]['params'] = $this->_handle_options( $option['params'] );
							break;
						case 'radio_image':
							$values                 = ( ! empty( $option['options'] ) && is_array( $option['options'] ) ) ? array_values( $option['options'] ) : '';
							$options[ $key ]['std'] = $values ? reset( $values ) : '';
							break;
						default:
							$options[ $key ]['std'] = '';
							break;
					}
				}
			}

			return $options;
		}

		/**
		 * @return array
		 */
		public function get_options() {
			return array();
		}

		/**
		 * @return array
		 */
		public function get_styles() {
			return array();
		}

		/**
		 * @return array
		 */
		public function get_scripts() {
			return array();
		}

		/**
		 * @return array
		 */
		public function get_localize() {
			return array();
		}

		/**
		 * @return array
		 */
		public function _get_assets() {

			$queue_assets = array();

			$prefix = apply_filters( 'builder-press/prefix-assets', 'builderpress-element-' );

			if ( $this->styles ) {
				// allow hook default folder
				$default_folder_css = apply_filters( 'builder-press/default-assets-folder', $this->assets_path . 'css/', $this->base );
				$default_url_css    = apply_filters( 'builder-press/default-assets-folder', $this->assets_url . 'css/', $this->base );

				foreach ( $this->styles as $handle => $args ) {
					$src      = $args['src'];
					$depends  = ( isset( $args['deps'] ) && is_array( $args['deps'] ) ) ? $args['deps'] : array();
					$media    = ! empty( $args['media'] ) ? $args['media'] : 'all';
					$deps_src = isset( $args['deps_src'] ) ? $args['deps_src'] : array();

					if ( file_exists( $default_folder_css . $src ) ) {
						// enqueue depends
						if ( $depends ) {
							foreach ( $depends as $depend ) {
								if ( wp_script_is( $depend ) ) {

									wp_enqueue_style( $depend );
								} else {
									do_action( 'builder-press/enqueue-depends-styles', $this->base, $depend );
								}
							}
						}

						// add to queue
						$queue_assets['styles'][ $prefix . $handle ] = array(
							'url'      => $default_url_css . $src,
							'deps'     => $depends,
							'media'    => $media,
							'deps_src' => $deps_src
						);
					}
				}
			}

			if ( $this->scripts ) {
				// allow hook default folder
				$default_folder_js = apply_filters( 'builder-press/default-assets-folder', $this->assets_path . 'js/', $this->base );
				$default_url_js    = apply_filters( 'builder-press/default-assets-folder', $this->assets_url . 'js/', $this->base );
				$localized         = false;
				foreach ( $this->scripts as $handle => $args ) {
					$src       = $args['src'];
					$depends   = ! empty( $args['deps'] ) ? $args['deps'] : array();
					$in_footer = isset( $args['in_footer'] ) ? $args['in_footer'] : true;
					$deps_src = isset( $args['deps_src'] ) ? $args['deps_src'] : array();

					if ( file_exists( $default_folder_js . $src ) ) {
						// enqueue depends
						if ( $depends ) {
							foreach ( $depends as $depend ) {
								if ( wp_script_is( $depend ) && $depend != 'jquery' ) {
									wp_enqueue_script( $depend );
								} else {
									do_action( 'builder-press/enqueue-depends-scripts', $this->base, $depend );
								}
							}
						}

						// add to queue
						$queue_assets['scripts'][ $prefix . $handle ] = array(
							'url'       => $default_url_js . $src,
							'deps'      => $depends,
							'in_footer' => $in_footer,
							'deps_src' => $deps_src
						);

						if ( $this->localize ) {
							foreach ( $this->localize as $name => $data ) {
								$queue_assets['scripts'][ $prefix . $handle ]['localize'][ $name ] = $data;
							}
						}

						if ( ! $localized && $this->localize ) {
							foreach ( $this->localize as $name => $data ) {
								wp_localize_script( $prefix . $handle, $name, $data );
							}
							$localized = true;
						}
					}
				}
			}

			return $queue_assets;
		}

		/**
		 * Register scripts
		 */
		public function register_scripts() {

			$queue = $this->_get_assets();

			$localized = false;
			if ( $queue ) {
				foreach ( $queue as $key => $assets ) {
					if ( $key == 'styles' ) {
						if ( ! empty( $args['deps_src'] ) ) {
							foreach ( $args['deps_src'] as $deps_name => $deps_src ) {
								if ( ! wp_script_is( $deps_name, 'registered' ) ) {
									wp_register_style( $deps_name, $deps_src );
								}
							}
						}
						foreach ( $assets as $name => $args ) {
							wp_register_style( $name, $args['url'], $args['deps'], BUILDER_PRESS_VER, $args['media'] );
						}
					} elseif ( $key == 'scripts' ) {
						foreach ( $assets as $name => $args ) {
                            $in_footer = isset( $args['in_footer'] ) ? $args['in_footer'] : true;
							if ( ! empty( $args['deps_src'] ) ) {
								foreach ( $args['deps_src'] as $deps_name => $deps_src ) {
									if ( ! wp_script_is( $deps_name, 'registered' ) ) {
										wp_register_script( $deps_name, $deps_src );
									}
								}
							}

 							wp_register_script( $name, $args['url'], $args['deps'], BUILDER_PRESS_VER, $in_footer);

							// localize scripts
							if ( ! $localized && isset( $args['localize'] ) ) {
								foreach ( $args['localize'] as $index => $data ) {
									wp_localize_script( $name, $index, $data );
								}
								$localized = true;
							}
						}
					}
				}
			}
		}

		/**
		 * Enqueue scripts.
		 */
		public function enqueue_scripts() {
			$queue = $this->_get_assets();

			if ( $queue ) {
				foreach ( $queue as $key => $assets ) {
					if ( $key == 'styles' ) {
						foreach ( $assets as $name => $args ) {
							if ( ! empty( $args['deps_src'] ) ) {
								foreach ( $args['deps_src'] as $deps_name => $deps_src ) {
									if ( ! wp_script_is( $deps_name, 'registered' ) ) {
										wp_register_style( $deps_name, $deps_src );
									}
								}
							}
							wp_enqueue_style( $name );
						}
					} elseif ( $key == 'scripts' ) {
						foreach ( $assets as $name => $args ) {
							if ( ! empty( $args['deps_src'] ) ) {
								foreach ( $args['deps_src'] as $deps_name => $deps_src ) {
									if ( ! wp_script_is( $deps_name, 'registered' ) ) {
										wp_register_script( $deps_name, $deps_src );
									}
								}
							}

							wp_enqueue_script( $name );
						}
					}
				}
			}
		}

		/**
		 * @return mixed
		 */
		protected function _icon_options() {

			$icon_options = array(
				array(
					'type'             => 'dropdown',
					'heading'          => esc_attr__( 'Icon type', 'builderpress' ),
					'param_name'       => 'icon_type',
					'admin_label'      => true,
					'value'            => array(
						esc_attr__( 'None', 'builderpress' )         => 'none',
						esc_attr__( 'Font Awesome', 'builderpress' ) => 'icon_fontawesome',
						esc_attr__( 'Ionicon', 'builderpress' )      => 'icon_ionicon',
						esc_attr__( 'Upload Image', 'builderpress' ) => 'icon_upload',
					),
					'std'              => 'icon_fontawesome',
					'edit_field_class' => 'vc_col-sm-6',
				),

				// Fontawesome Picker
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_attr__( 'Font Awesome', 'builderpress' ),
					'param_name'       => 'icon_fontawesome',
					'value'            => 'fa fa-heart',
					'settings'         => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
						'type'         => 'fontawesome',
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon_fontawesome' ),
					),
					'edit_field_class' => 'vc_col-sm-6',
					'description'      => esc_html__( 'Font awesome library.', 'builderpress' ),
				),

				// Ionicon Picker
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_attr__( 'Ionicon', 'builderpress' ),
					'param_name'       => 'icon_ionicon',
					'value'            => 'ion-android-add-circle',
					'settings'         => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
						'type'         => 'ionicon',
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon_ionicon' ),
					),
					'edit_field_class' => 'vc_col-sm-6',
					'description'      => esc_html__( 'Ionicons library.', 'builderpress' ),
				),

				// Upload icon image
				array(
					'type'             => 'attach_image',
					'heading'          => esc_attr__( 'Upload icon', 'builderpress' ),
					'param_name'       => 'icon_upload',
					'admin_label'      => true,
					'description'      => esc_attr__( 'Select an image to upload', 'builderpress' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon_upload' )
					),
					'edit_field_class' => 'vc_col-sm-6',
				)
			);

			return apply_filters( 'builder-press/element-icon-options', $icon_options );
		}

		/**
		 * Options to config number items in slider.
		 *
		 * @param array $default
		 * @param array $depends
		 *
		 * @return mixed
		 */
		protected function _number_items_options( $default = array(), $depends = array() ) {

			$options = apply_filters( 'builder-press/element-default-number-items-slider', array(
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Visible Items', 'builderpress' ),
					'param_name'       => 'items_visible',
					'std'              => '4',
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4',
				),

				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Tablet Items', 'builderpress' ),
					'param_name'       => 'items_tablet',
					'std'              => '2',
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4',
				),

				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Mobile Items', 'builderpress' ),
					'param_name'       => 'items_mobile',
					'std'              => '1',
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4',
				)
			) );

			// handle default value
			if ( $default ) {
				foreach ( $options as $key => $item ) {
					$name = $item['param_name'];
					if ( array_key_exists( $name, $default ) ) {
						$options[ $key ]['std'] = $default[ $name ];
					}
				}
			}

			// handle dependency
			if ( $depends ) {
				foreach ( $options as $key => $item ) {
					$options[ $key ]['dependency'] = $depends;
				}
			}

			return $options;
		}

		/**
		 * Get all Post type categories.
		 *
		 * @param       $category_name
		 *
		 * @return array
		 */
		protected function _post_type_categories( $category_name ) {
			// Only call on Backend.
			if ( ! is_admin() ) {
				return [];
			}

			$key     = 'builder-press/post-type-categories/' . $category_name;
			$options = builderpress_cache_load_first( 'get', $key );
			if ( false !== $options ) {
				return $options;
			}

			global $wpdb;
			$categories = $wpdb->get_results( $wpdb->prepare(
				"
				  SELECT      t2.slug, t2.name
				  FROM        $wpdb->term_taxonomy AS t1
				  INNER JOIN $wpdb->terms AS t2 ON t1.term_id = t2.term_id
				  WHERE t1.taxonomy = %s
				  ",
                $category_name
			) );

			$options = array( esc_html__( 'All Category', 'builderpress' ) => '' );
			foreach ( $categories as $category ) {

				$options[ html_entity_decode( $category->name ) ] = $category->slug;
			}

			builderpress_cache_load_first( 'set', $key, $options );

			return $options;
		}

		/**
		 * @return mixed
		 */
		protected function _setting_font_weights() {

			$font_weight = array(
				esc_html__( 'Select', 'builderpress' ) => '',
				esc_html__( 'Normal', 'builderpress' ) => 'normal',
				esc_html__( 'Bold', 'builderpress' )   => 'bold',
				esc_html__( '100', 'builderpress' )    => '100',
				esc_html__( '200', 'builderpress' )    => '200',
				esc_html__( '300', 'builderpress' )    => '300',
				esc_html__( '400', 'builderpress' )    => '400',
				esc_html__( '500', 'builderpress' )    => '500',
				esc_html__( '600', 'builderpress' )    => '600',
				esc_html__( '700', 'builderpress' )    => '700',
				esc_html__( '800', 'builderpress' )    => '800',
				esc_html__( '900', 'builderpress' )    => '900'
			);

			return apply_filters( 'builder-press/settings-font-weight', $font_weight );
		}

		/**
		 * @return mixed
		 */
		protected function _setting_tags() {

			$tags = array(
				esc_html__( 'Select tag', 'builderpress' ) => '',
				esc_html__( 'h2', 'builderpress' )         => 'h2',
				esc_html__( 'h3', 'builderpress' )         => 'h3',
				esc_html__( 'h4', 'builderpress' )         => 'h4',
				esc_html__( 'h5', 'builderpress' )         => 'h5',
				esc_html__( 'h6', 'builderpress' )         => 'h6'
			);

			return apply_filters( 'builder-press/settings-tags', $tags );
		}

		/**
		 * @return mixed
		 */
		protected function _event_statuses() {

			$statuses = array(
				esc_html__( 'All', 'builderpress' )       => '',
				esc_html__( 'Upcoming', 'builderpress' )  => 'upcoming',
				esc_html__( 'Happening', 'builderpress' ) => 'happening',
				esc_html__( 'Expired', 'builderpress' )   => 'expired',
			);

			return apply_filters( 'builder-press/settings-event-statuses', $statuses );
		}

		/**
		 * @return mixed
		 */
		protected function _setting_text_transform() {

			$text_transform = array(
				esc_html__( 'None', 'builderpress' )       => 'none',
				esc_html__( 'Capitalize', 'builderpress' ) => 'capitalize',
				esc_html__( 'Uppercase', 'builderpress' )  => 'uppercase',
				esc_html__( 'Lowercase', 'builderpress' )  => 'lowercase',
			);

			return apply_filters( 'builder-press/settings-text-transform', $text_transform );
		}

		/**
		 * Select course option
		 *
		 * @return array
		 */
		protected function _all_courses_options() {

			$args = array(
				'post_type'   => 'lp_course',
				'post_status' => 'publish',
			);

			$courses = new WP_Query( apply_filters( 'builder-press/query-select-courses', $args ) );

			$options                                          = array();
			$options[ __( 'Select course', 'builderpress' ) ] = '';

			if ( $courses->have_posts() ) {
				foreach ( $courses->posts as $course ) {
					$options[ $course->post_title ] = $course->ID;
				}
			}

			return $options;
		}

		/**
		 * Default options for all elements.
		 *
		 * @return mixed
		 */
		protected function _default_options() {

			$default_options = array(
				array(
					'type'             => 'textfield',
					'admin_label'      => true,
					'heading'          => __( 'Extra class', 'builderpress' ),
					'param_name'       => 'el_class',
					'value'            => '',
					'description'      => __( 'Add extra class for element.', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'             => 'textfield',
					'admin_label'      => true,
					'heading'          => __( 'Extra ID', 'builderpress' ),
					'param_name'       => 'el_id',
					'value'            => '',
					'description'      => __( 'Add extra ID for element.', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6'
				)
			);

			return apply_filters( 'builder-press/element-default-options', $default_options );
		}

	}
}
