<?php
if ( ! isset( $data ) ) {
	return;
}
$migrated_course_total = $data['migrated_course_total'] ?? 0;
$user_id               = $data['tutor_migrate_user_id'] ?? 0;
$migrated_course_items = $data['migrated_course'] ?? array();
$migrated_lesson       = $data['migrated_lesson'] ?? array();
$migrated_quiz         = $data['migrated_quiz'] ?? array();
$migrated_assignment   = $data['migrated_assignment'] ?? array();

$current_plugin = $data['current_plugin'] ?? array();
$user           = get_user_by( 'id', $user_id );
$timestamp      = $data['tutor_migrate_time'] ?? 0;
$course_total   = $data['course_total'] ?? 0;

if ( $migrated_course_total && ! empty( $user_id ) ) {
	?>
	<div id="migration-report">
		<div class="header">
			<h2><?php printf( esc_html__( 'Migrate %1s - By %2s', 'learnpress-import-export' ), date( 'd/m/Y', $timestamp ), $user->user_login ); ?></h2>
			<span
				class="migrated-course-total"><?php printf( esc_html__( 'Course Migrated (%s)', 'learnpress-import-export' ), $migrated_course_total . '/' . $course_total ); ?></span>
		</div>
		<div class="migrate-report-content <?php echo esc_attr( $current_plugin['name'] ?? '' ); ?>">
			<?php
			if ( count( $migrated_course_items ) ) {
				?>
				<div class="course-item-list">
					<?php
					foreach ( $migrated_course_items as $migrated_course ) {
						$lp_course_id = $migrated_course['lp'];
						if ( empty( get_post_status( $lp_course_id ) ) ) { // check course exist
							continue;
						}
						?>
						<div class="course-item">
							<header class="course-item-header">
								<div class="course-title">
										<span class="header-icon">
											<svg width="16" height="17" viewBox="0 0 16 17" fill="none"
												 xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd"
												  d="M8.00016 3.16669C8.36835 3.16669 8.66683 3.46516 8.66683 3.83335V13.1667C8.66683 13.5349 8.36835 13.8334 8.00016 13.8334C7.63197 13.8334 7.3335 13.5349 7.3335 13.1667V3.83335C7.3335 3.46516 7.63197 3.16669 8.00016 3.16669Z"
												  fill="#787C82"/>
											<path fill-rule="evenodd" clip-rule="evenodd"
												  d="M2.6665 8.49998C2.6665 8.13179 2.96498 7.83331 3.33317 7.83331H12.6665C13.0347 7.83331 13.3332 8.13179 13.3332 8.49998C13.3332 8.86817 13.0347 9.16665 12.6665 9.16665H3.33317C2.96498 9.16665 2.6665 8.86817 2.6665 8.49998Z"
												  fill="#787C82"/>
											</svg>
										</span>
									<?php printf( __( 'Course : %1s', 'learnpress-import-export' ),
										get_the_title( $lp_course_id ) );
									?>
								</div>
								<a href="<?php echo esc_url_raw( get_edit_post_link( $lp_course_id ) ); ?>"><?php esc_html_e( 'View Course', 'learnpress-import-export' ); ?></a>
							</header>
							<div class="course-item-content">
								<?php
								foreach ( $migrated_lesson as $lesson ) {
									if ( isset( $lesson['course_id'] ) && $lesson['course_id'] === $lp_course_id ) {
										$lp_lesson_id = $lesson['lp'];
										if ( empty( get_post_status( $lp_lesson_id ) ) ) { // check lesson exist
											continue;
										}
										?>
										<div class="lesson-item">
											<a href="<?php echo esc_url_raw( get_edit_post_link( $lp_lesson_id ) ); ?>"
											   class="lesson-title">
												<?php printf( __( 'Lesson : %1s', 'learnpress-import-export' ), get_the_title( $lp_lesson_id ) ); ?>
											</a>
										</div>
										<?php
									}
								}

								foreach ( $migrated_quiz as $quiz ) {
									if ( isset( $quiz['course_id'] ) && $quiz['course_id'] === $lp_course_id ) {
										$lp_quiz_id = $quiz['lp'];
										if ( empty( get_post_status( $lp_quiz_id ) ) ) { // check quiz exist
											continue;
										}
										?>
										<div class="lesson-item">
											<a href="<?php echo esc_url_raw( get_edit_post_link( $lp_quiz_id ) ); ?>"
											   class="lesson-title">
												<?php printf( __( 'Quiz : %1s', 'learnpress-import-export' ), get_the_title( $lp_quiz_id ) ); ?>
											</a>
										</div>
										<?php
									}
								}

								foreach ( $migrated_assignment as $assignment ) {
									if ( isset( $assignment['course_id'] ) && $assignment['course_id'] === $lp_course_id ) {
										$lp_assignment_id = $assignment['lp'];
										if ( empty( $lp_assignment_id ) ) { // check assignment exist
											continue;
										}
										?>
										<div class="lesson-item">
											<a href="<?php echo esc_url_raw( get_edit_post_link( $lp_assignment_id ) ); ?>"
											   class="lesson-title">
												<?php printf( __( 'Assignment : %1s', 'learnpress-import-export' ), get_the_title( $lp_assignment_id ) ); ?>
											</a>
										</div>
										<?php
									}
								}
								?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

