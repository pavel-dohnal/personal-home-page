<?php

namespace User;

class EmailTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @dataProvider validEmailAddress
	 */
	public function testValidEmailAddress($emailAddress)
	{
		$email = new Email($emailAddress);
		$this->assertEquals(trim($emailAddress), (string)$email);
	}

	public function validEmailAddress()
	{
		return [
			['a@b.c'],
			['asdf@192.168.0.1 '],
			['asdf@gmail.com'],
			['asdf@app'],
			['asdf@شبكة'],
		];
	}

	/**
	 * @expectedException \User\EEmailValidation
	 * @dataProvider invalidEmailAddress
	 */
	public function testInvalidEmailAddress($emailAddress)
	{
		$email = new Email($emailAddress);
		$this->assertEquals($emailAddress, (string)$email);
	}

	public function invalidEmailAddress()
	{
		return [
			['a@b c'],
			['asdf'],
		];
	}

}
