<?php
$course_cpt = defined( 'LP_COURSE_CPT' ) ? LP_COURSE_CPT : 'lp_course';

return apply_filters(
	'learnpress-import-export/filter/config/migration',
	array(
		'page_title'  => esc_html__( 'Migration Tool', 'learnpress-import-export' ),
		'menu_title'  => esc_html__( 'Migration Tool', 'learnpress-import-export' ),
		'parent_slug' => 'learn_press',
		'slug'        => 'lp-migration-tool',
		'capability'  => 'administrator',
		'name'        => 'lp-migration-tool',
	)
);
