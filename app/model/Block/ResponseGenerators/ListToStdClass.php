<?php

namespace Block\ResponseGenerator

class ListToStdClass implements IListResponseGenerator
{

	public function $blockResponseGeneratorFactory;

	public function __construct()
	{
		
	}

	/**
	 * @param \User\Documents\Block[]
	 * @return stdClass[]
	 */
	public function generate(array $blocks)
	{
		//TODO
	}

}