<?php

namespace Block\Validator;

class UrlValidatorTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var UrlValidator
	 */
	private $urlValidator;

	public function setup()
	{
		$this->urlValidator = new UrlValidator;
	}
	
	/**
	 * @expectedException \Block\Validator\EValidation
	 * @expectedExceptionMessage Url is mandatory.
	 */
	public function testCreateMissingUrlParameter()
	{
		$input = new \stdClass;
		$input->type = 'url';
		$this->urlValidator->validate($input);
	}

	/**
	 * @expectedException \Block\Validator\EValidation
	 * @expectedExceptionMessage Type parameter is mandatory.
	 */
	public function testMissingTypeParameter()
	{
		$input = new \stdClass;
		$input->url = 'xxx';
		$this->urlValidator->validate($input);
	}

	/**
	 * @expectedException \Block\Validator\EValidation
	 */
	public function testWrongType()
	{
		$input = new \stdClass;
		$input->type = 'wrongType';
		$input->url = 'http://www.example.com';
		$this->urlValidator->validate($input);
	}

	/**
	 * @expectedException \Block\Validator\EValidation
	 * @expectedExceptionMessage Malformed Url.
	 */
	public function testInvalidUrl()
	{
		$input = new \stdClass;
		$input->type = 'url';
		$input->url = 'http/www.example.com';
		$this->urlValidator->validate($input);
	}
}