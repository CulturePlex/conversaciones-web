<?php
/**
 * Template for displaying default template call to Call To Action layout 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/call-to-action/layout-2.php.
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
$img = wp_get_attachment_image_src( $params['image'], 'full' );
?>

<div class="inner-box">
    <div class="media-box">
		<?php if ( $img ) { ?>
            <img class="img-media" src="<?php echo esc_url( $img[0] ) ?>"
                 alt="<?php echo esc_attr__( 'Media', 'builderpress' ); ?>"/>
		<?php } ?>
    </div>

    <div class="content-box">
        <?php if($title){ ?>
            <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css  ); ?>>
                <?php echo esc_html( $title ); ?>
            </<?php echo $title_tag; ?>>
        <?php } ?>
        <?php if ( $description ) { ?>
            <h6 class="description" <?php echo ent2ncr( $des_css ); ?>>
                <?php echo ent2ncr( $description ); ?>
            </h6>
        <?php } ?>

		<?php if ( $action ) {
			$button_title = ! empty( $action['title'] ) ? $action['title'] : $title;
            if ( isset ( $params['action_title'] ) && $params['action_title'] != '' ) {
                $button_title = $params['action_title'];
            }
			?>

            <a class="readmore" href="<?php echo esc_url( $action['url'] ); ?>"
				<?php echo bp_template_build_link( $action ); ?>>
				<?php echo esc_html( $button_title ); ?>
            </a>
		<?php } ?>
    </div>
</div>