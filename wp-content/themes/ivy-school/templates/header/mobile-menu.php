<?php
/**
 * Header Mobile Menu Template
 *
 * @package Thim_Starter_Theme
 */
?>
<ul class="nav navbar-nav">
	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s'
		) );
	} else {
		wp_nav_menu( array(
			'theme_location' => '',
			'container'      => false,
			'items_wrap'     => '%3$s'
		) );
	}
	?>
</ul>
<?php do_action( 'after_mobile_menu' ); ?>
<?php
    if(wp_is_mobile()):
?>
    <div class="mobile-sidebar">
        <?php
            if(is_active_sidebar('menu-right')):
                dynamic_sidebar('menu-right');
            endif;
        ?>
    </div>
<?php
    endif;
?>


