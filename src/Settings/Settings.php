<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Settings;

abstract class Settings {

	public const NEXTIVA_ONE_GROUP = 'nextiva-one-settings';

	abstract public function register_settings(): void;

	/**
	 * @param array $args
	 */
	public function field_checkbox( array $args ): void {
		$value = get_option( $args['id'] );
		printf(
			'<fieldset class="nextiva-one__settings-group">
				<legend class="screen-reader-text"><span>%1$s</span></legend>
				<label class="nextiva-one__settings-label" for="%2$s">
					<input name="%2$s" type="checkbox" id="%2$s" value="1" %3$s />
					%4$s
				</label>
			</fieldset>',
			$args['legend'],
			esc_attr( $args['label_for'] ),
			checked( $value, true, false ),
			esc_html( $args['label_description'] )
		);

		$this->get_description( $args );
	}

	/**
	 * @param array $args
	 */
	public function get_description( array $args ): void {
		if ( empty( $args['description'] ) ) {
			return;
		}

		printf(
			'<p class="regular-text">%s</p>',
			esc_html( $args['description'] )
		);
	}

	/**
	 * @param array $args
	 */
	public function get_html_content( array $args ): void {
		if ( empty( $args['html'] ) ) {
			return;
		}

		printf( $args['html'] );
	}

	/**
	 * @param array $args
	 */
	public function field_html( array $args ): void {
		$text         = get_option( $args['id'], $args['default'] ?? '' );
		$hidden_field = '';

		if ( ! empty( $args['phone'] ) && preg_match( '/^(\d{3})(\d{3})(\d.+)/', $text, $matches ) ) {
			$text         = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
			$text         = apply_filters( 'nextivaone/field/format', $text, $args );
			$country_data = get_option( Button_Settings::NEXTIVA_ONE_COUNTRY, [] );
			$hidden_field = sprintf( '<input type="hidden" id="%1$s_%2$s" value="%3$s" name="%1$s_%2$s" />', esc_attr( $args['id'] ), 'country_code', htmlentities( json_encode( $country_data ) ) );
		}

		printf(
			'<fieldset class="nextiva-one__settings-group">
				<input type="%1$s" id="%2$s" name="%2$s" value="%3$s" placeholder="%4$s" class="regular-text nextiva-one__settings-field" data-js="%2$s" />
				%5$s
			</fieldset>',
			esc_attr( $args['type'] ),
			esc_attr( $args['id'] ),
			esc_attr( $text ),
			esc_attr( $args['placeholder'] ),
			$hidden_field
		);

		$this->get_description( $args );
		$this->get_html_content( $args );
	}

	/**
	 * @param array $args
	 */
	public function render_select_html( array $args ): void {
		$current = get_option( $args['id'], 0 );

		printf( '<fieldset class="nextiva-one__settings-group"><select name="%s" class="regular-text nextiva-one__settings-field" data-js="%s">', esc_attr( $args['id'] ), esc_attr( $args['id'] ) );

		foreach ( $args['options'] as $key => $option ) {
			printf(
				'<option value="%s" %s>%s</option>',
				esc_attr( $key ),
				selected( $current, $key, false ),
				$option
			);
		}

		printf( '</select></fieldset>' );

		$this->get_description( $args );
	}

	/**
	 * @param array $args
	 */
	public function render_toggle( array $args ): void {
		$current = get_option( $args['id'], 0 );

		printf( '<fieldset class="nextiva-one__settings-group">' );
		foreach ( $args['options'] as $key => $option ) {
			printf(
				'<p><label><input type="radio" name="%s" value="%d" %s data-js="%1$s" /> %s</label></p>',
				esc_attr( $args['id'] ),
				$key,
				checked( $key, ( int ) $current, false ),
				$option
			);
		}
		printf( '</fieldset>' );

		$this->get_description( $args );
		$this->get_html_content( $args );
	}

	public function render_color_picker( array $args ): void {
		$current = get_option( $args['id'], '#ffffff' );

		printf( '<fieldset class="nextiva-one__settings-group">' );
		printf(
			'<input type="text" id="%1$s" name="%1$s" value="%2$s" class="regular-text nextiva-one__settings-field nextiva-one--color-picker" data-js="" />',
			$args['id'],
			$current
		);
		printf( '</fieldset>' );

		$this->get_description( $args );
		$this->get_html_content( $args );
	}

	public function render_image_field( array $args ): void {
		$current = get_option( $args['id'], 0 );
		$image   = wp_get_attachment_image_url( $current, 'medium' );
		printf( '<fieldset class="nextiva-one__settings-group">' );
		if ( empty( $image ) ) {
			printf( '<a href="#" class="button nextiva-one__upload">%s</a>', $args['no_image_label'] );
			printf( '<br /><a href="#" class="nextiva-one__image-remove" style="display:none;">%s</a>', $args['remove_image_label'] );
			printf( '<input type="hidden" class="%1$s" name="%1$s" value="">', $args['id'] );
		} else {
			printf( '<a href="#" class="nextiva-one__settings nextiva-one__upload"><img class="nextiva-one__image-preview" src="%s" /></a>', $image );
			printf( '<br /><a href="#" class="nextiva-one__image-remove">%s</a>', $args['remove_image_label'] );
			printf( '<input type="hidden" class="%1$s" name="%1$s" value="%2$d">', $args['id'], absint( $current ) );
		}

		printf( '</fieldset>' );

		$this->get_description( $args );
		$this->get_html_content( $args );
	}

}
