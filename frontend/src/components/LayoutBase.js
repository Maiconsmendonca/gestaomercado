import React, { useState, useEffect, useRef } from 'react';
import { Outlet } from 'react-router-dom';
import Sidebar from './Sidebar';

const LayoutBase = ({ cards }) => {
    const [isSidebarOpen, setIsSidebarOpen] = useState(false);
    const sidebarRef = useRef(null);

    const closeSidebar = () => setIsSidebarOpen(false);
    const openSidebar = () => setIsSidebarOpen(true);

    const handleClickOutside = (event) => {
        if (sidebarRef.current && !sidebarRef.current.contains(event.target)) {
            closeSidebar();
        }
    };

    useEffect(() => {
        document.addEventListener('mousedown', handleClickOutside);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });

        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
            document.removeEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeSidebar();
            });
        };
    }, []);

    return (
        <div className="flex">
            <div ref={sidebarRef}>
                <Sidebar isOpen={isSidebarOpen} onClose={closeSidebar} />
            </div>
            <main className="flex-1 p-4 bg-gray-100">
                <button onClick={openSidebar} className="p-2 bg-blue-500 text-white rounded mb-4 focus:outline-none">
                    <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <div className="border-container" style={{
                    display: 'flex',
                    flexDirection: 'column',
                    alignItems: 'center',
                    padding: '20px',
                    border: '1px solid rgba(211, 211, 211, 0.5)',
                    borderRadius: '10px',
                    maxWidth: '80%',
                    height: '80vh',
                    margin: '5vh auto',
                    overflow: 'auto',
                    boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)'
                }}>
                    {/* Mostrar os Cards apenas na página inicial */}
                    <div className="dashboard flex flex-wrap justify-center items-start gap-4">
                        {window.location.pathname === '/' && cards}
                    </div>
                    <Outlet />
                </div>
            </main>
        </div>
    );
};

export default LayoutBase;
