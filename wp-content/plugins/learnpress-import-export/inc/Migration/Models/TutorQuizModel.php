<?php

namespace LPImportExport\Migration\Models;

class TutorQuizModel {
	/**
	 * @param $quiz_id
	 * @param $user_id
	 *
	 * @return array|object|\stdClass|null
	 */
	public static function is_started_quiz( $quiz_id = 0, $user_id = 0 ) {
		global $wpdb;

		return $wpdb->get_row(
			$wpdb->prepare(
				"SELECT *
				FROM 	{$wpdb->prefix}tutor_quiz_attempts
				WHERE 	user_id =  %d
						AND quiz_id = %d
						AND attempt_status = %s;
				",
				$user_id,
				$quiz_id,
				'attempt_started'
			)
		);
	}

	/**
	 * @param $quiz_id
	 * @param $user_id
	 *
	 * @return array|object|\stdClass|null
	 */
	public static function is_ended_quiz( $quiz_id = 0, $user_id = 0 ) {
		global $wpdb;

		return $wpdb->get_row(
			$wpdb->prepare(
				"SELECT *
				FROM 	{$wpdb->prefix}tutor_quiz_attempts
				WHERE 	user_id =  %d
						AND quiz_id = %d
						AND attempt_status = %s;
				",
				$user_id,
				$quiz_id,
				'attempt_ended'
			)
		);
	}

	/**
	 * @param $quiz_id
	 * @param $user_id
	 *
	 * @return array|object|\stdClass[]|null
	 */
	public static function get_quiz_attempts($quiz_id, $user_id) {
		global $wpdb;
		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT *
				FROM 	{$wpdb->prefix}tutor_quiz_attempts
				WHERE 	quiz_id = %d
						AND user_id = %d
						ORDER BY attempt_id  DESC
				",
				$quiz_id,
				$user_id
			)
		);
	}

	/**
	 * @param $quiz_attempt_id
	 *
	 * @return array|object|\stdClass[]|null
	 */
	public static function get_quiz_attempt_answers($quiz_attempt_id) {
		global $wpdb;
		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT *
				FROM 	{$wpdb->prefix}tutor_quiz_attempt_answers
				WHERE 	quiz_attempt_id = %d
						ORDER BY attempt_answer_id  DESC
				",
				$quiz_attempt_id,
			)
		);
	}
}
