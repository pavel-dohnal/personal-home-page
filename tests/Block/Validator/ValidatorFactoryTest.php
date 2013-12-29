<?php

namespace Block\Validator;

class ValidatorFactoryTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var ValidatorFactory
	 */
	private $validatorFactory;

	public function setup()
	{
		$this->validatorFactory = new ValidatorFactory;
	}

	/**
	 * @expectedException \Block\Validator\EValidation
	 * @expectedExceptionMessage Missing input data.
	 */
	public function testNoInput()
	{
		$input = null;
		$this->validatorFactory->createValidator($input);
	}

	/**
	 * @expectedException \Block\Validator\EValidation
	 * @expectedExceptionMessage Type parameter is mandatory.
	 */
	public function testMissingTypeParameter()
	{
		$input = new \stdClass;
		$input->url = 'http://www.example.com';
		$this->validatorFactory->createValidator($input);
	}

	public function testUrlBlockValidator()
	{
		$input = new \stdClass;
		$input->url = 'http://www.example.com';
		$input->type = 'url';
		$validator = $this->validatorFactory->createValidator($input);
		$this->assertInstanceOf('\Block\Validator\UrlValidator', $validator);
	}

}