<?php
/**
 * Created by PhpStorm.
 * User: khoapq
 * Date: 12/23/2016
 * Time: 11:38 AM
 */
?>
<?php

$parent_cat = 0;
$break_list = 4;
$class      = 0;


if ( $params['hide_all'] == true ) {
    $class = "hide-filter-all";
}
if ( $params['category'] ) {
    $parent_cat = get_term_by( 'slug', $params['category'], 'product_cat' );
    $parent_cat = isset( $parent_cat->term_id ) ? $parent_cat->term_id : 0;
}


$categories = get_categories( array( 'hide_empty' => true, 'parent' => $parent_cat, 'taxonomy' => 'product_cat' ) );


if ( $categories ) : ?>
    <div class="nav-filter <?php esc_attr($class) ?>">
        <?php
        $loop = 0;
        $list = '';
        $parent_cat = get_term_by( 'slug', $params['category'], 'product_cat' );

        if ( $params['category'] == ' ' ) {
            if ( $params['hide_all'] == false ) {
                $list = '<li class="cat-item current"><a data-cat="' . $params['category'] . '">' . esc_html__('All','builder-press') . '</a></li>';
            }
        } else {
            $list = '<li class="cat-item current"><a data-cat="' . $params['category'] . '">' . $parent_cat->name . '</a></li>';
        }


        foreach ( $categories as $i => $cat ) {

            if ( $loop == 0 && $params['hide_all'] == true ) {
                $class ="current";
            } else {
                $class = '';
            }

            $list .= '<li class="cat-item '. esc_attr($class) .'"><a data-cat="' . $cat->slug . '">' . $cat->name . '</a></li>';

            $loop++;
        }

        if ( $list ) {
            echo '<ul class="cat-list">' . $list . '</ul>';
        }

        ?>
    </div>
<?php endif; ?>
