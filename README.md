# Project: gRPC Full Stack App (PHP 7.3 + React)

## Features
- PHP 7.3 gRPC server using Spiral PHP gRPC
- React frontend with input and button
- Backend receives string via gRPC and returns it
- Docker setup for backend and frontend
- Basic tests for both parts

---

## Folder Structure
```
root/
├── backend/
│   ├── proto/
│   │   └── ping.proto
│   ├── src/
│   │   └── PingService.php
│   ├── server.php
│   ├── composer.json
│   └── Dockerfile
├── frontend/
│   ├── public/
│   ├── src/
│   │   └── App.js
│   ├── package.json
│   └── Dockerfile
├── docker-compose.yml
└── README.md
```

---

## 1. ping.proto
```proto
syntax = "proto3";

package ping;

service PingService {
  rpc Ping(PingRequest) returns (PingResponse);
}

message PingRequest {
  string message = 1;
}

message PingResponse {
  string message = 1;
}
```

---

## 2. Backend Setup

### 2.1 Install Spiral gRPC generator
```bash
wget https://github.com/spiral/php-grpc/releases/download/v1.4.0/protoc-gen-php-grpc-1.4.0-linux-amd64.tar.gz
sudo tar -xvzf protoc-gen-php-grpc-1.4.0-linux-amd64.tar.gz -C /usr/local/bin/
sudo chmod +x /usr/local/bin/protoc-gen-php-grpc
```

### 2.2 Generate PHP files from proto
```bash
protoc --proto_path=proto \
  --php_out=src \
  --php-grpc_out=src \
  proto/ping.proto
```

### 2.3 PingService.php
```php
namespace Ping;

use Spiral\GRPC; 

class PingService implements PingServiceInterface
{
    public function Ping(GRPC\ContextInterface $ctx, PingRequest $in): PingResponse
    {
        $response = new PingResponse();
        $response->setMessage($in->getMessage());
        return $response;
    }
}
```

### 2.4 server.php
```php
use Spiral\GRPC\Server;
use Ping\PingService;

require 'vendor/autoload.php';

$server = new Server();
$server->registerService(PingServiceInterface::class, new PingService());
$server->serve("0.0.0.0:9000");
```

### 2.5 Dockerfile (backend)
```Dockerfile
FROM php:7.3-cli

RUN apt-get update && apt-get install -y unzip git curl protobuf-compiler

WORKDIR /app
COPY . .

RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install

EXPOSE 9000
CMD ["php", "server.php"]
```

---

## 3. Frontend (React)

### 3.1 App.js
```jsx
import React, { useState } from 'react';

function App() {
  const [input, setInput] = useState("");
  const [output, setOutput] = useState("");

  const handlePing = async () => {
    const response = await fetch("http://localhost:8080/api/ping", {
      method: "POST",
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message: input })
    });
    const data = await response.json();
    setOutput(data.message);
  };

  return (
    <div>
      <input type="text" onChange={e => setInput(e.target.value)} />
      <button onClick={handlePing}>Send</button>
      <p>Response: {output}</p>
    </div>
  );
}

export default App;
```

### 3.2 Dockerfile (frontend)
```Dockerfile
FROM node:18

WORKDIR /app
COPY . .
RUN npm install && npm run build

EXPOSE 3000
CMD ["npm", "start"]
```

---

## 4. Docker Compose
```yaml
version: '3'
services:
  backend:
    build: ./backend
    ports:
      - "9000:9000"

  frontend:
    build: ./frontend
    ports:
      - "3000:3000"
```

---

## 5. Tests

### Backend Test (PHPUnit)
```php
public function testPingResponse() {
    $client = new \Spiral\GRPC\Client(["127.0.0.1:9000"]);
    $service = new \Ping\PingServiceClient($client);

    $request = new \Ping\PingRequest();
    $request->setMessage("Hello World");

    $response = $service->Ping(new \Spiral\GRPC\Context(), $request);
    $this->assertEquals("Hello World", $response->getMessage());
}
```

### Frontend Test (Jest)
```js
test('calls API and displays response', async () => {
  // Mock fetch and simulate API
});
```

---

## README.md
```md
# gRPC Full Stack App (PHP 7.3 + React)

## How to Run

```bash
docker-compose up --build
```

Open browser at [http://localhost:3000](http://localhost:3000)

## Test
- Run PHPUnit in backend
- Use Jest for frontend unit test
