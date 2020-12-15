
export function login(credentials) {
    return new Promise((res, rej)=>{
        axios.get('/sanctum/csrf-cookie').then((response) => {

            axios.post('api/login', credentials).then((response) => {

                res(response.data);
            })
                .catch((err) => {
                    rej(err.response.data.errors)
                })
        });
    })
}

export function register(credentials) {
    return new Promise((res, rej)=>{
        axios.get('/sanctum/csrf-cookie').then((response) => {

            axios.post('api/register', credentials).then((response) => {

                res(response.data);
            })
                .catch((err) => {
                    rej(err.response.data.errors)
                })
        });
    })
}

export function getUser() {
    const userStr = localStorage.getItem('user');
    if (!userStr) {
        return null;
    }
    return JSON.parse(userStr);
}