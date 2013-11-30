<?php

namespace User;

class SignUpServiceTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $userFacade;

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $passwordService;

	/** 
	 * @var SignUpService
	 */
	private $signUpService;

	public function setup()
	{
		$this->userFacade = $this->getMock('User\StorageFacade', array('loadByEmailAddress', 'save'), array(), '', false, false);
		$this->passwordService = $this->getMock('User\PasswordService', array('getHash'), array(), '', false, false);
		$this->signUpService = new SignUpService($this->userFacade, $this->passwordService);
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testCallWithInvalidData()
	{
		$this->signUpService->signUp(\Nette\ArrayHash::from([
			'email' => 'asdf@asd.sd', 
		]));
	}

	/**
	 * @expectedException \User\ESignUp
	 * @expectedExceptionMessage A user already exists with this email address
	 */
	public function testSignUpWithExistingUser()
	{
		$emailAddress = 'a@b.c';
		$password = 'secret';
		$passwordHash = 'hash';
		$user = new \User\Entity\User(new Email($emailAddress), $passwordHash);
		$this->userFacade
			->expects($this->once())
			->method('loadByEmailAddress')
			->with($emailAddress)
			->will($this->returnValue($user));
		$this->passwordService
			->expects($this->never())
			->method('getHash');
		$this->signUpService->signUp(\Nette\ArrayHash::from([
			'email' => $emailAddress, 
			'password' => $password,
			'name' => '',
		]));
	}

	/**
	 * @expectedException \User\ESignUp
	 * @expectedExceptionMessage Email address a is not valid.
	 */
	public function testSignUpWithInvalidEmailAddress()
	{
		$emailAddress = 'a';
		$password = 'secret';
		$this->userFacade
			->expects($this->once())
			->method('loadByEmailAddress')
			->with($emailAddress)
			->will($this->returnValue(null));
		$this->passwordService
			->expects($this->never())
			->method('getHash');
		$this->signUpService->signUp(\Nette\ArrayHash::from([
			'email' => $emailAddress, 
			'password' => $password,
			'name' => '',
		]));
	}

	public function testSignUp()
	{
		$emailAddress = 'a@c.b';
		$password = 'secret';
		$this->userFacade
			->expects($this->once())
			->method('loadByEmailAddress')
			->with($emailAddress)
			->will($this->returnValue(null));
		$this->userFacade
			->expects($this->once())
			->method('save');
		$this->passwordService
			->expects($this->once())
			->method('getHash')
			->with($this->equalTo($password));
		$this->signUpService->signUp(\Nette\ArrayHash::from([
			'email' => $emailAddress, 
			'password' => $password,
			'name' => '',
		]));
	}	

}