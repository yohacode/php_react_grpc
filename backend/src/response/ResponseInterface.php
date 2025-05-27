<?php declare(strict_types=1);

/**
 * Interface ResponseInterface
 * @package App\response
 */

namespace App\response;

interface ResponseInterface
{
    /**
     * Get the response status code
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Get the response headers
     *
     * @return array<string, string>
     * @example ['Content-Type' => 'application/json', 'Cache-Control' => 'no-cache']
     */
    public function getHeaders(): array;

    /**
     * Get the response body
     *
     * @return string|bool|null
     * @example '{"code": 200, "message": "Success", "data": []}'
     * @example null
     * @example false
     * @example 'Error occurred'
     * @example 'Unauthorized access'   
     * @example 'Resource not found'
     * @example 'Internal server error'
     */
    public function getBody(): string|bool|null;

    /**
     * Set the response status code
     *
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void;

    /**
     * Set the response headers
     *
     * @param array<string, string> $headers
     */
    public function setHeaders(array $headers): void;

    /**
     * Set the response body
     *
     * @param string|null $body
     */
    public function setBody(?string $body): void;
}
