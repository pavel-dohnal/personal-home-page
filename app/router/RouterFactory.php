<?php

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		$router[] = new \BlockRouter;
		$router[] = new Route('<presenter>/<action>[/<id>]', [
			'module' => 'Front',
			'presenter' => 'Homepage',
			'action' => 'default',
		]);
		return $router;
	}

}
