import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { createCategory, updateCategory, fetchCategoryById } from '../services/apiService';

const AddOrUpdateCategory = () => {
    const [categoryData, setCategoryData] = useState({
        name: '',
        tax_percentage: ''
    });
    const [isEditing, setIsEditing] = useState(false);
    const [error, setError] = useState('');

    const navigate = useNavigate();
    const { id } = useParams();

    useEffect(() => {
        const loadCategoryData = async () => {
            if (id) {
                try {
                    const data = await fetchCategoryById(id);
                    setCategoryData({
                        name: data.name,
                        tax_percentage: data.tax_percentage
                    });
                    setIsEditing(true);
                } catch (error) {
                    console.error('Error fetching category data:', error);
                }
            }
        };

        loadCategoryData();
    }, [id]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        if (name === 'tax_percentage' && (value < 0 || value > 100)) {
            setError('Tax percentage must be between 0 and 100.');
        } else {
            setError('');
            setCategoryData({ ...categoryData, [name]: value });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (isEditing) {
                await updateCategory(id, categoryData);
            } else {
                await createCategory(categoryData);
            }
            navigate('/categories');
        } catch (error) {
            console.error('Error saving category:', error);
        }
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-xl font-bold mb-4 text-center">{isEditing ? 'Update Category' : 'Add Category'}</h1>
            <form onSubmit={handleSubmit} className="bg-white p-6 border border-gray-200 rounded shadow-md max-w-lg mx-auto">
                <div className="mb-4">
                    <label className="block text-gray-700">Name</label>
                    <input
                        type="text"
                        name="name"
                        value={categoryData.name}
                        onChange={handleChange}
                        className="mt-1 block w-full border-b border-gray-300 rounded-none py-2 px-3 focus:outline-none focus:ring-0"
                        required
                    />
                </div>
                <div className="mb-4 relative">
                    <label className="block text-gray-700">Tax Percentage</label>
                    <div className="relative">
                        <input
                            type="number"
                            name="tax_percentage"
                            value={categoryData.tax_percentage}
                            onChange={handleChange}
                            className="mt-1 block w-full pl-12 border-b border-gray-300 rounded-none py-2 px-3 focus:outline-none focus:ring-0"
                            min="0"
                            max="100"
                            step="0.01"
                            required
                            style={{
                                appearance: 'none',
                                MozAppearance: 'textfield',
                            }}
                        />
                        <span className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">%</span>
                    </div>
                </div>
                {error && <p className="text-red-500 mb-4">{error}</p>}
                <button
                    type="submit"
                    className="bg-blue-500 text-white py-2 px-4 rounded w-full"
                >
                    {isEditing ? 'Update Category' : 'Add Category'}
                </button>
            </form>
        </div>
    );
};

export default AddOrUpdateCategory;
