<?php
/**
 * Template for displaying default template Accordion element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/accordion/kindergarten-layout-1.php.
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
?>
<div class="wrap-element">
    <?php
        $i = 1;
        foreach ($accordion  as $get_accordion):
            $icon_type   = $get_accordion['icon_type'];
            if($i == 1) {
                $class = 'active-dropdown';
            }else{
                $class = '';
            }
    ?>
            <?php
                if(isset($get_accordion['hidden_icon']) && $get_accordion['hidden_icon'] == true){
            ?>
                    <div class="accordion-item hidden-icon js-dropdown <?php echo $class; ?>">
                        <div class="question js-toggle-dropdown" <?php if(!empty($get_accordion['color'])){ ?> data-hover ="color:<?php echo $get_accordion['color']; ?>" <?php } ?>>
                            <?php echo esc_html($get_accordion['title']); ?>
                        </div>

                        <div class="answer js-dropdown-content">
                            <?php echo esc_html($get_accordion['content']); ?>
                        </div>
                    </div>
            <?php }else{?>
                <div class="accordion-item color-<?php echo $i; ?> js-dropdown <?php echo $class; ?>" <?php if(!empty($get_accordion['color'])){ ?> style="border-color:<?php echo $get_accordion['color']; ?> "<?php } ?>>
                    <div class="question js-toggle-dropdown" <?php if(!empty($get_accordion['color'])){ ?> data-hover ="color:<?php echo $get_accordion['color']; ?>" <?php } ?>>
                        <?php if ( $icon_type == 'icon_upload' ) {
                            $image = $get_accordion['icon_upload'];
                            if ( isset( $image ) ) { ?>
                                <div class="media">
                                    <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                                </div>
                            <?php }
                        } else if ( $icon_type == 'icon_ionicon' && $get_accordion['icon_ionicon'] ) { ?>
                            <i class="media-icon ionicons <?php echo esc_attr( $get_accordion['icon_ionicon'] ); ?>" <?php if(!empty($get_accordion['color'])){ ?> style="color:<?php echo $get_accordion['color']; ?>" <?php } ?>
                               aria-hidden="true"></i>
                        <?php } else if ( $icon_type == 'icon_fontawesome' && $get_accordion['icon_fontawesome'] ) { ?>
                            <i class="media-icon <?php echo esc_attr( $get_accordion['icon_fontawesome'] ); ?>" <?php if(!empty($get_accordion['color'])){ ?> style="color:<?php echo $get_accordion['color']; ?>" <?php } ?>
                               aria-hidden="true"></i>
                        <?php } ?>
                        <?php echo esc_html($get_accordion['title']); ?>
                    </div>

                    <div class="answer js-dropdown-content">
                        <?php echo esc_html($get_accordion['content']); ?>
                    </div>
                </div>
            <?php } ?>
    <?php
        $i++;
        endforeach;
    ?>
</div>
