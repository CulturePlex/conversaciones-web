<?php
/**
 * Template part for displaying single.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 */

if(!has_post_thumbnail( $post->ID )){
    $class_none_thumbnail = 'none-has-post-thumbnail';
}else{
    $class_none_thumbnail = '';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class_none_thumbnail); ?>>
	<div class="content-inner">
        <?php
        if ( 'elementor_library' == get_post_type() ) {
            the_content();
        } else {
            ?>
            <div class="wrapper-entry-top">
                <div class="entry-content">
                    <header class="entry-header">
                        <?php
                        if ( is_single() ) {
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        } else {
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        }
                        ?>
                    </header><!-- .entry-header -->
                    <?php thim_entry_meta(); ?>
                </div>
                <div class="entry-top">
                    <?php if ( get_theme_mod( 'blog_single_feature_image', true ) ) :
                        if ( class_exists( 'TP' ) ) {
                            do_action( 'thim_entry_top', 'full' );
                        } else {
                            if ( has_post_thumbnail() ) {
                                ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail(); ?>
                                </div><!-- .post-thumbnail -->
                                <?php
                            }
                        }
                    endif; ?>
                    <?php thim_entry_meta_date(); ?>
                </div><!-- .entry-top -->
            </div>
            <div class="entry-content">
                <div class="share-text">
                    <?php if ( get_theme_mod( 'show_sharing') == true ) :?>
                        <div class="entry-tag-share icon-share sticky-sidebar">
                            <?php thim_social_share( 'blog_single_' ); ?>
                        </div>
                    <?php endif;?>
                    <div class="entry-description <?php if ( get_theme_mod( 'show_sharing', false ) ) echo 'text';?>">
                        <?php
                        // Get post content
                        the_content();

                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ivy-school' ),
                                'after'  => '</div>',
                            )
                        );
                        ?>

                        <?php if ( get_theme_mod( 'show_tags_meta_tags', true ) ) : ?>
                            <div class="entry-tag-share">
                                <?php thim_entry_meta_tags(); ?>
                            </div>
                        <?php endif; ?>

                        <?php  do_action( 'thim_about_author' ); ?>

                        <div class="entry-navigation-post">
                            <?php
                            global $prev_post;
                            $prev_post = get_previous_post();
                            ?>
                            <div class="prev-post">

                                <?php
                                if (!empty( $prev_post )):
                                    ?>
                                    <div class="left-post">

                                        <a href="<?php echo esc_url(get_permalink($prev_post->ID)) ?>">
                                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                        </a>

                                    </div>
                                    <div class="right-post">
                                        <p class="heading"><?php echo esc_html__('Previous','ivy-school');?> </p>
                                        <h5 class="title">
                                            <a href="<?php echo esc_url(get_permalink($prev_post->ID)) ?>"><?php echo esc_html($prev_post->post_title); ?></a>
                                        </h5>
                                        <div class="date"><?php echo esc_html(get_the_date('F j, Y',$prev_post->ID)); ?></div>
                                    </div>

                                <?php
                                endif;
                                ?>
                            </div>

                            <?php
                            global $next_post;
                            $next_post = get_next_post();
                            ?>
                            <div class="next-post">
                                <?php
                                if (!empty( $next_post )):
                                    ?>
                                    <div class="left-post">
                                        <p class="heading"><?php echo esc_html__('Next','ivy-school');?> </p>
                                        <h5 class="title">
                                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo esc_html($next_post->post_title); ?></a>
                                        </h5>
                                        <div class="date"><?php echo esc_html(get_the_date('F j, Y',$next_post->ID)); ?> </div>
                                    </div>
                                    <div class="right-post">
                                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php
                                endif;
                                ?>
                            </div>

                        </div>

                        <?php
                        //  If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
	</div><!-- .content-inner -->

</article><!-- #post-## -->
