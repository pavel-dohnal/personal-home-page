<?php 

class HttpRequestData
{
	private $inputData;

	public function getData()
	{
		if (!$this->inputData) {
			$this->inputData = file_get_contents('php://input');
		}
		return $this->inputData;
	}

}