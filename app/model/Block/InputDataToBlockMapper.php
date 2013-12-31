<?php

namespace Block;

class InputDataToBlockMapper
{

	/**
	 * @var \Block\Validator\ValidatorFactory
	 */
	private $validatorFactory;

	public function __construct(\Block\Validator\ValidatorFactory $validatorFactory)
	{
		$this->validatorFactory = $validatorFactory;
	}

	/**
	 * @param \stdClass $inputData
	 * @return \User\Documents\Block
	 * @throws \InvalidArgumentException
	 * @throws \Nette\InvalidArgumentException
	 */
	public function map(\stdClass $inputData)
	{
		$validator = $this->validatorFactory->createValidator($inputData);
		try {
			$validator->validate($inputData);
		} catch (\Block\Validator\EValidation $e) {
			throw new \InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
		}
		//TODO check input type and create entity by input
		$entity = new \User\Documents\UrlBlock(new \Nette\Http\Url($inputData->url));
		return $entity;
	}
}