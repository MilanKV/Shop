export default {
    isLoggedIn: state => state.isLoggedIn,
    isAdmin: state => state.isAdmin,

    products: state => state.products,
    brands: state => state.brands,

    brandCounts: state => state.brandCounts,
    colorCounts: state => state.colorCounts,
    priceCounts: state => state.priceCounts
};