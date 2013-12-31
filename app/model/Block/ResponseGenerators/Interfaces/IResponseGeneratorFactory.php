<?php

namespace Block\ResponseGenerator;

interface IResponseGeneratorFactory
{
	/**
	 * @param string $blockType
	 * @return IResponseGenerator
	 */
	public function createResponseGenerator($blockType);
}