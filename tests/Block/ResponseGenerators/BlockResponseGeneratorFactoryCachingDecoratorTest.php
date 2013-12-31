<?php

namespace Block\ResponseGenerator;

class BlockResponseGeneratorFactoryCachingDecoratorTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $factory;

	/** @var BlockResponseGeneratorFactoryCachingDecorator */
	private $factoryDecorator;

	public function setup()
	{
		$this->factory = $this->getMock('\Block\ResponseGenerator\BlockResponseGeneratorFactory', ['createResponseGenerator'], [], '', false, false);
		$this->factoryDecorator = new BlockResponseGeneratorFactoryCachingDecorator($this->factory);
	}

	public function testReturnsGeneratedResponseGenerator()
	{
		$type = 'type';
		$responseGenerator = $this->getMock('Block\ResponseGenerator\UrlBLockToStdClass');
		$this->factory
			->expects($this->once())
			->method('createResponseGenerator')
			->with($type)
			->will($this->returnValue($responseGenerator));
		$result = $this->factoryDecorator->createResponseGenerator($type);
		$this->assertSame($responseGenerator, $result);
	}

	public function testCallFactoryOnce()
	{
		$type = 'type';
		$responseGenerator = $this->getMock('Block\ResponseGenerator\UrlBLockToStdClass');
		$this->factory
			->expects($this->once())
			->method('createResponseGenerator')
			->with($type)
			->will($this->returnValue($responseGenerator));
		$result1 = $this->factoryDecorator->createResponseGenerator($type);
		$result2 = $this->factoryDecorator->createResponseGenerator($type);
		$this->assertSame($responseGenerator, $result1);
		$this->assertSame($result1, $result2);
	}
}
