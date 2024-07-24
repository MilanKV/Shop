export default {
    isLoggedIn: state => state.isLoggedIn,
    isAdmin: state => state.isAdmin,

    products: state => state.products,
    brands: state => state.brands,
    product: state => state.product,
    activeImageIndex: state => state.activeImageIndex,
    brandCounts: state => state.brandCounts,
    colorCounts: state => state.colorCounts,
    priceCounts: state => state.priceCounts,
    subCategoryCounts: state => state.subCategoryCounts,
};