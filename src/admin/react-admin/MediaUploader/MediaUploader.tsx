import { Box, IconButton, Stack, TextField } from '@mui/material';
import { AxiosError, AxiosResponse } from 'axios';
import React, { useEffect, useState } from 'react';
import DeleteIcon from '@mui/icons-material/Delete';
import UploadButton from './UploadButton/UploadButton';
import RestApi from './services/api';
import headers from './services/headers';
import AlertMessage from './AlertMessage/AlertMesage';
import { Message } from './interfaces/Message';

interface Error {
  message: string;
}

type Props = {
  bannerId: string;
  inputName: string;
  inputLabel: string;
};

type Media = {
  id: number;
  media_url: string;
};

export default function MediaUploader({
  bannerId,
  inputName,
  inputLabel,
}: Props) {
  const [message, setMessage] = useState<Message | null>(null);
  const [media, setMedia] = useState({} as Media);

  const getAttachments = async (id: string) => {
    try {
      const { data }: AxiosResponse<Media> = await RestApi.get(
        `mt-banner-manager/v1/media?banner-id=${id}`,
      );
      setMedia(data);
    } catch (err) {
      const error = err as AxiosError<Error>;
      setMessage({
        type: 'error',
        text: `Dáta sa neporadilo načítať: ${error.message}`,
      });
    }
  };

  useEffect(() => {
    // eslint-disable-next-line  @typescript-eslint/no-floating-promises
    getAttachments(bannerId);
  }, []);

  const deleteMedia = async (id: string) => {
    try {
      const { data }: AxiosResponse<string> = await RestApi.delete(
        `mt-banner-manager/v1/media?banner-id=${id}`,
        {
          headers,
        },
      );

      if (data === 'deleted') {
        setMedia({
          id: 0,
          media_url: '',
        });
        setMessage({
          type: 'success',
          text: 'Obrázok bol úspešne vymazaný',
        });
      }
    } catch (err) {
      const error = err as AxiosError<Error>;
      setMessage({
        type: 'error',
        text: `Obrázok sa nepodarilo vymazať: ${error.message}`,
      });
    }
  };

  const uploadMedia = async (
    e: React.ChangeEvent<HTMLInputElement>,
  ) => {
    const { files } = e.target;
    const filesArray: Array<Blob> = [];
    for (let i = 0; i < files.length; i += 1) {
      filesArray.push(files[i]);
    }

    if (filesArray.length === 0) {
      return null;
    }

    const formData = new FormData();
    formData.append('banner-id', bannerId);
    for (let i = 0; i < filesArray.length; i += 1) {
      formData.append(`file_${i}`, filesArray[i]);
    }

    try {
      const { data }: AxiosResponse<Media> = await RestApi.post(
        `mt-banner-manager/v1/media`,
        formData,
        {
          headers,
        },
      );

      setMedia(data);

      setMessage({
        type: 'success',
        text: 'Dáta boli úspešne nahrané na server.',
      });
    } catch (err) {
      const error = err as AxiosError<Error>;
      setMessage({
        type: 'error',
        text: `Dáta sa neporadilo načítať: ${error.message}`,
      });
    }
    return false;
  };

  return (
    <Box mt={2} mb={2}>
      {media.media_url !== undefined && (
        <Stack direction="row" spacing={2} alignItems="center">
          <Box>
            <IconButton
              onClick={() => deleteMedia(bannerId)}
              aria-label="delete"
            >
              <DeleteIcon />
            </IconButton>
          </Box>

          <TextField
            id={inputName}
            name={inputName}
            label={inputLabel}
            variant="outlined"
            value={media.media_url}
            size="small"
            sx={{
              input: {
                padding: '8.5px 14px',
                lineHeight: 'unset',
                minHeight: 'auto',
                border: 0,
                '&:focus': {
                  borderColor: 'transparent',
                  boxShadow: 'unset',
                  outline: 0,
                },
              },
            }}
          />

          <UploadButton uploadHandler={uploadMedia} id={bannerId} />
        </Stack>
      )}
      <AlertMessage message={message} />
    </Box>
  );
}
