<?php
/**
 * Template for displaying default template product banner element layout 4.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-banner/layout-4.php.
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
 * @var $bn_size
 * @var $bn_text_line
 * @var $bn_title_bottom
 * @var $bn_title_large
 * @var $bn_title_top
 * @var $bn_description
 * @var $bn_link
 */

?>

<div class="banner-option">
    <?php if ( $bn_title_top || $bn_title_large || $bn_title_bottom ) { ?>
        <h3 class="title">
            <?php if ( $bn_title_top ) { ?>
                <span class="title-top"><?php echo ent2ncr($bn_title_top); ?></span>
            <?php }?>
            <?php if ( $bn_title_large ) { ?>
                <span class="title-large"><?php echo ent2ncr($bn_title_large); ?></span>
            <?php }?>
            <?php if ( $bn_title_bottom ) { ?>
                <span class="title-bottom"><?php echo ent2ncr($bn_title_bottom); ?></span>
            <?php }?>
        </h3>
    <?php }?>

    <?php if ( $bn_description ) { ?>
        <p class="sub-title"><?php echo ent2ncr($bn_description); ?></p>
    <?php }?>

    <?php if ( $bn_text_line ) { ?>
        <span class="line"><?php echo ent2ncr($bn_text_line); ?></span>
    <?php }?>
    <div class="size-options">
        <?php
        foreach ( $params['size'] as $s ) {
            if ( $s) : ?>
            <div class="option">
                <span class="size"><?php echo ent2ncr($s['bn_number']) ?>
                    <?php if ( $s['bn_unit'] ) { ?>
                    <span><?php echo ent2ncr($s['bn_unit']) ?></span>
                    <?php }?>
                </span>
                <?php if ( $s['bn_price'] ) { ?>
                    <span class="price"><?php echo ent2ncr($s['bn_price']) ?></span>
                <?php }?>
            </div>
            <?php endif; ?>
        <?php }?>
    </div>
    <?php
    if ( $bn_link ) { ?>
        <div class="btn-link">
            <a class="bp-btn" href="<?php echo ent2ncr($bn_link['url']) ?>"><?php echo ent2ncr($bn_link['title']) ?></a>
        </div>
    <?php } ?>

</div>


