<?php

namespace Block\Validator;

interface IBlockValidator
{
	public function validateCreate(\stdClass $input);

	public function validateUpdate(\stdClass $input);
}