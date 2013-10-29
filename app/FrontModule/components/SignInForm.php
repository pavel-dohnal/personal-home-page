<?php

namespace FrontModule;

class SignInForm extends \Nette\Application\UI\Control
{

	/**
	 * @var \SignInService
	 */
	private $signInService;

	public function __construct(\SignInService $signInService, \Nette\ComponentModel\IComponent $parent = NULL, $name = NULL)
	{
		parent::__construct($parent, $name);
		$this->signInService = $signInService;
	}

	public function render()
	{
		$template = $this->template;
		$template->setFile(__DIR__ . '/signInForm.latte');
		$template->render();
	}

	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new \Nette\Application\UI\Form;
			
		$form->addText('email', 'E-mail:')
			->setType('email')
			->setAttribute('placeholder', 'enter email')
			->setRequired('Please enter your email.')
			->addRule(\Nette\Forms\Form::EMAIL, 'Please enter a valid email address.');

		$form->addPassword('password', 'Password:')
			->setRequired('Please enter your password.');

		$form->addCheckbox('remember', 'Keep me signed in');

		$form->addSubmit('send', 'Sign in');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}

	public function signInFormSucceeded($form)
	{
		$values = $form->getValues();
		try {
			$this->signInService->signIn($values, $this->presenter->getUser());
			$this->presenter->redirect(':Front:Homepage:default');
		} catch (\Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
}