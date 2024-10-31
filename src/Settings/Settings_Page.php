<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Settings;

use Tribe\NextivaOne\Resources\Resource;

class Settings_Page {

	protected Resource $resource;

	public function __construct( Resource $resource ) {
		$this->resource = $resource;
	}

	/**
	 * Adds the NextivaOne Settings menu item.
	 *
	 * @hook admin_menu
	 *
	 * @return void
	 */
	public function add_settings_menu(): void {
		add_menu_page(
			__( 'NextivaONE', 'nextivaone' ),
			__( 'NextivaONE', 'nextivaone' ),
			'manage_options',
			Settings::NEXTIVA_ONE_GROUP,
			[ $this, 'create_admin_page' ],
			'data:image/svg+xml;base64,' . base64_encode( '<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M27.8463 33.0072C25.9964 33.0072 24.2384 33.0072 22.4803 32.9948C22.2941 32.9595 22.1293 32.8523 22.0214 32.6965C20.9464 31.2703 19.8697 29.8388 18.7965 28.4179C18.7047 28.2961 18.6094 28.176 18.4858 28.0154C18.1469 28.462 17.8398 28.8644 17.5362 29.2704C16.6678 30.4248 15.8064 31.5863 14.9238 32.7318C14.8658 32.8045 14.794 32.865 14.7125 32.9098C14.631 32.9546 14.5415 32.9829 14.449 32.9931C12.7033 33.0072 10.9594 33.0072 9.12012 33.0072C9.24368 32.8307 9.3284 32.693 9.42372 32.5677C11.4242 29.9035 13.4247 27.2423 15.4251 24.584C15.6334 24.3087 15.6016 24.1463 15.4075 23.8956C13.4282 21.2703 11.4536 18.6403 9.48373 16.0055C9.37782 15.8626 9.27545 15.7161 9.13071 15.5166C9.33723 15.506 9.47138 15.4954 9.60553 15.4937C11.1535 15.4937 12.6998 15.506 14.246 15.4813C14.4046 15.4704 14.5631 15.5031 14.7044 15.5759C14.8456 15.6488 14.9643 15.7589 15.0474 15.8943C16.0888 17.3064 17.1532 18.7185 18.2087 20.113C18.2846 20.2136 18.3676 20.3107 18.4858 20.466C18.6041 20.3177 18.7083 20.1942 18.8053 20.0653C19.8644 18.6532 20.9376 17.2411 21.9931 15.8131C22.0608 15.7086 22.1549 15.6239 22.2659 15.5675C22.3768 15.511 22.5008 15.485 22.6251 15.4919C24.2137 15.5078 25.8023 15.4919 27.3909 15.4919C27.5127 15.4919 27.6345 15.5042 27.8322 15.5131C27.7051 15.6896 27.6186 15.8361 27.5197 15.9667C25.5404 18.6085 23.5559 21.2474 21.566 23.8833C21.3595 24.1569 21.3524 24.3228 21.566 24.6034C23.5941 27.267 25.5922 29.9465 27.6009 32.6206C27.6733 32.7177 27.7333 32.8307 27.8463 33.0072Z" fill="white"/>
			<path d="M18.4756 14.2385C15.3672 14.2385 12.8272 11.6915 12.8448 8.61485C12.8625 5.53824 15.3725 3 18.4014 3C21.591 3 24.1239 5.49059 24.1239 8.62015C24.1226 9.3601 23.9753 10.0925 23.6906 10.7755C23.4059 11.4585 22.9893 12.0786 22.4647 12.6005C21.94 13.1223 21.3177 13.5356 20.6332 13.8166C19.9487 14.0977 19.2155 14.2411 18.4756 14.2385V14.2385Z" fill="white"/>
			</svg>' ),
		);
	}

	public function add_entries_page(): void {
		add_submenu_page(
			Settings::NEXTIVA_ONE_GROUP,
			__( 'Form Entries', 'nextivaone' ),
			__( 'Form Entries', 'nextivaone' ),
			'manage_options',
			'nextiva-one-entries',
			[ $this, 'create_entries_page' ]
		);
	}

	/**
	 * Outputs the markup for the NextivaOne Settings page.
	 *
	 * @return void
	 */
	public function create_admin_page(): void {
		// phpcs:ignore SlevomatCodingStandard.Variables.UnusedVariable.UnusedVariable
		$header_cutout_uri = $this->resource->get_asset_uri( 'images/admin/nextiva-one-admin-header-cutout.png' );

		require ONE_PATH . 'resources/views/admin/Settings.php';
	}

	public function create_entries_page(): void {
		require ONE_PATH . 'resources/views/admin/entries.php';
	}

}
