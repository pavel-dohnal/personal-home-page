<?php

class BlockRouter implements Nette\Application\IRouter
{
	public function match(Nette\Http\IRequest $httpRequest)
	{
		$url = $httpRequest->getUrl();
		$path = $url->getPath();
		if (stripos($path, 'block') === false) {
			return null;
		}
		$pathChunks = explode('/', strtolower(trim($path, '/')));
		if (end($pathChunks) === 'blocks') {
			return new \Nette\Application\Request('Front:Block:List', 'default', []);
		} else {			
			return $this->matchSingleBlock($pathChunks, $httpRequest->getMethod());
		}		
	}

	private function matchSingleBlock(array $pathChunks, $method)
	{
		if ((end($pathChunks) === 'block') && ($method === 'POST')) {
			return new \Nette\Application\Request('Front:Block:Create', 'default', []);
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
		if ($beforeLastPathChunk !== 'block') {
			return null;
		}
		if ($method === 'DELETE') {
			return new \Nette\Application\Request('Front:Block:Delete', 'default', ['id' => $lastPathChunk]);
		} elseif ($method === 'PUT') {
			return new \Nette\Application\Request('Front:Block:Update', 'default', ['id' => $lastPathChunk]);
		} else {
			return null;
		}
	}

	public function constructUrl(Nette\Application\Request $appRequest, Nette\Http\Url $refUrl)
	{
		throw new \InvalidStateException('Creating Block Urls is not supported.');
	}
}