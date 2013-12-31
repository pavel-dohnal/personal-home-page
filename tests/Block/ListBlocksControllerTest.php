<?php

namespace Block;

class ListBlocksControllerTest extends \PHPUnit_Framework_TestCase
{
	/** @var PHPUnit_Framework_MockObject_MockObject */
	private $responseGenerator;

	/** @var PHPUnit_Framework_MockObject_MockObject */
	private $facade;

	/** @var ListBlocksController */
	private $controller;

	public function setup()
	{
		$this->facade = $this->getMock('\Block\ListBlocksFacade', ['getBlocksByUser'], [], '', false, false);
		$this->responseGenerator = $this->getMock('\Block\ResponseGenerator\ListToStdClass', ['generate'], [], '', false, false);
		$this->controller = new ListBlocksController($this->facade, $this->responseGenerator);
	}

	public function testRun()
	{
		$user = $this->getMock('\User\Entity\User', [], [], '', false, false);
		$blocks = [
			$this->getMock('\User\Documents\UrlBlock', [], [], '', false, false),
			$this->getMock('\User\Documents\UrlBlock', [], [], '', false, false),
		];
		$this->facade
			->expects($this->once())
			->method('getBlocksByUser')
			->with($user)
			->will($this->returnValue($blocks));
		$this->responseGenerator
			->expects($this->once())
			->method('generate')
			->with($blocks)
			->will($this->returnValue([new \stdClass, new \stdClass]));
		$result = $this->controller->run($user);
		$this->assertCount(2, $result);
		$this->assertInstanceOf('\stdClass', reset($result));
		$this->assertInstanceOf('\stdClass', end($result));
	}

}