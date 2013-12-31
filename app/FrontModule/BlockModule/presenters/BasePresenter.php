<?php

namespace FrontModule\BlockModule;

/**
 * base presenter for block module
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