<?php
/**
 * Template for displaying default template Search Posts element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/search-posts/layout-2.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, hotam
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $params array - shortcode params
 */

$placeholder    = $params['placeholder'];
$el_class       = $params['el_class'];
$el_id          = $params['el_id'];
?>

<!--search posts element-->

<!--    button search-->
<div class="thim-search-box">
    <div class="toggle-form"><i class="ion-ios-search"></i></div><!-- .toggle-form -->
    <div class="form-search-wrapper">
        <div class="form-contain container">
            <form role="search" method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" class="search-field" autocomplete="off" placeholder="<?php echo esc_attr( $placeholder ) ?>" value="<?php echo get_search_query() ?>" name="s" />
                <button type="submit"><i class="ion-ios-search"></i></button>
            </form>
            <span class="icon-close"><i class="ion-ios-close"></i></span>
            <div class="results">
                <div class="search-found"></div>
                <div class="thim-icon-loading">
                    <div class="sk-three-bounce">
                        <div class="sk-child sk-bounce1"></div>
                        <div class="sk-child sk-bounce2"></div>
                        <div class="sk-child sk-bounce3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .form-search-wrapper -->
</div><!-- .thim-search-box -->
