<?php
/**
 * Template for displaying default template Learnpress List Instructors element layout grid.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-instructors/layout-grid.php.
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

?>

    <div class="list">
        <?php foreach ( $instructors as $item ) { ?>
            <?php
            $user = learn_press_get_user( $item->ID );
            $lp_info    = get_the_author_meta( 'lp_info', $item->ID );
            ?>
            <div class="item">
                <div class="pic">
                    <a href="<?php echo learn_press_user_profile_link($item->ID) ?>"><?php echo $user->get_profile_picture( '', 147 ); ?></a>
                </div>

                <div class="content">
                    <p class="para">
                        <?php echo $user->get_description();?>
                    </p>

                    <div class="info">
                        <span class="name"><?php echo $user->get_display_name(); ?>,</span> <?php echo esc_html( $lp_info['major'] ); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>