<?php

namespace Block\ResponseGenerator;

class BlockResponseGeneratorFactoryTest extends \PHPUnit_Framework_TestCase
{

	/** @var BlockResponseGeneratorFactory */
	private $factory;

	public function setup()
	{
		$this->factory = new BlockResponseGeneratorFactory;
	}

	public function testReturnsUrlBlockResponseGenerator()
	{
		$response = $this->factory->createResponseGenerator('url');
		$this->assertInstanceOf('Block\ResponseGenerator\UrlBlockToStdClass', $response);
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testThrowExceptionOnInvalidType()
	{
		$this->factory->createResponseGenerator('non-existing-type');
	}
}