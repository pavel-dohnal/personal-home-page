<?php

namespace Block\ResponseGenerator;

class ListToStdClass implements IListResponseGenerator
{

	/** @var IResponseGeneratorFactory */
	public $blockResponseGeneratorFactory;

	public function __construct(IResponseGeneratorFactory $blockResponseGeneratorFactory)
	{
		$this->blockResponseGeneratorFactory = $blockResponseGeneratorFactory;
	}

	/**
	 * @param \User\Documents\Block[]
	 * @return stdClass[]
	 */
	public function generate(array $blocks)
	{
		$return = [];
		foreach ($blocks as $block) {
			$responseGenerator = $this->blockResponseGeneratorFactory->createResponseGenerator($block->getType());
			$return[] = $responseGenerator->generate($block);
		}
		return $return;
	}

}