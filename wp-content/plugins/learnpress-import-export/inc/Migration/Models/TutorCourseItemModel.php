<?php

namespace LPImportExport\Migration\Models;

class TutorCourseItemModel {
	/**
	 * Lesson, quiz, assignment
	 * @return int
	 */
	public static function get_course_item_total() {
		global $wpdb;
		$sql = $wpdb->prepare(
			"
        SELECT COUNT(*)
        FROM {$wpdb->posts}
        WHERE post_type IN (%s, %s, %s)
        AND post_status =%s",
			LP_ADDON_IMPORT_EXPORT_TUTOR_LESSON_CPT,
			LP_ADDON_IMPORT_EXPORT_TUTOR_QUIZ_CPT,
			LP_ADDON_IMPORT_EXPORT_TUTOR_ASSIGNMENT_CPT,
			'publish'
		);

		$total = $wpdb->get_var( $sql );

		return $total ? intval( $total ) : 0;
	}
}
