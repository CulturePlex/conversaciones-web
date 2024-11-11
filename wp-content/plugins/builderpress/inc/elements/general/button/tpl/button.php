<?php
/**
 * Template for displaying default template Button element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/button/button.php.
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
$link               = $params['link'];
$style              = $params['style'];
$show_line          = !empty($params['show_line']) ? $params['show_line'] : '';
$button_margin      = $params['button_margin'];
$button_border_width = $params['button_border_width'];
$text_color         = $params['text_color'];
$text_hover_color   = $params['text_hover_color'];
$background_color   = $params['bg_color'];
$bg_hover_color     = $params['bg_hover_color'];
$background_color   = $params['bg_color'];
$border_color     = $params['border_color'];
$border_hover_color      = $params['border_hover_color'];
$button_padding     = $params['button_padding'];
$button_line_height = $params['button_line_height'];
$button_font_size   = $params['button_font_size'];
$button_font_weight = $params['button_font_weight'];
$icon_type          = $params['icon_type'];
$shape              = $params['shape'];
$align              = $params['align'];
$icon_alignment     = $params['icon_alignment'];
$icon_size          = $params['size'];
$el_class           = $params['el_class'];
$el_id              = $params['el_id'];
$bp_css = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? 'data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? 'data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';

$button_css = '';
$button_css .= $button_margin ? ' margin: ' . $button_margin . ';' : '';
$button_css = $button_css ? ' style="' . $button_css . '"' : '';

$inline_css = $text_color ? ' color: ' . $text_color . ';' : '';
$inline_css .= $button_border_width ? ' border-style: solid; border-width: ' . $button_border_width . 'px;' : '';
$inline_css .= $border_color ? ' border-color: ' . $border_color . ';' : '';
$inline_css .= $background_color ? ' background-color: ' . $background_color . ';' : '';
$inline_css .= $button_padding ? ' padding: ' . $button_padding . ';' : '';
$inline_css .= $button_line_height ? ' line-height: ' . $button_line_height . 'px;' : '';
$inline_css .= $button_line_height ? ' height: ' . $button_line_height . 'px;' : '';
$inline_css .= $button_font_size ? ' font-size: ' . $button_font_size . 'px;' : '';
$inline_css .= $button_font_weight ? ' font-weight: ' . $button_font_weight . ';' : '';
$inline_css = $inline_css ? ' style="' . $inline_css . '"' : '';

$el_class .= $shape ? ' shape-' . $params['shape'] . ' ' : '';
$el_class .= ( $icon_type && $icon_alignment ) ? 'icon_alignment-' . $icon_alignment . ' ' : '';

$button_classes = $icon_size ? 'btn-' . $icon_size . ' ' : '';

$style_hover = '';
if ( ! empty( $text_hover_color ) ) {
	$style_hover .= "color: " . $text_hover_color . ";";
}
if ( ! empty( $bg_hover_color ) ) {
	$style_hover .= "background-color: " . $bg_hover_color . ";";
}
if ( ! empty( $border_hover_color ) ) {
    $style_hover .= "border-color: " . $border_hover_color . ";";
}

if(!empty($show_line)) {
    $class_line = 'line-through';
}else {
    $class_line = '';
}
?>

<div class="bp-element bp-element-button <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $align ); ?> <?php echo esc_attr( $el_class ) ?> <?php echo esc_attr( $class_line ) ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?> <?php echo ent2ncr( $button_css ); ?> <?php echo $data_tablet;?> <?php echo $data_mobile;?>>
	<?php if ( $link ) {
		$title = $link['title'] ? $link['title'] : __( 'Button', 'builderpress' );
		if ( isset ( $params['linktype_title'] ) && $params['linktype_title'] != '' ) {
			$title = $params['linktype_title'];
        }?>

        <a class="btn btn-primary bp-element-hover <?php echo esc_html( $style );?> <?php echo esc_attr( $button_classes ); ?>"
           href="<?php echo esc_url( $link['url'] ); ?>"
			<?php echo ent2ncr( $inline_css ); ?>
			<?php echo bp_template_build_link( $link ); ?>
           data-hover="<?php echo ent2ncr( $style_hover ); ?>">

			<?php if ( $icon_type ) {
				if ( $icon_type == 'icon_upload' ) {
					//custom image
					echo wp_get_attachment_image( $params['icon_upload'], 'full' );
				} else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                    <!--                    ion icon-->
                    <i class="btn-icon ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>"
                       aria-hidden="true"></i>
				<?php } else if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                    <!--                    font awesome-->
                    <i class="btn-icon <?php echo esc_attr( $params[ $icon_type ] ); ?>"
                       aria-hidden="true"></i>
				<?php }
			} ?>

            <span class="inner-text"><?php echo ent2ncr( $title ); ?></span>
        </a>
	<?php } ?>
</div>