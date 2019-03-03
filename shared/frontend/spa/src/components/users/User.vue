<template>
    <tr @click="remove">
        <th scope="row">{{ isActive }}</th>
        <td>{{ age }}</td>
        <td>{{ first_name }}</td>
        <td>{{ last_name }}</td>
    </tr>
</template>

<script>
    export default {
        name: 'User',
        props: {
            isActive: {
                type: Boolean,
                require: true
            },
            age: {
                type: Number,
                default: 44
            },
            first_name: String,
            last_name: String
        },
        data() {
            return {
            }
        },
        methods: {
            remove() {
                this.$emit('removeUser', this.first_name)
            }
        }
    }
</script>