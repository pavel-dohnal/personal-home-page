<?php

class ESignUp extends Exception{}

class SignUpService
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
	 * Sign up a new user. 
	 * @param \Nette\ArrayHash $formValues
	 * @return \User
	 * @throws ESignUp
	 */
	public function signUp(\Nette\ArrayHash $formValues)
	{
		$this->checkUserExists($formValues->email);		
		try {
			$newUser = $this->createUser($formValues);
			$this->userFacade->save($newUser);
			return $newUser;
		} catch (\EEmailValidation $e) {
			throw new ESignUp($e->getMessage(), 0, $e);
		}
	}

	private function checkUserExists($emailAddress)
	{
		$existingUser = $this->userFacade->loadByEmailAddress($emailAddress);
		if ($existingUser) {
			throw new ESignUp('A user already exists with this email address');
		}	
	}

	private function createUser(\Nette\ArrayHash $formValues)
	{
		$email = new \Email($formValues->email);
		$newUser = new \User($email, $this->passwordService->getHash($formValues->password));
		if ($formValues->name) {
			$newUser->setName($formValues->name);
		}
		return $newUser;
	}

}