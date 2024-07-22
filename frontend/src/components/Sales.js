import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { fetchSales, deleteSale } from '../services/apiService';

const Sales = () => {
    const [sales, setSales] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        const loadSales = async () => {
            try {
                const response = await fetchSales();
                setSales(response.data);
            } catch (error) {
                setError('Failed to load sales.');
                console.error('Error fetching sales:', error);
            } finally {
                setLoading(false);
            }
        };

        loadSales();
    }, []);

    const handleDelete = async (id) => {
        if (window.confirm('Are you sure you want to delete this sale?')) {
            try {
                await deleteSale(id);
                setSales(sales.filter(sale => sale.id !== id));
            } catch (error) {
                setError('Failed to delete sale.');
                console.error('Error deleting sale:', error);
            }
        }
    };

    if (loading) return <p>Loading...</p>;

    return (
        <div className="container mx-auto p-4">
            <div className="flex justify-between items-center mb-4">
                <h1 className="text-xl font-bold">Sales</h1>
                <Link to="/sales/add" className="bg-blue-500 text-white py-2 px-4 rounded">Add Sale</Link>
            </div>
            {error && <p className="text-red-500 mb-4">{error}</p>}
            <table className="min-w-full bg-white border border-gray-200">
                <thead>
                <tr>
                    <th className="border px-4 py-2">ID</th>
                    <th className="border px-4 py-2">Items Count</th>
                    <th className="border px-4 py-2">Total Without Taxes</th>
                    <th className="border px-4 py-2">Total Taxes</th>
                    <th className="border px-4 py-2">Total With Taxes</th>
                    <th className="border px-4 py-2">Sale Date</th>
                    <th className="border px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                {Array.isArray(sales) && sales.map(sale => (
                    <tr key={sale.id}>
                        <td className="border px-4 py-2">{sale.id}</td>
                        <td className="border px-4 py-2">{sale.items_count}</td>
                        <td className="border px-4 py-2">${sale.total_sale_without_taxes}</td>
                        <td className="border px-4 py-2">${sale.total_taxes || '0.00'}</td>
                        <td className="border px-4 py-2">${sale.total_sale_with_taxes || '0.00'}</td>
                        <td className="border px-4 py-2">{sale.date}</td>
                        <td className="border px-4 py-2">
                            <Link to={`/sales/${sale.id}/edit`}
                                  className="bg-yellow-500 text-white py-1 px-2 rounded">Edit</Link>
                            <button
                                onClick={() => handleDelete(sale.id)}
                                className="bg-red-500 text-white py-1 px-2 rounded ml-2"
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

export default Sales;
