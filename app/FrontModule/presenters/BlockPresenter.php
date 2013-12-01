<?php

namespace FrontModule;

/**
 * simple rest presenter for block manipulation
 */
class BlockPresenter extends BasePresenter
{

	public function startup()
	{		
		parent::startup();		
		$this->changeActionByHttpMethod();		
		$user = $this->getUser();
		if (!$user->isLoggedIn()) {
			throw new \Nette\Application\BadRequestException('only authenticated access allowed', 403); 
		}
	}

	private function changeActionByHttpMethod()
	{
		$method = $this->request->getMethod();
		switch ($method) {
			case 'DELETE':
				$this->changeAction('deleteBlock');
				break;
			case 'POST':
				$this->changeAction('createBlock');
				break;
			case 'PUT':
				$this->changeAction('updateBlock');
				break;
			default:
				$this->changeAction('default');
				break;
		}
	}

	public function renderDefault()
	{
		//TODO devel only, delete this method
		$userBlocks = new \User\Documents\UserBlocks($this->getUser()->getIdentity()->getId());
		$userBlocks->addBlock(new \User\Documents\UrlBlock(new \Nette\Http\Url('http://www.gooble.com')));
		$dm = $this->context->getService('documentManager');
		$dm->persist($userBlocks);
		$dm->flush();
		die;
	}

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

	public function renderUpdateBlock()
	{
		$httpRequestService = $this->context->getService('parsedHttpInput');
		$inputData = $httpRequestService->getData();
		$user = $this->getUser();

	}

	public function renderDeleteBlock()
	{
		
	}

}