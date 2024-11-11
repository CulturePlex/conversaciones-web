<?php
/**
 * Template for displaying default template Services element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/services/services.php.
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
if ( ! $params['services'] ) {
	return;
}

// global params
$template_path = $params['template_path'];

// element params
$layout = $params['layout'];
?>

<?php builder_press_get_template( $layout, array( 'params' => $params ), $template_path ); ?>
