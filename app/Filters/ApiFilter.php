<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = getenv('JWT_SECRET_KEY');

        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return Services::response()
                ->setJSON(['message' => 'Unauthorized'])
                ->setStatusCode(401);
        }

        $token = str_replace('Bearer ', '', $authHeader);
        try {
            JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return Services::response()
                ->setJSON(['message' => 'Invalid token'])
                ->setStatusCode(401);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
