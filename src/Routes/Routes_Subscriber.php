<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Routes;

use Tribe\Libs\Container\Abstract_Subscriber;

/**
 * Subscribes routes to WP lifecycle hooks.
 */
class Routes_Subscriber extends Abstract_Subscriber {

	/**
	 * Registers any WP lifecycle hooks for routes.
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'rest_api_init', function (): void {
			$this->container->get( Form_Route::class )->register();
		}, 10, 0 );
	}

}
