<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://maicol07.it
 * @since             1.0.0
 * @package           mdi-wp
 *
 * @wordpress-plugin
 * Plugin Name:       Material Design Icons for WordPress
 * Plugin URI:        https://github.com/maicol07/mdi-wp
 * Description:       Use the Material Design icon set within WordPress. Icons can be inserted using either HTML or a shortcode.
 * Version:           1.0
 * Author:            maicol07
 * Author URI:        https://maicol07.it
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       mdi-wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . '/src/class-materialdesignicons.php';

$mdi = new MaterialDesignIcons();
