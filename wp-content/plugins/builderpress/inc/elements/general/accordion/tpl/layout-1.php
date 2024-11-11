<?php
/**
 * Template for displaying default template Accordion element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/accordion/layout-1.php.
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
?>
<?php
$i=0;
foreach ($accordion  as $get_accordion ):
    $i++;
    ?>
    <div class="item js-dropdown <?php if($i==1) echo 'active-dropdown';?>">
        <div class="question js-toggle-dropdown">
            <?php echo esc_html($get_accordion['title']); ?>
        </div>

        <div class="answer js-dropdown-content">
            <?php echo esc_html($get_accordion['content']); ?>
        </div>
    </div>
<?php
endforeach;
?>
