<?php 

class ParsedHttpInput
{
	/** @var \HttpRequestData */
	private $httpRequestData;

	public function __construct(\HttpRequestData $httpRequestData)
	{
		$this->httpRequestData = $httpRequestData;
	}

	public function getData()
	{
		$rawData = $this->httpRequestData->getData();
		return json_decode($rawData);
	}
}