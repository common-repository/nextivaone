<?php declare(strict_types=1);

/**
 * Plugin Name:       NextivaOne
 * Plugin URI:        https://www.nextiva.com/
 * Description:       The NextivaOne WordPress plugin provides the ability to add buttons to your WordPress site that adds "click to" functionality, enabling your website visitors to use a customizable interface to connect with you via a phone call or text.
 * Version:           1.0.4
 * Requires PHP:      7.4+
 * Author:            Nextiva
 * Author URI:        https://www.nextiva.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       nextivaone
 * Domain Path:       /languages
 */

namespace Tribe\NextivaOne;

use Tribe\NextivaOne\Activation\Activator;
use Tribe\NextivaOne\Activation\Deactivator;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Prevent duplicate autoloading during tests
if ( ! class_exists( Core::class ) ) {
	// Require the vendor folder via multiple locations
	$autoloaders = [
		trailingslashit( __DIR__ ) . 'vendor/scoper-autoload.php',
		trailingslashit( __DIR__ ) . 'vendor/autoload.php',
		trailingslashit( WP_CONTENT_DIR ) . '../vendor/autoload.php',
		trailingslashit( WP_CONTENT_DIR ) . 'vendor/autoload.php',
	];

	$autoload = current( array_filter( $autoloaders, 'file_exists' ) );

	require_once $autoload;
}

add_action( 'plugins_loaded', static function (): void {
	tribe_nextivaone()->init( __FILE__ );
}, 5, 0 );


function tribe_nextivaone(): Core {
	return Core::instance();
}

register_activation_hook( __FILE__, new Activator() );
register_deactivation_hook( __FILE__, new Deactivator() );
