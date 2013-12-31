<?php

namespace Block\ResponseGenerator;

class UrlBlockToStdClassTest extends \PHPUnit_Framework_TestCase
{

	/** @var ListToStdClass */
	private $generator;

	public function setup()
	{
		$this->generator = new UrlBlockToStdClass;
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testThrowExceptionOnInvalidType()
	{
		$block = $this->getMock('\User\Documents\Block', [], [], '', false, false);
		$response = $this->generator->generate($block);
	}

	public function testGenerate()
	{
		$block = $this->getMock('\User\Documents\UrlBlock', ['getId', 'getType', 'getUrl'], [], '', false, false);
		$block
			->expects($this->once())
			->method('getId')
			->will($this->returnValue(1));
		$block
			->expects($this->once())
			->method('getType')
			->will($this->returnValue('url'));
		$block
			->expects($this->once())
			->method('getUrl')
			->will($this->returnValue('http://www.example.com/'));
		$response = $this->generator->generate($block);
		$this->assertInstanceOf('\stdClass', $response);
		$this->assertCount(3, get_object_vars($response));
		$this->assertEquals(1, $response->id);
		$this->assertEquals('url', $response->type);
		$this->assertEquals('http://www.example.com/', $response->url);
	}
}