<?php

namespace Block\ResponseGenerator

interface IResponseGenerator
{

	/**
	 * genrate output for presenter usage
	 * @param \User\Documents\Block
	 */
	public function generate($block);

}