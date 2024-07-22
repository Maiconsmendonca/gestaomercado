import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { fetchCategories, fetchProducts, fetchSaleById } from '../services/apiService';
import { calculateItemTotal, calculateTotal } from '../services/utils';

const AddOrUpdateSale = () => {
    const [categories, setCategories] = useState([]);
    const [products, setProducts] = useState([]);
    const [filteredProducts, setFilteredProducts] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState('');
    const [selectedProduct, setSelectedProduct] = useState('');
    const [items, setItems] = useState([]);
    const [quantity, setQuantity] = useState(1);
    const [unitPrice, setUnitPrice] = useState(0);
    const [taxPercentage, setTaxPercentage] = useState(0);
    const [isEditing, setIsEditing] = useState(false);
    const [editingIndex, setEditingIndex] = useState(null);

    const { id } = useParams();
    const navigate = useNavigate();

    useEffect(() => {
        const fetchInitialData = async () => {
            try {
                const categoriesData = await fetchCategories();
                setCategories(categoriesData);

                const productsData = await fetchProducts();
                setProducts(productsData);
                setFilteredProducts(productsData);

                if (id) {
                    setIsEditing(true);
                    const { saleDetails } = await fetchSaleById(id);

                    const itemsList = saleDetails.map(item => ({
                        ...item,
                        quantity: parseInt(item.quantity, 10),
                        unit_price: parseFloat(item.unit_price),
                        tax_percentage: parseFloat(item.tax_percentage)
                    }));

                    setItems(itemsList);
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };
        fetchInitialData();
    }, [id]);

    useEffect(() => {
        if (selectedProduct) {
            const product = products.find(p => p.id === parseInt(selectedProduct, 10));
            if (product) {
                setUnitPrice(parseFloat(product.price));
                setTaxPercentage(parseFloat(product.taxPercentage));
            }
        }
    }, [selectedProduct, products]);

    const handleCategoryChange = async (e) => {
        const selectedCategory = e.target.value;
        setSelectedCategory(selectedCategory);

        try {
            if (selectedCategory) {
                const filtered = products.filter(product => product.category === parseInt(selectedCategory, 10));
                setFilteredProducts(filtered);
            } else {
                setFilteredProducts(products);
            }
        } catch (error) {
            console.error('Error filtering products:', error);
        }
    };

    const handleAddItem = () => {
        const product = products.find(p => p.id === parseInt(selectedProduct, 10));
        if (product) {
            if (editingIndex !== null) {
                setItems(prevItems => {
                    const updatedItems = [...prevItems];
                    const existingItem = updatedItems[editingIndex];
                    existingItem.quantity = quantity;
                    existingItem.unit_price = unitPrice;
                    existingItem.tax_percentage = taxPercentage;
                    return updatedItems;
                });
                setEditingIndex(null);
            } else {
                const newItem = {
                    ...product,
                    quantity,
                    unit_price: unitPrice,
                    tax_percentage: taxPercentage
                };
                setItems(prevItems => [...prevItems, newItem]);
            }

            setSelectedProduct('');
            setQuantity(1);
            setUnitPrice(0);
            setTaxPercentage(0);
        }
    };

    const handleEditItem = (index) => {
        const item = items[index];
        setSelectedProduct(item.product_id);
        setQuantity(item.quantity);
        setUnitPrice(item.unit_price);
        setTaxPercentage(item.tax_percentage);
        setEditingIndex(index);
        setSelectedCategory(item.category_id);
    };

    const handleRemoveItem = (index) => {
        setItems(prevItems => prevItems.filter((_, i) => i !== index));
    };

    const handleSaveSale = () => {
    };

    const calculateTotalWithTax = (items) => {
        return items.reduce((total, item) => total + (calculateItemTotal(item) * (1 + item.tax_percentage / 100)), 0);
    };

    const calculateTotalTax = (items) => {
        return items.reduce((total, item) => total + (calculateItemTotal(item) * (item.tax_percentage / 100)), 0);
    };

    const formatCurrency = (value) => {
        return value.toFixed(2);
    };

    return (
        <div className="p-6 bg-gray-100 min-h-screen">
            <div className="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 className="text-3xl font-bold mb-6 text-center">{isEditing ? 'Edit Sale' : 'Add Sale'}</h2>
                <div className="flex flex-wrap mb-4 gap-4">
                    <div className="flex-1 min-w-[200px]">
                        <label htmlFor="category" className="block mb-2 text-lg">Category:</label>
                        <select
                            id="category"
                            value={selectedCategory}
                            onChange={handleCategoryChange}
                            disabled={editingIndex !== null}
                            className={`w-full p-2 border rounded ${editingIndex !== null ? 'bg-gray-200 cursor-not-allowed' : 'bg-white'}`}
                        >
                            <option value="">Select Category</option>
                            {categories.map(category => (
                                <option key={category.id} value={category.id}>
                                    {category.name}
                                </option>
                            ))}
                        </select>
                    </div>
                    <div className="flex-1 min-w-[200px]">
                        <label htmlFor="product" className="block mb-2 text-lg">Product:</label>
                        <select
                            id="product"
                            value={selectedProduct}
                            onChange={(e) => setSelectedProduct(e.target.value)}
                            disabled={editingIndex !== null}
                            className={`w-full p-2 border rounded ${editingIndex !== null ? 'bg-gray-200 cursor-not-allowed' : 'bg-white'}`}
                        >
                            <option value="">Select Product</option>
                            {filteredProducts.map(product => (
                                <option key={product.id} value={product.id}>
                                    {product.name}
                                </option>
                            ))}
                        </select>
                    </div>
                </div>
                <div className="flex flex-wrap mb-4 gap-4">
                    <div className="flex-1 min-w-[200px]">
                        <label htmlFor="quantity" className="block mb-2 text-lg">Quantity:</label>
                        <input
                            type="number"
                            id="quantity"
                            value={quantity}
                            onChange={(e) => setQuantity(parseInt(e.target.value, 10))}
                            min="1"
                            className="w-full p-2 border rounded"
                        />
                    </div>
                    <div className="flex-1 min-w-[200px]">
                        <label htmlFor="unit_price" className="block mb-2 text-lg">Unit Price:</label>
                        <input
                            type="number"
                            id="unit_price"
                            value={unitPrice}
                            readOnly
                            className="w-full p-2 border rounded bg-gray-100"
                        />
                    </div>
                </div>
                <button
                    onClick={handleAddItem}
                    className="bg-blue-500 text-white p-2 rounded w-full mb-6"
                >
                    {editingIndex !== null ? 'Update Item' : 'Add Item'}
                </button>
                <div className="mt-6">
                    <h3 className="text-2xl font-bold mb-2">Items</h3>
                    <ul className="list-disc pl-5 space-y-2">
                        {items.map((item, index) => (
                            <li key={index} className="mb-2 flex justify-between items-center">
                                <span>
                                    {item.product_name} - {item.quantity} @ ${formatCurrency(item.unit_price)} each<br />
                                    Tax: ${formatCurrency(item.unit_price * (item.tax_percentage / 100))} each<br />
                                    Total: ${formatCurrency(calculateItemTotal(item) * item.quantity)}
                                </span>
                                <div className="flex">
                                    <button
                                        onClick={() => handleEditItem(index)}
                                        className="bg-yellow-500 text-white p-1 rounded ml-4"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        onClick={() => handleRemoveItem(index)}
                                        className="bg-red-500 text-white p-1 rounded ml-4"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </li>
                        ))}
                    </ul>
                    <div className="mt-4">
                        <h3 className="text-xl font-bold">Total (without tax): ${formatCurrency(calculateTotal(items))}</h3>
                        <h3 className="text-xl font-bold">Total Tax: ${formatCurrency(calculateTotalTax(items))}</h3>
                        <h3 className="text-xl font-bold">Total (with tax): ${formatCurrency(calculateTotalWithTax(items))}</h3>
                    </div>
                </div>
                <button
                    onClick={handleSaveSale}
                    className="bg-green-500 text-white p-2 rounded w-full mt-6"
                >
                    Save Sale
                </button>
            </div>
        </div>
    );
};

export default AddOrUpdateSale;
