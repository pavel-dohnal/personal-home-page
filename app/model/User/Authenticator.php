<?php

/**
 * Users authenticator.
 */
class Authenticator extends Nette\Object implements \Nette\Security\IAuthenticator
{

	/** 
	 * @var \UserFacade
	 */
	private $userFacade;

	/** 
	 * @var \PasswordService
	 */
	private $passwordService;

	public function __construct(\UserFacade $userFacade, \PasswordService $passwordService)
	{
		$this->userFacade = $userFacade;
		$this->passwordService = $passwordService;
	}

	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($emailAddress, $password) = $credentials;

		$user = $this->userFacade->loadByEmailAddress($emailAddress);
	
		if (!$user) {
			throw new \Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
		}

		if (!$this->passwordService->validate($password, $user->getPassword())) {
			throw new \Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		}

		return $user;
	}

}