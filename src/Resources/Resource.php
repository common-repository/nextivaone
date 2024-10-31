<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Resources;

class Resource {

	protected string $resource_uri;

	public function __construct( string $resource_uri ) {
		$this->resource_uri = $resource_uri;
	}

	public function get_asset_uri( string $path = '' ): string {
		return sprintf( '%s/%s', $this->resource_uri, $path );
	}

}
