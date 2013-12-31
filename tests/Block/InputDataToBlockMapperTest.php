<?php

namespace Block;

class InputDataToBlockMapperTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $validatorFactory;

	/**
	 * @var InputDataToBlockMapper
	 */
	private $mapper;
	
	public function setup()
	{
		$this->validatorFactory = $this->getMock('\Block\Validator\ValidatorFactory', ['createValidator'], [], '', false, false);		
		$this->mapper = new InputDataToBlockMapper($this->validatorFactory);
	}

	/**
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage invalid input
	 */
	public function testInvalidInput()
	{
		$input = new \stdClass;
		$validator = $this->getMock('\Block\Validator\UrlValidator', ['validate'], [], '', false, false);
		$validator
			->expects($this->once())
			->method('validate')
			->with($input)
			->will($this->throwException(new \Block\Validator\EValidation('invalid input')));
		$this->validatorFactory
			->expects($this->once())
			->method('createValidator')
			->with($input)
			->will($this->returnValue($validator));
		$this->mapper->map($input);
	}

	public function testValidUrlBlock()
	{
		$input = new \stdClass;
		$input->type = 'url';
		$input->url = 'http://www.example.com/';
		$validator = $this->getMock('\Block\Validator\UrlValidator', ['validate'], [], '', false, false);
		$validator
			->expects($this->once())
			->method('validate')
			->with($input)
			->will($this->returnValue(true));
		$this->validatorFactory
			->expects($this->once())
			->method('createValidator')
			->with($input)
			->will($this->returnValue($validator));
		$entity = $this->mapper->map($input);
		$this->assertInstanceOf('\User\Documents\UrlBlock', $entity);
		$this->assertEquals('http://www.example.com/', $entity->getUrl());
	}
}