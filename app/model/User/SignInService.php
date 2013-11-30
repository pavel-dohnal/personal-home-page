<?php

namespace User;

class SignInService
{

	const SIGN_EXPIRATION = '20 minutes';
	
	const SIGN_FOREVER_EXPIRATION = '1 year';

	/**
	 * @throws \Nette\Security\AuthenticationException
	 */
	public function signIn(\Nette\ArrayHash $formValues, \Nette\Security\User $user)
	{
		if ($formValues->remember) {
			$user->setExpiration(self::SIGN_FOREVER_EXPIRATION, FALSE);
		} else {
			$user->setExpiration(self::SIGN_EXPIRATION, TRUE);
		}

		$user->login($formValues->email, $formValues->password);
	}

}