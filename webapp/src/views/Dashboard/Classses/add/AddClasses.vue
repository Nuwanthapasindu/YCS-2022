<template>
    <main class="d-flex">
        <side-bar :open="nav_active" />
        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Nav Bar Start  -->
            <NavBar @toggleNav="toggle" />
            <!-- Nav Bar End  -->
            <div class="container">
                <div class="row my-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="card shadow w-100">
                            <div class="card-head">
                                <h1>Add Classes</h1>
                            </div>
                            <div class="card-body">

                                <div class="alert alert-danger  " v-for="(error, key) in errors" :key="key">
                                    <ul>
                                        <li v-for="(msg, key) in error" :key="key">
                                            {{ msg }}
                                        </li>
                                    </ul>
                                </div>
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">Class Teacher</span>
                                            <input type="text" class="form-control" v-model="state.teacher_name" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">Class Teacher Email</span>
                                            <input type="email" class="form-control" v-model="state.email" />
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-12 col-md-12 my-2">
                                            <span class="label">Temporary Password</span>
                                            <RandomPassword @generator="generator" />
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-5 col-md-12 my-2">

                                            <span class="label">Select the Class</span>
                                            <CLassList @selected_class="selected_class" />
                                        </div>
                                        <span
                                            class="text-center d-flex align-items-center justify-contents-center col-lg-2 col-md-12">
                                            OR
                                        </span>
                                        <div class="col-lg-5 col-md-12 my-2">
                                            <span class="label">Type The Class</span>
                                            <input type="text" class="form-control" v-model="state.class_name" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12 col-md-12 my-2">

                                            <span class="label">Other Details</span>
                                            <textarea class="form-control py-4 px-4 mt-3"
                                                v-model="state.other"></textarea>

                                        </div>


                                    </div>
                                    <button type="submit" class="btn" @click.prevent="HandleSubmit()"
                                        v-if="!sending">Add Class</button>

                                    <loader v-if="sending" />
                                    <div class="alert alert-success mt-2" v-if="success">
                                        {{ success }}

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <ClassTable :TableData="TableConfig.TableData" :TableHeaders="TableConfig.TableHeaders"
                    :Heading="TableConfig.Heading" />
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>
import RandomPassword from '@/components/Dashboard/passwords/RandomPassword.vue';
import CLassList from '@/components/classes/CLassList.vue';
import loader from '@/components/loader/LoaderView'
import axios from 'axios';
import ClassTable from '@/components/Dashboard/tables/classes/ClassTable.vue';
import { reactive } from 'vue';


export default {
    created() {
        this.get_data();
    },
    setup() {
        const state = reactive({

            teacher_name: '',
            email: '',
            password: '',
            class_name: '',
            other: '',

        });



        return { state }
    },
    data() {
        return {
            nav_active: false,
            sending: false,
            errors: null,
            success: null,
            TableConfig: {
                TableData: {},
                TableHeaders: ['#', 'Class', 'year', 'Other'],
                Heading: "Classes",

            }
        };
    },
    methods: {
        get_data() {
            axios.get('classes-teacher/all').then(response => {
                this.TableConfig.TableData = response.data.classes
            }).catch(e => {
                console.log(e);
            })
        },
        toggle(value) {
            this.nav_active = value;
        },

        selected_class(SelectedClass) {
            this.state.class_name = SelectedClass;

        },
        generator(password) {
            this.state.password = password;
        },
        HandleSubmit() {
            this.sending = true,
                axios.post('classes-teacher/add', this.state)
                    .then(res => {
                        this.success = res.data.Message
                        this.errors = null;
                        this.get_data();
                        this.sending = false;

                    })
                    .catch(err => {
                        this.errors = err.response.data.message;
                        this.success = null;
                        this.sending = false;
                    })

        },
    },
    components: { RandomPassword, CLassList, ClassTable, loader }
}
</script>

<style lang="scss" scoped>
main {
    width: 100vw;
    min-height: 100vh;
    height: auto;
    overflow-x: hidden;

}

.container {
    overflow-x: hidden;
    min-height: 100vh;

    .card {
        border-radius: 20px;
        overflow: hidden;
        z-index: 1;

        .card-head {
            height: 200px;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('@/assets/Dashboard/Classes/banner.jpg');
            background-size: cover;
            background-position: center center;
            display: flex;
            align-items: center;
            justify-content: center;

            h1 {
                color: #ffff;
                font-weight: 900;
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
        }
    }

    .popup {
        min-height: 100vh;
        background-color: rgba(0, 0, 0, .5);

    }
}
</style>