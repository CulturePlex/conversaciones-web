<?php

use LPImportExport\Migration\Helpers\SourceAsset;

$source_asset = SourceAsset::getInstance();

return apply_filters(
	'learnpress-import-export/filter/config/scripts',
	array(
		'admin'    => array(
			'register'       => array(
				'learnpress-import-export-global'       => array(
					'src'  => $source_asset->get_asset_admin_file_url( 'js', 'learnpress-import-export-global' ),
					'deps' => array( 'wp-api-fetch' ),
				),
				'lp-migration-tutor'       => array(
					'src'  => $source_asset->get_asset_admin_file_url( 'js', 'lp-migration-tutor' ),
					'deps' => array( 'wp-api-fetch' ),
					'screens'   => array(
						LP_ADDON_IMPORT_EXPORT_MIGRATION_PAGE,
					),
				),
			)
		),
		'frontend' => array(
			'register' => array(
				'learnpress-import-export-global'           => array(
					'src'  => $source_asset->get_asset_frontend_file_url( 'js', 'learnpress-import-export-global' ),
					'deps' => array( 'wp-api-fetch' ),
				)
			),
		),
	),
);
