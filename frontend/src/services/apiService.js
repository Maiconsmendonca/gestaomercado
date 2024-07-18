// src/services/apiService.js
import api from './api';

// Funções para "Products"
const fetchProduct = async (id) => {
    return api.get(`/product/${id}`);
};

const createProduct = async (productData) => {
    return api.post('/product', productData);
};

const updateProduct = async (id, productData) => {
    return api.put(`/product/${id}`, productData);
};

const deleteProduct = async (id) => {
    return api.delete(`/product/${id}`);
};

// Funções para "Sales"
const fetchSale = async (id) => {
    return api.get(`/sales/${id}`);
};

// Adicione funções similares para "Sales", "Product-Type", "Taxes"

// Exporta as funções para serem utilizadas nos components
export { fetchProduct, createProduct, updateProduct, deleteProduct, fetchSale };