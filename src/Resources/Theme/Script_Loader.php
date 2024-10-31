<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Resources\Theme;

use Tribe\NextivaOne\Resources\Loader;

/**
 * Front-end script & style loader.
 */
class Script_Loader extends Loader {

	/**
	 * @action wp_enqueue_scripts
	 */
	public function enqueue(): void {
		wp_enqueue_script( 'nextiva-one-index-js', $this->manifest_loader->get_manifest()['/js/theme/index.js'] );
		wp_enqueue_style( 'nextiva-one-index-css', $this->manifest_loader->get_manifest()['/css/theme/main.css'] );
	}

}
