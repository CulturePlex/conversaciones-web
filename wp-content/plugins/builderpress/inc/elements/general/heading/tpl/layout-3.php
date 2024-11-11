<?php
/**
 * Template for displaying default template Heading element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/heading/layout-1.php.
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

<?php if ( $sub_title ) { ?>
    <span class="sub-title" <?php echo ent2ncr( $sub_title_css ); ?>><?php echo wp_kses( $sub_title, $allow_html_tags ); ?></span>
<?php } ?>

<?php if ( $show_line ) { ?>
    <div class="line" <?php echo ent2ncr( $line_css ); ?>></div>
<?php } ?>

<?php if ( $description ) { ?>
    <div class="description" <?php echo ent2ncr( $des_css ); ?>><?php echo wp_kses( $description, $allow_html_tags ); ?></div>
<?php } ?>
