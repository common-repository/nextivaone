<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Settings;

use Tribe\NextivaOne\Resources\Resource;
use Tribe\NextivaOne\Template;

class Banner extends Template {

	public const SHOW_BANNER = 'nextiva.one.show_banner';
	public const HIDE_BANNER = 'nextiva_one_hide_banner';

	protected string $path = '/resources/views/admin/banner.php';
	protected Resource $resource;

	public function __construct( Resource $resource ) {
		$this->resource = $resource;
	}

	public function render(): void {
		if ( ! $this->should_show_banner() || ! empty( get_option( Button_Settings::NEXTIVA_ONE_BANNER_HIDE, 0 ) ) ) {
			return;
		}

		$data = [
			'url'                     => add_query_arg( [ 'action' => self::HIDE_BANNER, '_wpnonce' => wp_create_nonce( self::HIDE_BANNER ) ], admin_url( 'admin-post.php' ) ),
			'admin_banner_cutout_uri' => $this->resource->get_asset_uri( 'images/admin/nextiva-one-admin-plugin-banner-cutout.png' ),
			'settings_url'            => esc_url( add_query_arg( [ 'page' => 'nextiva-one-settings' ], admin_url( 'admin.php' ) ) ),
		];

		echo $this->get_content( $data );
	}

	public function dismiss(): void {
		$submission = filter_var_array( $_GET, [
			'_wpnonce' => FILTER_SANITIZE_STRING,
		] );

		if ( empty( $submission['_wpnonce'] ) || ! wp_verify_nonce( $submission['_wpnonce'], self::HIDE_BANNER ) ) {
			throw new \InvalidArgumentException( __( 'Invalid request. Please try again.', 'nextivaone' ), 403 );
		}

		update_user_meta( get_current_user_id(), self::SHOW_BANNER, 1 );
		wp_safe_redirect( $_SERVER['HTTP_REFERER'], 303 );
		// phpcs:ignore SlevomatCodingStandard.ControlStructures.LanguageConstructWithParentheses.UsedWithParentheses
		exit();
	}

	protected function should_show_banner(): bool {
		global $pagenow;

		return empty( get_user_meta( get_current_user_id(), self::SHOW_BANNER, true ) ) && ( $pagenow === 'index.php' || $pagenow === 'plugins.php' );
	}

}
