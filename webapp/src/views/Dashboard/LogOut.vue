<template>
    <main class="d-flex">

    </main>
</template>

<script>
import { mapActions } from 'vuex';
export default {

    created() {
        this.signOut()
    },
    methods: {
        ...mapActions({
            logout: 'auth/logout'
        }),
        signOut() {
            this.logout()
        }
    }
}
</script>

<style lang="scss" scoped>
main {
    width: 100vw;
    min-height: 100vh;
    height: auto;
    overflow-x: hidden;
}
</style>