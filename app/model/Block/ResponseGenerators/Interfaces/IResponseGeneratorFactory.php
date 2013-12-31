<?php

namespace Block\ResponseGenerator;

interface IResponseGeneratorFactory
{
	/**
	 * @param \User\Documents\Block $block
	 * @return IResponseGenerator
	 */
	public function createResponseGenerator(\User\Documents\Block $block);
}