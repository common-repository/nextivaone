<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Activation;

/**
 * Implement for activators/deactivators.
 *
 * @package Tribe\NextivaOne
 */
interface Operable {

	public const OPTION_NAME = 'tribe_nextivaone';

	/**
	 * @param  bool  $network_wide Pass via WordPress if this is a network activation
	 */
	public function __invoke( bool $network_wide = false ): void;

}
