<template>
    <main class="d-flex">
        <side-bar :open="nav_active" />
        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Nav Bar Start  -->
            <NavBar @toggleNav="toggle" />
            <!-- Nav Bar End  -->
            <div class="container h-100vh">
                <dashboard-Calendar class="w-100 my-5 h-100vh" is-dark is-range is-expanded />

                <div class="row my-5" v-if="state.role == 'section_head'">
                    <div class="col-lg-12 col-md-12">
                        <div class="card shadow w-100">
                            <div class="card-header card-head py-3">
                                <h1 class="heading">Classes Attendance</h1>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Class
                                                </th>
                                                <th>
                                                    Attendance
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(attendance, key) in attendance.classWiseAttendance" :key="key">
                                                <td>
                                                    {{ attendance.class }}
                                                </td>
                                                <td>
                                                    {{ attendance.attendance }}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>{{ attendance.allSectionAttendance
                                                }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <AdminSummary v-if="state.role == 'admin'" :data="attendance" />
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>
import { mapGetters } from 'vuex'
import { reactive } from 'vue';
import axios from 'axios';
import 'v-calendar/dist/style.css';
import AdminSummary from '@/components/Dashboard/summary/AdminSummary.vue';
export default {
    setup() {
        const state = reactive({
            User: null,
            role: null
        });
        return { state };
    },
    computed: mapGetters({
        user: "auth/GET_USER"
    }),
    data() {
        return {
            nav_active: false,
            attendance: {}
        };
    },
    created() {
        this.state.role = localStorage.getItem("role") !== null ? localStorage.getItem("role") : null;
        if (this.state.role == "section_head") {
            this.sectionAttendance();
        }
        if (this.state.role == "admin") {
            this.ALLsectionAttendance();
        }
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        },
        sectionAttendance() {
            axios.get("sections/attendance-summery").then(response => this.attendance = response.data);
        },
        ALLsectionAttendance() {
            axios.get("sections/all/attendance-summery").then(response => this.attendance = response.data);
        }
    },
    components: { AdminSummary }
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

    .card {
        border-radius: 20px;
        overflow: hidden;
        z-index: 1;

        .card-head {
            height: 200px;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('@/assets/Dashboard/Sections/banner.jpg');
            background-size: cover;
            background-position: center center;
            display: flex;
            align-items: center;
            justify-content: center;

            h1 {
                color: #ffff;
                font-weight: 900;
                text-align: center;
            }


        }

        .card-body {
            form {

                textarea,
                input {
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

                label {
                    font-weight: 700;
                }

                .btn {
                    background: var(--dashboard-color);
                    color: #fff;
                    border-radius: 5px;
                    font-weight: 800;
                }
            }

            .row {
                overflow-x: hidden;

                table {
                    tr {
                        th {
                            text-transform: uppercase;
                        }
                    }
                }
            }
        }
    }

    .popup {
        min-height: 100vh;
        background-color: rgba(0, 0, 0, .5);

    }
}
</style>