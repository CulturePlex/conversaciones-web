<div class="container">
    <?php if ( get_theme_mod( 'header_style', 'header_v1' ) == 'header_v3' ) {?>
        <div class="top-bar-v3">
            <?php dynamic_sidebar( 'topbar' ); ?>
            <a href="#" class="close-notification-bar">
                <i class="ion ion-android-close"></i>
            </a>
        </div>
    <?php } else {?>
        <div class="row-topbar">
            <div id="thimTopBarLeft" class="thim-topbar-left">
                <?php dynamic_sidebar( 'topbar_left' ); ?>
            </div>
            <div id="thimTopBarRight" class="thim-topbar-right">
                <?php dynamic_sidebar( 'topbar_right' ); ?>
            </div>
        </div>
    <?php }?>
</div>
