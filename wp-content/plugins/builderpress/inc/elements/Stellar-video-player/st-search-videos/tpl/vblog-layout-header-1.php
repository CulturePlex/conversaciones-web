<?php
/**
 * Template for displaying default template St-search-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-search-videos/layout-1.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

?>

<div class="wrap-element">
    <form class="search-form">
        <input type="search" class="search-field" name="search" placeholder="<?php echo esc_html__( 'Seach for a Movie...', 'builderpress' );?>" autocomplete="off">

        <button class="btn-search">
            <i class="ion ion-android-search"></i>
        </button>
    </form>
    <ul class="list-search-videos list-unstyled"></ul>
</div>
