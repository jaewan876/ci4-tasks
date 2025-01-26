<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Config\Services;

class AuthFilter implements FilterInterface
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

         // Check if user session is set
        if (!session()->has('user')) {
            return redirect()->to('/');
        }

        // Check if the Authorization header is present
        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader) {
            // return redirect()->to('/');
        }

        print_r($authHeader);

        // Extract the token from the Authorization header
        // $token = str_replace('Bearer ', '', $authHeader);

        // try {
        //     // Decode and validate the token
        //     $decoded = JWT::decode($token, new Key($key, 'HS256'));

        //     // Optionally, you can add custom logic to check user permissions here
        //     // For example:
        //     // if (!in_array('admin', $decoded->roles)) {
        //     //     throw new \Exception('Insufficient permissions.');
        //     // }

        //     // Store the decoded token in the request for further use (if needed)
        //     $request->user = $decoded;
        // } catch (\Exception $e) {
        //     return redirect()->to('/');
        // }
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
