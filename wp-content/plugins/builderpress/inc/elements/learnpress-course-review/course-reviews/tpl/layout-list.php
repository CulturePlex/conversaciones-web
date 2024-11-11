<?php
/**
 * Template for displaying default template Learnpress Course Reviews element layout list.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/course-reviews/layout-list.php.
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
 * @var $reviews
 */
foreach ( $reviews as $key => $review ) { ?>
    <div class="bl-comment">
        <div class="comment-item">
			<?php $course_rate = $review->rate;
			$non_star          = 5 - intval( $course_rate ); ?>

            <div class="star">
				<?php for ( $i = 0; $i < intval( $course_rate ); $i ++ ) { ?>
                    <i class="fa fa-star"></i>
				<?php } ?>
				<?php for ( $j = 0; $j < intval( $non_star ); $j ++ ) { ?>
                    <i class="fa fa-star-o"></i>
				<?php } ?>
            </div>

            <div class="name"><?php echo $review->user_login; ?></div>

            <p class="content"><?php echo $review->content; ?></p>
        </div>
    </div>
<?php }