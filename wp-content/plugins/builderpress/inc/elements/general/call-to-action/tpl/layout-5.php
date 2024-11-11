<?php
/**
 * Template for displaying default template Call To Action element layout 4.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/call-to-action/layout-4.php.
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
$action_secondary = $params['link_secondary'];
?>

<div class="inner-action">
    <div class="content-text">
        <?php if($title){ ?>
            <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css  ); ?>>
                <?php echo esc_html( $title ); ?>
            </<?php echo $title_tag; ?>>
        <?php } ?>

        <div class="call-action-button">
            <?php if ( $action ) {
                $button_title = $action['title'] ? $action['title'] : $title;
                if ( isset ( $params['action_title'] ) && $params['action_title'] != '' ) {
                    $button_title = $params['action_title'];
                }
                ?>
                <a class="btn-get-started" href="<?php echo esc_url( $action['url'] ); ?>"
                    <?php echo bp_template_build_link( $action ); ?>>
                    <?php echo esc_html( $button_title ); ?> </a>
            <?php } ?>
            <?php if ( $action_secondary ) {
                $button_title2 = $action_secondary['title'] ? $action_secondary['title'] : $title;
                if ( isset ( $params['action_title_2'] ) && $params['action_title_2'] != '' ) {
                    $button_title2 = $params['action_title_2'];
                }
                ?>

                <a class="btn-sign-up" href="<?php echo esc_url( $action_secondary['url'] ); ?>"
                    <?php echo bp_template_build_link( $action_secondary ); ?>>
                    <?php echo esc_html( $button_title2 ); ?> </a>
            <?php } ?>
        </div>
    </div>
</div>