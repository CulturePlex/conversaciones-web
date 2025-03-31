<?php

namespace LPImportExport\Migration\Controllers;

use LPImportExport\Migration\Helpers\Debug;
use LPImportExport\Migration\Helpers\Page;
use LPImportExport\Migration\Helpers\Config;
use LPImportExport\Migration\Helpers\RestApi;
use LPImportExport\Migration\Models\TutorCourseItemModel;
use LPImportExport\Migration\Models\TutorCourseModel;
use LPImportExport\Migration\Models\TutorQuestionModel;
use LPImportExport\Migration\Models\TutorSectionModel;
use LPImportExport\Migration\Helpers\Plugin;

class EnqueueScriptsController {

	/**
	 * @var mixed|string
	 */
	private $version_assets = LP_ADDON_IMPORT_EXPORT_VER;

	/**
	 * EnqueueScripts constructor.
	 */
	public function __construct() {
		if ( Debug::is_debug() ) {
			$this->version_assets = uniqid();
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
	}

	/**
	 * @param $args
	 *
	 * @return mixed|void
	 */
	public function can_load_asset( $args ) {
		$current_page = Page::get_current_page();
		$can_load     = false;

		if ( ! empty( $args['screens'] ) ) {
			if ( in_array( $current_page, $args['screens'] ) ) {
				$can_load = true;
			}
		} elseif ( ! empty( $args['exclude_screens'] ) ) {
			if ( ! in_array( $current_page, $args['exclude_screens'] ) ) {
				$can_load = true;
			}
		} else {
			$can_load = true;
		}

		$is_on = 'admin';
		if ( ! is_admin() ) {
			$is_on = 'frontend';
		}

		return apply_filters(
			'learnpress-import-export/filter/' . $is_on . '/can-load-assets/' . $args['type'] . '/' . $args['handle'],
			$can_load,
			$current_page,
			$args['screens']
		);
	}

	/**
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		$styles = Config::instance()->get( 'styles:admin' );

		$this->enqueue_css( $styles );
		$scripts          = Config::instance()->get( 'scripts:admin' );
		$register_scripts = $scripts['register'];

		$this->enqueue_js( $register_scripts );
		$this->localize_admin_script();
	}

	/**
	 * @return void
	 */
	public function wp_enqueue_scripts() {
		$styles = Config::instance()->get( 'styles:frontend' );
		$this->enqueue_css( $styles );
		$scripts          = Config::instance()->get( 'scripts:frontend' );
		$register_scripts = $scripts['register'];
		$this->enqueue_js( $register_scripts );
	}

	/**
	 * @return void
	 */
	public function localize_admin_script() {
		$scripts = array(
			'rest_namespace' => RestApi::generate_namespace(),
			'siteurl'        => site_url(),
		);

		if ( Plugin::is_tutor_active() ) {
			$scripts = array_merge(
				$scripts,
				array(
					'tutor_course_total'         => TutorCourseModel::get_course_total(),
					'tutor_section_total'        => TutorSectionModel::get_section_total(),
					'tutor_course_item_total'    => TutorCourseItemModel::get_course_item_total(),
					'tutor_question_total'       => TutorQuestionModel::get_question_total(),
					'tutor_course_process_total' => TutorCourseModel::get_process_course_total(),
				)
			);
		}

		wp_localize_script(
			'learnpress-import-export-global',
			'LP_ADDON_IMPORT_EXPORT_GLOBAL_OBJECT',
			$scripts
		);

		wp_localize_script(
			'learnpress-import-export-global',
			'LP_ADDON_IMPORT_EXPORT_TRANSLATION_OBJECT',
			array(
				'updating_status' => esc_html__( 'Migrating!', 'learnpress-import-export' ),
				'success_status'  => esc_html__( 'Success!', 'learnpress-import-export' ),
			)
		);
	}

	/**
	 * @param $styles
	 *
	 * @return void
	 */
	public function enqueue_css( $styles ) {
		foreach ( $styles as $handle => $args ) {
			wp_register_style(
				$handle,
				$args['src'] ?? '',
				$args['deps'] ?? array(),
				$this->version_assets,
				'all'
			);

			$can_load_asset = $this->can_load_asset(
				array(
					'handle'          => $handle,
					'screens'         => $args['screens'] ?? array(),
					'exclude_screens' => $args['exclude_screens'] ?? array(),
					'type'            => 'css',
				)
			);

			if ( $can_load_asset ) {
				wp_enqueue_style( $handle );
			}
		}
	}

	/**
	 * @param $register_scripts
	 *
	 * @return void
	 */
	public function enqueue_js( $register_scripts ) {
		foreach ( $register_scripts as $handle => $args ) {
			if ( isset( $args['condition'] ) && $args['condition'] === false ) {
				continue;
			}

			wp_register_script(
				$handle,
				$args['src'],
				$args['deps'] ?? array(),
				$this->version_assets,
				$args['in_footer'] ?? true
			);

			$can_load_asset = $this->can_load_asset(
				array(
					'handle'          => $handle,
					'screens'         => $args['screens'] ?? array(),
					'exclude_screens' => $args['exclude_screens'] ?? array(),
					'type'            => 'js',
				)
			);

			if ( $can_load_asset ) {
				wp_enqueue_script( $handle );
			}
		}
	}
}
