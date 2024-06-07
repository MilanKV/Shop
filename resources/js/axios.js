import axios from "axios";

const axiosInstance = axios.create({
    baseURL: 'http://127.0.0.1:8000',
    withCredentials: true,
});

export { axiosInstance };

export const checkAuthStatus = () => {
    return axiosInstance.get('/api/auth-status');
};

export const logout = () => {
    return axiosInstance.post('/logout');
};