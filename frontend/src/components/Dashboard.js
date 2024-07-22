import React from 'react';
import { Link } from 'react-router-dom';

const Dashboard = () => {
    return (
        <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div className="text-center p-6">
                <h1 className="text-4xl font-bold text-gray-800 mb-2">Bem-Vindo ao Gestão de Mercado</h1>
                <p className="text-lg text-gray-600 mb-4">Escolha uma opção no menu lateral ou inicie uma venda abaixo.</p>
                <Link to="/sales/add">
                    <button className="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Iniciar Venda
                    </button>
                </Link>
            </div>
        </div>
    );
};

export default Dashboard;
