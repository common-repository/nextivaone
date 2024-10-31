<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Shortcodes;

use Tribe\NextivaOne\Settings\Button_Settings;
use Tribe\NextivaOne\Templates\Template;

class NextivaOne_Shortcode extends \Tribe\NextivaOne\Template {

	public const NAME = 'nextiva_one';

	protected string $path = '/resources/views/public/main.php';

	/**
	 * @param array|string $params
	 *
	 * @return false|string
	 */
	public function render( $params ) {
		$defaults = $this->get_defaults();

		if ( $defaults[ Template::BUTTON_TYPE ] !== 'sticky' ) {
			$atts = shortcode_atts( $defaults, $params, self::NAME ); // @codingStandardsIgnoreLine

			return $this->get_content( $atts );
		}

		return '';
	}

	protected function get_defaults(): array {
		$actions = $this->get_actions();
		$labels  = $this->get_labels();
		$phone   = $this->get_phone_number();

		return [
			Template::SHOW_PLUGIN          => true,
			Template::PHONE_NUMBER         => $phone,
			Template::EMAIL                => $this->get_option( Button_Settings::NEXTIVA_ONE_EMAIL, '' ),
			Template::INTRO_TEXT           => $this->get_option( Button_Settings::NEXTIVA_ONE_INTRO_TEXT, '' ),
			Template::SHOW_BUTTON          => $this->get_show_button(),
			Template::RESPONSIVE_BEHAVIOUR => $this->get_responsive_behaviour(),
			Template::BUTTONS              => $this->render_buttons( $actions, $labels, $phone ),
			Template::BUTTON_LABELS        => $labels,
			Template::BUTTON_ACTIONS       => $actions,
			Template::BUTTON_TYPE          => $this->get_type(),
			Template::IMAGE                => $this->get_image(),
			Template::FORM                 => $this->render_form( $actions ),
			Template::BUTTON_POSITION      => $this->get_button_position(),
			Template::POPUP_STYLE          => $this->get_popup_style(),
			Template::FONTS                => $this->get_option( Button_Settings::NEXTIVA_ONE_FONTS, 0 ),
			Template::FONTS_COLOR          => $this->get_option( Button_Settings::NEXTIVA_ONE_FONTS_COLOR, '#ffffff' ),
			Template::THEME_COLOR          => $this->get_option( Button_Settings::NEXTIVA_ONE_THEME_COLOR, '#ffffff' ),
			Template::HEADER_TEXT_COLOR    => $this->get_option( Button_Settings::NEXTIVA_ONE_HEADER_COLOR, '#ffffff' ),
			Template::WIDGET_LABEL         => $this->get_option( Button_Settings::NEXTIVA_ONE_WIDGET_LABEL, esc_html__( 'Contact Us', 'nextivaone' ) ),
			Template::WIDGET_LABEL_ALIGN   => $this->get_option( Button_Settings::NEXTIVA_ONE_WIDGET_LABEL_ALIGN, 'left' ),
		];
	}

}
