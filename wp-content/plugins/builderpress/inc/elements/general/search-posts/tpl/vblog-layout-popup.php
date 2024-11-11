<?php
/**
 * Template for displaying default template Search Posts element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/search-posts/search-categories.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $params array - shortcode params
 */
$title    = $params['title'];
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
?>

<!--search posts element-->

    <?php if ( $title ) { ?>
        <h4 class="title"><?php echo esc_html( $title ); ?></h4>
    <?php } ?>

    <!--    button search-->
    <div class="search-button"></div>

    <div class="search-form">

        <!--        button close-->
        <span class="close-form"></span>

        <!--        search form-->
        <form role="search" method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="search-field" value="<?php echo esc_attr( get_search_query() ) ?>" name="s"
                   required/>
            <span class="search-notice"> <?php esc_html_e( 'Hit enter to search or ESC to close', 'builderpress' ); ?></span>
        </form>

        <ul class="list-search list-unstyled"></ul>
    </div>
