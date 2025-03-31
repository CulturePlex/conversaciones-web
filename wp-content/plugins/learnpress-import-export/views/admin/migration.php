<?php
if ( ! isset( $data['plugins'] ) || empty( count( $data['plugins'] ) ) ) {
	return;
}

use LPImportExport\Migration\Helpers\Template;

$template = Template::instance();

$plugins        = $data['plugins'];
$current_plugin = $data['current_plugin'];
$plugin_name    = $current_plugin['name'] ?? '';

$user_id   = $data['tutor_migrate_user_id'] ?? 0;
$user      = get_user_by( 'id', $user_id );
$timestamp = $data['tutor_migrate_time'] ?? 0;

$migrated_course_total = $data['migrated_course_total'] ?? 0;
$course_total          = $data['course_total'] ?? 0;

$migrated_section_total = $data['migrated_section_total'] ?? 0;
$section_total          = $data['section_total'] ?? 0;

$migrated_course_item_total = $data['migrated_course_item_total'] ?? 0;
$course_item_total          = $data['course_item_total'] ?? 0;

$migrated_question_total = $data['migrated_question_total'] ?? 0;
$question_total          = $data['question_total'] ?? 0;

$tutor_migrated_process_course_total = $data['tutor_migrated_process_course_total'] ?? 0;
$tutor_process_course_total          = $data['tutor_process_course_total'] ?? 0;

?>

<h2 class="nav-tab-wrapper lp-nav-tab-wrapper">
	<?php
	foreach ( $plugins as $plugin ) {
		?>
		<a href="<?php echo esc_url( $plugin['url'] ) ?>"
		   class="nav-tab nav-tab-active"><?php echo esc_html( $plugin['title'] ); ?></a>
		<?php
	}
	?>
</h2>

<div class="lp-migration-wrapper <?php echo esc_attr( $timestamp ? 'migrated' : '' ); ?>">
	<?php
	$template->get_admin_template( 'migration/header.php', compact( 'data' ) );
	?>
	<div class="content <?php echo esc_attr( $current_plugin['name'] ); ?>">
		<div class="migrate-item-list">
			<div class="course migrate-item">
				<?php
				$template->get_admin_template( 'migration/check-icon.php', compact( 'data' ) );
				?>
				<div class="migrate-item-desc">
					<label><?php esc_html_e( 'Courses Data', 'learnpress-import-export' ); ?></label>
					<p>
						<?php esc_html_e( 'Migrate courses into LearnPress.', 'learnpress-import-export' ); ?>
					</p>
					<div class="progress">
						<div class="progress-bar-container">
							<?php
							$percentage = 0;
							if ( $course_total ) {
								if ( $migrated_course_total > $course_total ) {
									$percentage = 100;
								} else {
									$percentage = round( ( $migrated_course_total / $course_total ) * 100, 2 );
								}
							}
							?>
							<div class="progress-bar" style="width:<?php echo esc_attr( $percentage ); ?>%"></div>
						</div>
						<div class="ratio-num">
							<span class="migrated-course-total"><?php echo esc_html( $migrated_course_total ) ?></span>/<span
								class="course-total"><?php echo esc_html( $course_total ); ?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="section migrate-item">
				<?php
				$template->get_admin_template( 'migration/check-icon.php', compact( 'data' ) );
				?>
				<div class="migrate-item-desc">
					<label><?php esc_html_e( 'Sections Data', 'learnpress-import-export' ); ?></label>
					<p>
						<?php esc_html_e( 'Migrate sections into LearnPress.', 'learnpress-import-export' ); ?>
					</p>
					<div class="progress">
						<div class="progress-bar-container">
							<?php
							$percentage = 0;
							if ( $section_total ) {
								if ( $migrated_section_total > $section_total ) {
									$percentage = 100;
								} else {
									$percentage = round( ( $migrated_section_total / $section_total ) * 100, 2 );
								}
							}
							?>
							<div class="progress-bar" style="width:<?php echo esc_attr( $percentage ); ?>%"></div>
						</div>
						<div class="ratio-num">
							<span
								class="migrated-section-total"><?php echo esc_html( $migrated_section_total ) ?></span>/<span
								class="section-total"><?php echo esc_html( $section_total ); ?></span>
						</div>
					</div>
				</div>
			</div>

			<div class="course-item migrate-item">
				<?php
				$template->get_admin_template( 'migration/check-icon.php', compact( 'data' ) );
				?>
				<div class="migrate-item-desc">
					<label><?php esc_html_e( 'Course Items Data', 'learnpress-import-export' ); ?></label>
					<p>
						<?php esc_html_e( 'Migrate lessons, quizzes and assignments into LearnPress.', 'learnpress-import-export' ); ?>
					</p>
					<div class="progress">
						<div class="progress-bar-container">
							<?php
							$percentage = 0;
							if ( $course_item_total ) {
								if ( $migrated_course_item_total > $course_item_total ) {
									$percentage = 100;
								} else {
									$percentage = round( ( $migrated_course_item_total / $course_item_total ) * 100, 2 );
								}
							}
							?>
							<div class="progress-bar" style="width:<?php echo esc_attr( $percentage ); ?>%"></div>
						</div>
						<div class="ratio-num">
							<span
								class="migrated-course-item-total"><?php echo esc_html( $migrated_course_item_total ) ?></span>/<span
								class="course-item-total"><?php echo esc_html( $course_item_total ); ?></span>
						</div>
					</div>
				</div>
			</div>

			<div class="question migrate-item">
				<?php
				$template->get_admin_template( 'migration/check-icon.php', compact( 'data' ) );
				?>
				<div class="migrate-item-desc">
					<label><?php esc_html_e( 'Questions Data', 'learnpress-import-export' ); ?></label>
					<p>
						<?php esc_html_e( 'Migrate questions into LearnPress.', 'learnpress-import-export' ); ?>
					</p>
					<div class="progress">
						<div class="progress-bar-container">
							<?php
							$percentage = 0;
							if ( $question_total ) {
								if ( $migrated_question_total > $question_total ) {
									$percentage = 100;
								} else {
									$percentage = round( ( $migrated_question_total / $question_total ) * 100, 2 );
								}
							}
							?>
							<div class="progress-bar" style="width:<?php echo esc_attr( $percentage ); ?>%"></div>
						</div>
						<div class="ratio-num">
							<span
								class="migrated-question-total"><?php echo esc_html( $migrated_question_total ) ?></span>/<span
								class="question-total"><?php echo esc_html( $question_total ); ?></span>
						</div>
					</div>
				</div>
			</div>

			<div class="course-process migrate-item">
				<?php
				$template->get_admin_template( 'migration/check-icon.php', compact( 'data' ) );
				?>
				<div class="migrate-item-desc">
					<label><?php esc_html_e( 'User Learning Progress Data', 'learnpress-import-export' ); ?></label>
					<p>
						<?php esc_html_e( 'Migrate user learning progress.', 'learnpress-import-export' ); ?>
					</p>
					<div class="progress">
						<div class="progress-bar-container">
							<?php
							$percentage = 0;
							if ( $tutor_process_course_total ) {
								if ( $tutor_migrated_process_course_total > $tutor_process_course_total ) {
									$percentage = 100;
								} else {
									$percentage = round( ( $tutor_migrated_process_course_total / $tutor_process_course_total ) * 100, 2 );
								}
							}
							?>
							<div class="progress-bar" style="width:<?php echo esc_attr( $percentage ); ?>%"></div>
						</div>
						<div class="ratio-num">
							<span
								class="migrated-process-course-total"><?php echo esc_html( $tutor_migrated_process_course_total ); ?></span>/<span
								class="process-course-total"><?php echo esc_html( $tutor_process_course_total ); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="status">
		</div>
		<div class="content-footer">
			<p class="desc">
				<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd"
						  d="M7.0188 2.02206C7.31832 1.85342 7.65626 1.76483 7.99999 1.76483C8.34373 1.76483 8.68166 1.85342 8.98119 2.02206C9.28071 2.19069 9.53172 2.43368 9.70999 2.72758L9.71191 2.73074L15.3586 12.1574L15.364 12.1666C15.5386 12.469 15.631 12.8119 15.632 13.1611C15.633 13.5104 15.5425 13.8538 15.3696 14.1571C15.1966 14.4605 14.9473 14.7134 14.6463 14.8905C14.3453 15.0676 14.0032 15.1628 13.654 15.1666L13.6467 15.1667L2.346 15.1667C1.9968 15.1628 1.65469 15.0676 1.35371 14.8905C1.05272 14.7134 0.803362 14.4605 0.630426 14.1571C0.457491 13.8538 0.367011 13.5104 0.367989 13.1611C0.368967 12.8119 0.461368 12.469 0.636 12.1666L0.641415 12.1574L6.28998 2.72757C6.46826 2.43368 6.71927 2.19069 7.0188 2.02206ZM7.99999 3.09816C7.88542 3.09816 7.77277 3.1277 7.67293 3.18391C7.57354 3.23987 7.49017 3.32038 7.4308 3.41775L1.78845 12.8372C1.73167 12.9371 1.70164 13.0499 1.70132 13.1649C1.70099 13.2813 1.73115 13.3957 1.7888 13.4969C1.84644 13.598 1.92956 13.6823 2.02989 13.7413C2.12934 13.7998 2.24226 13.8315 2.35759 13.8333H13.6424C13.7577 13.8315 13.8706 13.7998 13.9701 13.7413C14.0704 13.6823 14.1535 13.598 14.2112 13.4969C14.2688 13.3957 14.299 13.2813 14.2987 13.1649C14.2983 13.05 14.2683 12.9371 14.2116 12.8372L8.56999 3.41908C8.56973 3.41864 8.56946 3.41819 8.56919 3.41775C8.50981 3.32038 8.42645 3.23987 8.32706 3.18391C8.22722 3.1277 8.11457 3.09816 7.99999 3.09816Z"
						  fill="#FF9500"/>
					<path fill-rule="evenodd" clip-rule="evenodd"
						  d="M7.99998 5.83331C8.36817 5.83331 8.66665 6.13179 8.66665 6.49998V9.16665C8.66665 9.53484 8.36817 9.83331 7.99998 9.83331C7.63179 9.83331 7.33331 9.53484 7.33331 9.16665V6.49998C7.33331 6.13179 7.63179 5.83331 7.99998 5.83331Z"
						  fill="#FF9500"/>
					<path fill-rule="evenodd" clip-rule="evenodd"
						  d="M7.33331 11.8334C7.33331 11.4652 7.63179 11.1667 7.99998 11.1667H8.00665C8.37484 11.1667 8.67331 11.4652 8.67331 11.8334C8.67331 12.2015 8.37484 12.5 8.00665 12.5H7.99998C7.63179 12.5 7.33331 12.2015 7.33331 11.8334Z"
						  fill="#FF9500"/>
				</svg>
				<span><?php esc_html_e( 'Don\'t worry, your TutorLMS data will stay safe during the migration.', 'learnpress-import-export' ); ?></span>
			</p>
			<div class="action">
				<button id="lp-auto-migrate-btn"
						class="button <?php echo esc_attr( $current_plugin['name'] ); ?>" <?php echo esc_attr( $timestamp || empty( $course_total ) ? 'disabled' : '' ); ?>>
					<?php esc_html_e( 'Migrate Now', 'learnpress-import-export' ); ?></button>
				<button id="lp-clear-migrate-btn"
						class="button <?php echo esc_attr( $current_plugin['name'] ); ?>" <?php echo esc_attr( $timestamp ? '' : 'disabled' ); ?>>
					<?php esc_html_e( 'Clear Migrated Data', 'learnpress-import-export' ); ?></button>
			</div>
		</div>
	</div>
</div>
<?php
$template->get_admin_template( 'migration/report.php', compact( 'data' ) );
?>

