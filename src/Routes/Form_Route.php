<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Routes;

use Tribe\NextivaOne\Post_Types\Form_Entries;
use Tribe\NextivaOne\Settings\Button_Settings;

class Form_Route {

	/**
	 * Registers routes.
	 */
	public function register(): void {
		register_rest_route(
			$this->get_project_namespace(),
			'/form/submission',
			[
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => [ $this, 'form_handle' ],
				'permission_callback' => '__return_true',
			]
		);
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function form_handle( \WP_REST_Request $request ) {
		try {
			$params = $request->get_params();
			$params = apply_filters( 'nextivaone/form/submit/before_validation', $params );

			if ( empty( $params['first_last_name'] ) ) {
				return rest_ensure_response( new \WP_Error( 'nextivaone-form-submit', esc_html__( 'First and Last name is invalid.' ), [ 'field' => 'first_last_name' ] ) );
			}

			if ( ! filter_var( $params['email'], FILTER_VALIDATE_EMAIL ) ) {
				return rest_ensure_response( new \WP_Error( 'nextivaone-form-submit', esc_html__( 'Email address not in the correct format' ), [ 'field' => 'email' ] ) );
			}

			if ( empty( $params['subject'] ) ) {
				return rest_ensure_response( new \WP_Error( 'nextivaone-form-submit', esc_html__( 'Subject is invalid.' ), [ 'field' => 'subject' ] ) );
			}

			if ( empty( $params['message'] ) ) {
				return rest_ensure_response( new \WP_Error( 'nextivaone-form-submit', esc_html__( 'Message cannot be empty.' ), [ 'field' => 'message' ] ) );
			}

			if ( strlen( $params['message'] ) > 160 ) {
				return rest_ensure_response( new \WP_Error( 'nextivaone-form-submit', esc_html__( 'Message cannot be longer than 160 characters.' ), [ 'field' => 'message' ] ) );
			}

			if ( ! $this->process_submission( $params ) ) {
				return rest_ensure_response( new \WP_Error( 'nextivaone-form-submit', esc_html__( 'Could not process the form' ), [ 'field' => 'global' ] ) );
			}

			if ( ! $this->send_mail( $params ) ) {
				return rest_ensure_response( new \WP_Error( 'nextivaone-form-submit', esc_html__( 'Could not send email' ), [ 'field' => 'global' ] ) );
			}

			return rest_ensure_response( [
				'success' => true,
				'message' => esc_html__( '', 'nextivaone' ),
			] );
		} catch ( \Throwable $exception ) {
			return rest_ensure_response( new \WP_Error( 'nextivaone-form-submit', esc_html__( 'Could not process the form', 'nextivaone' ), [ 'field' => 'global' ] ) );
		}
	}

	public function get_project_namespace(): string {
		return apply_filters( 'nextivaone/rest_route/namespace', 'nextivaone/v1' );
	}

	protected function process_submission( array $params ): bool {
		$post = wp_insert_post( [
			'post_type'    => Form_Entries::NAME,
			'post_title'   => $params['first_last_name'],
			'post_content' => $params['message'],
		] );

		if ( empty( $post ) || is_wp_error( $post ) ) {
			return false;
		}

		unset( $params['message'] );

		foreach ( $params as $key => $value ) {
			if ( $key === '_wpnonce' ) {
				continue;
			}
			update_post_meta( $post, sprintf( 'nextivaone_entry_%s', $key ), esc_sql( $value ) );
		}

		return true;
	}

	protected function send_mail( array $params ): bool {
		$to_email = get_option( Button_Settings::NEXTIVA_ONE_EMAIL, '' );

		if ( empty( $to_email ) ) {
			return false;
		}

		$subject = sprintf( 'New submission from %s', get_bloginfo( 'name' ) );
		$message = '';

		foreach ( $params as $key => $value ) {
			if ( $key === '_wpnonce' ) {
				continue;
			}

			$message .= sprintf( '<p>%s</p><span>%s</span>', $key === 'first_last_name' ? 'First Last Name' : $key, $value );
		}

		return wp_mail( $to_email, $subject, $message );
	}

}
