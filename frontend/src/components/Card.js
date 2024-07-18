import React from 'react';

const Card = ({ title, value, color }) => {
    return (
        <div className={`card ${color} text-white p-4 rounded-lg shadow-md w-full sm:w-60 md:w-48 lg:w-64 xl:w-72 mx-auto`}>
            <h2 className="text-xl font-bold">{title}</h2>
            <p className="text-lg">{value}</p>
        </div>
    );
};

export default Card;