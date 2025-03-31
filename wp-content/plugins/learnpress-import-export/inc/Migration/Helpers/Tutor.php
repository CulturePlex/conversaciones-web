<?php

namespace LPImportExport\Migration\Helpers;

use LPImportExport\Migration\Models\TutorCourseItemModel;
use LPImportExport\Migration\Models\TutorCourseModel;
use LPImportExport\Migration\Models\TutorQuestionModel;
use LPImportExport\Migration\Models\TutorSectionModel;

class Tutor {
	public static function migrated_course() {
		return get_option( 'tutor_migrated_course', array() );
	}

	public static function migrated_section() {
		return get_option( 'tutor_migrated_section', array() );
	}

	public static function migrated_lesson() {
		return get_option( 'tutor_migrated_lesson', array() );
	}

	public static function migrated_quiz() {
		return get_option( 'tutor_migrated_quiz', array() );
	}

	public static function migrated_assignment() {
		return get_option( 'tutor_migrated_assignment', array() );
	}

	public static function migrated_question() {
		return get_option( 'tutor_migrated_question', array() );
	}

	public static function migrated_course_total() {
		return count( self::migrated_course() );
	}

	public static function migrated_section_total() {
		return count( self::migrated_section() );
	}

	public static function migrated_lesson_total() {
		return count( self::migrated_lesson() ) ;
	}

	public static function migrated_quiz_total() {
		return count( self::migrated_quiz() ) ;
	}

	public static function migrated_assignment_total() {
		return count( self::migrated_assignment() ) ;
	}

	public static function migrated_course_item_total() {
		return self::migrated_lesson_total() + self::migrated_quiz_total() + self::migrated_assignment_total();
	}

	public static function migrated_question_total() {
		return count( self::migrated_question() );
	}

	/**
	 * @return array
	 */
	public static function get_data() {
		$data                          = array();
		$data['course_total']          = TutorCourseModel::get_course_total();
		$data['migrated_course']       = self::migrated_course();
		$data['migrated_course_total'] = self::migrated_course_total();

		$data['section_total']          = TutorSectionModel::get_section_total();
		$data['migrated_section']       = self::migrated_section();
		$data['migrated_section_total'] = self::migrated_section_total();

		$data['course_item_total']          = TutorCourseItemModel::get_course_item_total();
		$data['migrated_lesson']            = self::migrated_lesson();
		$data['migrated_quiz']              = self::migrated_quiz();
		$data['migrated_assignment']        = self::migrated_assignment();
		$data['migrated_course_item_total'] = self::migrated_course_item_total();

		$data['question_total']          = TutorQuestionModel::get_question_total();
		$data['migrated_question'] = self::migrated_question();
		$data['migrated_question_total'] = self::migrated_question_total();

		$data['tutor_migrate_time']    = get_option( 'tutor_migrate_time', 0 );
		$data['tutor_migrate_user_id'] = get_option( 'tutor_migrate_user_id', 0 );

		$tutor_migrated_process_course_data          = get_option( 'tutor_migrated_process_course_data', array() );
		$data['tutor_migrated_process_course_total'] = count( $tutor_migrated_process_course_data );
		$data['tutor_process_course_total']          = TutorCourseModel::get_process_course_total();

		return $data;
	}
}
