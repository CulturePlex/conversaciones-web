<?php

namespace LPImportExport\Migration\Models;

class TutorQuestionModel {
	public static function get_question_total() {
		global $wpdb;

		$total = $wpdb->get_var( "SELECT COUNT(*)
			FROM {$wpdb->prefix}tutor_quiz_questions" );

		return $total ? intval( $total ) : 0;
	}

	/**
	 * @param $offset
	 * @param $limit
	 *
	 * @return array|object|\stdClass[]|null
	 */
	public static function get_questions($offset, $limit) {
		global $wpdb;
		return $wpdb->get_results($wpdb->prepare(
			"SELECT * FROM {$wpdb->prefix}tutor_quiz_questions LIMIT %d OFFSET %d",
			$limit, $offset
		));
	}
}
