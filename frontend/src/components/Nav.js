import React from 'react';
import { Link } from 'react-router-dom';

const Nav = ({ visible }) => {
    return (
        <div className="flex relative">
            <ul className={`${visible ? "w-full sm:w-48" : "w-0"} transition-width duration-500 flex flex-col font-bold
                h-screen fixed pt-20 left-0 bg-half-transparent justify-center items-center`}>
                <li className={`${visible ? 'flex' : 'hidden'} text-white hover:text-salmon w-full sm:w-32 m-1 p-5 justify-center`}>
                    <Link to="/">Início</Link>
                </li>
                <li className={`${visible ? 'flex' : 'hidden'} text-white hover:text-salmon w-full sm:w-32 m-1 p-5 justify-center`}>
                    <Link to="/products">Produtos</Link>
                </li>
                <li className={`${visible ? 'flex' : 'hidden'} text-white hover:text-salmon w-full sm:w-32 m-1 p-5 justify-center`}>
                    <Link to="/categories">Categorias</Link>
                </li>
                <li className={`${visible ? 'flex' : 'hidden'} text-white hover:text-salmon w-full sm:w-32 m-1 p-5 justify-center`}>
                    <Link to="/sales">Vendas</Link>
                </li>
            </ul>
        </div>
    );
};

export default Nav;
