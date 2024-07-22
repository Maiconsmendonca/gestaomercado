import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { fetchProducts, deleteProduct } from '../services/apiService';

const Products = () => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        const loadProducts = async () => {
            try {
                const productsData = await fetchProducts();
                setProducts(productsData);
            } catch (error) {
                setError('Failed to load products.');
                console.error('Error fetching products:', error);
            } finally {
                setLoading(false);
            }
        };

        loadProducts();
    }, []);

    const handleDelete = async (id) => {
        if (window.confirm('Are you sure you want to delete this product?')) {
            try {
                await deleteProduct(id);
                setProducts(products.filter(product => product.id !== id));
            } catch (error) {
                setError('Failed to delete product.');
                console.error('Error deleting product:', error);
            }
        }
    };

    if (loading) return <p>Loading...</p>;

    return (
        <div className="container mx-auto p-4">
            <div className="flex justify-between items-center mb-4">
                <h1 className="text-xl font-bold">Sales</h1>
                <Link to="/products/add" className="bg-blue-500 text-white py-2 px-4 rounded">Add Product</Link>
            </div>
            {error && <p className="text-red-500 mb-4">{error}</p>}
            <table className="min-w-full bg-white border border-gray-200">
                <thead>
                <tr>
                    <th className="border px-4 py-2">ID</th>
                    <th className="border px-4 py-2">Name</th>
                    <th className="border px-4 py-2">Category</th>
                    <th className="border px-4 py-2">Price</th>
                    <th className="border px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                {products.length > 0 ? (
                    products.map(product => (
                        <tr key={product.id}>
                            <td className="border px-4 py-2">{product.id}</td>
                            <td className="border px-4 py-2">{product.name}</td>
                            <td className="border px-4 py-2">{product.category}</td>
                            <td className="border px-4 py-2">${product.price}</td>
                            <td className="border px-4 py-2">
                                <Link to={`/products/${product.id}/edit`} className="bg-yellow-500 text-white py-1 px-2 rounded">Edit</Link>
                                <button
                                    onClick={() => handleDelete(product.id)}
                                    className="bg-red-500 text-white py-1 px-2 rounded ml-2"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    ))
                ) : (
                    <tr>
                        <td colSpan="5" className="border px-4 py-2 text-center">No products available</td>
                    </tr>
                )}
                </tbody>
            </table>
        </div>
    );
};

export default Products;
