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