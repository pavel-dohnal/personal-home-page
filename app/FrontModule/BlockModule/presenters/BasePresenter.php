<?php

namespace FrontModule\BlockModule;

/**
 * rest presenter for block manipulation
 */
abstract class BasePresenter extends \FrontModule\BaseJsonOutputPresenter
{

	public function startup()
	{		
		parent::startup();
		$user = $this->getUser();
		if (!$user->isLoggedIn()) {
			throw new \Nette\Application\BadRequestException('only authenticated access allowed', 403); 
		}
	}
}