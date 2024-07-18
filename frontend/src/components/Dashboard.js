import React, { useEffect, useState } from 'react';
import Card from './Card';

export default function Dashboard() {
    const [totalSales, setTotalSales] = useState(0);
    const [totalSalesValue, setTotalSalesValue] = useState(0);
    const [totalProducts, setTotalProducts] = useState(0);
    const [totalCategories, setTotalCategories] = useState(0);
    const [totalItemsSold, setTotalItemsSold] = useState(0);

    useEffect(() => {
        // Lógica para buscar dados aqui
    }, []);

    return (
        <div className="flex justify-center items-center min-h-screen bg-gray-100">
            <div className="border-container" style={{
                display: 'flex',
                flexDirection: 'column',
                justifyContent: 'center',
                alignItems: 'center',
                padding: '20px',
                border: '1px solid rgba(211, 211, 211, 0.5)', // Cor cinza claro transparente
                borderRadius: '10px',
                maxWidth: '80%', // Ajustado de 95% para 80%
                height: '80vh', // Ajustado de 90vh para 80vh
                margin: '5vh auto', // Ajustado conforme necessário
                overflow: 'auto',
                boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' // Sombra leve
            }}>
                <div className="dashboard flex flex-wrap justify-center items-start gap-4">
                    <Card title="Total de Vendas" value={totalSales} color="bg-blue-500"/>
                    <Card title="Valor Total de Vendas" value={`R$ ${totalSalesValue}`} color="bg-green-500"/>
                    <Card title="Produtos Cadastrados" value={totalProducts} color="bg-red-500"/>
                    <Card title="Categorias Cadastradas" value={totalCategories} color="bg-yellow-500"/>
                    <Card title="Itens Vendidos" value={totalItemsSold} color="bg-purple-500"/>
                </div>
            </div>
        </div>
    );
}