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
		$httpRequestService = $this->context->getService('parsedHttpInput');
		$inputData = $httpRequestService->getData();
		$this->checkInput($input);
	}

	private function checkInput($input)
	{
		if (!$this->getHttpRequest()->isMethod('post')) {
			throw new \Nette\Application\BadRequestException('only POST method is allowed', 405);
		}
	}

}