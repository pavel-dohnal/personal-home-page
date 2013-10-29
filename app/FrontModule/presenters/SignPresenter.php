<?php
namespace FrontModule;

/**
 * Sign in/up/out presenters.
 */
class SignPresenter extends BasePresenter
{

	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

	protected function createComponentSignInForm($name)
	{
		return new \FrontModule\SignInForm($this, $name);
	}

	protected function createComponentSignUpForm($name)
	{
		return new \FrontModule\SignUpForm(
			$this->context->getService('signUpService'),
			$this, 
			$name
		);
	}

}
