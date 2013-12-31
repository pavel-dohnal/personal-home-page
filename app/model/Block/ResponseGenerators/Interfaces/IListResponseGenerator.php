<?php

namespace Block\ResponseGenerator;

interface IListResponseGenerator
{

	/**
	 * genrate output for presenter usage
	 * @param \User\Documents\Block[]
	 */
	public function generate(array $blocks);

}