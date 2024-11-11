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


?>

<div class="wrap-element">
    <div class="background-element">
        <?php
        $thumbnail_id = (int) $params['image'];
        $size         = apply_filters( 'builder-press/call-to-action/kindergarten-layout-1/image-size', '584x439' );
        builder_press_get_attachment_image( $thumbnail_id, $size );
        ?>
    </div>

    <div class="content-element">
        <?php if ( $action ) {
        $button_title = $action['title'] ? $action['title'] : $title;
        if ( isset ( $params['action_title'] ) && $params['action_title'] != '' ) {
            $button_title = $params['action_title'];
        }
        ?>
            <a href="<?php echo esc_url( $action['url'] ); ?>" class="btn-call">
                <i class="fa fa-phone"></i>
            </a>
        <?php } ?>

        <div class="content">
            <?php if($title){ ?>
                <span class="text" <?php echo ent2ncr( $title_css  ); ?>><?php echo ent2ncr( $title ); ?> </span>
            <?php } ?>
            <?php if ( $description ) { ?>
                <span class="number" <?php echo ent2ncr( $des_css ); ?>><?php echo esc_html( $description ); ?></span>
            <?php } ?>
        </div>
    </div>
</div>

