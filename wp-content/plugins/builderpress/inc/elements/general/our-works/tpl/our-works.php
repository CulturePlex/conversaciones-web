<?php
/**
 * Template for displaying global default template Our Works element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/our-works/our-works.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $params array - shortcode params
 */

// global params
$template_path = $params['template_path'];
// global params
$layout   = $params['layout'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
$bp_css   = $params['bp_css'];
?>

    <div class="bp-element bp-element-our-works <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

		<?php builder_press_get_template( $layout, array( 'params' => $params ), $template_path ); ?>

    </div>

<?php
/**
 * @param bool   $id
 * @param string $tax_name
 *
 * @return mixed
 */
function get_the_portfolio_category( $id = false, $tax_name = 'category' ) {
	$categories = get_the_terms( $id, $tax_name );
	if ( ! $categories || is_wp_error( $categories ) ) {
		$categories = array();
	}

	$categories = array_values( $categories );

	foreach ( array_keys( $categories ) as $key ) {
		_make_cat_compat( $categories[ $key ] );
	}

	return apply_filters( 'get_the_portfolio_category', $categories, $id );
}

function builder_press_get_entry_meta_category( $limit = '-1' ) {
	$html       = '<span class="meta-category">';
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		if ( $limit == '-1' ) {
			foreach ( $categories as $cat ) {
				$html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a> ';
			}
		} else {
			foreach ( $categories as $key => $cat ) {
				if ( $key == $limit ) {
					break;
				}
				$html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a> ';
			}
		}
	}
	$html .= '</span>';

	return $html;
}