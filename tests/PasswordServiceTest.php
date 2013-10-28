<?php

class PasswordServiceTest extends PHPUnit_Framework_TestCase
{

	/** 
	 * @var \PasswordService
	 */
	private $passwordService;

	public function setup()
	{
		$this->passwordService = new \PasswordService;
	}

	public function testGetHash()
	{
		$password = 'realy secret password';
		$hash = $this->passwordService->getHash($password);
		$this->assertNotEquals($hash, $password);
		$this->assertGreaterThanOrEqual(32, strlen($hash));
	}

	public function testValidate()
	{
		$password = 'super secret password';
		$hash = $this->passwordService->getHash($password);
		$this->assertTrue($this->passwordService->validate($password, $hash));
	}

	public function testValidationShouldFailed()
	{
		$password = 'super secret password';
		$password2 = 'super secret passworc';
		$hash = $this->passwordService->getHash($password);
		$hash2 = $this->passwordService->getHash($password2);
		$this->assertFalse($this->passwordService->validate($password, $hash2));
	}

}
