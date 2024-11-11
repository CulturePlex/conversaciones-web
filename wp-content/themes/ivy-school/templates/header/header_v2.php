<?php
/**
 * Header V2 Template
 *
 * @package Thim_Starter_Theme
 */
?>
<div class="container">
	<div class="header-wrapper">
        <div class="width-logo sm-logo">
            <?php do_action( 'thim_header_logo' ); ?>
            <?php do_action( 'thim_header_sticky_logo' ); ?>
        </div>
        <nav class="width-navigation main-navigation">
            <?php get_template_part( 'templates/header/main-menu' ); ?>
            <div class="menu-mobile-effect navbar-toggle hidden" data-effect="mobile-effect">
                <div class="text-menu">
                    <?php esc_html_e( 'Menu', 'ivy-school' ); ?>
                </div>
                <div class="icon-wrap">
                    <i class="ion-navicon"></i>
                </div>
            </div>
        </nav>

        <div class="menu-right">
            <?php
            if ( is_active_sidebar( 'menu-right' ) ) {
                dynamic_sidebar( 'menu-right' );
            }
            ?>
        </div>
	</div>
</div>
