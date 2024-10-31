<?php declare(strict_types=1);

namespace Tribe\NextivaOne\Post_Types;

use Tribe\Libs\Container\Abstract_Subscriber;

class Post_Type_Subscriber extends Abstract_Subscriber {

	public function register(): void {
		add_action( 'init', function (): void {
			$this->container->get( Form_Entries::class )->register();
		}, 10, 0 );
	}

}
