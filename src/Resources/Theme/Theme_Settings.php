<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Resources\Theme;

class Theme_Settings {

	/**
	 * @param array $classes
	 *
	 * @return array
	 */
	public function active_theme_class( array $classes = [] ): array {
		$classes[] = 'nexone-active-theme--' . wp_get_theme()->get( 'TextDomain' );

		return $classes;
	}

}
