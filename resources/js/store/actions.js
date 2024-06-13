import { checkAuthStatus, logout, axiosInstance } from '../axios';
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

    async fetchProducts({ commit, state }, { selectedBrand, selectedColor, selectedPrice }) {
        try {
            const response = await axiosInstance.get('/api/products', {
                params: {
                    sort: state.sortingOption,
                    brand: selectedBrand,
                    color: selectedColor,
                    price: selectedPrice,
                },
            });
            commit('SET_PRODUCTS', response.data);
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    },
    updateSorting({ commit, dispatch }, sortingOption) {
        commit('SET_SORTING_OPTION', sortingOption);
        dispatch('fetchProducts', { 
            selectedBrand: null, 
            selectedColor: null, 
            selectedPrice: null 
        });
    },
    async fetchBrands({ commit }) {
        try {
            const response = await axiosInstance.get('/api/brands');
            commit('SET_BRANDS', response.data);
        } catch (error) {
            console.error('Error fetching brands:', error);
        }
    },
};