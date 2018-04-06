<?php
namespace Guz\Rest\Api\Views;

/**
 * Class Response
 * @package Guz\Rest\Api\Views
 */
class Response
{
    /**
     * Response constructor.
     * @param int $code
     * @param string $message
     * @param array $data
     */
    public function __construct($code, $message, $data = [])
    {
        http_response_code($code);
        header('Content-type: application/json');
        echo json_encode([
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ]);
        //Need to stop after response is sent
        exit();
    }
}