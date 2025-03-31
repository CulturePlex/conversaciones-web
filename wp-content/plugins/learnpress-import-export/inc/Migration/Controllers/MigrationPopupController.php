<?php

namespace LPImportExport\Migration\Controllers;

use LPImportExport\Migration\Helpers\Page;
use LPImportExport\Migration\Helpers\Template;

class MigrationPopupController {
	public function __construct() {
		add_action( 'learnpress_page_lp-migration-tool', array( $this, 'add_popups' ) );
	}

	/**
	 * @return void
	 */
	public function add_popups() {
		$data = array();
		$page = Page::get_current_plugin_by_page_url();

		if ( ! count( $page ) ) {
			return;
		}

		$data['current_plugin'] = $page;

		$popups = array(
			'before-migrate-popup.php',
			'clear-migrated-data-popup',
			'migrate-success-popup'
		);

		$template = Template::instance();
		foreach ( $popups as $popup ) {
			$template->get_admin_template( $popup, compact( 'data' ) );
		}
	}
}
