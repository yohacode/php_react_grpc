<?php declare(strict_types=1);

namespace App\request;

/**
 * Interface RequestInterface
 * @package App\request
 */
interface RequestInterface
{
    /**
     * Get the request method (GET, POST, etc.)
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Get the request URI
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Get the request headers
     *
     * @return array<string, string>
     * @example ['Content-Type' => 'application/json', 'Authorization']
     */
    public function getHeaders(): array;

    /**
     * Get the request body
     *
     * @return string|null
     */
    public function getBody(): ?string;
}