import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { fetchCategories, deleteCategory } from '../services/apiService';

const Categories = () => {
    const [categories, setCategories] = useState([]);

    useEffect(() => {
        const loadCategories = async () => {
            try {
                const response = await fetchCategories();
                setCategories(response);
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        };

        loadCategories();
    }, []);

    const handleDelete = async (id) => {
        try {
            await deleteCategory(id);
            setCategories(categories.filter(category => category.id !== id));
        } catch (error) {
            console.error('Error deleting category:', error);
        }
    };

    return (
        <div className="container mx-auto p-4">
            <div className="flex justify-between items-center mb-4">
                <h1 className="text-xl font-bold">Categories</h1>
                <Link to="/categories/add">
                    <button className="bg-blue-500 text-white py-2 px-4 rounded">Add Category</button>
                </Link>
            </div>
            <table className="min-w-full bg-white border border-gray-200">
                <thead>
                <tr>
                    <th className="border px-4 py-2">ID</th>
                    <th className="border px-4 py-2">Name</th>
                    <th className="border px-4 py-2">Tax Percentage</th>
                    <th className="border px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                {categories.map(category => (
                    <tr key={category.id}>
                        <td className="border px-4 py-2">{category.id}</td>
                        <td className="border px-4 py-2">{category.name}</td>
                        <td className="border px-4 py-2">{category.taxPercentage}%</td>
                        <td className="border px-4 py-2">
                            <Link to={`/categories/${category.id}/edit`}>
                                <button className="bg-yellow-500 text-white py-1 px-2 rounded">Edit</button>
                            </Link>
                            <button
                                className="bg-red-500 text-white py-1 px-2 rounded ml-2"
                                onClick={() => handleDelete(category.id)}
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
};

export default Categories;
