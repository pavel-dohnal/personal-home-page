<?php

namespace FrontModule;

class UserInfo extends \Nette\Application\UI\Control
{

	public function render(\Nette\Security\User $user)
	{
		$template = $this->template;
		$template->setFile(__DIR__ . '/userInfo.latte');
		$template->user = $user;
		$template->render();
	}

}
