<?php

namespace LPImportExport\Migration\Models;

class LPAssignmentModel {
	public static function create( &$args ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'      => '',
				'status'  => 'publish',
				'title'   => __( 'New Assignment', 'learnpress-assignments' ),
				'content' => '',
				'author'  => learn_press_get_current_user_id(),
			)
		);

		$assignment_args = array(
			'post_type'    => 'lp_assignment',
			'post_status'  => $args['status'],
			'post_title'   => $args['title'],
			'post_content' => $args['content'],
			'post_author'  => $args['author'],
		);

		$assignment_id = wp_insert_post( $assignment_args );

		if ( $assignment_id ) {
			// add default meta for new assignment
			$default_meta = self::get_default_meta();

			if ( is_array( $default_meta ) ) {
				foreach ( $default_meta as $key => $value ) {
					update_post_meta( $assignment_id, '_lp_' . $key, $value );
				}
			}
		}

		return $assignment_id;
	}

	/**
	 * @return array
	 */
	public static function get_default_meta() {
		return array(
			'duration'          => '3 day',
			'passing_grade'     => 5,
			'retake_count'      => 0,
			'mark'              => 10,
			'upload_file_limit' => 2,
			'upload_files'      => 1,
			'file_extension'    => 'jpg,txt,zip,pdf,doc,docx,ppt',
		);
	}
}
