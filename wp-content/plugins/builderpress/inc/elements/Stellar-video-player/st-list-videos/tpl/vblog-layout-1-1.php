<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-1-1.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

?>
<div class="wrap-element">
    <div class="normal-items">
        <div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post();
                if( taxonomy_exists('type') ) {
                    $type = wp_get_post_terms(get_the_ID(),'type');
                }
                ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="item">
                        <div class="pic">
                            <?php if ( has_post_thumbnail() ) { ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/vblog-layout-1-1/image-size', '270x140' );
                                builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                            </a>
                            <?php } else { ?>
                                <div class="no-thumbnail"></div>
                            <?php } ?>

                            <?php if( !empty($type) ) {?>
                                <div class="labels">
                                    <?php foreach ($type as $item) {
                                        $color = get_term_meta( $item->term_id, 'thim_type_color', true );
                                        ?>
                                        <div class="label"<?php echo ($color) ? ' style="background-color: '.$color.';"' : ''; ?>>
                                            <?php echo $item->name;?>
                                        </div>
                                    <?php }?>
                                </div>
                            <?php }?>
                        </div>

                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>">
                                <?php get_the_title() ? the_title() : the_ID(); ?>
                            </a>
                        </h4>

                        <div class="info">
                            <?php echo get_the_date(); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile;?>
        </div>
    </div>
</div>
