<?php
/**
 * Template for displaying default template Accordion element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/accordion/layout-2.php.
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
 * @var $accordion_tab
 */

if ( ! $accordion_tab ) {
    return;
}
$unique_id = uniqid( 'bp_' );
?>

<div class="tabs">
    <ul class="nav" role="tablist">
        <?php
        $active = 'active';

        foreach ( $accordion_tab  as $key => $get_accordion_tab ) {
            if ( $key != 0 ) {
                $active = '';
            }

            $tab_id    = $unique_id . '-acc-' . $key;
            ?>
            <li class="nav-item">
                <a class="nav-link <?php echo esc_attr($active) ?>" data-toggle="tab" href="#<?php echo esc_attr($tab_id) ?>" role="tab"><?php echo $get_accordion_tab['tab_title']; ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
    <div class="tab-content">

        <?php
        $active_content = 'active';
        foreach ( $accordion_tab  as $key => $get_accordion_tab ) {
            if ( $key != 0 ) {
                $active_content = '';
            }

            $tab_id_content    = $unique_id . '-acc-' . $key;
            ?>
            <div class="tab-pane <?php echo esc_attr($active_content)?>" id="<?php echo esc_attr($tab_id_content)?>" role="tabpanel">
                <?php

                if ( ! empty($get_accordion_tab['accordion_item'])) {
                    $i=0;
                    foreach ( $get_accordion_tab['accordion_item']  as $get_accordion_item ):
                        $i++;
                        ?>

                        <div class="item js-dropdown <?php if($i==1) echo 'active-dropdown';?>">
                            <?php if (! empty($get_accordion_item['title'])) :?>
                            <div class="question js-toggle-dropdown">
                                <i class="fa fa-question-circle"></i><?php echo esc_html($get_accordion_item['title']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (! empty($get_accordion_item['title'])) :?>
                            <div class="answer js-dropdown-content">
                                <?php echo esc_html($get_accordion_item['content']); ?>
                            </div>
                        <?php endif; ?>
                        </div>

                    <?php
                    endforeach;
                }
                ?>
            </div>
        <?php }
        ?>
    </div>


</div>
