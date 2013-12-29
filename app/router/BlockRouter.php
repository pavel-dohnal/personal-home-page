<?php

class BlockRouter implements Nette\Application\IRouter
{

	const BLOCK_URL_NAME = 'block';
	const BLOCKS_URL_NAME = 'blocks';
	const PRESENTER_ACTION_NAME = 'default';
	const MODULE_NAME = 'Front:Block:';

	public function match(Nette\Http\IRequest $httpRequest)
	{
		$url = $httpRequest->getUrl();
		$path = $url->getPath();
		if (stripos($path, self::BLOCK_URL_NAME) === false) {
			return null;
		}
		$pathChunks = explode('/', strtolower(trim($path, '/')));
		if (end($pathChunks) === self::BLOCKS_URL_NAME) {
			return new \Nette\Application\Request(self::MODULE_NAME . 'List', self::PRESENTER_ACTION_NAME, []);
		} else {			
			return $this->matchSingleBlock($pathChunks, $httpRequest->getMethod());
		}		
	}

	private function matchSingleBlock(array $pathChunks, $method)
	{
		if ((end($pathChunks) === self::BLOCK_URL_NAME) && ($method === \Nette\Http\IRequest::POST)) {
			return new \Nette\Application\Request(self::MODULE_NAME . 'Create', self::PRESENTER_ACTION_NAME, []);
		} else {
			return $this->matchSingleBlockWithParameter($pathChunks, $method);
		}
	}

	private function matchSingleBlockWithParameter(array $pathChunks, $method)
	{
		if (count($pathChunks) < 2) {
			return null;
		}
		$lastPathChunk = array_pop($pathChunks);
		$beforeLastPathChunk = array_pop($pathChunks);
		if ($beforeLastPathChunk !== self::BLOCK_URL_NAME) {
			return null;
		}
		if ($method === \Nette\Http\IRequest::DELETE) {
			return new \Nette\Application\Request(self::MODULE_NAME . 'Delete', self::PRESENTER_ACTION_NAME, ['id' => $lastPathChunk]);
		} elseif ($method === \Nette\Http\IRequest::PUT) {
			return new \Nette\Application\Request(self::MODULE_NAME . 'Update', self::PRESENTER_ACTION_NAME, ['id' => $lastPathChunk]);
		} else {
			return null;
		}
	}

	public function constructUrl(Nette\Application\Request $appRequest, Nette\Http\Url $refUrl)
	{
		throw new \InvalidStateException('Creating Block Urls is not supported.');
	}
}