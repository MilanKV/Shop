import { checkAuthStatus, logout } from '../axios';
import mutations from './mutations';

export default {
    async fetchAuthStatus({ commit }) {
        try {
            const response = await checkAuthStatus();
            commit('SET_LOGIN_STATUS', response.data.isAuthenticated);
            commit('SET_ADMIN_STATUS', response.data.role === 'admin' || response.data.role === 'superadmin');
        } catch (error) {
            console.error('Error fetching auth status:', error);
        }
    },
    async handleLogout({ commit }) {
        try {
            const response = await logout();
            commit('SET_LOGIN_STATUS', false);
            commit('SET_ADMIN_STATUS', false);
            console.log(response.data.message);
            window.location.href = '/';
        } catch (error) {
            console.error('Error logging out:', error);
        }
    },
};