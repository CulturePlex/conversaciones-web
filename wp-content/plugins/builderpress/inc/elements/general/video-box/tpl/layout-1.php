<?php
/**
 * Template for displaying default template Video Box element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/video-box/layout-1.php.
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

$sub_button = $params['sub_button'];
?>
<div <?php echo $style; ?>>
    <div class="box-inner">
		<?php if ( $sub_title ) { ?>
            <div class="subtitle"><?php echo nl2br( $sub_title ); ?></div>
        <?php } ?>

		<?php if ( $title ) { ?>
            <h3 class="title"><?php echo nl2br( $title ); ?></h3>
		<?php } ?>

        <div class="video-button">
			<?php if ( $sub_button ) {
				$sub_button_title = isset( $sub_button['title'] ) ? $sub_button['title'] : __( 'Read more', 'builderpress' );
                if ( isset ( $params['linktype_title'] ) && $params['linktype_title'] != '' ) {
                    $sub_button_title = $params['linktype_title'];
                }
				?>
                <a class="read-more-button"
                   href="<?php echo esc_url( $sub_button['url'] ); ?>"
					<?php echo bp_template_build_link( $sub_button ); ?>>
					<?php echo ent2ncr( $sub_button_title ); ?>
                </a>
			<?php } ?>

			<?php if ( $video_link ) {
				$video_button_title = isset( $video_button['title'] ) ? $video_button['title'] : __( 'View', 'builderpress' );
                if ( isset ( $params['sub_button_title'] ) && $params['sub_button_title'] != '' ) {
                    $video_button_title = $params['sub_button_title'];
                }
				?>
                <a class="btn-open-video popup-youtube"
                   href="<?php echo esc_url( $video_link ); ?>" <?php echo bp_template_build_link( $video_link ); ?>>
                    <i class="ion-ios-play"></i>
					<?php echo ent2ncr( $video_button_title ); ?></a>
			<?php } ?>
        </div>
    </div>
</div>