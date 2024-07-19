import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8080/api', // Ajuste a URL conforme necessário
    headers: {
        'Content-Type': 'application/json',
    },
});

export default api;
