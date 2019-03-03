<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">isActive</th>
                <th scope="col">Age</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
            </tr>
            </thead>
            <tbody>
                <user v-for="item in items"
                      v-bind:isActive="item.isActive"
                      v-bind:age="item.age"
                      v-bind:first_name="item.first_name"
                      v-bind:last_name="item.last_name"
                      v-on:removeUser="remove"
                />
            </tbody>
        </table>
    </div>
</template>

<script>
import User from './User.vue'

export default {
    name: 'Users',
    data() {
        return {
            items: [
                { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
                { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
                { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
                { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
            ]
        }
    },
    components: {
        User
    },
    methods: {
        remove(firstName) {
            console.log("Из компонента USERS ", firstName);
        }
    }
}
</script>