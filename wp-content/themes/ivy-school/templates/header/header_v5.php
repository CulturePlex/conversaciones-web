<?php
/**
 * Header V5 Template
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

        <div class="header-menu">
            <nav class="width-navigation main-navigation">
                <?php get_template_part( 'templates/header/main-menu' ); ?>
            </nav>

            <div class="menu-right">
                <?php
                if ( is_active_sidebar( 'menu-right' ) ) {
                    dynamic_sidebar( 'menu-right' );
                }
                ?>
                <div class="menu-mobile-effect navbar-toggle hidden" data-effect="mobile-effect">
                    <div class="icon-wrap">
                        <i class="ion-navicon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>