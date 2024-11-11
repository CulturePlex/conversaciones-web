<?php
/**
 * Template for displaying default template Twitter element layout list.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/twitter/layout-list.php.
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
 * @var $title
 * @var $tweets
 */
?>

<h3 class="title"><?php echo esc_html( $title ); ?></h3>

<ul class="list-tweets">
	<?php foreach ( $tweets as $tweet ) {
		$username    = $tweet['user']['screen_name'];
		$latestTweet = $tweet['text'];
		$latestTweet = preg_replace( '/https:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="https://$1" target="_blank">https://$1</a>', $latestTweet );
		$latestTweet = preg_replace( '/@([a-z0-9_]+)/i', '<a href="https://twitter.com/$1" target="_blank">@$1</a>', $latestTweet );
		$latestTweet = preg_replace( '/#([a-z0-9_]+)/i', '<a href="https://twitter.com/hashtag/$1" target="_blank">#$1</a>', $latestTweet );
		?>

        <li class="tweet-item">
            <a href="https://twitter.com/<?php esc_attr( $username ); ?>/status/<?php esc_attr( $tweet['id_str'] ) ?>"
               target="_blank"><i class="fa fa-x-twitter"></i></a>
            <p class="tweet-content"><?php echo ent2ncr( $latestTweet ); ?></p>
        </li>
	<?php } ?>
</ul>
