<?php

namespace Block\ResponseGenerator;

class UrlBlockToStdClass implements IResponseGenerator
{

	/**
	 * @param \User\Documents\UrlBlock $block
	 * @return \stdClass
	 */
	public function generate($block)
	{
		if (!$block instanceOf \User\Documents\UrlBlock) {
			throw new \InvalidArgumentException('Invalid block type.');
		}
		$return = new \stdClass;
		$return->id = $block->getId();
		$return->type = $block->getType();
		$return->url = $block->getUrl();
		return $return;
	}

}