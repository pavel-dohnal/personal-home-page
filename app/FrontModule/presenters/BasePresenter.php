<?php

namespace FrontModule;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter
{

	/**
	 * @return Nette\Security\User
	 */
	public function getUser()
	{
		//TODO refresh user from database. 
		return parent::getUser();
	}

	public function beforeRender()
	{
		$this->template->user = $this->getUser();
	}

	public function createComponentUserInfo($name)
	{
		return new \FrontModule\UserInfo($this, $name);
	}

}
