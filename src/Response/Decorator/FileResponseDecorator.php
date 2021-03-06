<?php declare(strict_types = 1);

namespace Apitte\Core\Response\Decorator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class FileResponseDecorator
{

	public function decorate(
		ResponseInterface $response,
		StreamInterface $stream,
		string $filename,
		string $contentType = 'application/octet-stream',
		bool $forceDownload = true
	): ResponseInterface
	{
		return $response
			->withHeader('Content-Type', $contentType)
			->withHeader('Content-Description', 'File Transfer')
			->withHeader('Content-Transfer-Encoding', 'binary')
			->withHeader(
				'Content-Disposition',
				($forceDownload ? 'attachment' : 'inline')
				. '; filename="' . $filename . '"'
				. '; filename*=utf-8\'\'' . rawurlencode($filename)
			)
			->withHeader('Expires', '0')
			->withHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
			->withHeader('Pragma', 'public')
			->withHeader('Content-Length', $stream->getSize())
			->withBody($stream);
	}

}
