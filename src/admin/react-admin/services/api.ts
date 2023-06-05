import axios from 'axios';

declare const wpApiSettings: {
  root: string;
};

export default axios.create({
  baseURL: wpApiSettings.root,
});
