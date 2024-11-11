<article id="tp_event-<?php the_ID(); ?>" <?php post_class( 'tp_single_event' ); ?>>

    <?php
    /**
     * tp_event_before_single_event hook
     *
     */
    do_action( 'tp_event_before_single_event' );
    ?>

    <div class="bl-detail-event">
        <div class="heading">
            <?php
            /**
             * tp_event_single_event_title hook
             */
            do_action( 'tp_event_single_event_title' );
            ?>

            <?php
            $event    = new WPEMS_Event( get_the_ID() );
            $user = get_user_by( 'id', $event->post->post_author );
            $categories   = get_the_terms(get_the_ID(), 'tp_event_category');
            ?>
            <div class="description">
                <?php echo esc_html__( 'Posted by', 'ivy-school' ); ?> <a href="#"><?php echo esc_html($user->data->user_nicename);?></a>
                <?php if ( isset( $categories[0] ) ) {?>
                    / <?php echo esc_html__( 'Categories', 'ivy-school' ); ?> <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) );?>"><?php echo esc_html( $categories[0]->name );?></a>
                <?php }?>
            </div>
        </div>

        <div class="info">
            <?php
            /**
             * tp_event_loop_event_location hook
             */
            do_action( 'tp_event_loop_event_location' );
            ?>

            <?php
            /**
             * thim_event_loop_event_contact hook
             */
            do_action( 'thim_event_loop_event_contact' );
            ?>
        </div>

        <div class="text">
            <?php
            /**
             * tp_event_single_event_content hook
             */
            do_action( 'tp_event_single_event_content' );
            ?>
        </div>

        <?php if ( get_theme_mod( 'event_show_sharing') == true ) :?>
            <div class="share">
                <?php thim_social_share( 'event_single_' ); ?>
            </div>
        <?php endif;?>

    </div>

	<?php
	/**
	 * tp_event_after_single_event hook
	 *
	 * @hooked tp_event_after_single_event - 10
	 */
	do_action( 'tp_event_after_single_event' );
	?>

    <?php
    //  If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
    ?>

</article><!-- #product-<?php the_ID(); ?> -->