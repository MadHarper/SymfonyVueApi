export default {
    getToken() {
        return localStorage.getItem('token')
    },
    setToken(token) {
        localStorage.setItem('token', token)
    },
    isAuthorized() {
        return localStorage.getItem('token') !== null
    },
    clearToken(){
        localStorage.removeItem('token')
    }
}
