<?php
/**
 * Template for displaying template Our team element layout 3.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/our-team/layout-3.php.
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
$size = apply_filters( 'builder-press/our-team/layout-5/image-size', '270x392' );
?>
<div class="wrap-element">
    <div class="row">
        <?php foreach ( $members as $member ) { ?>
            <?php $avatar_id = ! empty( $member['photo'] ) ? (int) $member['photo'] : ''; ?>
            <div class="col-sm-6 col-md-3">
                <div class="author-item">
                    <div class="pic-author">
                        <?php
                            builder_press_get_attachment_image($avatar_id, $size);
                        ?>
                        <?php if ( ! empty( $member['link'] ) ) { ?>
                            <a href="<?php echo esc_url($member['link']) ?>" class="overlay-author"></a>
                        <?php } ?>
                    </div>

                    <div class="text-author">
                        <h4 class="name-author">
                            <a href="<?php echo esc_url($member['link']) ?>">
                                <?php echo esc_html( $member['name'] ); ?>
                            </a>
                        </h4>

                        <?php if ( ! empty( $member['job'] ) ) { ?>
                            <div class="info-author">
                                <?php echo esc_html( $member['job'] ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
