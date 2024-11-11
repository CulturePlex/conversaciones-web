<?php
/**
 * Template for displaying default template Heading element kindergarten-layout-2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/heading/kindergarten-layout-2.php.
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

$title           = $params['title'];
$sub_title       = $params['sub_title'];
$description     = $params['content'];
$show_line       = $params['show_line'];
$image           = !empty($params['image']) ? $params['image'] : '';
$allow_html_tags = apply_filters( 'builder-press/heading/allow-html-tags', array(
    'a'      => array( 'href' => array(), 'title' => array() ),
    'ul'     => array( 'class' => array() ),
    'li'     => array( 'class' => array() ),
    'span'   => array( 'class' => array() ),
    'br'     => array(),
    'em'     => array(),
    'strong' => array(),
) );
?>
<?php if ( $title ) { ?>
    <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css ); ?>>
    <?php echo wp_kses( $title, $allow_html_tags ); ?>
    </<?php echo $title_tag; ?>>
<?php } ?>

<?php if ( $show_line) { ?>
    <div class="line" <?php echo ent2ncr( $line_css ); ?>>
        <span class="icon-line">
            <?php $image_show = wp_get_attachment_image_src( $image, 'full' ); ?>
                <img src="<?php echo esc_attr( $image_show[0] ); ?>"
                         width="<?php echo esc_attr( $image_show[1] ); ?>"
                         height="<?php echo esc_attr( $image_show[2] ); ?>"
                         alt="<?php esc_attr__( 'image icon', 'builderpress' ); ?>">
        </span>
    </div>
<?php } ?>

<?php if ( $sub_title ) { ?>
    <span class="sub-title" <?php echo ent2ncr( $sub_title_css ); ?>><?php echo wp_kses( $sub_title, $allow_html_tags ); ?></span>
<?php } ?>



