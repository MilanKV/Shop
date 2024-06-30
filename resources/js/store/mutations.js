export default {
  SET_LOGIN_STATUS(state, status) {
    state.isLoggedIn = status;
  },
  SET_ADMIN_STATUS(state, status) {
    state.isAdmin = status;
  },

  SET_PRODUCTS(state, products) {
    state.products = products;
  },
  SET_SORTING_OPTION(state, sortingOption) {
    state.sortingOption = sortingOption;
  },
  SET_BRANDS(state, brands) {
    state.brands = brands;
  },
  SET_PAGINATION(state, pagination) {
    state.pagination = pagination;
  },
};