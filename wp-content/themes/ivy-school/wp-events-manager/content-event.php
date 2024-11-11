<?php
/**
 * The template for displaying event content in the single-event.php template
 *
 * Override this template by copying it to yourtheme/tp-event/templates/content-event.php
 *
 * @author 		ThimPress
 * @package 	tp-event
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * tp_event_before_loop_event hook
	 *
	 */
	 do_action( 'tp_event_before_loop_event' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div id="event-<?php the_ID(); ?>" class="custom-col col-md-6 col-xl-4">

    <div class="item-normal">

        <?php
        /**
         * tp_event_before_loop_event_summary hook
         *
         * @hooked tp_event_show_event_sale_flash - 10
         * @hooked tp_event_show_event_images - 20
         */
        do_action( 'tp_event_before_loop_event_item' );
        ?>

        <div class="pic">

            <?php
            /**
             * tp_event_single_event_thumbnail hook
             */
            do_action( 'tp_event_single_event_thumbnail' );
            ?>

        </div>

        <div class="content">

            <div class="date-event">
                <span class="day"><?php echo wpems_event_start( 'd', null );?></span> <?php echo wpems_event_start( 'M, Y', null );?>
            </div>
            <div class="info-event">
                <div class="title-event">
                    <a href="<?php the_permalink() ?>">
                        <?php the_title(); ?>
                    </a>
                </div>

                <div class="meta-event">
                    <span>
                        <i class="ion ion-android-alarm-clock"></i>
                        <?php echo wpems_event_start( 'H:i', null, false );?> -  <?php echo wpems_event_end( 'H:i', null, false );?>
                    </span>

                    <span>
                        <i class="ion ion-ios-location-outline"></i>
                        <?php echo wpems_event_location();?>
                    </span>
                </div>
            </div>

        </div>

        <?php
        /**
         * tp_event_after_loop_event_item hook
         *
         * @hooked tp_event_show_event_sale_flash - 10
         * @hooked tp_event_show_event_images - 20
         */
        do_action( 'tp_event_after_loop_event_item' );
        ?>

    </div>

</div>

<?php do_action( 'tp_event_after_loop_event' ); ?>
