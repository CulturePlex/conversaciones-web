<?php
/**
 * Template for displaying default template Learnpress List Instructors element layout slider 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-instructors/layout-slider 2.php.
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
$title    = $params['title_instructors'];
?>
<div class="wrap-element">
    <h4 class="element-title">
       <?php echo esc_html($title); ?>
    </h4>
    <div class="slide-instructor js-call-slick-col" data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
        <div class="slide-slick">
            <?php foreach ($instructors as $item ) { ?>
                <?php
                    $user = learn_press_get_user($item->ID);
                    $lp_info = get_the_author_meta( 'lp_info', $item->ID );
                ?>
                <div class="item-slick">
                    <div class="instructor-item">
                            <div class="instructor-image">
                                <a href="<?php echo learn_press_user_profile_link($item->ID) ?>"><?php echo $user->get_profile_picture('',480); ?></a>
                            </div>

                        <div class="instructor-text">
                            <div class="info">
                                <a href="<?php echo learn_press_user_profile_link($item->ID) ?>" class="name"><?php echo $user->get_display_name(); ?></a>
                                <span class="line">/</span>
                                <?php if ( isset( $lp_info['major'] ) && $lp_info['major'] ) : ?>
                                    <span class="more-info"><?php echo esc_html( $lp_info['major'] ); ?></span>
                                <?php endif; ?>
                            </div>

                                <div class="content">
                                    <?php echo $user->get_description();?>
                                </div>

                            <div class="socials">
                                <?php if ( isset( $lp_info['facebook'] ) && $lp_info['facebook'] ) : ?>
                                    <a href="<?php echo esc_url($lp_info['facebook']);?>" class="social-item">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if ( isset( $lp_info['twitter'] ) && $lp_info['twitter'] ) : ?>
                                    <a href="<?php echo esc_url($lp_info['twitter']);?>" class="social-item">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( isset( $lp_info['skype'] ) && $lp_info['skype'] ) : ?>
                                    <a href="<?php echo esc_url($lp_info['skype']);?>" class="social-item">
                                        <i class="fa fa-skype"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( isset( $lp_info['google'] ) && $lp_info['google'] ) : ?>
                                    <a href="<?php echo esc_url($lp_info['google']);?>" class="social-item">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if ( isset( $lp_info['instagram'] ) && $lp_info['instagram'] ) : ?>
                                    <a href="<?php echo esc_url($lp_info['instagram']);?>" class="social-item">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if ( isset( $lp_info['linkedin'] ) && $lp_info['linkedin'] ) : ?>
                                    <a href="<?php echo esc_url($lp_info['linkedin']);?>" class="social-item">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if ( isset( $lp_info['youtube'] ) && $lp_info['youtube'] ) : ?>
                                    <a href="<?php echo esc_url($lp_info['youtube']);?>" class="social-item">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick">
                <i class="ion ion-ios-arrow-thin-left"></i>
            </div>

            <div class="arow-slick next-slick">
                <i class="ion ion-ios-arrow-thin-right"></i>
            </div>
        </div>
    </div>
</div>
