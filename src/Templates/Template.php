<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Templates;

use Tribe\NextivaOne\Settings\Button_Settings;

class Template extends \Tribe\NextivaOne\Template {

	public const SHOW_PLUGIN          = 'show_plugin';
	public const PHONE_NUMBER         = 'phone_number';
	public const INTRO_TEXT           = 'intro_text';
	public const WIDGET_LABEL         = 'widget_label';
	public const WIDGET_LABEL_ALIGN   = 'widget_label_align';
	public const BUTTON_ACTIONS       = 'button_actions';
	public const BUTTON_TYPE          = 'button_type';
	public const BUTTON_POSITION      = 'button_position';
	public const SHOW_BUTTON          = 'show_button';
	public const RESPONSIVE_BEHAVIOUR = 'responsive_behavior';
	public const BUTTONS              = 'buttons';
	public const BUTTON_LABELS        = 'button_labels';
	public const POPUP_STYLE          = 'popup_style';
	public const IMAGE                = 'image';
	public const FONTS                = 'fonts';
	public const EMAIL                = 'email';
	public const FORM                 = 'form';
	public const FONTS_COLOR          = 'fonts_color';
	public const THEME_COLOR          = 'theme_color';
	public const HEADER_TEXT_COLOR    = 'header_color';

	protected string $path = '/resources/views/public/main.php';

	public function render(): void {
		$args = $this->get_data();
		echo $this->get_content( $args );
	}

	public function get_data(): array {
		$actions = $this->get_actions();
		$labels  = $this->get_labels();
		$phone   = $this->get_phone_number();

		return [
			self::SHOW_PLUGIN          => $this->get_type() !== 'static',
			self::PHONE_NUMBER         => $phone,
			self::EMAIL                => $this->get_option( Button_Settings::NEXTIVA_ONE_EMAIL, '' ),
			self::INTRO_TEXT           => $this->get_option( Button_Settings::NEXTIVA_ONE_INTRO_TEXT, '' ),
			self::SHOW_BUTTON          => $this->get_show_button(),
			self::RESPONSIVE_BEHAVIOUR => $this->get_responsive_behaviour(),
			self::BUTTONS              => $this->render_buttons( $actions, $labels, $phone ),
			self::BUTTON_LABELS        => $labels,
			self::BUTTON_ACTIONS       => $actions,
			self::BUTTON_TYPE          => $this->get_type(),
			self::IMAGE                => $this->get_image(),
			self::FORM                 => $this->render_form( $actions ),
			self::BUTTON_POSITION      => $this->get_button_position(),
			self::POPUP_STYLE          => $this->get_popup_style(),
			self::FONTS                => $this->get_option( Button_Settings::NEXTIVA_ONE_FONTS, 0 ),
			self::FONTS_COLOR          => $this->get_option( Button_Settings::NEXTIVA_ONE_FONTS_COLOR, '#ffffff' ),
			self::THEME_COLOR          => $this->get_option( Button_Settings::NEXTIVA_ONE_THEME_COLOR, '#ffffff' ),
			self::HEADER_TEXT_COLOR    => $this->get_option( Button_Settings::NEXTIVA_ONE_HEADER_COLOR, '#ffffff' ),
			self::WIDGET_LABEL         => $this->get_option( Button_Settings::NEXTIVA_ONE_WIDGET_LABEL, esc_html__( 'Contact Us', 'nextivaone' ) ),
			self::WIDGET_LABEL_ALIGN   => $this->get_option( Button_Settings::NEXTIVA_ONE_WIDGET_LABEL_ALIGN, 'left' ),
		];
	}

}
