<?php

namespace FrontModule;

class SignUpForm extends \Nette\Application\UI\Control
{

	/**
	 * @var \SignUpService
	 */
	private $signUpService;

	/**
	 * @var \SignInService
	 */
	private $signInService;

	public function __construct(
		\SignUpService $signUpService, 
		\SignInService $signInService, 
		\Nette\ComponentModel\IComponent $parent = NULL, 
		$name = NULL
	)
	{
		parent::__construct($parent, $name);
		$this->signUpService = $signUpService;
		$this->signInService = $signInService;
	}

	public function render()
	{
		$template = $this->template;
		$template->setFile(__DIR__ . '/signUpForm.latte');
		$template->render();
	}

	/**
	 * Sign-up form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignUpForm()
	{
		$form = new \Nette\Application\UI\Form;
			
		$form->addText('email', 'E-mail*:')
			->setType('email')
			->setAttribute('placeholder', 'enter email')
			->setRequired('Please enter your email.')
			->addRule(\Nette\Forms\Form::EMAIL, 'Please enter a valid email address.');

		$form->addText('name', 'Name:')
			->setAttribute('placeholder', 'enter name (optional)');

		$form->addPassword('password', 'Password*:')
			->setRequired('Please enter your password.');

		$form->addPassword('password_retype', 'Password again*:')
			->setRequired('Please retype your password.')
			->addRule(\Nette\Forms\Form::EQUAL, 'Passwords don\'t match.', $form['password']);

		$form->addCheckbox('remember', 'Keep me signed in');

		$form->addSubmit('send', 'Sign up');

		$form->onSuccess[] = $this->signUpFormSucceeded;
		return $form;
	}

	public function signUpFormSucceeded($form)
	{
		$values = $form->getValues();

		try {
			$this->signUpService->signUp($values);
			$this->signInService->signIn($values, $this->presenter->getUser());
			$this->presenter->redirect(':Front:Homepage:default');
		} catch (\ESignUp $e) {
			$form->addError($e->getMessage());
		} catch (\Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
