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

	/**
	 * @param string $blockType
	 * @return IResponseGenerator
	 */
	public function createResponseGenerator($blockType)
	{
		if ($this->responseType !== 'stdClass') {
			throw new \InvalidStateException('this response type is not implemented (' . $this->responseType . ')');
		}
		if ($blockType === \User\Documents\UrlBlock::TYPE) {
			return new \Block\ResponseGenerator\UrlBlockToStdClass;
		}
		throw new \InvalidArgumentException('invalid type');
	}

}