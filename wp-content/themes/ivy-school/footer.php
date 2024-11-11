<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #main-content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
$custom_class       = get_theme_mod( 'footer_custom_class', '' ) . ' site-footer';
?>

</div><!-- #main-content -->

<?php if ( ! is_page_template( 'templates/comingsoon.php' ) ) : ?>
    <?php do_action( 'thim_above_footer_area' ); ?>
	<footer id="colophon" class="<?php echo esc_attr($custom_class);?>">
		<?php thim_footer_layout(); ?>
	</footer><!-- #colophon -->
    <?php do_action( 'thim_end_footer_area' ); ?>
<?php endif; ?>
</div><!-- wrapper-container -->

<?php do_action( 'thim_space_body' ); ?>

<?php wp_footer(); ?>
</body>
</html>
