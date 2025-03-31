<?php

use LPImportExport\Migration\Helpers\Plugin;

$is_tutor_active = Plugin::is_tutor_active();
$config_data     = array();

if ( $is_tutor_active ) {
	$config_data['tutor'] = array(
		'title' => esc_html__( 'Tutor LMS', 'learnpress-import-export' ),
		'name'  => 'tutor',
		'icon'  => LP_ADDON_IMPORT_EXPORT_ASSETS_URL . '/images/tutor-128x128.jpg',
		'url'   => add_query_arg(
			array(
				'page' => 'lp-migration-tool',
				'tab'  => 'tutor'
			),
			admin_url( 'admin.php' )
		),
		'desc'  => esc_html__( 'Migrate the Tutor data to LearnPress with the LearnPress Migration Tool.', 'learnpress-import-export' )
	);
}

return apply_filters(
	'learnpress-import-export/filter/config/migration-plugin',
	$config_data
);
