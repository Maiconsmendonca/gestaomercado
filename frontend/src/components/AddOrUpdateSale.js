import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { createSale, updateSale, fetchSaleById, fetchProduct } from '../services/apiService';

const AddOrUpdateSale = () => {
    const [saleData, setSaleData] = useState({
        items: [{ product_id: '', quantity: '' }]
    });
    const [products, setProducts] = useState([]);
    const [isEditing, setIsEditing] = useState(false);

    const navigate = useNavigate();
    const { id } = useParams(); // Obtém o ID da venda da URL, se presente

    useEffect(() => {
        const loadSaleData = async () => {
            if (id) {
                try {
                    const data = await fetchSaleById(id);
                    setSaleData({
                        items: data.items
                    });
                    setIsEditing(true); // Define como edição quando um ID está presente
                } catch (error) {
                    console.error('Error fetching sale data:', error);
                }
            }
        };

        const loadProducts = async () => {
            try {
                const response = await fetchProduct();
                setProducts(response.data);
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        };

        loadSaleData();
        loadProducts();
    }, [id]);

    const handleChange = (e, index) => {
        const { name, value } = e.target;
        const updatedItems = [...saleData.items];
        updatedItems[index] = { ...updatedItems[index], [name]: value };
        setSaleData({ ...saleData, items: updatedItems });
    };

    const handleAddItem = () => {
        setSaleData({
            ...saleData,
            items: [...saleData.items, { product_id: '', quantity: '' }]
        });
    };

    const handleRemoveItem = (index) => {
        setSaleData({
            ...saleData,
            items: saleData.items.filter((_, i) => i !== index)
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (isEditing) {
                await updateSale(id, saleData);
            } else {
                await createSale(saleData);
            }
            navigate('/sales');
        } catch (error) {
            console.error('Error saving sale:', error);
        }
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-xl font-bold mb-4 text-center">{isEditing ? 'Update Sale' : 'Add Sale'}</h1>
            <form onSubmit={handleSubmit} className="bg-white p-6 border border-gray-200 rounded shadow-md max-w-lg mx-auto">
                {saleData.items.map((item, index) => (
                    <div key={index} className="mb-4 border-b border-gray-300 pb-4">
                        <label className="block text-gray-700">Item {index + 1}</label>
                        <div className="flex items-center gap-4">
                            <select
                                name="product_id"
                                value={item.product_id}
                                onChange={(e) => handleChange(e, index)}
                                className="mt-1 block w-1/2 border-b border-gray-300 rounded-none py-2 px-3 focus:outline-none focus:ring-0"
                                required
                            >
                                <option value="">Select a product</option>
                                {products.map(product => (
                                    <option key={product.id} value={product.id}>
                                        {product.name}
                                    </option>
                                ))}
                            </select>
                            <input
                                type="number"
                                name="quantity"
                                value={item.quantity}
                                onChange={(e) => handleChange(e, index)}
                                className="mt-1 block w-1/2 border-b border-gray-300 rounded-none py-2 px-3 focus:outline-none focus:ring-0"
                                min="1"
                                step="1"
                                required
                            />
                            <button
                                type="button"
                                onClick={() => handleRemoveItem(index)}
                                className="bg-red-500 text-white py-1 px-2 rounded"
                            >
                                -
                            </button>
                        </div>
                    </div>
                ))}

                <button
                    type="button"
                    onClick={handleAddItem}
                    className="bg-green-500 text-white py-2 px-4 rounded mb-4"
                >
                    + Add Item
                </button>

                <button
                    type="submit"
                    className="bg-blue-500 text-white py-2 px-4 rounded w-full"
                >
                    {isEditing ? 'Update Sale' : 'Add Sale'}
                </button>
            </form>
        </div>
    );
};

export default AddOrUpdateSale;
