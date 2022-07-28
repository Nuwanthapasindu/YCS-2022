<template>
    <select @change.prevent="select_user($event)" class="form-control">
        <option>Select The user</option>
        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.full_name }} &nbsp; ({{ user.role }})
        </option>

    </select>
</template>

<script>
import axios from 'axios'
export default {
    mounted() {
        axios.get('/user/all').then(response => this.users = response.data.users)
    },
    data() {
        return {
            users: null
        }
    },
    methods: {
        select_user(e) {
            this.$emit('select_user', e.target.value)
        }
    },
}
</script>

<style lang="scss" scoped>
select {
    border: none;
    border-bottom: 2px solid var(--dashboard-color);
    outline: 0;

    &::placeholder {
        font-weight: 400;
        color: var(--dashboard-color);
    }

    &:focus {
        outline: 0;
        box-shadow: none;
        transition: all .2s ease-in-out;
        border-bottom: 2px solid var(--dashboard-warning);

    }
}
</style>