<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Settings;

use Tribe\NextivaOne\Shortcodes\NextivaOne_Shortcode;

class Button_Settings extends Settings {

	public const NEXTIVA_ONE_NUMBER             = 'nextiva_one_your_number';
	public const NEXTIVA_ONE_EMAIL              = 'nextiva_one_email';
	public const NEXTIVA_ONE_COUNTRY            = 'nextiva_country';
	public const NEXTIVA_ONE_BANNER_HIDE        = 'nextiva_one_banner';
	public const NEXTIVA_ONE_INTRO_TEXT         = 'nextiva_one_intro_text';
	public const NEXTIVA_ONE_FONTS              = 'nextiva_one_fonts';
	public const NEXTIVA_ONE_FONTS_COLOR        = 'nextiva_one_fonts_color';
	public const NEXTIVA_ONE_THEME_COLOR        = 'nextiva_one_theme_color';
	public const NEXTIVA_ONE_HEADER_COLOR       = 'nextiva_one_header_color';
	public const NEXTIVA_ONE_IMAGE              = 'nextiva_one_image';
	public const NEXTIVA_ONE_BUTTON_SECTION     = 'nextiva_one_button_settings';
	public const NEXTIVA_ONE_BUTTON_ACTION      = 'nextiva_one_button_action';
	public const NEXTIVA_ONE_WIDGET_LABEL       = 'nextiva_one_widget_label';
	public const NEXTIVA_ONE_WIDGET_LABEL_ALIGN = 'nextiva_one_widget_label_align';
	public const NEXTIVA_ONE_BUTTON_LABEL       = 'nextiva_one_button_label';
	public const NEXTIVA_ONE_BUTTON_TYPE        = 'nextiva_one_button_type';
	public const NEXTIVA_ONE_BUTTON_POSITION    = 'nextiva_one_button_position';
	public const NEXTIVA_ONE_BUTTON_SHOW        = 'nextiva_one_button_show';
	public const NEXTIVA_ONE_BUTTON_RESPONSIVE  = 'nextiva_one_button_responsive';
	public const NEXTIVA_ONE_BUTTON_POPUP       = 'nextiva_one_button_popup';

	public const NEXTIVA_ONE_BUTTON_ACTION_CALL              = 1;
	public const NEXTIVA_ONE_BUTTON_ACTION_TEXT              = 2;
	public const NEXTIVA_ONE_BUTTON_ACTION_MESSAGE           = 3;
	public const NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT         = 0;
	public const NEXTIVA_ONE_BUTTON_ACTION_CALL_MESSAGE      = 4;
	public const NEXTIVA_ONE_BUTTON_ACTION_TEXT_MESSAGE      = 5;
	public const NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT_MESSAGE = 6;

	public function register_settings(): void {
		add_settings_section(
			self::NEXTIVA_ONE_BUTTON_SECTION,
			null,
			[ $this, 'description' ],
			self::NEXTIVA_ONE_GROUP
		);

		$this->phone_field();
		$this->email_field();
		$this->intro_text_field();
		$this->widget_field();
		$this->widget_field_align();
		$this->actions_field();
		$this->labels_field();
		$this->fonts_field();
		$this->fonts_color_field();
		$this->theme_color_field();
		$this->header_text_color();
		$this->image_field();
		$this->type_field();
		$this->position_field();
		$this->show_field();
		$this->popup_field();
		$this->response_behaviour_field();
	}

	/**
	 * @param array $args
	 */
	public function render_labels_html( array $args ): void {
		$default = [
			'call'    => __( 'Call us', 'nextivaone' ),
			'text'    => __( 'Text us', 'nextivaone' ),
			'message' => __( 'Message us', 'nextivaone' ),
		];
		$values  = get_option( $args['id'], $default );
		$fields  = [
			'call'    => __( 'Call Button', 'nextivaone' ),
			'text'    => __( 'Text Button', 'nextivaone' ),
			'message' => __( 'Message Button', 'nextivaone' ),
		];

		printf( '<fieldset class="nextiva-one__settings-group"><legend class="screen-reader-text"><span>%s</span></legend>', $args['legend'] );
		foreach ( $fields as $key => $label ) {
			printf(
				'<label class="nextiva-one__settings-label" for="%2$s-%4$s" data-js="%1$s-%4$s">
					<span class="label">%3$s:</span>
					<input type="text" id="%1$s-%4$s" name="%1$s[%4$s]" value="%2$s" class="nextiva-one__settings-field" />
				</label>',
				$args['id'],
				$values[ $key ] ?? $default[ $key ],
				$label,
				$key
			);
		}
		printf( '</fieldset>' );

		$this->get_description( $args );
	}

	/**
	 * @param mixed $data
	 *
	 * @return array|false|mixed|string|string[]|void|null
	 */
	public function validate_phone_field( $data ) {
		$old    = get_option( self::NEXTIVA_ONE_NUMBER, '' );
		$valid  = preg_match( '/^^([0-9-]{10,}+$)/m', $data );
		$banner = get_option( self::NEXTIVA_ONE_BANNER_HIDE );

		if ( empty( $banner ) ) {
			update_option( self::NEXTIVA_ONE_BANNER_HIDE, true );
		}
		$skip_validation = apply_filters( 'nextivaone/validation/skip', false, $data, self::NEXTIVA_ONE_NUMBER );

		if ( empty( $valid ) && ! $skip_validation ) {
			add_settings_error(
				self::NEXTIVA_ONE_NUMBER,
				self::NEXTIVA_ONE_NUMBER . '-validation',
				__( 'Phone number has invalid value. Please match 1-555-555-5555 or 555-555-5555 pattern', 'nextivaone' )
			);

			return $old;
		}

		if ( ! empty( $_POST['nextiva_one_your_number_country_code'] ) ) {
			$country_data = json_decode( html_entity_decode( stripslashes( $_POST['nextiva_one_your_number_country_code'] ) ), true );
			update_option( self::NEXTIVA_ONE_COUNTRY, $country_data );
		}

		return preg_replace( '/[^0-9]/', '', $data );
	}



	/**
	 * @param mixed $data
	 *
	 * @return mixed
	 */
	public function validate_email_field( $data ) {
		if ( empty( $data ) ) {
			return $data;
		}

		$old      = get_option( self::NEXTIVA_ONE_EMAIL, '' );
		$is_valid = filter_var( $data, FILTER_VALIDATE_EMAIL );

		if ( ! $is_valid ) {
			add_settings_error(
				self::NEXTIVA_ONE_NUMBER,
				self::NEXTIVA_ONE_EMAIL . '-validation',
				__( 'Email field has invalid value. Please correct field value and try again', 'nextivaone' )
			);

			return $old;
		}

		return $data;
	}

	protected function phone_field(): void {
		register_setting(
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_NUMBER,
			[ 'sanitize_callback' => [ $this, 'validate_phone_field' ], ]
		);

		add_settings_field(
			self::NEXTIVA_ONE_NUMBER,
			__( 'Your Nextiva Phone Number', 'nextivaone' ),
			[ $this, 'field_html' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'          => self::NEXTIVA_ONE_NUMBER,
				'label_for'   => self::NEXTIVA_ONE_NUMBER,
				'type'        => 'text',
				'phone'       => true,
				'placeholder' => __( 'Your phone number', 'nextivaone' ),
			]
		);
	}

	protected function email_field(): void {
		register_setting(
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_EMAIL,
			[ 'sanitize_callback' => [ $this, 'validate_email_field' ], ]
		);

		add_settings_field(
			self::NEXTIVA_ONE_EMAIL,
			esc_html__( 'Your Email', 'nextivaone' ),
			[ $this, 'field_html' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'          => self::NEXTIVA_ONE_EMAIL,
				'label_for'   => self::NEXTIVA_ONE_EMAIL,
				'type'        => 'email',
				'placeholder' => __( 'Enter email', 'nextivaone' ),
			]
		);
	}

	protected function intro_text_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_INTRO_TEXT );

		add_settings_field(
			self::NEXTIVA_ONE_INTRO_TEXT,
			__( 'Intro Text', 'nextivaone' ),
			[ $this, 'field_html' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'          => self::NEXTIVA_ONE_INTRO_TEXT,
				'label_for'   => self::NEXTIVA_ONE_INTRO_TEXT,
				'type'        => 'text',
				'placeholder' => __( 'Enter intro text', 'nextivaone' ),
				'html'        => sprintf(
					'<p>%s</p>',
					__( 'This is an open field in which you can add anything.', 'nexone' ),
				),
			]
		);
	}

	protected function widget_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_WIDGET_LABEL );

		add_settings_field(
			self::NEXTIVA_ONE_WIDGET_LABEL,
			esc_html__( 'Widget Label', 'nextivaone' ),
			[ $this, 'field_html' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'          => self::NEXTIVA_ONE_WIDGET_LABEL,
				'label_for'   => self::NEXTIVA_ONE_WIDGET_LABEL,
				'type'        => 'text',
				'placeholder' => esc_html__( 'Update widget label', 'nextivaone' ),
				'default'     => esc_html__( 'Contact Us', 'nextivaone' ),
			]
		);
	}

	protected function widget_field_align(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_WIDGET_LABEL_ALIGN );

		add_settings_field(
			self::NEXTIVA_ONE_WIDGET_LABEL_ALIGN,
			esc_html__( 'Widget Label Align', 'nextivaone' ),
			[ $this, 'render_select_html' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'      => self::NEXTIVA_ONE_WIDGET_LABEL_ALIGN,
				'options' => [
					'left'   => esc_html__( 'Left', 'nextivaone' ),
					'right'  => esc_html__( 'Right', 'nextivaone' ),
					'center' => esc_html__( 'Center', 'nextivaone' ),
				],
			]
		);
	}

	protected function actions_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_BUTTON_ACTION );

		add_settings_field(
			self::NEXTIVA_ONE_BUTTON_ACTION,
			__( 'Button Action(s)', 'nextivaone' ),
			[ $this, 'render_select_html' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'      => self::NEXTIVA_ONE_BUTTON_ACTION,
				'options' => [
					self::NEXTIVA_ONE_BUTTON_ACTION_CALL              => esc_html__( 'Call', 'nextivaone' ),
					self::NEXTIVA_ONE_BUTTON_ACTION_TEXT              => esc_html__( 'Text', 'nextivaone' ),
					self::NEXTIVA_ONE_BUTTON_ACTION_MESSAGE           => esc_html__( 'Message', 'nextivaone' ),
					self::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT         => esc_html__( 'Call & Text', 'nextivaone' ),
					self::NEXTIVA_ONE_BUTTON_ACTION_CALL_MESSAGE      => esc_html__( 'Call & Message', 'nextivaone' ),
					self::NEXTIVA_ONE_BUTTON_ACTION_TEXT_MESSAGE      => esc_html__( 'Text & Message', 'nextivaone' ),
					self::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT_MESSAGE => esc_html__( 'Call, Text & Message', 'nextivaone' ),
				],
			]
		);
	}

	protected function labels_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_BUTTON_LABEL );

		add_settings_field(
			self::NEXTIVA_ONE_BUTTON_LABEL,
			__( 'Button Label(s)', 'nextivaone' ),
			[ $this, 'render_labels_html' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'          => self::NEXTIVA_ONE_BUTTON_LABEL,
				'legend'      => __( 'Button Label(s)', 'nextivaone' ),
				'description' => __( 'The label will determine what text will be displayed on the button(s).', 'nextivaone' ),
			]
		);
	}

	protected function fonts_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_FONTS );

		add_settings_field(
			self::NEXTIVA_ONE_FONTS,
			esc_html__( 'Widget Fonts', 'nextivaone' ),
			[ $this, 'render_toggle' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'      => self::NEXTIVA_ONE_FONTS,
				'options' => [
					0 => esc_html__( 'Plugin fonts', 'nextivaone' ),
					1 => esc_html__( 'Theme default fonts', 'nextivaone' ),
				],
				'html'    => sprintf(
					'<p class="regular-text" data-js="button-type-sticky-content">
						%s
					</p>',
					esc_html__( 'Determine which fonts the widget should use', 'nextivaone' ),
				),
			]
		);
	}

	protected function fonts_color_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_FONTS_COLOR );

		add_settings_field(
			self::NEXTIVA_ONE_FONTS_COLOR,
			esc_html__( 'Widget Fonts Color', 'nextivaone' ),
			[ $this, 'render_color_picker' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id' => self::NEXTIVA_ONE_FONTS_COLOR,
			]
		);
	}

	protected function theme_color_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_THEME_COLOR );

		add_settings_field(
			self::NEXTIVA_ONE_THEME_COLOR,
			esc_html__( 'Widget Theme Color', 'nextivaone' ),
			[ $this, 'render_color_picker' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id' => self::NEXTIVA_ONE_THEME_COLOR,
			]
		);
	}

	protected function header_text_color(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_HEADER_COLOR );

		add_settings_field(
			self::NEXTIVA_ONE_HEADER_COLOR,
			esc_html__( 'Widget Top Line Fonts Color', 'nextivaone' ),
			[ $this, 'render_color_picker' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id' => self::NEXTIVA_ONE_HEADER_COLOR,
			]
		);
	}

	protected function image_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_IMAGE );

		add_settings_field(
			self::NEXTIVA_ONE_IMAGE,
			esc_html__( 'Widget Icon Image', 'nextivaone' ),
			[ $this, 'render_image_field' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'                 => self::NEXTIVA_ONE_IMAGE,
				'no_image_label'     => esc_html__( 'Upload image', 'nextivaone' ),
				'remove_image_label' => esc_html__( 'Remove image', 'nextivaone' ),
				'html'               => sprintf(
					'<p class="regular-text" data-js="button-type-sticky-content">
						%s
					</p>',
					esc_html__( 'NextivaOne icon will be displayed by default', 'nextivaone' ),
				),
			]
		);
	}

	protected function type_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_BUTTON_TYPE );

		add_settings_field(
			self::NEXTIVA_ONE_BUTTON_TYPE,
			__( 'Button Type', 'nextivaone' ),
			[ $this, 'render_toggle' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'      => self::NEXTIVA_ONE_BUTTON_TYPE,
				'options' => [
					0 => __( 'Sticky', 'nextivaone' ),
					1 => __( 'Static', 'nextivaone' ),
				],
				'html'    => sprintf(
					'<p class="regular-text" data-js="button-type-sticky-content">
						%s
					</p>
					<div data-js="button-type-static-content">
						<p class="regular-text">%s</p>
						<pre class="shortcode">[%s]</pre>
					</div>',
					__( 'A sticky button will always display at the same position on the webpage - regardless of how far the page was scrolled.', 'nextivaone' ),
					__( 'The static button can be inserted anywhere on your webpage if you copy the shortcode below.', 'nextivaone' ),
					NextivaOne_Shortcode::NAME
				),
			]
		);
	}

	protected function position_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_BUTTON_POSITION );

		add_settings_field(
			self::NEXTIVA_ONE_BUTTON_POSITION,
			__( 'Button Position', 'nextivaone' ),
			[ $this, 'render_select_html' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'          => self::NEXTIVA_ONE_BUTTON_POSITION,
				'class'       => self::NEXTIVA_ONE_BUTTON_POSITION,
				'options'     => [
					0 => __( 'Bottom Right', 'nextivaone' ),
					1 => __( 'Bottom Left', 'nextivaone' ),
					2 => __( 'Bottom Center', 'nextivaone' ),
					3 => __( 'Full-Width', 'nextivaone' ),
				],
				'description' => __( 'Determines how the sticky call button shows up on your website.', 'nextivaone' ),
			]
		);
	}

	protected function show_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_BUTTON_SHOW );

		add_settings_field(
			self::NEXTIVA_ONE_BUTTON_SHOW,
			__( 'Show Button', 'nextivaone' ),
			[ $this, 'render_toggle' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'      => self::NEXTIVA_ONE_BUTTON_SHOW,
				'class'   => self::NEXTIVA_ONE_BUTTON_SHOW,
				'options' => [
					0 => __( 'On all pages', 'nextivaone' ),
					1 => __( 'On homepage only', 'nextivaone' ),
				],
			]
		);
	}

	protected function popup_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_BUTTON_POPUP );

		add_settings_field(
			self::NEXTIVA_ONE_BUTTON_POPUP,
			__( 'Pop-Up Style', 'nextivaone' ),
			[ $this, 'render_toggle' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'      => self::NEXTIVA_ONE_BUTTON_POPUP,
				'options' => [
					0 => __( 'Slide-in drawer', 'nextivaone' ),
					1 => __( 'Modal window', 'nextivaone' ),
				],
			]
		);
	}

	protected function response_behaviour_field(): void {
		register_setting( self::NEXTIVA_ONE_GROUP, self::NEXTIVA_ONE_BUTTON_RESPONSIVE );

		add_settings_field(
			self::NEXTIVA_ONE_BUTTON_RESPONSIVE,
			__( 'Responsive Behaviour', 'nextivaone' ),
			[ $this, 'render_toggle' ],
			self::NEXTIVA_ONE_GROUP,
			self::NEXTIVA_ONE_BUTTON_SECTION,
			[
				'id'          => self::NEXTIVA_ONE_BUTTON_RESPONSIVE,
				'options'     => [
					0 => __( 'Show on all devices', 'nextivaone' ),
					1 => __( 'Show only on mobile', 'nextivaone' ),
				],
				'description' => __( 'Note: Additional software is needed to call or text on desktop devices so some visitors may experience issues.', 'nextivaone' ),
			]
		);
	}

}
