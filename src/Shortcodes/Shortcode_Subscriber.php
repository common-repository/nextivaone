<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Shortcodes;

use Tribe\Libs\Container\Abstract_Subscriber;

/**
 * Class Asset_Subscriber
 *
 * @package Tribe\NextivaOne
 */
class Shortcode_Subscriber extends Abstract_Subscriber {

	public function register(): void {
		add_shortcode( 'nextiva_one', [ new NextivaOne_Shortcode(), 'render' ] );
	}

}
