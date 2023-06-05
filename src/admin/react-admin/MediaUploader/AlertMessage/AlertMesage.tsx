import { Alert, Box } from '@mui/material';
import React, { useEffect, useState } from 'react';
import { Message } from '../interfaces/Message';

type Props = {
  message: Message;
};

export default function AlertMessage({ message }: Props) {
  const [alert, setAlert] = useState(true);
  useEffect(() => {
    const timer = setTimeout(() => {
      setAlert(false);
    }, 3000);

    if (alert === false) {
      setAlert(true);
    }
    // To clear or cancel a timer, you call the clearTimeout(); method,
    // passing in the timer object that you created into clearTimeout().

    return () => clearTimeout(timer);
  }, [message]);

  return message
    ? alert && (
        <Box mt={2}>
          <Alert severity={message.type}>{message.text}</Alert>
        </Box>
      )
    : null;
}
