<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Activation;

use Tribe\NextivaOne\Settings\Button_Settings;

/**
 * Invoked during plugin deactivation.
 *
 * @package Tribe\NextivaOne\Activation
 */
class Deactivator implements Operable {

	public function __invoke( bool $network_wide = false ): void {
		delete_option( self::OPTION_NAME );
		$options_to_delete = [
			Button_Settings::NEXTIVA_ONE_BUTTON_ACTION,
			Button_Settings::NEXTIVA_ONE_BUTTON_LABEL,
			Button_Settings::NEXTIVA_ONE_BUTTON_POSITION,
			Button_Settings::NEXTIVA_ONE_BUTTON_RESPONSIVE,
			Button_Settings::NEXTIVA_ONE_BUTTON_SHOW,
			Button_Settings::NEXTIVA_ONE_BUTTON_TYPE,
			Button_Settings::NEXTIVA_ONE_BUTTON_POPUP,
			Button_Settings::NEXTIVA_ONE_EMAIL,
			Button_Settings::NEXTIVA_ONE_FONTS,
			Button_Settings::NEXTIVA_ONE_WIDGET_LABEL_ALIGN,
			Button_Settings::NEXTIVA_ONE_WIDGET_LABEL,
			Button_Settings::NEXTIVA_ONE_BANNER_HIDE,
			Button_Settings::NEXTIVA_ONE_INTRO_TEXT,
			Button_Settings::NEXTIVA_ONE_NUMBER,
		];

		foreach ( $options_to_delete as $option ) {
			delete_option( $option );
		}
	}

}
