<?php
/**
 * Template for displaying default template Call To Action element vblog-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/call-to-action/vblog-layout-1.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

$img = wp_get_attachment_image_src( $params['image'], 'full' );
$style = '';
if($img) $style = ' style="background-image: url(' . $img[0] . ')"';
?>
<div class="wrap-element"<?php echo $style;?>>
    <div class="overlay"></div>

    <div class="content">
        <div class="text" <?php echo ent2ncr( $title_css  ); ?>>
            <?php echo ent2ncr( $title ); ?>
        </div>
        <?php if ( $action ) {
            $button_title = $action['title'] ? $action['title'] : $title;
            if ( isset ( $params['action_title'] ) && $params['action_title'] != '' ) {
                $button_title = $params['action_title'];
            }
            ?>

            <a class="btn-readmore btn-small shape-round" href="<?php echo esc_url( $action['url'] ); ?>"
                <?php echo bp_template_build_link( $action ); ?>>
                <?php echo esc_html( $button_title ); ?> </a>
        <?php } ?>
    </div>
</div>

