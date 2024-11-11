<div class="wrap-element">
    <div class="thim-wrap-tabs js-call-tabs-slide">
        <div class="wrap-arrows-tabs">
            <a href="#" class="arrow-tabs prev-arrow">
                <i class="ion ion-ios-arrow-thin-left"></i>
            </a>

            <a href="#" class="arrow-tabs next-arrow">
                <i class="ion ion-ios-arrow-thin-right"></i>
            </a>
        </div>

        <ul class="thim-nav-tabs">
            <?php
                $i = 1;
                foreach ($tabs as $tab) {
            ?>
                <li class="item-nav <?php if($i==1) echo 'active';?>" data-panel="<?php echo esc_attr($i); ?>">
                    <?php echo esc_html($tab['title']) ?>
                </li>
            <?php
                    $i++;
                }
            ?>
        </ul>

        <div class="thim-content-tabs">
            <?php
                $j = 1;
                foreach ($tabs as $tab) {
            ?>
                <div class="tab-panel" data-nav="<?php echo esc_attr($j); ?>">
                    <p>
                        <?php echo esc_html($tab['content']) ?>
                    </p>
                </div>
            <?php
                    $j++;
                }
            ?>

        </div>
    </div>
</div>