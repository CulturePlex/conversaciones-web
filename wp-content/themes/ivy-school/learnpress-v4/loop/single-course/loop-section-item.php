<?php
/**
 * Template for displaying curriculum tab of single course.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.1.5
 */

defined( 'ABSPATH' ) || exit();

// PARAM: section_item, course_item, can_view_item, user, course_id is required.

/**
 * @var LP_Model_User_Can_View_Course_Item $can_view_item
 * @var LP_Course_Item $course_item
 */
if ( empty( $section_item ) || empty( $course_item ) || empty( $can_view_item ) || empty( $course_id ) ) {
	return;
}
$post_type = str_replace( 'lp_', '', $course_item->get_post_type() );
$course    = learn_press_get_course( $course_id );
if ( ! $course ) {
	return;
}

$section_id = LP_Section_DB::getInstance()->get_section_id_by_item_id( $section_item['ID'] );
$section    = $course->get_sections( 'object', $section_id );
if ( ! $section instanceof LP_Course_Section ) {
	return;
}

/**
 * List items of section
 *
 * @var LP_Course_Item[]
 */
$items = $section->get_items();


?>

<li class="<?php echo esc_attr( implode( ' ', $course_item->get_class_v2( $course_id, $section_item['ID'], $can_view_item ) ) ); ?> "
    data-id="<?php echo esc_attr( $section_item['ID'] ); ?>">
    <div class="meta-left">
        <?php echo $section->get_position() . '.' . $key; ?>
        <?php do_action( 'learn_press_before_section_item_title', $course_item, $section_item, $course ); ?>
    </div>
    <a class="section-item-link" href="<?php echo esc_url_raw( $course_item->get_permalink() ); ?>">
        <span class="item-name"><?php echo esc_html( $section_item['post_title'] ); ?></span>
    </a>
    <div class="course-item-meta">
        <?php do_action( 'learn-press/course-section-item/before-' . $course_item->get_item_type() . '-meta', $course_item ); ?>
        <span class="item-meta course-item-status"
            title="<?php echo esc_attr( $course_item->get_status_title() ); ?>"></span>

        <?php do_action( 'learn-press/course-section-item/after-' . $course_item->get_item_type() . '-meta', $course_item ); ?>
    </div>

</li>