<?php
/**
 * Template for displaying default template Posts element layout grid 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/vblog-layout-grid-1.php.
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
 * @var $query
 * @var $title
 * @var $show_date
 * @var $show_author
 * @var $show_number_comments
 * @var $show_excerpt
 * @var $show_readmore
 * @var $show_number_favorite
 */
?>

<?php if( isset($title) ) {?>
    <h3 class="title"><?php echo esc_html( $title ); ?></h3>
<?php }?>

<div class="wrap-element">
    <div class="grid-posts grid-isotope">
        <div class="grid-sizer"></div>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="grid-item">
            <?php if( has_post_format( 'quote' ) && thim_meta( 'thim_quote_author_url' ) ) {?>
                <a href="<?php the_permalink();?>" class="post-item-text">
                    <div class="content">
                        “<?php the_title();?>”
                    </div>

                    <div class="line"></div>

                    <div class="name">
                        <?php echo get_post_meta( get_the_ID(), 'thim_quote_author_text', true );?>
                    </div>

                    <div class="star">
                        <i class="ion ion-android-star"></i>
                        <i class="ion ion-android-star"></i>
                        <i class="ion ion-android-star"></i>
                        <i class="ion ion-android-star"></i>
                        <i class="ion ion-android-star"></i>
                    </div>
                </a>
            <?php } elseif ( has_post_format( 'gallery' ) ) {?>
                <?php
                $thumbs = thim_meta( 'thim_gallery', "type=image&single=false&size=full" );
                ?>
                <div class="post-type-gallery js-call-slick-gallery" data-numofshow="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
                    <div class="wrap-arrow-slick">
                        <div class="arow-slick prev-slick">
                            <i class="ion ion-ios-arrow-left"></i>
                        </div>

                        <div class="arow-slick next-slick">
                            <i class="ion ion-ios-arrow-right"></i>
                        </div>
                    </div>
                    <div class="slide-slick">
                        <?php foreach ( $thumbs as $key => $image ) {?>
                            <div class="item-slick">
                                <div class="gallery-item">
                                    <?php
                                    if ( ! empty( $image['url'] ) ) {
                                        echo sprintf(
                                            '<img src="%s" alt="' . esc_attr__( 'Gallery', 'ivy-school' ) . '">',
                                            $thumbs[ $key ]['url']
                                        );
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            <?php } elseif ( has_post_format( 'video' ) ) {?>
                <?php
                $key = rand(100,999);
                $video_key = get_post_meta( get_the_ID(), 'thim_video', false );
                if (strlen(strstr($video_key[0], 'iframe')) > 0) {
                    $html_video = $video_key[0];
                } else {
                    $html_video = '<iframe width="500" height="400" src="'.$video_key[0].'"></iframe>';
                }
                ?>
                <div id="box-video-<?php echo $key;?>" class="mfp-with-anim mfp-hide frame-video-popup"><?php echo $html_video;?></div>
                <div class="post-item <?php echo (has_post_thumbnail()) ? 'text-overlay' : 'text-default';?> ">
                    <div class="pic">
                        <a href="<?php the_permalink();?>"><?php the_post_thumbnail('full');?></a>
                        <div class="overlay"></div>
                        <a href="#box-video-<?php echo $key;?>" class="btn-play-blog" data-id="<?php echo get_the_ID();?>" data-effect="mfp-zoom-in"></a>
                    </div>
                </div>
            <?php } else {?>
            <div class="post-item <?php echo (has_post_thumbnail()) ? 'text-overlay' : 'text-default';?> ">
                <div class="pic">
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('full');?></a>
                    <div class="overlay"></div>
                </div>

                <div class="text">
                    <div class="date">
                        <?php echo get_the_date();?>
                    </div>

                    <h4 class="title">
                        <a href="<?php the_permalink();?>">
                            <?php the_title();?>
                        </a>
                    </h4>

                    <div class="content">
                        <?php echo wp_trim_words( get_the_excerpt(), 12 ); ?>
                    </div>

                    <a href="<?php the_permalink();?>" class="link-readmore">
                        <?php echo esc_html__( 'read more', 'builderpress' );?>
                    </a>
                </div>
            </div>
            <?php }?>
        </div>
        <?php endwhile; ?>
    </div>
</div>