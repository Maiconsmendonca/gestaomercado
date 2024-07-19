import api from './axios'; // Importe a instância do axios

// Funções para "Products"
const fetchProduct = async (id) => {
    try {
        const response = await api.get(`/products/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error fetching product:', error);
        throw error;
    }
};

const createProduct = async (productData) => {
    try {
        const response = await api.post('/products', productData);
        return response.data;
    } catch (error) {
        console.error('Error creating product:', error);
        throw error;
    }
};

const updateProduct = async (id, productData) => {
    try {
        const response = await api.put(`/products/${id}`, productData);
        return response.data;
    } catch (error) {
        console.error('Error updating product:', error);
        throw error;
    }
};

const deleteProduct = async (id) => {
    try {
        await api.delete(`/products/${id}`);
    } catch (error) {
        console.error('Error deleting product:', error);
        throw error;
    }
};

// Funções para "Dashboard"
const fetchDashboardData = async () => {
    try {
        const response = await api.get('/dashboard'); // Ajuste a URL conforme a sua API
        return response.data;
    } catch (error) {
        console.error('Error fetching dashboard data:', error);
        throw error;
    }
};

// Função para "Product Types"
const fetchProductTypes = async () => {
    try {
        const response = await api.get('/product-types');
        return response.data;
    } catch (error) {
        console.error('Error fetching product types:', error);
        throw error;
    }
};

// Função para buscar um produto pelo ID
const fetchProductById = async (id) => {
    try {
        const response = await api.get(`/products/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error fetching product by ID:', error);
        throw error;
    }
};

// Funções para "Categories"
const fetchCategories = async () => {
    return api.get('/categories');
};

const fetchCategoryById = async (id) => {
    try {
        const response = await api.get(`/categories/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error fetching category by ID:', error);
        throw error;
    }
};

const createCategory = async (categoryData) => {
    return api.post('/categories', categoryData);
};

const updateCategory = async (id, categoryData) => {
    return api.put(`/categories/${id}`, categoryData);
};

const deleteCategory = async (id) => {
    return api.delete(`/categories/${id}`);
};

// Funções para "Sales"
const fetchSales = async () => {
    return api.get('/sales');
};

const fetchSaleById = async (id) => {
    try {
        const response = await api.get(`/sales/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error fetching sale by ID:', error);
        throw error;
    }
};

const createSale = async (saleData) => {
    return api.post('/sales', saleData);
};

const updateSale = async (id, saleData) => {
    return api.put(`/sales/${id}`, saleData);
};

const deleteSale = async (id) => {
    return api.delete(`/sales/${id}`);
};

// Função para "Products"
const fetchProducts = async () => {
    return api.get('/products');
};

// Exporta as funções para serem utilizadas nos components
export {
    fetchProduct,
    createProduct,
    updateProduct,
    deleteProduct,
    fetchDashboardData,
    fetchProductTypes,
    fetchProductById,
    fetchCategories,
    fetchCategoryById,
    createCategory,
    updateCategory,
    deleteCategory,
    fetchSales,
    fetchSaleById,
    createSale,
    updateSale,
    deleteSale
};
