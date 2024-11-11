<?php
/**
 * Template for displaying default template Call To Action element layout-3.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/call-to-action/layout-3.php.
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
?>

<div class="inner-action">
    <div class="content-text">
        <?php if($title){ ?>
            <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css  ); ?>>
                <?php echo esc_html( $title ); ?>
            </<?php echo $title_tag; ?>>
        <?php } ?>

        <?php if ( $description ) { ?>
            <h6 class="description" <?php echo ent2ncr( $des_css ); ?>>
                <?php echo esc_html( $description ); ?>
            </h6>
        <?php } ?>
    </div>

	<?php if ( $action ) {
		$button_title = $action['title'] ? $action['title'] : $title;
        if ( isset ( $params['action_title'] ) && $params['action_title'] != '' ) {
            $button_title = $params['action_title'];
        }
		?>

        <a class="readmore" href="<?php echo esc_url( $action['url'] ); ?>"
			<?php echo bp_template_build_link( $action ); ?>>
			<?php echo esc_html( $button_title ); ?> </a>
	<?php } ?>
</div>
