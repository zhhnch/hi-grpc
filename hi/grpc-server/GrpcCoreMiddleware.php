<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hi\GrpcServer;

use Google\Protobuf\Internal\Message;
use Hyperf\Grpc\Parser;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Logger\LoggerFactory;
use Hyperf\RpcServer\Router\DispatcherFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class GrpcCoreMiddleware extends \Hyperf\RpcServer\CoreMiddleware
{
    /**
     * Transfer the non-standard response content to a standard response object.
     *
     * @param array|string $response
     */
    protected function transferToResponse($response, ServerRequestInterface $request): ResponseInterface
    {
        if ($response instanceof Message) {
            $body = Parser::serializeMessage($response);
            return $this->response()
                ->withAddedHeader('Content-Type', 'application/grpc')
                ->withAddedHeader('trailer', 'grpc-status, grpc-message')
                ->withBody(new SwooleStream($body))
                ->withTrailer('grpc-status', '0')
                ->withTrailer('grpc-message', '');
        }

        if (is_string($response)) {
            return $this->response()->withBody(new SwooleStream($response));
        }

        if (is_array($response)) {
            return $this->response()
                ->withAddedHeader('Content-Type', 'application/json')
                ->withBody(new SwooleStream(json_encode($response)));
        }

        return $this->response()->withBody(new SwooleStream((string) $response));
    }
}
