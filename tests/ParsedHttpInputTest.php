<?php

class ParsedHttpInputTest extends PHPUnit_Framework_TestCase
{

	/** @var \PasswordService */
	private $parsedHttpInput;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	private $httpRequestData;

	public function setup()
	{
		$this->httpRequestData = $this->getMock('\HttpRequestData', ['getData']);
		$this->parsedHttpInput = new \ParsedHttpInput($this->httpRequestData);
	}

	public function testInvalidInput()
	{
		$this->httpRequestData
			->expects($this->once())
			->method('getData')
			->will($this->returnValue('{"invalid": }'));
		$data = $this->parsedHttpInput->getData();
		$this->assertNull($data);
	}

	public function testValidInput()
	{
		$this->httpRequestData
			->expects($this->once())
			->method('getData')
			->will($this->returnValue('{"valid": "input"}'));
		$data = $this->parsedHttpInput->getData();
		$this->assertEquals('input', $data->valid);
	}
}
