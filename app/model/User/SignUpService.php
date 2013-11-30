<?php

namespace User;

class ESignUp extends \Exception{}

class SignUpService
{

	/** 
	 * @var StorageFacade
	 */
	private $userStorageFacade;

	/** 
	 * @var \PasswordService
	 */
	private $passwordService;

	public function __construct(StorageFacade $userStorageFacade, PasswordService $passwordService)
	{
		$this->userStorageFacade = $userStorageFacade;
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
		$this->checkInputParams($formValues);
		$this->checkUserExists($formValues->email);		
		try {
			$newUser = $this->createUser($formValues);
			$this->userStorageFacade->save($newUser);
			return $newUser;
		} catch (EEmailValidation $e) {
			throw new ESignUp($e->getMessage(), 0, $e);
		}
	}

	private function checkUserExists($emailAddress)
	{
		$existingUser = $this->userStorageFacade->loadByEmailAddress($emailAddress);
		if ($existingUser) {
			throw new ESignUp('A user already exists with this email address');
		}	
	}

	private function createUser(\Nette\ArrayHash $formValues)
	{
		$email = new Email($formValues->email);
		$newUser = new \User\Entity\User($email, $this->passwordService->getHash($formValues->password));
		if ($formValues->name) {
			$newUser->setName($formValues->name);
		}
		return $newUser;
	}

	private function checkInputParams(\Nette\ArrayHash $formValues)
	{
		if (
			!isset($formValues->email) 
			|| !isset($formValues->password)
			|| !isset($formValues->name)
		) {
			throw new \InvalidArgumentException('Missing required input parameter.');
		}

	}

}