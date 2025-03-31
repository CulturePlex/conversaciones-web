<?php

namespace LPImportExport\Migration\Helpers;

class Plugin {
	public static function is_lp_active() {
		return is_plugin_active( 'learnpress/learnpress.php' );
	}

//	public static function is_lp_assignments_active() {
//		return is_plugin_active( 'learnpress-assignments/learnpress-assignments.php' );
//	}

	public static function is_tutor_active() {
		return is_plugin_active( 'tutor/tutor.php' );
	}
}
