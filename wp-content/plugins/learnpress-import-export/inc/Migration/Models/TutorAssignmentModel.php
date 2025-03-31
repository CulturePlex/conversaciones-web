<?php

namespace LPImportExport\Migration\Models;

class TutorAssignmentModel {
	/**
	 * @param int $course_id
	 * @param int $student_id
	 *
	 * @return false|mixed|\stdClass
	 */
	public static function get_assignment( int $course_id, int $student_id ) {
		global $wpdb;
		$course_id  = sanitize_text_field( $course_id );
		$student_id = sanitize_text_field( $student_id );
		$result     = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM {$wpdb->comments} c
				INNER JOIN {$wpdb->posts} ON c.comment_post_ID = ID  AND c.user_id = %d AND c.comment_approved = %s
				WHERE post_parent IN (SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND post_parent = %d AND post_status = %s)
					AND post_type =%s
					AND post_status = %s
			",
				$student_id,
				'submitted',
				LP_ADDON_IMPORT_EXPORT_TUTOR_TOPIC_CPT,
				$course_id,
				'publish',
				LP_ADDON_IMPORT_EXPORT_TUTOR_ASSIGNMENT_CPT,
				'publish'
			)
		);

		return count( $result ) ? $result[0] : false;
	}
}
