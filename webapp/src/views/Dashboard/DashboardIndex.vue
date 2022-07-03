<template>
    <main class="d-flex">
        <side-bar :open="nav_active" />
        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Nav Bar Start  -->
            <NavBar @toggleNav="toggle" />
            <!-- Nav Bar End  -->
            <div class="container">

            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>


export default {

    data() {
        return {
            nav_active: false
        }
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        }
    }
}
</script>

<style lang="scss">
main {
   // background: var(--dashboard-color);
    width: 100vw;
    min-height: 100vh;
    height: auto;
    overflow-x: hidden;
}

.container {
    overflow-x: hidden;
}
</style>