<?php

namespace LPImportExport\Migration\Models;

class LPQuestionAnswerModel {
	/**
	 * @param $question_answer_id
	 * @param bool $only_first
	 *
	 * @return array|mixed|object|\stdClass|\stdClass[]|null
	 */
	public static function get_answer_by_answer_id( $question_answer_id , bool $only_first = false) {
		global $wpdb;
		$sql = $wpdb->prepare(
			"SELECT * FROM $wpdb->learnpress_question_answers WHERE question_answer_id = %d
                        ",
			intval($question_answer_id)
		);

		$result = $wpdb->get_results( $sql );
		return $only_first ? $result[0] : $result;
	}

	/**
	 * @param $question_id
	 * @param bool $only_first
	 *
	 * @return array|mixed|object|\stdClass|\stdClass[]|null
	 */
	public static function get_answer_by_question_id( $question_id, bool $only_first = false) {
		global $wpdb;
		$sql = $wpdb->prepare(
			"SELECT * FROM $wpdb->learnpress_question_answers WHERE question_id = %d",
			intval($question_id)
		);

		$result = $wpdb->get_results( $sql );
		return $only_first ? $result[0] : $result;
	}

	/**
	 * @param $question_answer_id
	 * @param $meta_key
	 * @param $only_first
	 *
	 * @return array|mixed|object|\stdClass|\stdClass[]|null
	 */
	public static function get_question_answer_meta( $question_answer_id, $meta_key, bool $only_first = false ) {
		global $wpdb;
		$sql = $wpdb->prepare(
			"SELECT * FROM $wpdb->learnpress_question_answermeta WHERE learnpress_question_answer_id = %d
                        AND meta_key=%s",
			intval($question_answer_id),
			$meta_key
		);

		$result = $wpdb->get_results( $sql );
		return $only_first ? $result[0] : $result;
	}
}
