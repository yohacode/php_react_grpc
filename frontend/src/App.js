import logo from './logo.svg';
import './App.css';
import React, { useState } from 'react';

function App() {
  // Create a simple form with controlled input and submit handler

  const [inputValue, setInputValue] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    // here will hanfle the form submission logic and gRPC call
    console.log('Form submitted with value:', inputValue);
  };

  return (
    <div className="App">
      <div className='App-header'>
        <form onSubmit={handleSubmit}>
          <label htmlFor="inputField">Input</label>
          <input
            type="text"
            id="inputField"
            placeholder="Input Something"
            value={inputValue}
            onChange={e => setInputValue(e.target.value)}
          />
          <button className='btn-info' type="submit">Submit</button>
        </form>
      </div>
      <footer className="App-footer">
        <p>Footer content goes here.</p>
      </footer>
    </div>
  );
}

export default App;
