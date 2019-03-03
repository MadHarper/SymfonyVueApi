<template>
    <form>
        <div class="form-group">
            <label for="exampleInputUUID1">User Name</label>
            <input v-model="name" type="text" placeholder="Введите uuid" id="exampleInputUUID1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input v-model="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button @click.prevent="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
import axios from 'axios'
import router from './router'
import auth from '@/helpers/auth'

export default {
    name: 'Login',
    data() {
        return {
            name: null,
            password: null
        }
    },
    methods: {
        submit() {
            // Переделать на глобальную константу
            axios.post('http://svue.dev:8055/login', {
                    uuid: this.name,
                    password: this.password
                })
                .then(response => {
                    console.log(response.data.code);
                    let token = response.data.code;
                    auth.setToken(token)
                    this.$axios.defaults.headers.common['X-AUTH-TOKEN'] = token;
                    router.push("/");
                })
                .catch(err => console.log("Поймал ошибку", err))
        }
    }
}
</script>