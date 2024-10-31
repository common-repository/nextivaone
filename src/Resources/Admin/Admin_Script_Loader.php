<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Resources\Admin;

use Tribe\NextivaOne\Resources\Loader;

/**
 * wp-admin/dashboard script & style loader.
 */
class Admin_Script_Loader extends Loader {

	/**
	 * @action admin_enqueue_scripts
	 */
	public function enqueue(): void {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_register_script( 'nextiva-one-admin-index-js', $this->manifest_loader->get_manifest()['/js/admin/index.js'], [ 'jquery', 'wp-color-picker' ] );
		wp_localize_script( 'nextiva-one-admin-index-js', 'nextivaone', [
			'localization' => apply_filters( 'nextivaone/localization/admin/js', [
				'image' => [
					'remove_image_label' => esc_html__( 'Remove image', 'nextivaone' ),
					'upload_image_label' => esc_html__( 'Upload image', 'nextivaone' ),
				],
			] ),
		] );
		wp_enqueue_script( 'nextiva-one-admin-index-js' );
		wp_enqueue_style( 'nextiva-one-admin-main-css', $this->manifest_loader->get_manifest()['/css/admin/main.css'] );
	}

}
