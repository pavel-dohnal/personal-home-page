<?php

namespace Block\ResponseGenerator;

class BlockResponseGeneratorFactory implements IResponseGeneratorFactory
{

	private $responseType;

	/**
	 * @param string $responseType
	 */
	public function __construct($responseType = 'stdClass')
	{
		$this->responseType = $responseType;
	}

	public function createResponseGenerator(\User\Documents\Block $block)
	{
		if ($this->responseType !== 'stdClass') {
			throw new \Exception('this response type is not implemented (' . $this->responseType . ')');
		}
		//TODO
	}

}