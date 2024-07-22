import api from './axios';

// Funções para "Products"
export const fetchProducts = async () => {
    try {
        const response = await api.get('/product');
        return response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
        throw error;
    }
};

export const createProduct = async (productData) => {
    try {
        const response = await api.post('/product', productData);
        return response.data;
    } catch (error) {
        console.error('Error creating product:', error);
        throw error;
    }
};

export const updateProduct = async (id, productData) => {
    try {
        const response = await api.put(`/product/${id}`, productData);
        return response.data;
    } catch (error) {
        console.error('Error updating product:', error);
        throw error;
    }
};

export const deleteProduct = async (id) => {
    try {
        await api.delete(`/product/${id}`);
    } catch (error) {
        console.error('Error deleting product:', error);
        throw error;
    }
};

export const fetchDashboardData = async () => {
    try {
        const response = await api.get('/dashboard'); // Ajuste a URL conforme a sua API
        return response.data;
    } catch (error) {
        console.error('Error fetching dashboard data:', error);
        throw error;
    }
};

export const fetchProductTypes = async () => {
    try {
        const response = await api.get('/product-type');
        return response.data;
    } catch (error) {
        console.error('Error fetching product types:', error);
        throw error;
    }
};

export const fetchProductById = async (id) => {
    try {
        const response = await api.get(`/product/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error fetching product by ID:', error);
        throw error;
    }
};

export const fetchCategories = async () => {
    try {
        const response = await api.get('/product-type');
        return response.data;
    } catch (error) {
        console.error('Failed to fetch categories:', error);
        throw error;
    }
};

export const fetchCategoryById = async (id) => {
    try {
        const response = await api.get(`/product-type/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error fetching category by ID:', error);
        throw error;
    }
};

export const createCategory = async (categoryData) => {
    return api.post('/product-type', categoryData);
};

export const updateCategory = async (id, categoryData) => {
    return api.put(`/product-type/${id}`, categoryData);
};

export const deleteCategory = async (id) => {
    return api.delete(`/product-type/${id}`);
};

export const fetchSales = async () => {
    try {
        const response = await api.get('/sales');
        return response.data;
    } catch (error) {
        console.error('Failed to fetch sales', error);
        throw error;
    }
};


export const fetchSaleById = async (saleId) => {
    try {
        const response = await api.get(`/sales/${saleId}`);
        return response.data;
    } catch (error) {
        console.error('Failed to fetch sale details', error);
        throw error;
    }
};

export const createSale = async (saleData) => {
    return api.post('/sales', saleData);
};

export const updateSale = async (id, saleData) => {
    return api.put(`/sales/${id}`, saleData);
};

export const deleteSale = async (id) => {
    return api.delete(`/sales/${id}`);
};
