<?php declare(strict_types=1);

namespace App\response;

/**
 * Class Response
 * Represents a response object that can be used to send data back to the client.
 * Implements the ResponseInterface to ensure it adheres to the expected structure.
 */
class Response implements ResponseInterface
{
    /**
     * @var int HTTP status code for the response.
     */
    private int $code;
    /**
     * @var string Message to be included in the response.
     */
    private string $message;
    /**
     * @var array<string> Additional data to be included in the response.
     */
    private array $data;


    /**
     * Response constructor.
     *
     * @param int $code HTTP status code for the response.
     * @param string $message Message to be included in the response.
     * @param array<string> $data Additional data to be included in the response.
     */
    public function __construct(int $code, string $message, array $data = [])
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * Creates a new Response instance from an array.
     * @return int A new Response instance.
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * Gets the message from the response.
     *
     * @return string The message of the response.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Gets the data from the response.
     *
     * @return array<string> The data of the response.
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Creates a new Response instance from an array.
     *
     * @return int A new Response instance.
     */
    public function getStatusCode(): int
    {
        return $this->code >= 200 && $this->code < 300 ? 200 : 400;
    }

    /**
     * Gets the headers for the response.
     *
     * @return array<string> The headers of the response.
     */
    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'X-Response-Code' => (string)$this->code,
        ];
    }

    /**
     * Gets the body of the response as a JSON string.
     *
     * @return string|bool|null The body of the response, or null if no body is set.
     */
    public function getBody(): string|bool|null
    {
        return json_encode([
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data,
        ]);
    }

    /**
     * Sets the status code for the response.
     *
     * @param int $statusCode The HTTP status code to set.
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->code = $statusCode;
    }

    /**
     * Sets the headers for the response.
     * 
     * @param array<string, string> $headers.
     */
    public function setHeaders(array $headers): void
    {
        // This method is not typically used in a response object, headers are usually set by the server.
        // However, you can implement it if needed for custom headers.
        foreach ($headers as $key => $value) {
            $this->getHeaders()[$key] = $value;
        }
    }

    /**
     * Sets the body of the response from a JSON string.
     * @param string|null $body The JSON string to set as the body.
     * @return void
     */
    public function setBody(?string $body): void
    {
        if ($body !== null) 
        {
            $decoded = json_decode($body, true);
            if (!is_array($decoded)) {
                $decoded = [];
            }
            $this->data = (isset($decoded['data']) && is_array($decoded['data']))
                ? array_map(
                    fn($v) => is_scalar($v) || (is_object($v) && method_exists($v, '__toString')) ? (string)$v : '',
                    $decoded['data']
                )
                : [];
            $this->message = isset($decoded['message']) && is_string($decoded['message']) ? $decoded['message'] : 'No message provided';
            $this->code = isset($decoded['code']) && is_int($decoded['code']) ? $decoded['code'] : (isset($decoded['code']) && is_numeric($decoded['code']) ? (int)$decoded['code'] : 200);
        } else 
        {
            $this->data = [];
            $this->message = 'No body provided';
            $this->code = 400; // Default to bad request if no body is set
        }
        $this->message = $this->message ?: 'No message provided';
        $this->code = $this->code ?: 200; // Default to 200 if no code is set

    }

    
    // custom
    
    /**
     * Sets the message for the response.
     *
     * @param string $message The message to set.
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }



}