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

$img_size     = explode( ',', $params['img_size'] );

if ( ! empty( $img_size ) && is_array($img_size) ) {
    if ( count($img_size) > 1 ) {
        $arr_sizes = [
            'size-md'  => $img_size[0],
            'size-md2' => $img_size[1],
        ];
    } else {
        $arr_sizes = [
            'size-md'  => $img_size[0],
            'size-md2' => $img_size[0],
        ];
    }
}



$arr_names = [
    'size-md',
    'size-md2',
    'size-md2',
    'size-md',
    'size-md',
    'size-md2',
    'size-md2',
    'size-md',
];

 if ( $params['photos'] ): ?>
    <?php $photo_ids = explode( ',', $params['photos'] ); ?>
    <div class="grid-wrapper row">
        <?php
        $i        = 0;
        foreach ( $photo_ids as $key => $photo ) :
            $size_name = $arr_names[ $i ];
            $size = $arr_sizes[ $size_name ];
            $i ++;
            if ( $i == 14 ) {
                $i = 0;
            }
            $full = wp_get_attachment_image_src( $photo, 'full' );
			if ( isset( $full ) && ! empty( $full ) ) {
				$full = $full[0];
			} else {
				$full = '';
			}

            $img_size = apply_filters( 'builder-press/grid-images/layout-images-slider/default-size', $size );
            ?>
            <div class="grid-item <?php echo esc_attr( $size_name ); ?>">
                <div class="item-inner">
                    <a href="<?php echo esc_attr( $full ); ?>" class="bp-popup-image zoom-image"> <?php builder_press_get_attachment_image( $photo, $img_size ); ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>