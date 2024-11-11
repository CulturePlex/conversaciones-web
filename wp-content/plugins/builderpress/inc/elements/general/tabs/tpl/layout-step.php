<?php
/**
 * Template for displaying default template Tabs element layout step.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/tabs/layout-step.php.
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
$i=$j=0;
?>

<div class="thim-wrap-tabs js-call-tabs">
    <ul class="thim-nav-tabs">
        <?php foreach ($tabs as $tab) { $i++;?>
        <li class="item-nav <?php if($i==1) echo 'active';?>" data-panel="<?php echo esc_attr($i);?>">
            <span class="inside"><?php echo esc_html($tab['title']);?> <span><?php echo esc_attr($i);?></span></span>
        </li>
        <?php }?>
    </ul>

    <div class="thim-content-tabs">
        <?php foreach ($tabs as $tab) { $j++;?>
        <div class="tab-panel" data-nav="<?php echo esc_attr($j);?>">
            <?php echo esc_html($tab['content']);?>
        </div>
        <?php }?>
    </div>
</div>
