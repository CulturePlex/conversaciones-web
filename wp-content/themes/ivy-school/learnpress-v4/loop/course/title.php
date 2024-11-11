<?php
/**
 * Template for displaying title of course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/title.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>