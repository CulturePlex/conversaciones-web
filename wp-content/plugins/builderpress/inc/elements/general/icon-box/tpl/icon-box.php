<?php
/**
 * Template for displaying default template Icon Box element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/icon-box/icon-box.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * @var $params array - shortcode params
 */

// global params
$template_path = $params['template_path'];
$layout      = isset($params['layout'])? $params['layout'] : 'layout-1';
$el_class    = $params['el_class'];
$el_id       = $params['el_id'];
$link        = $params['box_link'];
$icon_type   = $params['icon_type'];
$title       = $params['title'];
$description = $params['description'];
$el_class    = $params['el_class'];
$el_id       = $params['el_id'];
$bp_css = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet   = $bp_css_tablet ? 'data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile   = $bp_css_mobile ? 'data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';
$show_line     = ( !empty($params['show_line']) ) ? $params['show_line'] : false;
$icon_style    = !empty($params['icon_style']) ? $params['icon_style'] : 'style-1';
$style_layout_6   = !empty($params['style_layout_6']) ? $params['style_layout_6'] : 'layout-6-default';
$icon_size     = !empty($params['icon_size']) ? $params['icon_size'] : '';
$image           = !empty($params['image']) ? $params['image'] : '';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';

// title style
$title_css = '';
$title_css .= $params['title_color'] ? 'color:' . $params['title_color'] . '; ' : '';
$title_css .= $params['title_font_size'] ? 'font-size:' . $params['title_font_size'] . 'px; ' : '';
$title_css .= $params['title_font_weight'] ? 'font-weight:' . $params['title_font_weight'] . '; ' : '';
$title_css .= $params['title_margin'] ? 'margin:' . $params['title_margin'] . '; ' : '';
$title_css .= $params['title_custom_css'] ? $params['title_custom_css'] : '';
$title_css = $title_css ? ' style="' . $title_css . '"' : '';
$title_tag = $params['title_tag'] ? $params['title_tag'] : 'h3';

$link_css = '';
$link_css .= $params['link_color'] ? 'color:' . $params['link_color'] . '; ' : '';
$link_css = $link_css ? ' style="' . $link_css . '"' : '';

// description style
$des_css = '';
$des_css .= $params['desc_color'] ? 'color:' . $params['desc_color'] . '; ' : '';
$des_css .= $params['desc_font_weight'] ? 'font-weight:' . $params['desc_font_weight'] . '; ' : '';
$des_css .= $params['desc_font_size'] ? 'font-size:' . $params['desc_font_size'] . 'px; ' : '';
$des_css .= $params['desc_margin'] ? 'margin:' . $params['desc_margin'] . '; ' : '';
$des_css .= $params['desc_custom_css'] ? $params['desc_custom_css'] : '';
$des_css = $des_css ? ' style="' . $des_css . '"' : '';

// icon style
$icon_css = '';
$icon_css .= $params['icon_font_size'] ? 'font-size: ' . $params['icon_font_size'] . 'px; ' : '';
$icon_css .= $params['icon_color'] ? 'color:' . $params['icon_color'] . '; ' : '';
$icon_css .= ( ( $icon_type == 'icon_ionicon' || $icon_type == 'icon_fontawesome' ) && $params['box_icon_height'] ) ? 'line-height: ' . $params['box_icon_height'] . 'px;' : '';
$icon_css .= $params['icon_border_color'] ? 'border-color:' . $params['icon_border_color'] . '; ' : '';
$icon_css .= $params['icon_background_color'] ? 'background-color:' . $params['icon_background_color'] . '; ' : '';
//$icon_css .= $params['icon_size'] ? 'font-size:' . $params['icon_size'] . 'px; ' : '';
$icon_css   = $icon_css ? ' style="' . $icon_css . '"' : '';
$icon_shape = $params['icon_shape'];
$el_class   .= $params['icon_position'] ? ' ' . $params['icon_position'] : '';
$el_class   .= $params['text_align'] ? ' ' . $params['text_align'] : '';

// box icon style
$box_icon_css = '';
$box_icon_css .= $params['icon_margin'] ? 'margin:' . $params['icon_margin'] . '; ' : '';
$box_icon_css .= $params['box_icon_width'] ? 'width:' . $params['box_icon_width'] . 'px; ' : '';
$box_icon_css .= $params['box_icon_height'] ? 'line-height:' . $params['box_icon_height'] . 'px; ' : '';
$box_icon_css .= $params['box_icon_height'] ? 'height:' . $params['box_icon_height'] . 'px; ' : '';
$box_icon_css .= $params['icon_background_color'] ? 'background-color:' . $params['icon_background_color'] . '; ' : '';
$box_icon_css = $box_icon_css ? ' style="' . $box_icon_css . '"' : '';

// content style
$content_css = '';
$content_css .= ( $params['box_icon_width'] && $params['icon_position'] && ( $params['icon_position'] == 'icon-left' || $params['icon_position'] == 'icon-right' ) ) ? 'width: calc(100% - ' . ( $params['box_icon_width'] + 25 ) . 'px); ' : '';
$content_css = $content_css ? ' style="' . $content_css . '"' : '';

// button style
$button_css = '';
$button_css .= $params['button_text_color'] ? 'color:' . $params['button_text_color'] . '; ' : '';
$button_css = $button_css ? ' style="' . $button_css . '"' : '';

// line color
// line style
$line_css = '';
$line_css .= !empty($params['line_color']) ? 'color:' . $params['line_color'] . '; ' : '';
$line_css = $line_css ? ' style="' . $line_css . '"' : '';

//Style hover
$icon_hover = $link_hover = '';

if ( !empty( $params['icon_hover_background_color'] ) ) {
    $icon_hover .= "background-color: " . $params['icon_hover_background_color'] . ";";
}
if ( !empty( $params['icon_hover_border_color'] ) ) {
    $icon_hover .= "border-color: " . $params['icon_hover_border_color'] . ";";
}
if ( !empty( $params['link_hover_color'] ) ) {
    $link_hover .= "color: " . $params['link_hover_color'] . ";";
}

?>
<?php
    if($show_line == true){
        $class_line = 'line-right';
    }else{
        $class_line = '';
    }
    $class_layout = '';
    switch ($layout){
        case 'layout-3':
            $class_layout = 'icon-right-layout-3';
            break;
        case 'layout-4':
            $class_layout = 'icon-left-layout-4';
            break;
    }
?>
<div class="bp-element bp-element-icon-box <?php echo esc_attr($class_layout); ?> <?php echo esc_attr($icon_size); ?> <?php echo esc_attr($class_line); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $icon_style ); ?> <?php echo esc_attr( $style_layout_6 ); ?> <?php echo esc_attr($style_layout); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>  <?php echo $data_tablet;?> <?php echo $data_mobile;?>>
	<?php builder_press_get_template( $layout,
		array(
			'icon_shape'   => $icon_shape,
			'icon_type'    => $icon_type,
			'params'       => $params,
			'icon_css'     => $icon_css,
			'icon_hover'   => $icon_hover,
			'box_icon_css' => $box_icon_css,
			'title'        => $title,
			'title_tag'    => $title_tag,
			'title_css'    => $title_css,
			'content_css'  => $content_css,
			'link'         => $link,
            'link_hover'   => $link_hover,
			'link_css'     => $link_css,
			'des_css'      => $des_css,
			'description'  => $description,
			'button_css'   => $button_css,
            'show_line'    => $show_line,
            'line_css'     => $line_css,
            'icon_style'   => $icon_style,
            'style_layout_6'   => $style_layout_6,
            'image'        => $image
		), $template_path );
	?>
</div>
