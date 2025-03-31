<?php

namespace LPImportExport\Migration\Helpers;

/**
 * Class Page
 * @package LPImportExport\Migration\Helpers
 */
class Page {
	/**
	 * @return mixed|string|void
	 */
	public static function get_current_page() {
		if ( self::is_migration_tool_page() ) {
			return LP_ADDON_IMPORT_EXPORT_MIGRATION_PAGE;
		} else {
			return apply_filters( 'learnpress-import-export/filter/page/current', '' );
		}
	}


	/**
	 * @return bool
	 */
	public static function is_migration_tool_page(): bool {
		$page = Validation::sanitize_params_submitted( $_GET['page'] ?? '' );
		if ( ! empty( $page ) && 'lp-migration-tool' !== $page ) {
			return false;
		}

//		$tab = Validation::sanitize_params_submitted( $_GET['tab'] ?? '' );
//		if ( ! empty( $tab ) && 'tutor_migration' !== $tab ) {
//			return false;
//		}

		return true;
	}

	/**
	 * @return array|mixed
	 */
	public static function get_current_plugin_by_page_url() {
		$plugins = Config::instance()->get( 'migration-plugin' );

		$page    = Validation::sanitize_params_submitted( $_GET['page'] ?? '' );
		if ( ! empty( $page ) && 'lp-migration-tool' !== $page ) {
			return array();
		}

		$tab = Validation::sanitize_params_submitted( $_GET['tab'] ?? '' );
		if ( empty( $tab ) ) {
			if ( count( $plugins ) ) {
				return array_values($plugins)[0] ?? array();
			} else {
				return array();
			}

		}

		return $plugins[ $tab ] ?? array();
	}
}
