<?php

namespace FrontModule;

class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$user = $this->getUser();
		$user->isLoggedIn();
	}

}
