import { checkAuthStatus, logout, axiosInstance } from '../axios';

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

    async fetchProducts({ commit, state }, { selectedBrand, selectedColor, selectedPrice, selectedCategory, selectedSubcategory, page = 1, perPage = 9 }) {
        try {
            const response = await axiosInstance.get('/api/products', {
                params: {
                    sort: state.sortingOption,
                    brand: selectedBrand,
                    color: selectedColor,
                    price: selectedPrice,
                    category: selectedCategory,
                    subcategory: selectedSubcategory,
                    page,
                    perPage,
                },
            });
            commit('SET_PRODUCTS', response.data.products);
            commit('SET_PAGINATION', response.data.pagination);
            commit('SET_BRAND_COUNTS', response.data.counts.brands);
            commit('SET_COLOR_COUNTS', response.data.counts.colors);
            commit('SET_PRICE_COUNTS', response.data.counts.prices);
            commit('SET_SUBCATEGORY_COUNTS', response.data.counts.subCategorys);
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
    async fetchCategories({ commit }) {
        try {
            const response = await axiosInstance.get('/api/categories');
            commit('SET_CATEGORIES', response.data);
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    },
};