<?php
/**
 * Template for displaying default template Search Products element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-search/search-categories.php.
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
<?php
if(bp_detect_device() == 'mobile'){
    ?>
    <div class="search-button" id="btn-action"></div>
    <div class="mobile-search-form">
        <form role="search" method="get" class="form-mobile-search" action="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
            <label>
                <input type="search" class="search-field" placeholder="<?php echo esc_html($placeholder) ?>" value="<?php echo esc_attr( get_search_query() ) ?>" name="s"
                       required autocomplete="off"/>
                <input type="hidden" name="post_type" value="product">
            </label>
            <button type="button" class="btn-live-search"><i class="ion-ios-search-strong"></i></button>
        </form>
        <ul class="list-search list-unstyled"></ul>
    </div>
<?php }else{ ?>
    <div class="destop-search-form">
        <form role="search" method="get" class="form-destop-search" action="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
            <label>
                <input type="hidden" name="post_type" value="product">
                <input type="search" class="search-field" placeholder="<?php echo esc_html($placeholder) ?>" value="<?php echo esc_attr( get_search_query() ) ?>" name="s"
                       required autocomplete="off"/>
            </label>
            <button type="button" class="btn-live-search"><i class="ion-ios-search-strong"></i></button>
        </form>
        <ul class="list-search list-unstyled"></ul>

    </div>
<?php } ?>
