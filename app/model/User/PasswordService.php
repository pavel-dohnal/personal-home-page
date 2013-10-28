<?php

class PasswordService
{

	public function getHash($password)
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	public function validate($password, $hashedPassword)
	{
		return password_verify($password, $hashedPassword);
	}

}