<?php

namespace FrontModule;

/**
 * Base presenter for presenters with json output.
 */
abstract class BaseJsonOutputPresenter extends BasePresenter
{
	/**
	 * @param array|\stdClass $output
	 * @param int $httpCode
	 */
	protected function terminateWithResponse($output, $httpCode = 200)
	{
		$httpResponse = $this->getHttpResponse();
		$httpResponse->setCode($httpCode);
		$response = new \Nette\Application\Responses\JsonResponse($output);
		$this->terminate($response);
	}

	/**
	 * @param string $outputMessage
	 * @param int $httpCode
	 */
	protected function terminateWithError($outputMessage, $httpCode = 400)
	{
		$output = new \stdClass;
		$output->message = $outputMessage;
		$this->terminateWithResponse($output, $httpCode);
	}
}