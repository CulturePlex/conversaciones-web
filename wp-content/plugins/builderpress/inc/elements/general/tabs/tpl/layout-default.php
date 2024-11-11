<?php
/**
 * Template for displaying default template Tabs element layout default.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/tabs/layout-default.php.
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
 * @var $param
 */
$title_position = $params['title_position'];
$i=$j=0;
?>
<div class="thim-wrap-tabs js-call-tabs">
    <div class="row">
        <div class="col-sm-4 col-md-3">
            <ul class="thim-nav-tabs">
                <?php foreach ($tabs as $tab) { $i++;?>
                    <li class="item-nav <?php if($i==1) echo 'active';?>" data-panel="<?php echo esc_attr($i);?>">
                        <?php echo esc_html($tab['title']);?>
                    </li>
                <?php }?>
            </ul>
        </div>

        <div class="col-sm-8 col-md-9">
            <div class="thim-content-tabs">
                <?php foreach ($tabs as $tab) { $j++;?>
                <div class="tab-panel" data-nav="<?php echo esc_attr($j);?>">
                    <?php echo esc_html($tab['content']);?>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>