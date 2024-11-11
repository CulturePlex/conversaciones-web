<?php
/**
 * Template for displaying template gallery images element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/gallery-images/layout-1.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * @var $params array - shortcode params
 */

defined( 'ABSPATH' ) || exit;
$title    = !empty($params['title']) ? $params['title']  : '';
?>
<div class="wrap-element">
    <h3 class="title-gallery">
        <?php echo esc_html($title); ?>
    </h3>
    <?php if ( $params['photos'] ): ?>
        <div class="grid-gallery">
        <?php
            $photo_ids = explode( ',', $params['photos'] );
            foreach ($photo_ids as $get_lists_photo_ids):
            ?>
                <?php $img_id = ! empty( $get_lists_photo_ids) ? (int) $get_lists_photo_ids : ''; ?>
                    <a href="#" class="item-gallery">
                        <?php
                        $thumbnail_id = $img_id ;
                        $size         = apply_filters( 'builder-press/gallery-images/vblog-layout/image-size', '90x90' );
                        builder_press_get_attachment_image( $thumbnail_id, $size );
                        ?>
                    </a>
            <?php endforeach; ?>
        </div>
            <?php
        endif; ?>
</div>