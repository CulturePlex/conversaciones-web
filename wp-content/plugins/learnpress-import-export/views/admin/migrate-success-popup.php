<?php
if ( ! isset( $data ) ) {
	return;
}

$current_plugin = $data['current_plugin'];
?>
<div id="lp-migrate-success-popup">
	<div class="bg-overlay"></div>
	<div class="content">
		<a class="remove-popup" href="#">
			<span class="dashicons dashicons-no-alt"></span>
		</a>
		<div class="migrate-result">

		</div>
		<div class="action">
			<a class="button go-to-dashboard"
			   href="<?php echo add_query_arg( array( 'post_type' => LP_COURSE_CPT ), admin_url( 'edit.php' ) );?>"><?php esc_html_e( 'Go To Course Lists', 'learnpress-import-export' ); ?></a>
			<a class="button view-report" href="#"><?php esc_html_e( 'View Report', 'learnpress-import-export' ); ?></a>
		</div>
	</div>
</div>
