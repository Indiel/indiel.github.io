<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Response;

class ApiProxyController extends Controller {

	public function proxyAction($path)
	{
		$request = ServerRequest::fromGlobals();
		$request = $this->setUri($request, $path);
		$request = $this->setMultipart($request);

		$proxyClient = new Client([
			'http_errors' => false,
			'verify' => true,
			'timeout' => 10,
			'connect_timeout' => 10,
		]);

		$apiResponse = $proxyClient->send($request);

		$response = new Response();
		$response->setContent($apiResponse->getBody()->getContents());
		$response->setStatusCode($apiResponse->getStatusCode());

		return $response;
	}

	protected function setUri(RequestInterface $request, $path)
	{
		$apiUrl = $this->getParameter('turnkey_lender_api_url');

		$target = new Uri($apiUrl);

		$uri = $request->getUri()
		               ->withScheme($target->getScheme())
		               ->withHost($target->getHost());

		if ($port = $target->getPort()) {
			$uri = $uri->withPort($port);
		}

		if ($path) {
			$uri = $uri->withPath(rtrim($path, '/'));
		}

		return $request->withUri($uri);
	}

	protected function setMultipart(RequestInterface $request)
	{
		$contentType = $request->getHeader('Content-Type');
		$contentType = empty($contentType) ? '' : $contentType[0];
		if (strpos($contentType, 'multipart/form-data') !== false && $request->getMethod() == 'POST') {
			// Make multipart stream
			$elements = array();
			foreach ($_POST as $key => $value) {
				$tmp = array();
				$tmp['name'] = $key;
				$tmp['contents'] = $value;
				array_push($elements, $tmp);
			}
			foreach ($_FILES as $key => $value) {
				$tmp = array();
				$tmp['name'] = $key;
				$tmp['filename'] = $value['name'];
				$tmp['headers']['Content-Type'] = $value['type'];
				$tmp['headers']['Content-Length'] = $value['size'];
				$tmp['contents'] = fopen($value['tmp_name'], 'r');
				array_push($elements, $tmp);
			}
			$body = new Psr7\MultipartStream($elements);
			$request = $request->withBody($body)
			                   ->withHeader('Content-Type', 'multipart/form-data; Boundary=' . $body->getBoundary());
		}
		return $request;
	}
}