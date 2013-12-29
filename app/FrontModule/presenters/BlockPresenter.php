<?php

namespace FrontModule;

/**
 * simple rest presenter for block manipulation
 * @deprecated Use BlockModule instead
 */
class BlockPresenter extends BaseJsonOutputPresenter
{

	
	public function renderCreateBlock()
	{
		$httpRequestService = $this->context->getService('parsedHttpInput');
		$createBlock = $this->context->getService('createBlockController');
		try {
			$output = $createBlock->run($httpRequestService->getData(), $this->getUser());
			$this->terminateWithResponse($output, 201);
		} catch (\InvalidArgumentException $e) {
			$this->terminateWithError($e->getMessage());
		}
	}
}