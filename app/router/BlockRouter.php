<?php

class BlockRouter implements Nette\Application\IRouter
{
	function match(Nette\Http\IRequest $httpRequest)
	{
		$url = $httpRequest->getUrl();
		$path = $url->getPath();
		if (stripos($path, 'block') === false) {
			return NULL;
		}
		$pathChunks = explode('/', strtolower(trim($path, '/')));
		$params = [];
		if (end($pathChunks) === 'blocks') {
			$presenter = 'Front:Block:List';
		} else {			
			if ((end($pathChunks) === 'block') && ($httpRequest->getMethod() === 'POST')) {
				$presenter = 'Front:Block:Create';
			} else {
				$lastPathChunk = array_pop($pathChunks);
				$beforeLastPathChunk = array_pop($pathChunks);
				if ($beforeLastPathChunk !== 'block') {
					return NULL;
				}
				if ($httpRequest->getMethod() === 'DELETE') {
					$presenter = 'Front:Block:Delete';
					$params['id'] = $lastPathChunk;
				} elseif ($httpRequest->getMethod() === 'PUT') {
					$presenter = 'Front:Block:Update';
					$params['id'] = $lastPathChunk;
				} else {
					return NULL;
				}
			}
		}
		return new \Nette\Application\Request(
			$presenter,
			'default',
			$params
		);
	}

	function constructUrl(Nette\Application\Request $appRequest, Nette\Http\Url $refUrl)
	{
		//not suppported
	}
}