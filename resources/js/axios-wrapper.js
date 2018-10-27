import axios from 'axios';
import store from './store';
import router from './router';
class Wrapper {
  constructor() {
    this.initService()
  }

  initService() {
    let service = axios.create({});
    service.interceptors.request.use(
        config => {

          config.headers.Accept = 'application/json';
          const token = store.state.auth.token || '';
          if (token !== '') {
            config.headers.Authorization = `Bearer ${token}`;
          }
          return config;
        },
        error => Promise.reject(error)
    );
    service.interceptors.response.use(null, this.handleError);
    this.service = service
  }

  handleError(error) {
    if(error.response && error.response.status === 401) {
        router.push('/login');
        return Promise.resolve();
    }
    return Promise.reject(error);
  }

}

const wrapper = new Wrapper();

export default wrapper.service;