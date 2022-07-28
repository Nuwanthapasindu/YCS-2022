<template>
    <main class="d-flex">
        <side-bar :open="nav_active" />
        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Nav Bar Start  -->
            <NavBar @toggleNav="toggle" />
            <!-- Nav Bar End  -->
            <div class="container d-flex justify-content-center">
                <div class="col-lg-9 col-md-12">
                    <div class="alert alert-danger mt-4" role="alert" v-if="errorMessage">


                        <ul>
                            <li v-for="(message, key) in errorMessage " :key="key">
                                {{ message[0] }}
                            </li>
                        </ul>
                    </div>
                    <div class="alert alert-success mt-4" role="alert" v-if="successMessage">
                        {{ successMessage }}
                    </div>

                    <h3 class="text-center my-3">Assign</h3>
                    <div class="row mt-5">
                        <div class="col-lg-12 col-md-12">

                            <UserSelector @select_user="select_user" />
                        </div>
                    </div>


                    <h3 class="text-center my-3">To</h3>

                    <div class="row mb-5">

                        <div class="col-lg-12 col-md-12">
                            <OnlineSection @selected_section="selected_section" />
                        </div>
                    </div>
                    <div class="row mb-5">

                        <button class="btn button" @click="handelAssign">Assign user to Section</button>
                    </div>
                </div>
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->
    </main>
</template>

<script>
import UserSelector from "@/components/Dashboard/selections/users/UserSelector.vue";
import OnlineSection from "@/components/Dashboard/sections/OnlineSection.vue";
import axios from 'axios'
export default {
    setup() {
        return {};
    },
    data() {
        return {
            nav_active: false,
            user: '',
            section: '',
            successMessage: '',
            errorMessage: '',
        };
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        },
        select_user(value) {

            this.user = value
        },
        selected_section(value) {

            this.section = value
        },
        handelAssign() {
            axios.post('sections/assign', {
                User_id: this.user,
                Section_id: this.section
            }).then(response => this.successMessage = response.data.message).catch(e => this.errorMessage = e.response.data.message)
        },
    },
    components: { UserSelector, OnlineSection }
}
</script>

<style lang="scss" scoped>
.button {
    background: var(--dashboard-color);
    color: #fff;
    border-radius: 5px;
    font-weight: 800;
}
</style>