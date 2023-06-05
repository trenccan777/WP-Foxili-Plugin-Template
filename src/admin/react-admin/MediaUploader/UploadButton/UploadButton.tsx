import React from 'react';
import { styled } from '@mui/material/styles';
import LoadingButton from '@mui/lab/LoadingButton';
import AttachFileIcon from '@mui/icons-material/AttachFile';

const Input = styled('input')({
  display: 'none',
});

type Props = {
  id: string;
  uploadHandler: (e: React.ChangeEvent<HTMLInputElement>) => void;
};

export default function UploadButton({ id, uploadHandler }: Props) {
  return (
    <label htmlFor={id}>
      <Input id={id} multiple type="file" onChange={uploadHandler} />
      <LoadingButton
        startIcon={<AttachFileIcon />}
        variant="contained"
        component="span"
        loadingPosition="start"
      >
        Pridať obrázok
      </LoadingButton>
    </label>
  );
}
