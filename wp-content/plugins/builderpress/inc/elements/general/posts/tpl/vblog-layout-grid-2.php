<?php
/**
 * Template for displaying default template Posts element layout slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/vblog-layout-grid-2.php.
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
global $post_id;

?>

<?php if( isset($title) ) {?>
    <h3 class="title"><?php echo esc_html( $title ); ?></h3>
<?php }?>
<div class="wrap-element">
    <div class="grid-posts grid-isotope">
        <div class="grid-sizer"></div>
        <?php
            $i = 1;
            while ( $query->have_posts() ) : $query->the_post();
                // check post format
                if (has_post_format('aside')) {
                    $class_format = 'aside-item image-item';
                } elseif (has_post_format('chat')) {
                    $class_format = 'chat-item';
                } elseif (has_post_format('gallery')) {
                    $class_format = 'slide-item';
                } elseif (has_post_format('image')) {
                    $class_format = 'image-item';
                } elseif (has_post_format('link')) {
                    $class_format = 'link-item';
                } elseif (has_post_format('quote')) {
                    $class_format = 'quote-item image-item';
                } elseif (has_post_format('audio')) {
                    $class_format = 'audio-item';
                }elseif (has_post_format('video')) {
                    $class_format = 'video-item';
                }
                else {
                    $class_format = 'image-item';
                }

                // check post  first child
                if($i == 1){
                    $size = 'size_2x1';
                    $feature_item = 'feature-item';
                }else {
                    $size = '';
                    $feature_item = '';
                }
                ?>
            <div class="grid-item <?php echo $size ?>">
                <div class="item-post <?php echo $class_format; ?>  <?php echo $feature_item; ?>">
                    <div class="media-item">
                        <?php
                        if ( class_exists( 'TP' ) ) {
                            thim_entry_top_archive();
                        } else {
                            if ( has_post_thumbnail() ) {
                                ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail(); ?>
                                </div><!-- .post-thumbnail -->
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <?php
                    if ( has_post_format( 'link' ) && thim_meta( 'thim_link_url' ) && thim_meta( 'thim_link_text' ) ) {
                        $url  = thim_meta( 'thim_link_url' );
                        $text = thim_meta( 'thim_link_text' );
                        if ( $url && $text ) { ?>
                            <header class="entry-header">
                                <h4 class="entry-title title">
                                    <a class="link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>
                                </h4>
                            </header><!-- .entry-header -->
                            <?php
                        }
                        ?>
                        <div class="entry-summary content">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-summary -->

                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn-readmore btn-small shape-round"><?php echo esc_html__( 'Read More', 'builderpress' ); ?></a>


                        <?php if ( get_theme_mod( 'show_sharing', false ) ) :?>
                            <div class="share">
                                <div class="wrap-text">
                        <span class="text">
                            <?php echo esc_html__('SHARE THIS ARTICLE','builderpress')?>
                        </span>
                                    <span class="line"></span>
                                </div>
                                <?php do_action( 'thim_social_share' ); ?>
                            </div>
                        <?php endif; ?>

                    <?php } elseif ( has_post_format( 'quote' ) && thim_meta( 'thim_quote_author_url' ) ) {

                        $author     = thim_meta( 'thim_quote_author_text' );
                        $author_url = thim_meta( 'thim_quote_author_url' );
                        if ( $author_url ) {
                            $author = ' <a href=' . esc_url( $author_url ) . '>' . $author . '</a>';
                        }
                        ?>
                        <?php thim_entry_meta()?>

                        <header class="entry-header">
                            <?php the_title( sprintf( '<h4 class="entry-title title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                        </header><!-- .entry-header -->


                        <div class="entry-summary content">
                            <?php if ( $author ) { ?>
                                <div class="box-header box-quote">
                                    <blockquote><?php the_content(); ?><cite><?php echo wp_kses( $author, array(
                                                'a' => array(
                                                    'href' => array(),
                                                )
                                            ) ); ?></cite>
                                    </blockquote>
                                </div>
                            <?php } ?>
                        </div><!-- .entry-summary -->

                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn-readmore btn-small shape-round"><?php echo esc_html__( 'Read More', 'hairsalon' ); ?></a>


                        <?php if ( get_theme_mod( 'show_sharing', false ) ) :?>
                            <div class="share">
                                <div class="wrap-text">
                        <span class="text">
                            <?php echo esc_html__('SHARE THIS ARTICLE','builderpress')?>
                        </span>
                                    <span class="line"></span>
                                </div>
                                <?php do_action( 'thim_social_share' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php
                    } elseif ( has_post_format( 'audio' ) ) { ?>
                        <?php thim_entry_meta()?>

                        <header class="entry-header">
                            <div class="entry-meta">
                                <?php the_title( sprintf( '<h4 class="entry-title title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                            </div>
                        </header><!-- .entry-header -->

                        <div class="entry-summary content">
                            <?php
                            the_excerpt();
                            ?>
                        </div><!-- .entry-summary -->

                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn-readmore btn-small shape-round"><?php echo esc_html__( 'Read More', 'hairsalon' ); ?></a>

                        <?php if ( get_theme_mod( 'show_sharing', false ) ) :?>
                            <div class="share">
                                <div class="wrap-text">
                        <span class="text">
                            <?php echo esc_html__('SHARE THIS ARTICLE','builderpress')?>
                        </span>
                                    <span class="line"></span>
                                </div>
                                <?php do_action( 'thim_social_share' ); ?>
                            </div>
                        <?php endif; ?>
                    <?php } elseif ( has_post_format( 'chat' ) ) { ?>

                        <?php thim_entry_meta()?>

                        <header class="entry-header">
                            <div class="entry-meta">
                                <?php the_title( sprintf( '<h4 class="entry-title title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                            </div>
                        </header><!-- .entry-header -->

                        <div class="entry-summary content">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-summary -->

                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn-readmore btn-small shape-round"><?php echo esc_html__( 'Read More', 'hairsalon' ); ?></a>

                        <?php if ( get_theme_mod( 'show_sharing', false ) ) :?>
                            <div class="share">
                                <div class="wrap-text">
                        <span class="text">
                            <?php echo esc_html__('SHARE THIS ARTICLE','builderpress')?>
                        </span>
                                    <span class="line"></span>
                                </div>


                                <?php do_action( 'thim_social_share' ); ?>

                            </div>
                        <?php endif; ?>
                    <?php } else { ?>
                        <?php thim_entry_meta()?>

                        <header class="entry-header">
                            <?php the_title( sprintf( '<h4 class="entry-title title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                        </header>
                        <!-- .entry-header -->

                        <div class="entry-summary content">
                            <?php
                            the_excerpt();
                            ?>
                        </div><!-- .entry-summary -->

                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn-readmore btn-small shape-round"><?php echo esc_html__( 'Read More', 'hairsalon' ); ?></a>


                            <div class="share">
                                <div class="wrap-text">
                        <span class="text">
                            <?php echo esc_html__('SHARE THIS ARTICLE','builderpress')?>
                        </span>
                                    <span class="line"></span>
                                </div>

                                <?php do_action( 'thim_social_share' ); ?>

                            </div>

                    <?php }
                    ?>
                </div>
            </div>
        <?php
            $i++;
            endwhile; ?>
    </div>

</div>
