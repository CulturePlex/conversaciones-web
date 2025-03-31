<?php

namespace LPImportExport\Migration\Models;

class TutorSectionModel {
	public static function get_section_total() {
		global $wpdb;
		$sql = $wpdb->prepare(
			"
        SELECT COUNT(*)
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status=%s",
			LP_ADDON_IMPORT_EXPORT_TUTOR_TOPIC_CPT,
			     'publish'
		);

		$total = $wpdb->get_var( $sql );

		return $total ? intval( $total ) : 0;
	}
}
