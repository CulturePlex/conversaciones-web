<?php
/**
 * Template for displaying default template Twitter element layout slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/twitter/layout-slider.php.
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
 * @var $tweets
 */
?>

<div class="js-call-slick-col" data-numofslide="1" data-numofscroll="1" data-loopslide="0" data-autoscroll="0" data-speedauto="6000" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
    <div class="list-tweets slide-slick">
        <?php foreach ( $tweets as $tweet ) {
            $username    = $tweet['user']['screen_name'];
            $latestTweet = $tweet['text'];
            $latestTweet = preg_replace( '/https:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="https://$1" target="_blank">https://$1</a>', $latestTweet );
            $latestTweet = preg_replace( '/@([a-z0-9_]+)/i', '<a href="https://twitter.com/$1" target="_blank">@$1</a>', $latestTweet );
            $latestTweet = preg_replace( '/#([a-z0-9_]+)/i', '<a href="https://twitter.com/hashtag/$1" target="_blank">#$1</a>', $latestTweet );
            ?>
            <div class="tweet-item item-slick">
                <div class="top">
                    <a href="#">
                        <i class="fa fa-x-twitter"></i>
                    </a>
                </div>
                <div class="tweet-content">
                    <?php echo ent2ncr( $latestTweet ); ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="wrap-dot-slick"></div>
</div>