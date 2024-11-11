<?php
/**
 * BuilderPress Posts config class
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

if ( ! class_exists( 'BuilderPress_Config_Posts' ) ) {
	/**
	 * Class BuilderPress_Config_Posts
	 */
	class BuilderPress_Config_Posts extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Posts constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'posts';
			$this->name = __( 'Posts', 'builderpress' );
			$this->desc = __( 'Display list posts', 'builderpress' );

			parent::__construct();

		}

		/**
		 * @return array
		 */
		public function get_options() {
			static $options;
			if ( ! is_null( $options ) ) {
				return $options;
			}

			// options
			return $options = array(
				array(
					'type'        => 'radio_image',
					'heading'     => __( 'Layout', 'builderpress' ),
					'param_name'  => 'layout',
					'options'     => array(
						'layout-list-1'                => $this->assets_url . 'images/layouts/layout-list-1.jpg',
						'layout-list-2'                => $this->assets_url . 'images/layouts/layout-list.jpg',
						'layout-slider'                => $this->assets_url . 'images/layouts/layout-slider.jpg',
						'layout-grid'                  => $this->assets_url . 'images/layouts/layout-grid.jpg',
						'vblog-layout-slider-3'        => $this->assets_url . 'images/layouts/vblog-layout-slider-3.jpg',
						'vblog-layout-list-footer'     => $this->assets_url . 'images/layouts/vblog-layout-list-footer.jpg',
						'vblog-layout-grid-1'          => $this->assets_url . 'images/layouts/vblog-layout-grid-1.jpg',
						'vblog-layout-grid-2'          => $this->assets_url . 'images/layouts/vblog-layout-isotope.png',
						'vblog-layout-list-sidebar-2'  => $this->assets_url . 'images/layouts/vblog-layout-list-sidebar-2.png',
						'kindergarten-layout-widget-2' => $this->assets_url . 'images/layouts/kindergarten-layout-widget-2.jpg',
						'kindergarten-layout-grid-1'   => $this->assets_url . 'images/layouts/kindergarten-layout-grid-1.jpg',
						'kindergarten-layout-grid-2'   => $this->assets_url . 'images/layouts/kindergarten-layout-grid-2.jpg',
						'marketing-layout-grid-1'      => $this->assets_url . 'images/layouts/marketing-layout-grid-1.jpg',
						'marketing-layout-grid-2'      => $this->assets_url . 'images/layouts/marketing-layout-grid-2.jpg',
						'coach-life-layout-list-1'     => $this->assets_url . 'images/layouts/coach-life-layout-list-1.png',
						'tutorx-layout-grid-1'         => $this->assets_url . 'images/layouts/tutorx-layout-grid-1.jpg',
					),
					'std'         => 'layout-list-1',
					'description' => __( 'Select type of style.', 'builderpress' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'builderpress' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Sub Title', 'builderpress' ),
					'param_name' => 'sub_title',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array(
							'vblog-layout-slider-3',
						),
					),
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'builderpress' ),
					'param_name' => 'post_link',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array(
							'layout-slider',
							'marketing-layout-grid-2',
						),
					),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Category', 'builderpress' ),
					'param_name'       => 'category',
					'value'            => $this->_post_type_categories( 'category' ),
					'edit_field_class' => 'vc_col-xs-6',
				),
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Number of posts', 'builderpress' ),
					'param_name'       => 'number',
					'std'              => '5',
					'edit_field_class' => 'vc_col-xs-6',
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show post date', 'builderpress' ),
					'param_name'       => 'show_date',
					'std'              => true,
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array(
							'layout-slider',
							'layout-list-1',
							'layout-list-2',
							'vblog-layout-list-sidebar-2',
							'kindergarten-layout-widget-1',
							'kindergarten-layout-widget-2',
						),
					),
					'edit_field_class' => 'vc_col-xs-4',
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show author', 'builderpress' ),
					'param_name'       => 'show_author',
					'std'              => true,
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array(
							'layout-list-1',
							'layout-grid',
							'layout-list-2',
						),
					),
					'edit_field_class' => 'vc_col-xs-4',
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show number comments', 'builderpress' ),
					'param_name'       => 'show_number_comments',
					'std'              => true,
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array(
							'layout-grid',
							'layout-list-1',
							'layout-list-2',
						),
					),
					'edit_field_class' => 'vc_col-xs-4',
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show number favorite', 'builderpress' ),
					'param_name'       => 'show_number_favorite',
					'std'              => false,
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array(
							'layout-grid',
						),
					),
					'edit_field_class' => 'vc_col-xs-4',
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show short description', 'builderpress' ),
					'param_name'       => 'show_excerpt',
					'std'              => true,
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array(
							'layout-grid',
							'layout-slider',
						),
					),
					'edit_field_class' => 'vc_col-xs-4',
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show read more button', 'builderpress' ),
					'param_name'       => 'show_readmore',
					'std'              => true,
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array(
							'layout-grid',
							'layout-slider',
						),
					),
					'edit_field_class' => 'vc_col-xs-4',
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show Image', 'builderpress' ),
					'param_name'       => 'show_image',
					'std'              => false,
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array(
							'coach-life-layout-list-1',
						),
					),
					'edit_field_class' => 'vc_col-xs-4',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Sort', 'builderpress' ),
					'param_name'       => 'sort_post',
					'value'            => array(
						__( 'Date', 'builderpress' )   => 'date',
						__( 'Random', 'builderpress' ) => 'rand',
						__( 'Title', 'builderpress' )  => 'title',
					),
					'description'      => __( 'Choose Sort', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-6',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Order By', 'builderpress' ),
					'param_name'       => 'order_post',
					'value'            => array(
						__( 'ASC', 'builderpress' )  => 'asc',
						__( 'DESC', 'builderpress' ) => 'desc',
					),
					'description'      => __( 'Choose Order By', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-4',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Style Layout', 'builderpress' ),
					'param_name'       => 'style_layout',
					'value'            => array(
						__( 'Style Default', 'builderpress' )   => '',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS Shortcode', 'js_composer' ),
					'param_name' => 'bp_css',
					'group'      => __( 'Design Options', 'js_composer' ),
				),
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'posts' => array(
					'src' => 'posts.css',
				),
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'posts' => array(
					'src'  => 'posts.js',
					'deps' => array(
						'jquery',
						'builder-press-slick',
						'builder-press-magnific-popup',
					),
				),
			);
		}

		/*
		 *  thim_entry_meta
		 * */

		public function thim_post_entry_meta() {
			?>
			<div class="entry-meta info">
				<span class="author info-item">
					<i class="ion ion-android-person"></i> <?php echo esc_html__( 'by ', 'video-blog' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo esc_html( get_the_author() ); ?></a>
				</span>

				<span class="item-info">
					<?php echo get_the_date( 'm d, Y' ); ?>
				</span>

				<span class="comment-total info-item"><i class="ion ion-android-chat"></i>
					<?php comments_popup_link( '0 Comment', '1 Comment', '% Comments', 'comments-link', 'Comments are off for this post' ); ?>
				</span>
			</div>
			<?php
		}
	}
}
