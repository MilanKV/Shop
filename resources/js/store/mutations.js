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

  SET_SELECTED_CATEGORY(state, categoryId) {
    state.selectedCategory = categoryId;
  },

  SET_BRAND_COUNTS(state, counts) {
    state.brandCounts = counts;
  },
  SET_COLOR_COUNTS(state, counts) {
    state.colorCounts = counts;
  },
  SET_PRICE_COUNTS(state, counts) {
    state.priceCounts = counts;
  },
  SET_SUBCATEGORY_COUNTS(state, counts) {
    state.subCategoryCounts = counts;
  },

  SET_SORTING_OPTION(state, sortingOption) {
    state.sortingOption = sortingOption;
  },
  SET_PAGINATION(state, pagination) {
    state.pagination = pagination;
  },
};