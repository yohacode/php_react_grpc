<?php declare(strict_types=1);

namespace App\Request;

use App\request\RequestInterface;

/**
 * Request class that implements the RequestInterface.
 * This class represents an HTTP request with a method, URI, headers, and an optional body.
 */

class Request implements RequestInterface
{
    /**
     * @var string The HTTP method of the request (e.g., GET, POST, PUT, DELETE).
     */
    private string $method;
    /**
     * @var string The URI of the request.
     */
    private string $uri;
    /**
     * @var array<string> The headers of the request, represented as an associative array.
     */
    private array $headers;
    /**
     * @var string|null The body of the request, which is optional.
     */
    private ?string $body;

    /**
     * Constructor to initialize the request with method, URI, headers, and an optional body.
     *
     * @param string $method The HTTP method of the request.
     * @param string $uri The URI of the request.
     * @param array<string> $headers The headers of the request.
     * @param string|null $body The body of the request, which is optional.
     */
    public function __construct(string $method, string $uri, array $headers = [], ?string $body = null)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * Getters for the request properties.
     * @return string The HTTP method of the request.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Getters for the request properties.
     * @return string The URI of the request.
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Getters for the request properties.
     * @return array<string> The headers of the request.
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Getters for the request properties.
     * @return string|null The body of the request, which is optional.
     */
    public function getBody(): ?string
    {
        return $this->body;
    }
}