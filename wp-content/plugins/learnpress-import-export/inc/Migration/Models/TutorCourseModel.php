<?php

namespace LPImportExport\Migration\Models;

class TutorCourseModel {
	/**
	 * @return int
	 */
	public static function get_course_total() {
		global $wpdb;
		$sql = $wpdb->prepare(
			"
        SELECT COUNT(*)
        FROM {$wpdb->posts}
        WHERE post_type = %s
        AND post_status = %s",
			LP_ADDON_IMPORT_EXPORT_TUTOR_COURSE_CPT,
			'publish'
		);

		$total = $wpdb->get_var( $sql );

		return $total ? intval( $total ) : 0;
	}

	/**
	 * @return int
	 */
	public static function get_process_course_total() {
		global $wpdb;
		$sql = $wpdb->prepare(
			"
        SELECT COUNT(*)
	    FROM {$wpdb->posts}
	    WHERE post_type = %s
	    AND post_status = %s
		",
			LP_ADDON_IMPORT_EXPORT_TUTOR_COURSE_ENROLLED,
			'completed'
		);

		$total = $wpdb->get_var( $sql );

		return $total ? intval( $total ) : 0;
	}
}
