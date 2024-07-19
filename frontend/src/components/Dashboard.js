import React, {useEffect, useState} from 'react';
import Card from './Card';
import {fetchDashboardData} from '../services/apiService'; // Ajuste conforme necessário

const Dashboard = () => {
    const [totalSales, setTotalSales] = useState(0);
    const [totalSalesValue, setTotalSalesValue] = useState(0);
    const [totalProducts, setTotalProducts] = useState(0);
    const [totalCategories, setTotalCategories] = useState(0);
    const [totalItemsSold, setTotalItemsSold] = useState(0);

    useEffect(() => {
        // Lógica para buscar dados do dashboard
        fetchDashboardData().then(response => {
            setTotalSales(response.data.totalSales);
            setTotalSalesValue(response.data.totalSalesValue);
            setTotalProducts(response.data.totalProducts);
            setTotalCategories(response.data.totalCategories);
            setTotalItemsSold(response.data.totalItemsSold);
        });
    }, []);

    return (
        <div className="dashboard flex flex-wrap justify-center items-start gap-4">
            <Card title="Total de Vendas" value={totalSales} color="bg-blue-500"/>
            <Card title="Valor Total de Vendas" value={`R$ ${totalSalesValue}`} color="bg-green-500"/>
            <Card title="Produtos Cadastrados" value={totalProducts} color="bg-red-500"/>
            <Card title="Categorias Cadastradas" value={totalCategories} color="bg-yellow-500"/>
            <Card title="Itens Vendidos" value={totalItemsSold} color="bg-purple-500"/>
        </div>
    );
};

export default Dashboard;
