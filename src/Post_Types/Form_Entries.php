<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Post_Types;

class Form_Entries {

	public const NAME = 'nextivaone_entry';

	public function register(): void {
		register_post_type( self::NAME, $this->get_args() );
	}

	protected function get_args(): array {
		return [
			'hierarchical'     => false,
			'enter_title_here' => esc_html__( 'NextivaONE Form Entries', 'tribe' ),
			'map_meta_cap'     => true,
			'supports'         => [],
			'has_archive'      => false,
			'show_in_menu'     => false,
			'capability_type'  => 'post',
			'show_in_rest'     => false,
		];
	}

}
