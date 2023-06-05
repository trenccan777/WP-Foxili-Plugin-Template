export interface Message  {
    type: 'success' | 'info' | 'warning' | 'error';
    text: string;
  };