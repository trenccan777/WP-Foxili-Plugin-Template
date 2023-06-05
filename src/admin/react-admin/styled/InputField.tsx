import { TextField, styled } from '@mui/material';

const InputField = styled(TextField)(() => ({
  input: {
    padding: '8.5px 14px',
    lineHeight: 'unset',
    minHeight: 'auto',
    border: 0,
    '&:focus': {
      borderColor: 'transparent',
      boxShadow: 'none',
      outline: 0,
    },
  },
}));

export default InputField;
