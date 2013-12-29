<?php

class RouterFactoryTest extends \PHPUnit_Framework_TestCase
{

	/** 
	 * @var RouterFactory
	 */
	private $routerFactory;

	public function setup()
	{
		$this->routerFactory = new RouterFactory();
	}

	public function testReturnRouteList()
	{
		$router = $this->routerFactory->createRouter();
		$this->assertInstanceOf('Nette\Application\Routers\RouteList', $router);
	}

	public function testReturnAtLeastTwoRoutesInList()
	{
		$router = $this->routerFactory->createRouter();
		$this->assertGreaterThan(1, count($router));
	}
}