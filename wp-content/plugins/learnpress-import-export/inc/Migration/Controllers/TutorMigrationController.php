<?php

namespace LPImportExport\Migration\Controllers;

use Exception;
use LearnPress\Models\CourseModel;
use LearnPress\Models\CoursePostModel;
use LearnPress\Models\UserItemMeta\UserQuizMetaModel;
use LearnPressAssignment\Models\UserAssignmentModel;
use LP_Background_Single_Course;
use LP_Datetime;
use LP_Quiz;
use LP_Section_DB;
use LP_User_Items_Result_DB;
use LPImportExport\Migration\Helpers\Tutor;
use LPImportExport\Migration\Models\LPAssignmentModel;
use LPImportExport\Migration\Helpers\RestApi;
use LPImportExport\Migration\Models\LPQuestionAnswerModel;
use LPImportExport\Migration\Models\TutorAssignmentModel;
use LPImportExport\Migration\Models\TutorCourseModel;
use LPImportExport\Migration\Models\TutorQuestionModel;
use Tutor\Models\QuizModel;
use TUTOR\Question_Answers_List;
use WP_Query;
use WP_REST_Server;
use LPImportExport\Migration\Helpers\General;
use LearnPress\Models\UserItems\UserItemModel;
use LPImportExport\Migration\Models\TutorQuizModel;
use LP_User_Item_Quiz;

class TutorMigrationController {
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	public function register_rest_routes() {
		register_rest_route(
			RestApi::generate_namespace(),
			'/migrate/tutor',
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'permission_callback' => '__return_true',
					'callback'            => array( $this, 'migrate' ),
				),
			)
		);

		register_rest_route(
			RestApi::generate_namespace(),
			'/delete-migrated-data/tutor',
			array(
				'methods'             => WP_REST_Server::DELETABLE,
				'permission_callback' => '__return_true',
				'callback'            => array( $this, 'delete_migrated_data' ),
			),
		);
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function delete_migrated_data( \WP_REST_Request $request ) {
		$courses  = get_option( 'tutor_migrated_course', array() );
		$sections = get_option( 'tutor_migrated_section', array() );
		$lessons  = get_option( 'tutor_migrated_lesson', array() );

		$quizzes     = get_option( 'tutor_migrated_quiz', array() );
		$assignments = get_option( 'tutor_migrated_assignment', array() );
		$questions   = get_option( 'tutor_migrated_question', array() );

		global $wpdb;
		$wpdb->query( 'START TRANSACTION' );
		try {
			foreach ( $courses as $course ) {
				if ( $course['lp'] ) {
					wp_delete_post( $course['lp'], true );
				}
			}


			foreach ( $sections as $section ) {
				$section_curd = new \LP_Section_CURD( $section['course_id'] );
				$section_curd->delete( $section['id'] );
			}

			foreach ( $lessons as $lesson ) {
				if ( $lesson['lp'] ) {
					wp_delete_post( $lesson['lp'], true );
				}
			}

			foreach ( $quizzes as $quiz ) {
				if ( $quiz['lp'] ) {
					wp_delete_post( $quiz['lp'], true );
				}
			}

			foreach ( $assignments as $assignment ) {
				if ( $assignment['lp'] ) {
					wp_delete_post( $assignment['lp'], true );
				}
			}

			foreach ( $questions as $question ) {
				if ( $question['lp'] ) {
					wp_delete_post( $question['lp'], true );
				}
			}

			delete_option( 'tutor_migrate_user_id' );
			delete_option( 'tutor_migrate_time' );

			delete_option( 'tutor_migrated_course' );
			delete_option( 'tutor_migrated_section' );
			delete_option( 'tutor_migrated_lesson' );
			delete_option( 'tutor_migrated_quiz' );
			delete_option( 'tutor_migrated_assignment' );
			delete_option( 'tutor_migrated_question' );
			delete_option( 'tutor_migrated_process_course_data' );
			$wpdb->query( 'COMMIT' );
		} catch ( Exception $e ) {
			$wpdb->query( 'ROLLBACK' );

			return RestApi::error( esc_html__( 'Clear failed!', 'learnpress-import-export' ) );
		}

		$current_tutor_course_total = TutorCourseModel::get_course_total();
		$data                       = array(
			'tutor_course_total' => $current_tutor_course_total
		);

		return RestApi::success( esc_html__( 'Clear successfully!', 'learnpress-import-export' ), $data );
	}

	/**
	 * @return false|string
	 */
	public function get_migrate_success_html() {
		$migrated_course_total   = Tutor::migrated_course_total();
		$migrated_lesson_total   = Tutor::migrated_lesson_total();
		$migrated_quiz_total     = Tutor::migrated_quiz_total();
		$migrated_question_total = Tutor::migrated_question_total();

		ob_start();
		?>
		<div class="title">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd"
					  d="M8 1.33333C4.3181 1.33333 1.33333 4.3181 1.33333 8C1.33333 11.6819 4.3181 14.6667 8 14.6667C11.6819 14.6667 14.6667 11.6819 14.6667 8C14.6667 4.3181 11.6819 1.33333 8 1.33333ZM0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8Z"
					  fill="#34C759"/>
				<path
					d="M11.0685 5.4759L7.54764 9.62136L5.58892 7.66984C5.37262 7.45166 5.03615 7.4759 4.81985 7.66984C4.60355 7.88802 4.62758 8.22742 4.81985 8.4456L7.01891 10.6153C7.16311 10.7608 7.35538 10.8335 7.54764 10.8335C7.73991 10.8335 7.93218 10.7608 8.07638 10.6153L11.8376 6.2759C12.0539 6.05772 12.0539 5.71833 11.8376 5.50014C11.6213 5.28196 11.2848 5.28196 11.0685 5.4759Z"
					fill="#34C759"/>
			</svg>
			<div class="text">
				<span><?php esc_html_e( 'Migration Successful!', 'learnpress-import-export' ); ?></span>
				<p><?php esc_html_e( 'The migration from Tutor LMS to LearnPress is successfully done.', 'learnpress-import-export' ); ?></p>
			</div>
		</div>
		<ul>
			<li>
				<?php printf( esc_html__( 'Courses Migrated: %s', 'learnpress-import-export' ), $migrated_course_total ); ?>
			</li>
			<li>
				<?php printf( esc_html__( 'Lessons Migrated: %s', 'learnpress-import-export' ), $migrated_lesson_total ); ?>
			</li>
			<li>
				<?php printf( esc_html__( 'Quizzes Migrated: %s', 'learnpress-import-export' ), $migrated_quiz_total ); ?>
			</li>
			<li>
				<?php printf( esc_html__( 'Questions Migrated: %s', 'learnpress-import-export' ), $migrated_question_total ); ?>
			</li>
		</ul>
		<?php

		return ob_get_clean();
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function migrate( \WP_REST_Request $request ) {
		try {
			if ( ! current_user_can( 'administrator' ) ) {
				throw new Exception( __( 'You are not allowed to migrate.', 'learnpress-import-export' ), 403 );
			}

			if ( empty( TutorCourseModel::get_course_total() ) ) {
				throw new Exception( __( 'There are no tutor courses.', 'learnpress-import-export' ), 404 );
			}

			$params         = $request->get_params();
			$migrate_item   = $params['item'] ?? 'course';
			$paged          = $params['paged'] ?? 1;
			$posts_per_page = $params['number'] ?? 10;

			if ( get_option( 'tutor_migrate_time' ) && $migrate_item === 'course' && $paged === 1 ) { // First migrate request
				throw new Exception( __( 'The courses have been migrated.', 'learnpress-import-export' ), 404 );
			}

			if ( empty( $migrate_item ) ) {
				throw new Exception( __( 'Course item is required.', 'learnpress-import-export' ), 400 );
			}

			//Course
			if ( $migrate_item === 'course' ) {
				return $this->migrate_course( $paged, $posts_per_page );
			} else if ( $migrate_item === 'section' ) {
				return $this->migrate_section( $paged, $posts_per_page );
			} else if ( $migrate_item === 'course_item' ) { //Migrate Lesson, quiz, assignment
				return $this->migrate_course_item( $paged, $posts_per_page );
			} else if ( $migrate_item === 'question' ) {
				return $this->migrate_question( $paged, $posts_per_page );
			} else if ( $migrate_item === 'course_process' ) {
				return $this->migrate_course_process( $paged, $posts_per_page );
			}
		} catch ( Exception $e ) {

			return RestApi::error( $e->getMessage(), $e->getCode() );
		}
	}

	/**
	 * @param $paged
	 * @param $posts_per_page
	 *
	 * @return \WP_REST_Response
	 * @throws Exception
	 */
	public function migrate_course( $paged, $posts_per_page ) {
		$lp_course_curd    = new \LP_Course_CURD();
		$tutor_course_args = array(
			'post_type'      => LP_ADDON_IMPORT_EXPORT_TUTOR_COURSE_CPT,
			'paged'          => $paged,
			'posts_per_page' => $posts_per_page,
			'post_status'    => 'publish',
		);

		$query = new WP_Query( $tutor_course_args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$tutor_course_id = get_the_ID();

				$lp_course_id = $this->get_migrated_lp_course( $tutor_course_id )['lp'] ?? '';

				$tutor_course_author_id = get_the_author_meta( 'ID' );

				$tutor_course_title   = get_the_title();
				$tutor_course_content = get_the_content();
				$tutor_course_status  = get_post_status();

				//Course complete status migration
				//Course enrolled

				//Create lp course
				if ( empty( $lp_course_id ) ) {
					$lp_course_args = array(
						'title'   => $tutor_course_title,
						'content' => $tutor_course_content,
						'status'  => $tutor_course_status,
						'author'  => $tutor_course_author_id
					);

					$lp_course_id = $lp_course_curd->create( $lp_course_args );
					$this->add_migrated_course_item( $tutor_course_id, $lp_course_id );
				}

				//Course data
				$this->migrate_course_meta_data( $tutor_course_id, $lp_course_id );
			}

			if ( $paged === 1 ) {
				$this->update_migrate_option();
			}
		}
		$data = array();

		$data['max_page']              = $query->max_num_pages;
		$data['post_count']            = $query->post_count;
		$data['migrated_course_total'] = Tutor::migrated_course_total();

		if ( $query->post_count === $posts_per_page ) {
			$data['next_migrate_item'] = 'question';
			$data['next_page']         = $paged + 1;

			return RestApi::success( esc_html__( 'Migrated course!', 'learnpress-import-export' ), $data );
		}

		$data['next_migrate_item'] = 'section';
		$data['next_page']         = 1;

		return RestApi::success( esc_html__( 'All course migrated!', 'learnpress-import-export' ), $data );
	}

	/**
	 * @param $paged
	 * @param $posts_per_page
	 *
	 * @return \WP_REST_Response
	 */
	public function migrate_section( $paged, $posts_per_page ) {
		//Get tutor topic(section)
		$tutor_topic_args = array(
			'post_type'      => LP_ADDON_IMPORT_EXPORT_TUTOR_TOPIC_CPT,
			'post_status'    => 'publish',
			'posts_per_page' => $posts_per_page,
			'orderby'        => 'menu_order',
			'order'          => 'asc',
			'paged'          => $paged
		);

		$query = new WP_Query( $tutor_topic_args );

		if ( $query->have_posts() ) {
			$section_order = intval( $paged );

			while ( $query->have_posts() ) {
				$query->the_post();
				$tutor_topic_id  = get_the_ID();
				$lp_section_id   = $this->get_migrated_lp_section( $tutor_topic_id )['lp'] ?? '';
				$tutor_course_id = get_post_field( 'post_parent', $tutor_topic_id );
				$tutor_course_id = intval( $tutor_course_id );
				$lp_course_id    = $this->get_migrated_lp_course( $tutor_course_id )['lp'] ?? '';

				if ( empty( $lp_course_id ) ) {
					continue;
				}

				$section_curd = new \LP_Section_CURD( $lp_course_id );
				//Add lp section

				if ( empty( $lp_section_id ) ) {
					$lp_section_args = array(
						'section_course_id'   => $lp_course_id,
						'section_name'        => get_the_title(),
						'section_order'       => $section_order,
						'section_description' => get_the_content(),
					);

					$section       = $section_curd->create( $lp_section_args );
					$lp_section_id = $section['section_id'];

					$this->add_migrated_section_item( $tutor_topic_id, $lp_section_id, intval( $lp_course_id ) );
				}
			}
		}

		$data['max_page']               = $query->max_num_pages;
		$data['post_count']             = $query->post_count;
		$data['migrated_section_total'] = Tutor::migrated_section_total();

		if ( $query->post_count === $posts_per_page ) {
			$data['next_migrate_item'] = 'section';
			$data['next_page']         = $paged + 1;

			return RestApi::success( esc_html__( 'Migrated section!', 'learnpress-import-export' ), $data );
		}

		$data['next_migrate_item'] = 'course_item';
		$data['next_page']         = 1;

		return RestApi::success( esc_html__( 'All section migrated!', 'learnpress-import-export' ), $data );
	}

	/**
	 * @param $paged
	 * @param $posts_per_page
	 *
	 * @return \WP_REST_Response
	 * @throws Exception
	 */
	public function migrate_course_item( $paged, $posts_per_page ) {
		//Get tutor lesson or quiz
		$tutor_item_args = array(
			'post_type'      => array(
				LP_ADDON_IMPORT_EXPORT_TUTOR_LESSON_CPT,
				LP_ADDON_IMPORT_EXPORT_TUTOR_QUIZ_CPT,
				LP_ADDON_IMPORT_EXPORT_TUTOR_ASSIGNMENT_CPT
			),
			'posts_per_page' => $posts_per_page,
			'paged'          => $paged,
			'post_status'    => 'publish',
		);

		$query = new WP_Query( $tutor_item_args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$tutor_item_id        = get_the_ID();
				$tutor_item_post_type = get_post_type();
				$tutor_section_id     = get_post_field( 'post_parent', $tutor_item_id );

				$tutor_section_id = intval( $tutor_section_id );
				$migrated_section = $this->get_migrated_lp_section( $tutor_section_id );
//				if(empty($migrated_section)){
//					var_dump($tutor_section_id);die;
//				}
				$lp_section_id = $migrated_section['lp'] ?? '';
				$lp_course_id  = $migrated_section['course_id'] ?? '';

				if ( empty( $lp_section_id ) || empty( $lp_course_id ) ) {
					continue;
				}

				$section_curd = new \LP_Section_CURD( $lp_course_id );

				if ( $tutor_item_post_type === LP_ADDON_IMPORT_EXPORT_TUTOR_LESSON_CPT ) {
					$migrate_item_type = 'lesson';
					$lp_item_id        = $this->get_migrated_lp_lesson( $tutor_item_id )['lp'] ?? '';
				} else if ( $tutor_item_post_type === LP_ADDON_IMPORT_EXPORT_TUTOR_QUIZ_CPT ) {
					$migrate_item_type = 'quiz';
					$lp_item_id        = $this->get_migrated_lp_quiz( $tutor_item_id )['lp'] ?? '';
				} else {
					$migrate_item_type = 'assignment';
					$lp_item_id        = $this->get_migrated_lp_assignment( $tutor_item_id )['lp'] ?? '';
				}

				$new_item_id = null;
				if ( empty( $lp_item_id ) ) {
					//Add lesson or quiz
					$lp_item_args = array(
						'title'   => get_the_title(),
						'content' => get_the_content(),
						'status'  => get_post_status(),
					);

					if ( in_array( $tutor_item_post_type, array(
						LP_ADDON_IMPORT_EXPORT_TUTOR_LESSON_CPT,
						LP_ADDON_IMPORT_EXPORT_TUTOR_QUIZ_CPT
					) ) ) {
						$lp_item_args['type'] = $tutor_item_post_type === LP_ADDON_IMPORT_EXPORT_TUTOR_LESSON_CPT ? LP_LESSON_CPT : LP_QUIZ_CPT;
						$new_items            = $section_curd->new_item(
							$lp_section_id,
							$lp_item_args
						);

						$new_item = end( $new_items );

						$new_item_id = $new_item['id'] ?? '';

					} else if ( $tutor_item_post_type === LP_ADDON_IMPORT_EXPORT_TUTOR_ASSIGNMENT_CPT ) {
						$new_item_id = LPAssignmentModel::create( $lp_item_args );
						$items       = array(
							array(
								'type' => 'lp_assignment',
								'id'   => $new_item_id
							)
						);

						$section_curd->add_items_section( $lp_section_id, $items );
					}

					if ( $migrate_item_type === 'lesson' ) {
						$this->add_migrated_lesson_item( $tutor_item_id, $new_item_id, $lp_course_id, $lp_section_id );
					} elseif ( $migrate_item_type === 'quiz' ) {
						$this->add_migrated_quiz_item( $tutor_item_id, $new_item_id, $lp_course_id, $lp_section_id );
					} else {
						$this->add_migrated_assignment_item( $tutor_item_id, $new_item_id, $lp_course_id, $lp_section_id );
					}
				}

				//Lesson or quiz meta data
				$lp_course_item_meta = array();

				if ( $tutor_item_post_type === LP_ADDON_IMPORT_EXPORT_TUTOR_LESSON_CPT ) {
					//Preview
					$tutor_lesson_preview = get_post_meta( $tutor_item_id, '_is_preview', true );
					if ( ! empty( $tutor_lesson_preview ) ) {
						$lp_course_item_meta['preview'] = 'yes';
					}
				} else if ( $tutor_item_post_type === LP_ADDON_IMPORT_EXPORT_TUTOR_QUIZ_CPT ) {
					//Duration
					$lp_duration = '10 minute'; // default

					$time_limit = tutor_utils()->get_quiz_option( $tutor_item_id, 'time_limit' );
					if ( isset( $time_limit['time_value'] ) && isset( $time_limit['time_type'] ) ) {
						if ( $time_limit['time_type'] === 'seconds' ) {
							$lp_duration = '1 minute';
						} else {
							$lp_duration = $time_limit['time_value'] . ' ' . rtrim( $time_limit['time_type'], "s" );;
						}
					}

					$lp_course_item_meta['duration'] = $lp_duration;

					//Passing grade
					$tutor_passing_grade                  = tutor_utils()->get_quiz_option( $tutor_item_id, 'passing_grade' );
					$lp_course_item_meta['passing_grade'] = $tutor_passing_grade;

					//Retake count
					$tutor_feedback_mode = tutor_utils()->get_quiz_option( $tutor_item_id, 'feedback_mode' );

					if ( $tutor_feedback_mode === 'retry' ) {
						$tutor_attempts_allowed = tutor_utils()->get_quiz_option( $tutor_item_id, 'attempts_allowed' );
						if ( empty( $tutor_attempts_allowed ) ) {
							$lp_course_item_meta['retake_count'] = - 1;
						} else {
							$lp_course_item_meta['retake_count'] = $tutor_attempts_allowed;
						}
					}
				} else if ( $tutor_item_post_type === LP_ADDON_IMPORT_EXPORT_TUTOR_ASSIGNMENT_CPT ) {  // assignment
					//Attachments
					$tutor_assignment_attachments       = maybe_unserialize( get_post_meta( $tutor_item_id, '_tutor_assignment_attachments', true ) );
					$lp_course_item_meta['attachments'] = $tutor_assignment_attachments;

					//Duration
					$tutor_time_duration = tutor_utils()->get_assignment_option(
						$tutor_item_id,
						'time_duration',
						array(
							'time'  => '',
							'value' => 0,
						)
					);

					$tutor_assignment_duration_value = trim( $tutor_time_duration['value'] );
					$tutor_assignment_duration_time  = trim( $tutor_time_duration['time'] );

					$lp_course_item_meta['duration'] = $tutor_assignment_duration_value . ' ' . rtrim( $tutor_assignment_duration_time, "s" );

					//Mark
					$tutor_total_mark = tutor_utils()->get_assignment_option(
						$tutor_item_id,
						'total_mark',
						0
					);

					$lp_course_item_meta['mark'] = $tutor_total_mark;

					//Passing grade
					$tutor_pass_mark                      = tutor_utils()->get_assignment_option(
						$tutor_item_id,
						'pass_mark',
						0
					);
					$lp_course_item_meta['passing_grade'] = $tutor_pass_mark;

					//Upload file number
					$tutor_upload_files_limit            = tutor_utils()->get_assignment_option(
						$tutor_item_id,
						'upload_files_limit',
						0
					);
					$lp_course_item_meta['upload_files'] = $tutor_upload_files_limit;

					//Upload file number
					$tutor_upload_file_size_limit             = tutor_utils()->get_assignment_option(
						$tutor_item_id,
						'upload_file_size_limit',
						0
					);
					$lp_course_item_meta['upload_file_limit'] = $tutor_upload_file_size_limit;
				}

				//Section item meta data
				if ( $new_item_id && count( $lp_course_item_meta ) ) {
					foreach ( $lp_course_item_meta as $key => $value ) {
						update_post_meta( $new_item_id, '_lp_' . $key, $value );
					}
				}
			}
		}

		$data['max_page']                   = $query->max_num_pages;
		$data['post_count']                 = $query->post_count;
		$data['migrated_course_item_total'] = Tutor::migrated_course_item_total();

		if ( $query->post_count === $posts_per_page ) {
			$data['next_migrate_item'] = 'course_item';
			$data['next_page']         = $paged + 1;

			return RestApi::success( esc_html__( 'Migrated course item!', 'learnpress-import-export' ), $data );
		}

		$data['next_migrate_item'] = 'question';
		$data['next_page']         = 1;

		return RestApi::success( esc_html__( 'All course item migrated!', 'learnpress-import-export' ), $data );
	}

	/**
	 * @param $paged
	 * @param $posts_per_page
	 *
	 * @return \WP_REST_Response
	 */
	public function migrate_question( $paged, $posts_per_page ) {
		global $wpdb;
		$question_curd   = new \LP_Question_CURD();
		$offset          = ( $paged - 1 ) * $posts_per_page;
		$limit           = $posts_per_page;
		$tutor_questions = TutorQuestionModel::get_questions( $offset, $limit );

		if ( count( $tutor_questions ) ) {
			foreach ( $tutor_questions as $tutor_question ) {
				$tutor_question_id    = $tutor_question->question_id;
				$tutor_question_title = $tutor_question->question_title;
				$tutor_question_des   = $tutor_question->question_description;
				$tutor_question_type  = $tutor_question->question_type;
				$tutor_question_mark  = $tutor_question->question_mark;
				$tutor_ans_explain    = $tutor_question->answer_explanation;
				$tutor_quiz_id        = $tutor_question->quiz_id;
				$tutor_question_order = $tutor_question->question_order;

				//Not use, maybe later
//					$tutor_question_settings = maybe_unserialize( $tutor_question->question_settings );

				if ( $tutor_question_type === 'single_choice' ) {
					$lp_question_type = 'single_choice';
				} elseif ( $tutor_question_type === 'multiple_choice' ) {
					$lp_question_type = 'multi_choice';
				} elseif ( $tutor_question_type === 'true_false' ) {
					$lp_question_type = 'true_or_false';
				} elseif ( $tutor_question_type === 'fill_in_the_blank' ) {
					$lp_question_type = 'fill_in_blanks';
				} else {
					continue;
				}

				$lp_question_order = $tutor_question_order;
				$migrated_lp_quiz  = $this->get_migrated_lp_quiz( intval( $tutor_quiz_id ) );

				$lp_quiz_id    = $migrated_lp_quiz['lp'] ?? '';
				$lp_course_id  = $migrated_lp_quiz['course_id'] ?? '';
				$lp_section_id = $migrated_lp_quiz['section_id'] ?? '';

				if ( empty( $lp_quiz_id ) || empty( $lp_course_id ) || empty( $lp_section_id ) ) {
					continue;
				}

				$lp_question_args = array(
					'quiz_id'        => $lp_quiz_id,
					'order'          => $lp_question_order,
					'id'             => '',
					'status'         => 'publish',
					'type'           => $lp_question_type,
					'title'          => $tutor_question_title,
					'content'        => $tutor_question_des,
					'create_answers' => false,
				);

				$question    = $question_curd->create( $lp_question_args );
				$question_id = $question->get_id();
				$this->add_migrated_question_item(
					$tutor_question_id,
					$question_id,
					$lp_course_id,
					$migrated_lp_quiz['section_id'],
					$lp_quiz_id
				);

				//Question meta
				$lp_question_meta = array();
				if ( ! empty( $tutor_question_mark ) ) {
					$lp_question_meta['mark'] = intval( $tutor_question_mark );
				}

				if ( ! empty( $tutor_ans_explain ) ) {
					$lp_question_meta['explanation'] = $tutor_ans_explain;
				}

				foreach ( $lp_question_meta as $key => $value ) {
					update_post_meta( $question_id, '_lp_' . $key, $value );
				}

				//Question answer
				$tutor_question_answers = Question_Answers_List::answer_list_by_question( $tutor_question_id, $tutor_question_type );
				$lp_question_ans_order  = 1;

				$lp_question_answer_meta_data = array();

				foreach ( $tutor_question_answers as $tutor_question_answer ) {
					$tutor_question_answer_id = $tutor_question_answer->answer_id;
					$title                    = $tutor_question_answer->answer_title;
					$answer                   = $tutor_question_answer->answer_two_gap_match;
					$value                    = learn_press_random_value();
					$is_true                  = $tutor_question_answer->is_correct ? 'yes' : 'no';

					if ( $tutor_question_type === 'fill_in_the_blank' ) {
						$blanks = explode( "{dash}", $title );

						$result = '';
						foreach ( $blanks as $index => $blank ) {
							$result .= $blank;

							if ( $index < count( $blanks ) - 1 ) {
								$fill       = explode( "|", $answer );
								$fill_value = trim( $fill[ $index ] );
								$unique_id  = General:: get_unique_id( 12 );
								$result     .= '[fib fill="' . $fill_value . '" id="' . $unique_id . '"]';

								$lp_question_answer_meta_data[ $unique_id ] = array(
									'fill'       => $fill_value,
									'id'         => $unique_id,
									'comparison' => '',
									'match_case' => 0,
									'index'      => $index + 1,
									'open'       => ''
								);
							}
						}

						$value   = '';
						$is_true = '';
						$title   = $result;
					}

					$lp_question_ans_data = array(
						'question_id' => $question_id,
						'title'       => $title,
						'value'       => $value,
						'is_true'     => $is_true,
						'order'       => $lp_question_ans_order,
					);


					$wpdb->insert(
						$wpdb->learnpress_question_answers,
						$lp_question_ans_data,
						array( '%d', '%s', '%s', '%s', '%d' )
					);

					$lp_question_answer_id = $wpdb->insert_id;

					$this->add_migrated_question_answer_item(
						$tutor_question_answer_id,
						$lp_question_answer_id,
						$lp_course_id,
						$lp_section_id,
						$lp_quiz_id,
						$question_id
					);

					if ( $tutor_question_type === 'fill_in_the_blank' ) {
						learn_press_update_question_answer_meta( $lp_question_answer_id, '_blanks', $lp_question_answer_meta_data );
					}

					$lp_question_ans_order ++;
				}
			}
		}

		$post_count = count( $tutor_questions );

		$migrated_question_total = Tutor::migrated_question_total();
		$total_question          = TutorQuestionModel::get_question_total();

		$data['max_page']                = ceil( $total_question / $posts_per_page );
		$data['post_count']              = $post_count;
		$data['migrated_question_total'] = $migrated_question_total;

		if ( $post_count === $posts_per_page ) {
			$data['next_migrate_item'] = 'question';
			$data['next_page']         = $paged + 1;

			return RestApi::success( esc_html__( 'Migrated question!', 'learnpress-import-export' ), $data );
		}

		$migrated_course = Tutor::migrated_course();
		foreach ( $migrated_course as $value ) {
			$lp_course_id = $value ['lp'];
			$bg           = LP_Background_Single_Course::instance();
			$bg->data(
				array(
					'handle_name' => 'save_post',
					'course_id'   => $lp_course_id,
					'data'        => [],
				)
			)->dispatch();
		}

		$data['next_migrate_item'] = 'course_process';
		$data['next_page']         = 1;

		return RestApi::success( esc_html__( 'Migrated all question!', 'learnpress-import-export' ), $data );
	}

	/**
	 * @param $paged
	 * @param $posts_per_page
	 *
	 * @return \WP_REST_Response
	 * @throws Exception
	 */
	public function migrate_course_process( $paged, $posts_per_page ) {
		$tutor_migrated_process_course_data = get_option( 'tutor_migrated_process_course_data', array() );

		//Course enrolled
		$tutor_course_args = array(
			'post_type'      => LP_ADDON_IMPORT_EXPORT_TUTOR_COURSE_ENROLLED,
			'paged'          => $paged,
			'posts_per_page' => $posts_per_page,
			'post_status'    => 'completed',
		);

		$query = new WP_Query( $tutor_course_args );


		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$tutor_course_enrolled_id = get_the_ID();
				$tutor_course_id          = get_post_field( 'post_parent', $tutor_course_enrolled_id );
				$tutor_course_start_time  = get_the_time( 'U' );

				$lp_course_id = $this->get_migrated_lp_course( $tutor_course_id )['lp'];

				if ( empty( $lp_course_id ) ) { // If not migrate course => ignore
					continue;
				}

//				$lp_course = learn_press_get_course( $lp_course_id );

				$tutor_student_id = get_the_author_meta( 'ID' );  // also is lp_course_student id

				$lp_student = learn_press_get_user( $tutor_student_id );
//				$tutor_instructor_id = $lp_instructor_id = get_post_field( 'post_author', $tutor_course_id );

				$course_item_exist = UserItemModel:: find_user_item(
					$tutor_student_id,
					$lp_course_id,
					LP_COURSE_CPT,
					$ref_id = 0,
					$ref_type = 'lp_order',
					false
				);

				//Enrolled course
				$user_course_item_data = array(
					'user_id'    => $tutor_student_id,
					'item_id'    => $lp_course_id,
					'start_time' => gmdate( LP_Datetime::$format, $tutor_course_start_time ),
					'item_type'  => LP_COURSE_CPT,
					'status'     => LP_COURSE_ENROLLED,
					'graduation' => LP_COURSE_GRADUATION_IN_PROGRESS,
					'ref_id'     => 0,
					'ref_type'   => 'lp_order',
					'parent_id'  => 0
				);

				if ( $course_item_exist ) {
					$user_course_item_data['user_item_id'] = $course_item_exist->get_user_item_id();
				}

				$user_course_item = new UserItemModel( $user_course_item_data );
				$user_course_item->save();

				$user_course_item_id = $user_course_item->get_user_item_id();
				//Lesson
				$migrated_lessons = $this->get_lessons_by_lp_course_parent_id( $lp_course_id );

				foreach ( $migrated_lessons as $migrated_lesson ) {
					$tutor_lesson_id           = $migrated_lesson['tutor'];
					$lp_lesson_id              = $migrated_lesson['lp'];
					$tutor_is_completed_lesson = tutor_utils()->is_completed_lesson( $tutor_lesson_id, $tutor_student_id );

					if ( $tutor_is_completed_lesson ) {
						$user_lesson_item_data = array(
							'user_id'    => $tutor_student_id,
							'item_id'    => $lp_lesson_id,
							'start_time' => gmdate( LP_Datetime::$format, get_the_time( 'U', $tutor_lesson_id ) ),
							'end_time'   => gmdate( LP_Datetime::$format, $tutor_course_start_time ),
							'item_type'  => LP_LESSON_CPT,
							'status'     => LP_ITEM_COMPLETED,
							'graduation' => 'passed',
							'ref_id'     => $lp_course_id,
							'ref_type'   => LP_COURSE_CPT,
							'parent_id'  => $user_course_item_id
						);

						$user_lesson_item = new UserItemModel( $user_lesson_item_data );
						$user_lesson_item->save();
					}
				}

				//Quiz
				$migrated_quizzes = $this->get_quizzes_by_lp_course_parent_id( $lp_course_id );

				foreach ( $migrated_quizzes as $migrated_quiz ) {
					$tutor_quiz_id   = $migrated_quiz['tutor'];
					$lp_quiz_id      = $migrated_quiz['lp'];
					$lp_quiz         = LP_Quiz::get_quiz( $lp_quiz_id );
					$lp_question_ids = $lp_quiz->get_question_ids();

					//Quiz Attempt
					$tutor_quiz_attempts      = TutorQuizModel::get_quiz_attempts( $tutor_quiz_id, $tutor_student_id );
					$tutor_quiz_attempt_count = count( $tutor_quiz_attempts );

					if ( $tutor_quiz_attempt_count ) {
//						$tutor_is_started_quiz = TutorQuizModel::is_started_quiz( $tutor_quiz_id, $tutor_student_id );

						$user_quiz_item_data = array(
							'user_id'    => $tutor_student_id,
							'item_id'    => $lp_quiz_id,
							'start_time' => null,
							'end_time'   => null,
							'item_type'  => LP_QUIZ_CPT,
							'status'     => LP_ITEM_STARTED,
							'graduation' => LP_GRADUATION_IN_PROGRESS,
							'ref_id'     => $lp_course_id,
							'ref_type'   => LP_COURSE_CPT,
							'parent_id'  => $user_course_item_id
						);

						$user_quiz_item = new UserItemModel( $user_quiz_item_data );
						$user_quiz_item->save();

						$user_quiz_item_id = $user_quiz_item->get_user_item_id();

						foreach ( $tutor_quiz_attempts as $tutor_quiz_attempt ) {
							$tutor_quiz_is_start   = $tutor_quiz_attempt->attempt_status === 'attempt_started';
							$tutor_quiz_is_end     = $tutor_quiz_attempt->attempt_status === 'attempt_ended';
							$tutor_quiz_attempt_id = $tutor_quiz_attempt->attempt_id;
							$tutor_quiz_start_time = $tutor_quiz_attempt->attempt_started_at ?? null;
							$tutor_quiz_end_time   = $tutor_quiz_attempt->attempt_ended_at ?? null;

							$user_quiz_item->status     = $tutor_quiz_is_start ? LP_ITEM_STARTED : LP_ITEM_COMPLETED;
							$user_quiz_item->start_time = $tutor_quiz_start_time;
							$user_quiz_item->end_time   = $tutor_quiz_end_time;

							if ( $tutor_quiz_is_end ) {
								$tutor_quiz_attempt_answers = QuizModel::get_quiz_answers_by_attempt_id( $tutor_quiz_attempt_id );
								$lp_answered                = array();

								foreach ( $tutor_quiz_attempt_answers as $tutor_quiz_attempt_answer ) {
									$tutor_question_id = $tutor_quiz_attempt_answer->question_id;
									$lp_question_id    = $this->get_migrated_lp_question( $tutor_question_id )['lp'];

									$tutor_given_answer  = maybe_unserialize( $tutor_quiz_attempt_answer->given_answer );
									$tutor_question_type = $tutor_quiz_attempt_answer->question_type;
									if ( $tutor_question_type === 'single_choice' ) {
										if ( is_array( $tutor_given_answer ) && isset( $tutor_given_answer[0] ) ) {
											$tutor_answer_id = $tutor_given_answer[0];
										} else {
											$tutor_answer_id = $tutor_given_answer;
										}
										if ( $tutor_answer_id ) {
											$lp_answer_id = $this->get_migrated_lp_question_answer( $tutor_answer_id )['lp'];
											$lp_answer    = LPQuestionAnswerModel::get_answer_by_answer_id( $lp_answer_id, true );
											if ( $lp_answer ) {
												$lp_answered[ $lp_question_id ] = $lp_answer->value;
											}
										}
									} elseif ( $tutor_question_type === 'multiple_choice' ) {
										if ( is_array( $tutor_given_answer ) && count( $tutor_given_answer ) ) {
											$lp_multi_choice_answered = array();
											foreach ( $tutor_given_answer as $tutor_answer_id ) {
												$lp_answer_id = $this->get_migrated_lp_question_answer( $tutor_answer_id )['lp'];
												$lp_answer    = LPQuestionAnswerModel::get_answer_by_answer_id( $lp_answer_id, true );
												if ( $lp_answer ) {
													$lp_multi_choice_answered[] = $lp_answer->value;
												}
											}
											$lp_answered[ $lp_question_id ] = $lp_multi_choice_answered;
										}
									} elseif ( $tutor_question_type === 'true_false' ) {
										$tutor_answer_id = $tutor_given_answer;
										if ( $tutor_answer_id ) {
											$lp_answer_id = $this->get_migrated_lp_question_answer( $tutor_answer_id )['lp'];
											$lp_answer    = LPQuestionAnswerModel::get_answer_by_answer_id( $lp_answer_id, true );

											if ( $lp_answer ) {
												$lp_answered[ $lp_question_id ] = $lp_answer->value;
											}
										}

									} elseif ( $tutor_question_type === 'fill_in_the_blank' ) {

										if ( is_array( $tutor_given_answer ) && count( $tutor_given_answer ) ) {
											$lp_fill_in_blank_answered = array();

											foreach ( $tutor_given_answer as $key => $tutor_answer_value ) {
												$lp_answer = LPQuestionAnswerModel::get_answer_by_question_id( $lp_question_id, true );
												if ( $lp_answer ) {
													$lp_answer_id   = $lp_answer->question_answer_id;
													$lp_answer_meta = LPQuestionAnswerModel::get_question_answer_meta( $lp_answer_id, '_blanks', true );

													if ( $lp_answer_meta ) {
														$lp_answer_meta = maybe_unserialize( $lp_answer_meta );
														preg_match_all( '/id="([a-f0-9]+)"/', $lp_answer_meta->meta_value, $matches );
														$lp_answer_ids                              = $matches[1] ?? array();
														$lp_answer_id                               = $lp_answer_ids[ $key ];
														$lp_fill_in_blank_answered[ $lp_answer_id ] = $tutor_answer_value;
													}
												}
											}
											$lp_answered[ $lp_question_id ] = $lp_fill_in_blank_answered;
										}
									} else {
										continue;
									}
								}

								$lp_user_quiz = new LP_User_Item_Quiz( $lp_quiz_id );
								$lp_user_quiz->set_start_time( $tutor_quiz_start_time );
								$lp_user_quiz->set_end_time( $tutor_quiz_end_time );
								$result = $lp_user_quiz->calculate_quiz_result( $lp_answered );

								LP_User_Items_Result_DB::instance()->insert( $user_quiz_item_id, wp_json_encode( $result ) );
								$user_quiz_item->graduation = empty( $result['pass'] ) ? 'failed' : 'passed';
							}

							$user_quiz_item->save();
						}

						//Retake quiz
						if ( $tutor_quiz_attempt_count > 1 ) {
							$user_quiz_retaken_new                          = new UserQuizMetaModel();
							$user_quiz_retaken_new->learnpress_user_item_id = $user_quiz_item_id;
							$user_quiz_retaken_new->meta_key                = UserQuizMetaModel::KEY_RETAKEN_COUNT;
							$user_quiz_retaken_new->meta_value              = $tutor_quiz_attempt_count - 1;
							$user_quiz_retaken_new->save();
						}

					}
				}

				//Assignment
				$migrated_assignments = $this->get_assignments_by_lp_course_parent_id( $lp_course_id );
				foreach ( $migrated_assignments as $migrated_assignment ) {
//					$tutor_assignment_id = $migrated_assignment['tutor'];
					$lp_assignment_id = $migrated_assignment['lp'];

					$tutor_assignment = TutorAssignmentModel::get_assignment( $tutor_course_id, $tutor_student_id );
					if ( $tutor_assignment ) {
						$saved_time = gmdate( LP_Datetime::$format, strtotime( $tutor_assignment->comment_date ) );

						$user_assign_item_data = array(
							'user_id'    => $tutor_student_id,
							'item_id'    => $lp_assignment_id,
							'start_time' => $saved_time,
							'end_time'   => '',
							'item_type'  => 'lp_assignment',
							'status'     => 'started',
							'graduation' => null,
							'ref_id'     => $lp_course_id,
							'ref_type'   => LP_COURSE_CPT,
							'parent_id'  => $user_course_item_id
						);

						$tutor_is_completed_assignment = $tutor_assignment->comment_approved === 'submitted';
						if ( $tutor_is_completed_assignment ) {
							$user_assign_item_data['end_time'] = $saved_time;
							$user_assign_item_data['status']   = 'completed';
						}

						$user_assign_item = new UserItemModel( $user_assign_item_data );
						$user_assign_item->save();

						$userAssignmentModel = UserAssignmentModel::find( $user_assign_item->user_id, $lp_course_id, $user_assign_item->item_id, true );
						//Note
						$tutor_assign_content = strip_tags( $tutor_assignment->comment_content );

						$userAssignmentModel->set_meta_value_for_key( $userAssignmentModel::META_KEY_ANSWER_NOTE, $tutor_assign_content, true );
						//Attachments
						$tutor_assign_attachments = get_comment_meta( $tutor_assignment->comment_ID, 'uploaded_attachments', true );
						$tutor_assign_attachments = json_decode( $tutor_assign_attachments );

						$lp_assign_attachments = array();
						if ( ! empty( $tutor_assign_attachments ) && is_array( $tutor_assign_attachments ) ) {
							foreach ( $tutor_assign_attachments as $tutor_assign_attachment ) {
								$file_uploaded                                          = [
									'filename'   => $tutor_assign_attachment->name,
									'file'       => str_replace( ABSPATH, '', $tutor_assign_attachment->url ),
									'url'        => str_replace( get_site_url(), '', $tutor_assign_attachment->url ),
									'type'       => $tutor_assign_attachment->type,
									'size'       => filesize( $tutor_assign_attachment->url ),
									'saved_time' => $saved_time,
								];
								$lp_assign_attachments[ md5( $file_uploaded['file'] ) ] = $file_uploaded;
							}
						}

						$userAssignmentModel->set_meta_value_for_key( $userAssignmentModel::META_KEY_ANSWER_UPLOAD, $lp_assign_attachments, true );
						//Evaluate
						//Mark
						$tutor_assignment_mark = get_comment_meta( $tutor_assignment->comment_ID, 'assignment_mark', true );
						//Note
						$tutor_assignment_note          = get_comment_meta( $tutor_assignment->comment_ID, 'instructor_note', true );
						$tutor_assignment_evaluate_time = get_comment_meta( $tutor_assignment->comment_ID, 'evaluate_time', true );
						if ( $tutor_assignment_evaluate_time ) {
							$userAssignmentModel->set_meta_value_for_key( $userAssignmentModel::META_KEY_MARK, $tutor_assignment_mark, false );
							$userAssignmentModel->set_meta_value_for_key( $userAssignmentModel::META_KEY_INSTRUCTOR_NOTE, $tutor_assignment_note, true );
							$lp_assignment_passing_grade  = get_post_meta( $lp_assignment_id, '_lp_passing_grade', true );
							$user_assign_item->graduation = $tutor_assignment_mark >= $lp_assignment_passing_grade ? 'passed' : 'failed';
							$user_assign_item->status     = 'evaluated';
							$user_assign_item->save();
						}
					}
				}

				//Finish course
				$tutor_is_completed_course = tutor_utils()->is_completed_course( $tutor_course_id, $tutor_student_id, false );

				if ( $tutor_is_completed_course ) {
					$lp_student->finish_course( $lp_course_id );
					$user_course = $lp_student->get_course_data( $lp_course_id );
					$user_course->set_end_time( gmdate( LP_Datetime::$format, strtotime( $tutor_is_completed_course->comment_date ) ) );
				}

				$tutor_migrated_process_course_data[] = array(
					'lp'      => $lp_course_id,
					'tutor'   => $tutor_course_id,
					'user_id' => $tutor_student_id
				);
			}

			update_option( 'tutor_migrated_process_course_data', $tutor_migrated_process_course_data );
		}

		$data                                  = array();
		$data['max_page']                      = $query->max_num_pages;
		$data['post_count']                    = $query->post_count;
		$data['migrated_course_process_total'] = count( get_option( 'tutor_migrated_process_course_data', array() ) );

		if ( $query->post_count === $posts_per_page ) {
			$data['next_migrate_item'] = 'section';
			$data['next_page']         = $paged + 1;

			return RestApi::success( esc_html__( 'Migrated course process!', 'learnpress-import-export' ), $data );
		}

		$data['migrate_success_html'] = $this->get_migrate_success_html();
		$data['next_migrate_item']    = false;
		$data['next_page']            = 1;

		return RestApi::success( esc_html__( 'All data migrated successfully.', 'learnpress-import-export' ), $data );
	}

	/**
	 * @param $tutor_course_id
	 * @param $lp_course_id
	 *
	 * @return void
	 * @throws Exception
	 */
	public function migrate_course_meta_data( $tutor_course_id, $lp_course_id ) {
		//Price
		$tutor_course_product_id = get_post_meta( $tutor_course_id, '_tutor_course_product_id', true );
		if ( $tutor_course_product_id ) {
			$tutor_course_price      = get_post_meta( $tutor_course_product_id, '_regular_price', true );
			$tutor_course_sale_price = get_post_meta( $tutor_course_product_id, '_sale_price', true );
		} else {
			$tutor_course_price      = get_post_meta( $tutor_course_id, 'tutor_course_price', true );
			$tutor_course_sale_price = get_post_meta( $tutor_course_id, 'tutor_course_sale_price', true );
		}

		//Update
		if ( $tutor_course_price ) {
			update_post_meta( $lp_course_id, '_lp_regular_price', $tutor_course_price );
		}

		if ( $tutor_course_sale_price ) {
			update_post_meta( $lp_course_id, '_lp_sale_price', $tutor_course_sale_price );
		}

		//Thumbnail
		$course_thumbnail = get_post_meta( $tutor_course_id, '_thumbnail_id', true );
		if ( ! empty( $course_thumbnail ) ) {
			update_post_meta( $lp_course_id, '_thumbnail_id', $course_thumbnail );
		}

		//Duration
		$tutor_course_duration = get_post_meta( $tutor_course_id, '_course_duration', true );
		if ( ! empty( $tutor_course_duration ) ) {
			$hours                         = $tutor_course_duration['hours'] ?? 0;
			$minutes                       = $tutor_course_duration['minutes'] ?? 0;
			$tutor_course_duration_minutes = $hours * 60 + $minutes;

			update_post_meta( $lp_course_id, '_lp_duration', $this->get_lp_duration( $tutor_course_duration_minutes ) );
		}

		//Level
		$tutor_course_level = get_post_meta( $tutor_course_id, '_tutor_course_level', true );

		if ( $tutor_course_level ) {
			if ( $tutor_course_level === 'all_levels' ) {
				$lp_level = '';
			} else {
				$lp_level = $tutor_course_level;
			}

			update_post_meta( $lp_course_id, '_lp_level', $lp_level );
		}

		//Max students
		$maximum_students = tutor_utils()->get_course_settings( $tutor_course_id, 'maximum_students' );
		if ( $maximum_students ) {
			update_post_meta( $lp_course_id, '_lp_max_students', $maximum_students );
		}

		//Requirements
		$tutor_requirements = get_post_meta( $tutor_course_id, '_tutor_course_requirements', true );
		if ( ! empty( $tutor_requirements ) ) {
			$tutor_requirements = explode( "\n", $tutor_requirements );
			update_post_meta( $lp_course_id, '_lp_requirements', $tutor_requirements );
		}

		//Target audience
		$tutor_target_audience = get_post_meta( $tutor_course_id, '_tutor_course_target_audience', true );
		if ( ! empty( $tutor_target_audience ) ) {
			$tutor_target_audience = explode( "\n", $tutor_target_audience );
			update_post_meta( $lp_course_id, '_lp_target_audiences', $tutor_target_audience );
		}

		//Key features
		$tutor_key_features = get_post_meta( $tutor_course_id, '_tutor_course_benefits', true );
		if ( ! empty( $tutor_key_features ) ) {
			$tutor_key_features = explode( "\n", $tutor_key_features );
			update_post_meta( $lp_course_id, '_lp_key_features', $tutor_key_features );
		}

		$coursePostModel = new CoursePostModel( get_post( $lp_course_id ) );
		$courseModelNew  = new CourseModel( $coursePostModel );
		$courseModelNew->save();
	}

	/**
	 * @param $tutor_duration_minutes
	 *
	 * @return string
	 */
	public function get_lp_duration( $tutor_duration_minutes ) {
		if ( $tutor_duration_minutes % 10080 == 0 ) {  // 1 week = 10080 minutes
			$lp_duration = intdiv( $tutor_duration_minutes, 10080 ) . ' week';
		} else if ( $tutor_duration_minutes % 1440 == 0 ) {  // 1 day = 1440  minutes
			$lp_duration = intdiv( $tutor_duration_minutes, 1440 ) . ' day';
		} else if ( $tutor_duration_minutes % 60 == 0 ) {  // 1 hour = 1440  minutes
			$lp_duration = intdiv( $tutor_duration_minutes, 60 ) . ' hour';
		} else {
			$lp_duration = $tutor_duration_minutes . ' minute';
		}

		return $lp_duration;
	}

	/**
	 * @return void
	 */
	public function update_migrate_option() {
		update_option( 'tutor_migrate_user_id', get_current_user_id() );
		update_option( 'tutor_migrate_time', current_time( 'timestamp' ) );
	}

	/**
	 * @param $course_parent_id
	 *
	 * @return array
	 */
	public function get_lessons_by_lp_course_parent_id( $course_parent_id ) {
		$results               = array();
		$tutor_migrated_lesson = get_option( 'tutor_migrated_lesson', array() );

		foreach ( $tutor_migrated_lesson as $key => $value ) {
			if ( $value['course_id'] === $course_parent_id ) {
				$results[] = $value;
			}
		}

		return array_values( $results );
	}

	/**
	 * @param $course_parent_id
	 *
	 * @return array
	 */
	public function get_quizzes_by_lp_course_parent_id( $course_parent_id ) {
		$results             = array();
		$tutor_migrated_quiz = get_option( 'tutor_migrated_quiz', array() );

		foreach ( $tutor_migrated_quiz as $value ) {
			if ( $value['course_id'] === $course_parent_id ) {
				$results[] = $value;
			}
		}

		return array_values( $results );
	}


	/**
	 * @param $course_parent_id
	 *
	 * @return array
	 */
	public function get_assignments_by_lp_course_parent_id( $course_parent_id ) {
		$results                   = array();
		$tutor_migrated_assignment = get_option( 'tutor_migrated_assignment', array() );

		foreach ( $tutor_migrated_assignment as $value ) {
			if ( $value['course_id'] === $course_parent_id ) {
				$results[] = $value;
			}
		}

		return array_values( $results );
	}

	/**
	 * @param $tutor_item_id
	 * @param $lp_item_id
	 *
	 * @return void
	 */
	public function add_migrated_course_item( $tutor_item_id, $lp_item_id ) {
		$tutor_migrated_course = get_option( 'tutor_migrated_course', array() );

		$tutor_migrated_course[] = array(
			'tutor' => intval( $tutor_item_id ),
			'lp'    => intval( $lp_item_id ),
		);

		update_option( 'tutor_migrated_course', $tutor_migrated_course );
	}

	/**
	 * @param $tutor_course_id
	 *
	 * @return mixed|string
	 */
	public function get_migrated_lp_course( $tutor_course_id ) {
		$tutor_migrated_course = get_option( 'tutor_migrated_course', array() );
		foreach ( $tutor_migrated_course as $value ) {
			if ( $value['tutor'] === intval( $tutor_course_id ) ) {
				return $value;
			}
		}

		return array();
	}

	/**
	 * @param $tutor_section_id
	 * @param $lp_section_id
	 * @param int $lp_course_id
	 *
	 * @return void
	 */
	public function add_migrated_section_item( $tutor_section_id, $lp_section_id, int $lp_course_id = 0 ) {
		$tutor_migrated_section = get_option( 'tutor_migrated_section', array() );

		$tutor_migrated_section[] = array(
			'tutor'     => intval( $tutor_section_id ),
			'lp'        => intval( $lp_section_id ),
			'course_id' => $lp_course_id
		);

		update_option( 'tutor_migrated_section', $tutor_migrated_section );
	}

	/**
	 * @param $tutor_section_id
	 *
	 * @return array|mixed
	 */
	public function get_migrated_lp_section( $tutor_section_id ) {
		$tutor_migrated_section = get_option( 'tutor_migrated_section', array() );
		foreach ( $tutor_migrated_section as $value ) {
			if ( $value['tutor'] === intval( $tutor_section_id ) ) {
				return $value;
			}
		}

		return array();
	}

	/**
	 * @param $tutor_lesson_id
	 * @param $lp_lesson_id
	 * @param int $lp_course_id
	 * @param int $lp_section_id
	 *
	 * @return void
	 */
	public function add_migrated_lesson_item( $tutor_lesson_id, $lp_lesson_id, int $lp_course_id = 0, int $lp_section_id = 0 ) {
		$tutor_migrated_lesson = get_option( 'tutor_migrated_lesson', array() );

		$tutor_migrated_lesson[] = array(
			'tutor'      => intval( $tutor_lesson_id ),
			'lp'         => intval( $lp_lesson_id ),
			'course_id'  => $lp_course_id,
			'section_id' => $lp_section_id
		);

		update_option( 'tutor_migrated_lesson', $tutor_migrated_lesson );
	}

	/**
	 * @param $tutor_lesson_id
	 *
	 * @return mixed|string
	 */
	public function get_migrated_lp_lesson( $tutor_lesson_id ) {
		$tutor_migrated_lesson = get_option( 'tutor_migrated_lesson', array() );
		foreach ( $tutor_migrated_lesson as $value ) {
			if ( $value['tutor'] === intval( $tutor_lesson_id ) ) {
				return $value;
			}
		}

		return array();
	}

	/**
	 * @param $tutor_quiz_id
	 * @param $lp_quiz_id
	 * @param int $lp_course_id
	 * @param int $lp_section_id
	 *
	 * @return void
	 */
	public function add_migrated_quiz_item( $tutor_quiz_id, $lp_quiz_id, int $lp_course_id = 0, int $lp_section_id = 0 ) {
		$tutor_migrated_quiz = get_option( 'tutor_migrated_quiz', array() );

		$tutor_migrated_quiz[] = array(
			'tutor'      => intval( $tutor_quiz_id ),
			'lp'         => intval( $lp_quiz_id ),
			'course_id'  => $lp_course_id,
			'section_id' => $lp_section_id
		);

		update_option( 'tutor_migrated_quiz', $tutor_migrated_quiz );
	}

	/**
	 * @param $tutor_quiz_id
	 *
	 * @return mixed|string
	 */
	public function get_migrated_lp_quiz( $tutor_quiz_id ) {
		$tutor_migrated_quiz = get_option( 'tutor_migrated_quiz', array() );
		foreach ( $tutor_migrated_quiz as $value ) {
			if ( $value['tutor'] === intval( $tutor_quiz_id ) ) {
				return $value;
			}
		}

		return array();
	}

	/**
	 * @param $tutor_assignment_id
	 * @param $lp_assignment_id
	 * @param int $lp_course_id
	 * @param int $lp_section_id
	 *
	 * @return void
	 */
	public function add_migrated_assignment_item( $tutor_assignment_id, $lp_assignment_id, int $lp_course_id = 0, int $lp_section_id = 0 ) {
		$tutor_migrated_assignment = get_option( 'tutor_migrated_assignment', array() );

		$tutor_migrated_assignment[] = array(
			'tutor'      => intval( $tutor_assignment_id ),
			'lp'         => intval( $lp_assignment_id ),
			'course_id'  => $lp_course_id,
			'section_id' => $lp_section_id
		);

		update_option( 'tutor_migrated_assignment', $tutor_migrated_assignment );
	}

	/**
	 * @param $tutor_assignment_id
	 *
	 * @return mixed|string
	 */
	public function get_migrated_lp_assignment( $tutor_assignment_id ) {
		$tutor_migrated_assignment = get_option( 'tutor_migrated_assignment', array() );
		foreach ( $tutor_migrated_assignment as $value ) {
			if ( $value['tutor'] === intval( $tutor_assignment_id ) ) {
				return $value['lp'] ?? '';
			}
		}

		return '';
	}


	/**
	 * @param $tutor_question_id
	 * @param $lp_question_id
	 * @param int $lp_course_id
	 * @param int $lp_section_id
	 * @param int $lp_quiz_id
	 *
	 * @return void
	 */
	public function add_migrated_question_item( $tutor_question_id, $lp_question_id, int $lp_course_id = 0, int $lp_section_id = 0, int $lp_quiz_id = 0 ) {
		$tutor_migrated_question = get_option( 'tutor_migrated_question', array() );

		$tutor_migrated_question[] = array(
			'tutor'      => intval( $tutor_question_id ),
			'lp'         => intval( $lp_question_id ),
			'course_id'  => $lp_course_id,
			'section_id' => $lp_section_id,
			'quiz_id'    => $lp_quiz_id
		);

		update_option( 'tutor_migrated_question', $tutor_migrated_question );
	}

	/**
	 * @param $tutor_question_id
	 *
	 * @return array|mixed
	 */
	public function get_migrated_lp_question( $tutor_question_id ) {
		$tutor_migrated_question = get_option( 'tutor_migrated_question', array() );
		foreach ( $tutor_migrated_question as $value ) {
			if ( $value['tutor'] === intval( $tutor_question_id ) ) {
				return $value;
			}
		}

		return array();
	}

	/**
	 * @param $tutor_question_answer_id
	 * @param $lp_question_answer_id
	 * @param int $lp_course_id
	 * @param int $lp_section_id
	 * @param int $lp_quiz_id
	 * @param int $lp_question_id
	 *
	 * @return void
	 */
	public function add_migrated_question_answer_item(
		$tutor_question_answer_id,
		$lp_question_answer_id,
		int $lp_course_id = 0,
		int $lp_section_id = 0,
		int $lp_quiz_id = 0,
		int $lp_question_id = 0
	) {
		$tutor_migrated_question_answer = get_option( 'tutor_migrated_question_answer', array() );

		$tutor_migrated_question_answer[] = array(
			'tutor'       => intval( $tutor_question_answer_id ),
			'lp'          => intval( $lp_question_answer_id ),
			'course_id'   => $lp_course_id,
			'section_id'  => $lp_section_id,
			'quiz_id'     => $lp_quiz_id,
			'question_id' => $lp_question_id
		);

		update_option( 'tutor_migrated_question_answer', $tutor_migrated_question_answer );
	}

	/**
	 * @param $tutor_question_answer_id
	 *
	 * @return array|mixed
	 */
	public function get_migrated_lp_question_answer( $tutor_question_answer_id ) {
		$tutor_migrated_question = get_option( 'tutor_migrated_question_answer', array() );
		foreach ( $tutor_migrated_question as $value ) {
			if ( $value['tutor'] === intval( $tutor_question_answer_id ) ) {
				return $value;
			}
		}

		return array();
	}
}
