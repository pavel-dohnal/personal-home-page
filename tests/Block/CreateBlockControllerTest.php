<?php

namespace Block;

class CreateBlockControllerTest extends \PHPUnit_Framework_TestCase
{

	/** @var PHPUnit_Framework_MockObject_MockObject */
	private $mapper;

	/** @var PHPUnit_Framework_MockObject_MockObject */
	private $facade;

	/** @var CreateBlockController */
	private $controller;

	public function setup()
	{
		$this->facade = $this->getMock('\Block\CreateBlockFacade', ['setBlock', 'saveBlock'], [], '', false, false);
		$this->mapper = $this->getMock('\Block\InputDataToBlockMapper', ['map'], [], '', false, false);
		$this->controller = new CreateBlockController($this->mapper, $this->facade);
	}

	public function testRun()
	{
		$id = 'abcd123';
		$input = new \stdClass;
		$input->type = 'url';
		$input->url = 'http://example.com';
		$block = $this->getMock('\User\Documents\UrlBlock', [], [], '', false, false);
		$block
			->expects($this->once())
			->method('getId')
			->will($this->returnValue($id));
		$user = $this->getMock('\User\Entity\User', [], [], '', false, false);
		$this->mapper
			->expects($this->once())
			->method('map')
			->with($input)
			->will($this->returnValue($block));
		$this->facade
			->expects($this->once())
			->method('setBlock')
			->with($block);
		$this->facade
			->expects($this->once())
			->method('saveBlock')
			->with($user);
		$return = $this->controller->run($user, $input);
		$this->assertInstanceOf('\stdClass', $return);
		$this->assertEquals($id, $return->created);
	}
}