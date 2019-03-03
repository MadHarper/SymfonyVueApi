import axios from 'axios'


export const HTTP = axios.create({
    baseURL: `http://svue.dev:8055/api/`
})
