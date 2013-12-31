<?php

namespace FrontModule\BlockModule;

class ListPresenter extends BasePresenter
{

	/** 
	 * @var \Block\ListBlocksController
	 */
	private $listBlocksController;

	public function __construct(\Block\ListBlocksController $listBlocksController)
	{
		$this->listBlocksController = $listBlocksController;
	}

	public function renderDefault()
	{		
		$output = $this->listBlocksController->run($this->getUser()->getIdentity());
		$this->terminateWithResponse($output);
	}
}