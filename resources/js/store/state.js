export default {
    isLoggedIn: false,
    isAdmin: false,

    sortingOption: 'Low to High',
    products: [],
    brands: [],
    categories: [],

    selectedCategory: null,
    selectedSubcategory: null,

    brandCounts: {},
    colorCounts: {},
    priceCounts: {},
    subCategoryCounts: {},

    pagination: {
        total: 0,
        per_page: 9,
        current_page: 1,
        last_page: 1,
        from: 0,
        to: 0,
    },
};