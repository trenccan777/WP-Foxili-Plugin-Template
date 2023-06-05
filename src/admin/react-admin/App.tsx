import React, { useState } from 'react';
import InputField from './styled/InputField';

export default function App() {
  const [input, setInput] = useState('Toto je test plugin');

  const inputFieldHandler = (
    e: React.ChangeEvent<HTMLInputElement>,
  ) => {
    setInput(e.target.value);
  };
  return (
    <div id="test-plugin-admin">
      <InputField
        name="label-text"
        label="Text štítku"
        variant="outlined"
        size="small"
        value={input}
        onChange={inputFieldHandler}
      />
    </div>
  );
}
