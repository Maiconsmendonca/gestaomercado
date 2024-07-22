// src/utils.js
export const calculateItemTotal = (item) => {
    console.log('item:', item);
    return item.unit_price * item.quantity;
};

export const calculateTotal = (items) => {
    return items.reduce((total, item) => total + calculateItemTotal(item), 0);
};
