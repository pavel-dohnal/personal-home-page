<?php

namespace User;

class AuthenticatorTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $userStorageFacade;

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $passwordService;

	/** 
	 * @var Authenticator
	 */
	private $authenticator;

	public function setup()
	{
		$this->userStorageFacade = $this->getMock('\User\UserFacade', ['loadByEmailAddress'], [], '', false, false);
		$this->passwordService = $this->getMock('\User\PasswordService', ['validate'], [], '', false, false);
		$this->authenticator = new Authenticator($this->userStorageFacade, $this->passwordService);
	}

	/**
	 * @expectedException \Nette\Security\AuthenticationException
	 * @expectedExceptionMessage The email address is incorrect.
	 * @expectedExceptionCode 1
	 */
	public function testAuthenticateWithUnknownUser()
	{
		$emailAddress = 'a@b.c';
		$password = 'secret';
		$this->userStorageFacade
			->expects($this->once())
			->method('loadByEmailAddress')
			->with($emailAddress)
			->will($this->returnValue(null));
		$this->passwordService
			->expects($this->never())
			->method('validate');
		$this->authenticator->authenticate([$emailAddress, $password]);
	}

	/**
	 * @expectedException \Nette\Security\AuthenticationException
	 * @expectedExceptionMessage The password is incorrect.
	 * @expectedExceptionCode 2
	 */
	public function testAuthenticateWithInvalidPassword()
	{
		$emailAddress = 'a@b.c';
		$password = 'secret';
		$passwordHash = 'hash';
		$user = new \User\Entity\User(new Email($emailAddress), $passwordHash);
		$this->userStorageFacade
			->expects($this->once())
			->method('loadByEmailAddress')
			->with($emailAddress)
			->will($this->returnValue($user));
		$this->passwordService
			->expects($this->once())
			->method('validate')
			->with($this->equalTo($password), $this->equalTo($passwordHash))
			->will($this->returnValue(false));
		$this->authenticator->authenticate([$emailAddress, $password]);
	}

	public function testAuthenticateWithValidCredentials()
	{
		$emailAddress = 'a@b.c';
		$password = 'secret';
		$passwordHash = 'hash';
		$user = new \User\Entity\User(new Email($emailAddress), $passwordHash);
		$this->userStorageFacade
			->expects($this->once())
			->method('loadByEmailAddress')
			->with($emailAddress)
			->will($this->returnValue($user));
		$this->passwordService
			->expects($this->once())
			->method('validate')
			->with($this->equalTo($password), $this->equalTo($passwordHash))
			->will($this->returnValue(true));
		$identity = $this->authenticator->authenticate([$emailAddress, $password]);
		$this->assertEquals($user, $identity);
	}

}