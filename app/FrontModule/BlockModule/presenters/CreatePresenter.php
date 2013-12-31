<?php

namespace FrontModule\BlockModule;

class CreatePresenter extends BasePresenter
{

	/**
	 * @var \ParsedHttpInput
	 */
	private $parsedHttpInput;

	/** 
	 * @var \Block\CreateBlockController
	 */
	private $createBlockController;

	public function __construct(\ParsedHttpInput $parsedHttpInput, \Block\CreateBlockController $createBlockController)
	{
		$this->parsedHttpInput = $parsedHttpInput;
		$this->createBlockController = $createBlockController;
	}

	public function renderDefault()
	{		
		try {
			$output = $this->createBlockController->run($this->getUser()->getIdentity(), $this->parsedHttpInput->getData());
			$this->terminateWithResponse($output, 201);
		} catch (\InvalidArgumentException $e) {
			$this->terminateWithError($e->getMessage());
		} catch (\Nette\InvalidArgumentException $e) {
			$this->terminateWithError($e->getMessage(), $e->getCode());
		}
	}
}