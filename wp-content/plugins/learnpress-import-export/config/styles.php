<?php

use LPImportExport\Migration\Helpers\SourceAsset;

$source_asset = SourceAsset::getInstance();

return apply_filters(
	'learnpress-import-export/filter/config/style',
	array(
		'admin'    => array(
			'learnpress-import-export-admin' => array(
				'src' => $source_asset->get_asset_admin_file_url(
					'css',
					'learnpress-import-export-admin'
				),
			),
		),
		'frontend' => array(
			'learnpress-import-export-global'           => array(
				'src' => $source_asset->get_asset_frontend_file_url(
					'css',
					'learnpress-import-export-global'
				),
			)
		),
	)
);
