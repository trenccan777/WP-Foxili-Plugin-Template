declare const wpApiSettings: {
  nonce: string;
};

const headers = {
  'Content-Type': 'application/json',
  accept: 'application/json',
  'X-WP-Nonce': wpApiSettings.nonce,
};

export default headers;
