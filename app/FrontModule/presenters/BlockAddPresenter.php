<?php

namespace FrontModule;

class BlockAddPresenter extends BasePresenter
{

	/**
	 * POST action
	 * saves new block
	 */
	public function renderDefault()
	{
		$httpRequestData = $this->context->getService('httpRequestData');
		$inputData = $httpRequestData->getData();
		$this->checkInput($input);
	}

}