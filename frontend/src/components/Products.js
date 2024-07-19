import React from 'react';
import { Link } from 'react-router-dom';

const Products = () => {
    return (
        <div className="container mx-auto p-4">
            <div className="flex justify-between items-center mb-4">
                <h1 className="text-xl font-bold">Products</h1>
                <Link to="/products/add">
                    <button className="bg-blue-500 text-white py-2 px-4 rounded">Add Product</button>
                </Link>
            </div>
            <table className="min-w-full bg-white border border-gray-200">
                <thead>
                <tr>
                    <th className="border px-4 py-2">ID</th>
                    <th className="border px-4 py-2">Name</th>
                    <th className="border px-4 py-2">Price</th>
                    <th className="border px-4 py-2">Product Type</th>
                    <th className="border px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                {/* Example data */}
                <tr>
                    <td className="border px-4 py-2">1</td>
                    <td className="border px-4 py-2">Product A</td>
                    <td className="border px-4 py-2">R$ 10.00</td>
                    <td className="border px-4 py-2">Type 1</td>
                    <td className="border px-4 py-2">
                        <Link to={`/products/1/edit`}>
                            <button className="bg-yellow-500 text-white py-1 px-2 rounded">Edit</button>
                        </Link>
                        <button className="bg-red-500 text-white py-1 px-2 rounded ml-2">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    );
};

export default Products;
