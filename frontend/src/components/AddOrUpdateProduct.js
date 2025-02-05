import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { createProduct, updateProduct, fetchProductById, fetchProductTypes, fetchCategoryById } from '../services/apiService';

const AddProduct = () => {
    const [productData, setProductData] = useState({
        name: '',
        productTypeId: '',
        price: ''
    });
    const [productTypes, setProductTypes] = useState([]);
    const [isEditing, setIsEditing] = useState(false);
    const [error, setError] = useState('');

    const navigate = useNavigate();
    const { id } = useParams();

    useEffect(() => {
        const loadProductData = async () => {
            if (id) {
                try {
                    const data = await fetchProductById(id);
                    setProductData({
                        name: data.name,
                        price: data.price,
                        productTypeId: data.category || ''
                    });
                    setIsEditing(true);
                } catch (error) {
                    console.error('Error fetching product data:', error);
                }
            }
        };

        const loadProductTypes = async () => {
            try {
                const response = await fetchProductTypes();
                setProductTypes(response);
            } catch (error) {
                console.error('Error fetching product types:', error);
            }
        };

        loadProductData();
        loadProductTypes();
    }, [id]);

    useEffect(() => {
        const updateSelectedProductType = async () => {
            if (productData.productTypeId) {
                try {
                    const category = await fetchCategoryById(productData.productTypeId);
                    if (category) {
                        setProductData(prevState => ({
                            ...prevState,
                            productTypeId: category.id
                        }));
                    }
                } catch (error) {
                    console.error('Error fetching category by ID:', error);
                }
            }
        };

        updateSelectedProductType();
    }, [productData.productTypeId]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        if (name === 'price' && value < 0) {
            setError('Price cannot be negative.');
        } else {
            setError('');
            setProductData({ ...productData, [name]: value });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (isEditing) {
                await updateProduct(id, productData);
            } else {
                await createProduct(productData);
            }
            navigate('/products');
        } catch (error) {
            console.error('Error saving product:', error);
        }
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-xl font-bold mb-4 text-center">{isEditing ? 'Update Product' : 'Add Product'}</h1>
            <form onSubmit={handleSubmit}
                  className="bg-white p-6 border border-gray-200 rounded shadow-md max-w-lg mx-auto">
                <div className="mb-4">
                    <label className="block text-gray-700">Name</label>
                    <input
                        type="text"
                        name="name"
                        value={productData.name}
                        onChange={handleChange}
                        className="mt-1 block w-full border-b border-gray-300 rounded-none focus:outline-none focus:ring-0"
                        required
                    />
                </div>
                <div className="mb-4">
                    <label className="block text-gray-700">Category</label>
                    <select
                        name="productTypeId"
                        value={productData.productTypeId}
                        onChange={handleChange}
                        className="mt-1 block w-full border-b border-gray-300 rounded-none bg-white focus:outline-none"
                        required
                    >
                        <option value="">Select a type</option>
                        {productTypes.map(type => (
                            <option key={type.id} value={type.id}>
                                {type.name}
                            </option>
                        ))}
                    </select>
                </div>
                <div className="mb-4 relative">
                    <label className="block text-gray-700">Price</label>
                    <div className="relative">
                        <input
                            type="number"
                            name="price"
                            value={productData.price}
                            onChange={handleChange}
                            className="mt-1 block w-full pl-12 border-b border-gray-300 rounded-none focus:outline-none focus:ring-0"
                            step="0.01"
                            min="0"
                            inputMode="decimal"
                            style={{
                                appearance: 'none',
                                MozAppearance: 'textfield',
                            }}
                            required
                        />
                        <span className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">R$</span>
                    </div>
                </div>
                {error && <p className="text-red-500 mb-4">{error}</p>}
                <button
                    type="submit"
                    className="bg-blue-500 text-white py-2 px-4 rounded w-full"
                >
                    {isEditing ? 'Update Product' : 'Save Product'}
                </button>
            </form>
        </div>
    );
};

export default AddProduct;
