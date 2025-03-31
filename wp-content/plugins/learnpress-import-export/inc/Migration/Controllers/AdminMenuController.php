<?php

namespace LPImportExport\Migration\Controllers;

use LPImportExport\Migration\Helpers\Config;
use LPImportExport\Migration\Helpers\General;
use LPImportExport\Migration\Helpers\Page;
use LPImportExport\Migration\Helpers\Template;
use LPImportExport\Migration\Helpers\Tutor;
use LPImportExport\Migration\Models\TutorCourseItemModel;
use LPImportExport\Migration\Models\TutorCourseModel;
use LPImportExport\Migration\Models\TutorSectionModel;

class AdminMenuController {
	private $config;
	private $active_plugins;

	public function __construct() {
		$this->active_plugins = Config::instance()->get( 'migration-plugin' );
		$this->config         = Config::instance()->get( 'migration' );
		add_action( 'admin_menu', array( $this, 'register' ), 9999 );
	}

	/**
	 * @return void
	 */
	public function register() {
		if ( empty( count( $this->active_plugins ) ) ) {
			return;
		}

		add_submenu_page(
			$this->config['parent_slug'],
			$this->config['page_title'],
			$this->config['menu_title'],
			$this->config['capability'],
			$this->config['slug'],
			array( $this, 'migration_tool' )
		);
	}

	/**
	 * @return void
	 */
	public function migration_tool() {
		ob_start();
		$data['plugins']        = $this->active_plugins;
		$current_plugin         = Page::get_current_plugin_by_page_url();
		$data['current_plugin'] = $current_plugin;

		if ( isset( $current_plugin['name'] ) ) {
			$plugin_name     = $current_plugin['name'];
			$migrated_course = get_option( $plugin_name . '_migrated_course', array() );

			$data['migrated_course'] = $migrated_course;
			if ( $current_plugin['name'] === 'tutor' ) {
				$data = array_merge($data, Tutor::get_data());
			}
		}

		Template::instance()->get_admin_template( 'migration.php', compact( 'data' ) );
		echo General::ksesHTML( ob_get_clean() );
	}
}
