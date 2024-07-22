import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import LayoutBase from './components/LayoutBase';
import Dashboard from './components/Dashboard';
import Products from './components/Products';
import Sales from './components/Sales';
import Categories from './components/Categories';
import AddOrUpdateProduct from './components/AddOrUpdateProduct';
import AddOrUpdateCategory from './components/AddOrUpdateCategory';
import AddOrUpdateSale from './components/AddOrUpdateSale';

function App() {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<LayoutBase />}>
                    <Route index element={<Dashboard />} />
                    <Route path="products" element={<Products />} />
                    <Route path="products/add" element={<AddOrUpdateProduct />} />
                    <Route path="products/:id/edit" element={<AddOrUpdateProduct />} />
                    <Route path="sales" element={<Sales />} />
                    <Route path="categories" element={<Categories />} />
                    <Route path="categories/add" element={<AddOrUpdateCategory />} />
                    <Route path="categories/:id/edit" element={<AddOrUpdateCategory />} />
                    <Route path="sales" element={<Sales />} />
                    <Route path="sales/add" element={<AddOrUpdateSale />} />
                    <Route path="sales/:id/edit" element={<AddOrUpdateSale />} />
                </Route>
            </Routes>
        </Router>
    );
}

export default App;
