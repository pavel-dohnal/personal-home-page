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
		$this->detectAction();
		$user = $this->getUser()
		if ($user->isLoggedIn()) {
			throw new \Nette\Application\BadRequestException('only authenticated access allowed', 403); 
		}
	}

	private function detectAction()
	{
		$method = $this->request->getMethod();
		switch ($method) {
			case 'DELETE':
				$action = 'deleteBlock';
				break;
			case 'POST':
				$action = 'createBlock';
				break;
			case 'PUT':
				$action = 'updateBlock';
				break;
			default:
				$action = 'default';
				break;
		}
		$this->changeAction($action);
	}

	public function renderDefault()
	{
		
		
	}

	public function renderCreateBlock()
	{
		$httpRequestService = $this->context->getService('parsedHttpInput');
		$inputData = $httpRequestService->getData();
		$user = $this->getUser()
	}

	public function renderUpdateBlock()
	{
		$httpRequestService = $this->context->getService('parsedHttpInput');
		$inputData = $httpRequestService->getData();
		$user = $this->getUser()
	}

	public function renderDeleteBlock()
	{
		
	}

}