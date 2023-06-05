declare const wpApiSettings: {
  nonce: string;
};

const headers = {
  'Content-Type': 'multipart/form-data',
  'X-WP-Nonce': wpApiSettings.nonce,
};

export default headers;
