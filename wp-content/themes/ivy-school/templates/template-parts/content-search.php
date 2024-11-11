<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

if(!has_post_thumbnail( $post->ID )){
    $class_none_thumbnail = 'none-has-post-thumbnail';
}else{
    $class_none_thumbnail = '';
}


$class = 'column-1-blog-archive col-md-12 '. $class_none_thumbnail;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="content-inner">
        <?php 
            if(get_post_type() != 'page') {
                ?>
                    <div class="entry-top">
                        <?php 
                            if ( has_post_thumbnail()) {
                                ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail(); ?>
                                </div><!-- .post-thumbnail -->
                                <?php
                            }
                            thim_entry_meta_date();
                        ?>
                    </div>
                <?php
            }
        ?>
        
        <div class="entry-content">
            <header class="entry-header">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            </header><!-- .entry-header -->
            <?php if ( 'post' === get_post_type() ) : ?>
                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>

            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
        </div>
    </div>
</article><!-- #post-## -->
