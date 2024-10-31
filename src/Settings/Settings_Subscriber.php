<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Settings;

use Tribe\Libs\Container\Abstract_Subscriber;

/**
 * Class Asset_Subscriber
 *
 * @package Tribe\NextivaOne
 */
class Settings_Subscriber extends Abstract_Subscriber {

	public function register(): void {
		add_action( 'admin_menu', function (): void {
			$this->container->get( Settings_Page::class )->add_settings_menu();
		}, -1, 0 );

		add_action( 'admin_init', function (): void {
			$this->container->get( Button_Settings::class )->register_settings();
		} );

		add_action( 'admin_notices', function (): void {
			$this->container->get( Banner::class )->render();
		} );

		add_action( 'admin_post_' . Banner::HIDE_BANNER, function (): void {
			$this->container->get( Banner::class )->dismiss();
		} );
	}

}
