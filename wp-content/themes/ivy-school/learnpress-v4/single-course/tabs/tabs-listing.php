<?php
/**
 * Template for displaying tab nav of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/tabs/tabs.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$tabs = learn_press_get_course_tabs();
?>

<?php foreach ( $tabs as $key => $tab ) { ?>
	<div id="<?php echo esc_attr( $tab['id'] ); ?>" class="row_content_course">
		<?php
		$class = 'course-tab-panel-'.$key;
		if($key == 'reviews'){
			$class ='landing-review';
		}
		?>
		<div class="<?php echo $class; ?>">
			<?php
			if ( 'faqs' == $key ) {
				echo '<h3>' . $tab['title'] . '</h3>';
			}

			if ( is_callable( $tab['callback'] ?? '' ) ) {
				call_user_func( $tab['callback'], $key, $tab );
			} else {
				/**
				 * @since 4.0.0
				 */
				do_action( 'learn-press/course-tab-content', $key, $tab );
			}
			?>
		</div>
	</div>
<?php } ?>

<?php do_action( 'theme_course_extra_boxes' ); ?>
