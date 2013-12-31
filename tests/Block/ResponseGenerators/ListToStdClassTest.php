<?php

namespace Block\ResponseGenerator;

class ListToStdClassTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $factory;

	/** @var ListToStdClass */
	private $responseGenerator;

	public function setup()
	{
		$this->factory = $this->getMock('\Block\ResponseGenerator\BlockResponseGeneratorFactory', ['createResponseGenerator'], [], '', false, false);
		$this->responseGenerator = new ListToStdClass($this->factory);
	}

	public function testGenerate()
	{
		$blocks = [
			$this->getMock('\User\Documents\UrlBlock', ['getType'], [], '', false, false),
			$this->getMock('\User\Documents\UrlBlock', ['getType'], [], '', false, false),
		];
		$blocks[0]
			->expects($this->once())
			->method('getType')
			->will($this->returnValue('type1'));
		$blocks[1]
			->expects($this->once())
			->method('getType')
			->will($this->returnValue('type2'));
		$responseGenerator1 = $this->getMock('\Block\ResponseGenerator\UrlBLockToStdClass', ['generate'], [], '', false, false);
		$responseGenerator1
			->expects($this->once())
			->method('generate')
			->with($this->identicalTo($blocks[0]))
			->will($this->returnValue(new \stdClass));
		$responseGenerator2 = $this->getMock('\Block\ResponseGenerator\UrlBLockToStdClass', ['generate'], [], '', false, false);
		$responseGenerator2
			->expects($this->once())
			->method('generate')
			->with($this->identicalTo($blocks[1]))
			->will($this->returnValue(new \stdClass));;
		$this->factory
			->expects($this->exactly(2))
			->method('createResponseGenerator')
			->will($this->onConsecutiveCalls($responseGenerator1, $responseGenerator2));
		$this->factory
			->expects($this->at(0))
			->method('createResponseGenerator')
			->with('type1');
		$this->factory
			->expects($this->at(1))
			->method('createResponseGenerator')
			->with('type2');
		$response = $this->responseGenerator->generate($blocks);
		$this->assertCount(2, $response);
		$this->assertInstanceOf('\stdClass', reset($response));
		$this->assertInstanceOf('\stdClass', end($response));
	}

}