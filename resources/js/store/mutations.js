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
  SET_BRANDS(state, brands) {
    state.brands = brands;
  },
  SET_CATEGORIES(state, categories) {
    state.categories = categories;
  },

  SET_COUNTS(state, counts) {
    state.brandCounts = counts.brands;
    state.colorCounts = counts.colors;
    state.priceCounts = counts.prices;
    state.subCategoryCounts = counts.subCategorys;
  },
  SET_SORTING_OPTION(state, sortingOption) {
    state.sortingOption = sortingOption;
  },
  SET_PAGINATION(state, pagination) {
    state.pagination = pagination;
  },
};