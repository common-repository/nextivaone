<?php declare(strict_types=1);

namespace Tribe\NextivaOne;

use Tribe\NextivaOne\Settings\Button_Settings;

class Template {

	public const ACTIONS = [
		'call-text',
		'call',
		'text',
		'message',
		'call-message',
		'text-message',
		'call-text-message',
	];

	protected string $path = '';

	/**
	 * @function render_buttons
	 *
	 * @param string $actions
	 * @param array  $labels
	 * @param string $phone
	 *
	 * @return false|string
	 */
	public function render_buttons( string $actions, array $labels, string $phone ) {
		$data = [
			Templates\Template::BUTTON_ACTIONS => $actions,
			Templates\Template::BUTTON_LABELS  => $labels,
			Templates\Template::PHONE_NUMBER   => $phone,
		];

		return $this->get_content( $data, 'resources/views/public/buttons.php' );
	}

	public static function get_field_attributes( array $attrs ): string {
		if ( empty( $attrs ) ) {
			return '';
		}

		$result = '';
		foreach ( $attrs as $name => $value ) {
			$result .= sprintf( '%s="%s"', $name, is_array( $value ) ? json_encode( $value ) : $value );
		}

		return $result;
	}

	/**
	 * @param array  $context
	 * @param string $path
	 *
	 * @return false|string
	 */
	protected function get_content( array $context = [], string $path = '' ) {
		extract( $context );
		ob_start();
		include $this->get_path( $path );

		return ob_get_clean();
	}

	/**
	 * @return mixed|void
	 */
	protected function get_path( string $path = '' ) {
		return apply_filters( 'nextivaone/template/path', ONE_PATH . ( $path ?: $this->path ) );
	}

	/**
	 * @param string $name
	 * @param mixed  $default
	 *
	 * @return mixed|void
	 */
	protected function get_option( string $name, $default ) {
		global $post;
		$value = get_option( $name, $default );

		return apply_filters( 'nextivaone/template/option=' . $name, $value, $default, $post );
	}

	/**
	 * @return array
	 */
	protected function get_labels(): array {
		$default_labels = [
			'call'    => __( 'Call us', 'nextivaone' ),
			'text'    => __( 'Text us', 'nextivaone' ),
			'message' => __( 'Message us', 'nextivaone' ),
		];

		$current = $this->get_option( Button_Settings::NEXTIVA_ONE_BUTTON_LABEL, $default_labels );
		foreach ( $default_labels as $key => $label ) {
			if ( array_key_exists( $key, $current ) ) {
				continue;
			}

			$current[ $key ] = $label;
		}

		return $current;
	}

	/**
	 * @return string
	 */
	protected function get_button_position(): string {
		$value = $this->get_option( Button_Settings::NEXTIVA_ONE_BUTTON_POSITION, 0 );

		switch ( $value ) {
			case 1:
				return 'bottom-left';

			case 2:
				return 'bottom-center';

			case 3:
				return 'full-width';

			default:
				return 'bottom-right';
		}
	}

	/**
	 * @return string
	 */
	protected function get_show_button(): string {
		return ( int ) $this->get_option( Button_Settings::NEXTIVA_ONE_BUTTON_SHOW, 0 ) === 0 ? 'all' : 'homepage';
	}

	/**
	 * @return string
	 */
	protected function get_responsive_behaviour(): string {
		return ( int ) $this->get_option( Button_Settings::NEXTIVA_ONE_BUTTON_RESPONSIVE, 0 ) === 0 ? 'all' : 'mobile';
	}

	/**
	 * @return string
	 */
	protected function get_type(): string {
		return ( int ) $this->get_option( Button_Settings::NEXTIVA_ONE_BUTTON_TYPE, 0 ) === 0 ? 'sticky' : 'static';
	}

	protected function get_popup_style(): string {
		return ( int ) $this->get_option( Button_Settings::NEXTIVA_ONE_BUTTON_POPUP, 0 ) === 0 ? 'slide' : 'modal';
	}

	/**
	 * @return string
	 */
	protected function get_actions(): string {
		$actions = ( int ) $this->get_option( Button_Settings::NEXTIVA_ONE_BUTTON_ACTION, Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT );

		switch ( $actions ) {
			case Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL:
				return self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL ];

			case Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_TEXT:
				return self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_TEXT ];

			case Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_MESSAGE:
				return self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_MESSAGE ];

			case Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_MESSAGE:
				return self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_MESSAGE ];

			case Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_TEXT_MESSAGE:
				return self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_TEXT_MESSAGE ];

			case Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT_MESSAGE:
				return self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT_MESSAGE ];

			case Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT:
			default:
				return self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT ];
		}
	}

	/**
	 * @return array|false|null
	 */
	protected function get_image() {
		$image_id = ( int ) $this->get_option( Button_Settings::NEXTIVA_ONE_IMAGE, 0 );
		$image    = wp_get_attachment_image_src( $image_id, 'medium' );

		return $image ?: null;
	}

	/**
	 * Get phone number with country code
	 *
	 * @return string
	 */
	protected function get_phone_number(): string {
		$number = $this->get_option( Button_Settings::NEXTIVA_ONE_NUMBER, '' );

		if ( empty( $number ) ) {
			return '';
		}

		$country = $this->get_option( Button_Settings::NEXTIVA_ONE_COUNTRY, [] );

		if ( empty( $country ) || $country['iso2'] === 'us' ) {
			return sprintf( '+1%s', $number );
		}

		return sprintf( '+%s%s', $country['dialCode'], $number );
	}

	/**
	 * @param string $actions
	 *
	 * @return false|string
	 */
	protected function render_form( string $actions ) {
		$is_message_button = in_array(
			$actions,
			[
				self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_TEXT_MESSAGE ],
				self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT_MESSAGE ],
				self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_MESSAGE ],
				self::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_MESSAGE ],
			]
		);

		if ( ! $is_message_button ) {
			return '';
		}

		$data = [
			'fields' => [
				'name'    => [
					'placeholder' => esc_html__( 'First and last name', 'nextivaone' ),
					'id'          => 'nextivaone-name',
					'type'        => 'text',
					'name'        => 'first_last_name',
					'required'    => true,
					'classes'     => [],
					'attrs'       => [],
					'label'       => esc_html__( '* First and last name', 'nextivaone' ),
				],
				'email'   => [
					'placeholder' => esc_html__( 'i.e. mary@email.com', 'nextivaone' ),
					'id'          => 'nextivaone-email',
					'name'        => 'email',
					'type'        => 'email',
					'required'    => true,
					'classes'     => [],
					'label'       => esc_html__( '* Email address', 'nextivaone' ),
					'attrs'       => [],
				],
				'subject' => [
					'placeholder' => esc_html__( 'Give your message a subject', 'nextivaone' ),
					'id'          => 'nextivaone-subject',
					'type'        => 'text',
					'name'        => 'subject',
					'required'    => true,
					'classes'     => [],
					'label'       => esc_html__( '* Subject field', 'nextivaone' ),
					'attrs'       => [],
				],
				'message' => [
					'placeholder' => esc_html__( '', 'nextivaone' ),
					'id'          => 'nextivaone-message',
					'type'        => 'textarea',
					'name'        => 'message',
					'required'    => true,
					'classes'     => [],
					'label'       => esc_html__( '* Your message', 'nextivaone' ),
					'attrs'       => [
						'maxlength' => 160,
					],
				],
			],
		];

		$data = apply_filters( 'nextivaone/forms/message_form', $data, $actions );

		return $this->get_content( $data, 'resources/views/public/form.php' );
	}

}
