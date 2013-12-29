<?php

namespace Block;

class CreateBlockController
{
	//dependencies:
	//validatorFactory
	//createBlockFacadeFactory

	public function run(\User\Entity\User $user, \stdClass $input = null)
	{
		//validate input
		//in createBlockFacade
			//load users block
			//if user block not found, create new
			//create block
			//flush
		return [];
	}
}