import React from 'react';
import { Link } from 'react-router-dom';

const Sidebar = ({ isOpen, onClose }) => {
    if (!isOpen) return null;

    return (
        <div className="fixed top-0 left-0 h-full w-64 bg-gray-800 bg-opacity-80 text-white shadow-lg transition-transform transform" style={{ transform: isOpen ? 'translateX(0)' : 'translateX(-100%)' }}>
            <button onClick={onClose} className="text-white p-4 focus:outline-none absolute top-4 right-4">
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <nav className="mt-16">
                <ul>
                    <li><Link to="/" className="block px-4 py-2 hover:bg-gray-700">Home</Link></li>
                    <li><Link to="/products" className="block px-4 py-2 hover:bg-gray-700">Products</Link></li>
                    <li><Link to="/sales" className="block px-4 py-2 hover:bg-gray-700">Sales</Link></li>
                    <li><Link to="/categories" className="block px-4 py-2 hover:bg-gray-700">Categories</Link></li>
                </ul>
            </nav>
        </div>
    );
};

export default Sidebar;
