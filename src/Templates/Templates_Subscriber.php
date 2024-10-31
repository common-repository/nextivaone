<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Templates;

use Tribe\Libs\Container\Abstract_Subscriber;

/**
 * Class Asset_Subscriber
 *
 * @package Tribe\NextivaOne
 */
class Templates_Subscriber extends Abstract_Subscriber {

	public function register(): void {
		add_action( 'wp_footer', function (): void {
			$this->container->get( Template::class )->render();
		}, 10, 0 );
	}

}
