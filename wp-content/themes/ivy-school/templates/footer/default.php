<?php
/**
 * Footer template: Default
 *
 * @package Thim_Starter_Theme
 */
?>

<?php if ( get_theme_mod( 'footer_widgets', false ) ) {?>
<div class="footer">
	<div class="container">
		<?php thim_footer_widgets(); ?>
	</div>
</div>
<?php }?>

<div class="copyright-area">
	<div class="container">
		<div class="copyright-content">
            <?php thim_copyright_bar(); ?>
            <?php if( is_active_sidebar( 'copy-right' ) ) {?>
                <?php dynamic_sidebar( 'copy-right' ); ?>
            <?php }?>
		</div>
	</div>
</div>