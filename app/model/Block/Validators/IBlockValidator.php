<?php

namespace Block\Validator;

interface IBlockValidator
{
	public function validate(\stdClass $input);
}