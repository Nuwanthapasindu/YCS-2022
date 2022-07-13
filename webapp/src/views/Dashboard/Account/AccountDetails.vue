<template>
    <main class="d-flex">
        <side-bar :open="nav_active" />
        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Nav Bar Start  -->
            <NavBar @toggleNav="toggle" />
            <!-- Nav Bar End  -->
            <!-- Form -->
            <div class="container py-4 my-5">
                <div class="row">
                    <!-- Profile Details Start -->
                    <div class="col-lg-4 col-md-12 mb-5">
                        <div class="card shadow-sm">
                            <div class="card-head profile_card">
                                <img :src="user.profile_pic" class="profile_pic" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <!-- Profile Details Start -->
                        <div class="card shadow-sm">
                            <div class="card-body py-5">
                                <div class="row py-5">
                                    <div class="col-lg-12">
                                        <table class="table table-borderless table-hover h-100">
                                            <tr>
                                                <th>Full Name </th>
                                                <td>{{ user.full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Number </th>
                                                <td>{{ user.mobile_number }}</td>

                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ user.address }}</td>

                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ user.email }}</td>

                                            </tr>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container py-4 my-5">
                <!-- Form -->
                <div class="row">
                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-head">
                                <h1>Update Profile</h1>
                            </div>
                            <div class="card-body">
                                <form class="py-2">
                                    <div class="alert alert-danger" v-if="state.errorMessages">
                                        <ul>
                                            <li v-for="(message, key) in state.errorMessages" :key="key">
                                                {{ message[0] }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="alert alert-success" v-if="state.successMessage">
                                        {{ state.successMessage }}
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                            <span
                                                class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                                v-if="v$.Full_name.$error">* &nbsp;{{
                                                        v$.Full_name.$errors[0].$message
                                                }}</span>
                                            <input type="text" class="form-control" v-model="state.Full_name" />
                                        </div>

                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                                            <span
                                                class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                                v-if="v$.Mobile_number.$error">* &nbsp;{{
                                                        v$.Mobile_number.$errors[0].$message
                                                }}</span>
                                            <input type="tel" class="form-control" v-model="state.Mobile_number" />
                                        </div>

                                    </div>
                                    <div class="row my-3">
                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <label for="exampleInputEmail1" class="form-label">Address</label>
                                            <span
                                                class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                                v-if="v$.Address.$error">* &nbsp;{{
                                                        v$.Address.$errors[0].$message
                                                }}</span>
                                            <input type="text" class="form-control" v-model="state.Address" />
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label for="exampleInputEmail1" class="form-label">Email</label>
                                            <span
                                                class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                                v-if="v$.email.$error">* &nbsp;{{
                                                        v$.email.$errors[0].$message
                                                }}</span>
                                            <input type="email" class="form-control" v-model="state.email" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn"
                                                @click.prevent="handleSubmit">Update</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <ImageUploader />
                    </div>
                </div>
                <!-- Form End -->
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>
import ImageUploader from '@/components/Dashboard/uploads/ImageUploader.vue';
import axios from 'axios';
import useVuelidate from '@vuelidate/core'
import { reactive, computed } from 'vue';
import { mapGetters, mapActions, useStore } from 'vuex'
import { helpers, minLength, maxLength, email, required, numeric } from '@vuelidate/validators'
export default {
    computed: mapGetters({
        user: 'auth/GET_USER'
    }),

    setup() {
        const store = useStore();

        const state = reactive({

            Full_name: store.getters['auth/GET_USER'].full_name,
            Mobile_number: store.getters['auth/GET_USER'].mobile_number,
            Address: store.getters['auth/GET_USER'].address,
            email: store.getters['auth/GET_USER'].email,
            errorMessages: '',
            successMessage: '',

        });
        const rules = computed(() => {
            return {
                Full_name: {
                    required: helpers.withMessage('The mobile number field is required', required)
                },
                Mobile_number: {
                    required: helpers.withMessage('The mobile number field is required', required),
                    minLength: helpers.withMessage('The mobile number must be at least 9 characters', minLength(9)),
                    maxLength: helpers.withMessage('The mobile number should be a maximum of 11 characters', maxLength(11)),
                    numeric: helpers.withMessage('The mobile number field must be numeric', numeric)
                },
                Address: {
                    required: helpers.withMessage('The address field is required', required)
                },

                email: {
                    required: helpers.withMessage('The email field is required', required),
                    email: helpers.withMessage('Please type a valid email address', email),
                },
                // password: {
                //     required: helpers.withMessage('The password field is required', required),
                //     minLength: helpers.withMessage('The password must be at least 8 characters', minLength(8)),
                // },
            }
        });
        const v$ = useVuelidate(rules, state);

        return { state, v$ };
    },


    data() {
        return {
            nav_active: false,
        };
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        },
        ...mapActions({
            'attempt': 'auth/attempt'
        }),

        handleSubmit() {

            this.v$.$validate();
            if (!this.v$.$error) {



                axios.post('auth/profile/' + this.user.uuid, {
                    'Full_name': this.state.Full_name,
                    'mobile_number': this.state.Mobile_number,
                    'Address': this.state.Address,
                    'email': this.state.email,
                }).then(response => {
                    this.state.successMessage = response.data.message
                    this.attempt(localStorage.getItem('token'))

                }).catch(e => {
                    this.state.errorMessages = e.response.data.message
                })
            }

        }
    },
    components: { ImageUploader, }
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

    .card {
        border-radius: 20px;
        overflow: hidden;
        z-index: 1;

        .card-head {
            height: 200px;
            background-image: url('@/assets/Dashboard/MyProfile/banner.jpg');
            background-size: cover;
            background-position: center center;
            display: flex;
            align-items: center;
            justify-content: center;

            &.profile_card {
                height: 400px;

                img.profile_pic {
                    width: 200px;
                    height: 200px;
                    border-radius: 50%;

                    object-fit: cover;
                    border: 5px solid var(--dashboard-main);
                    padding: 2px;
                    transform: translate(0px, 0%);

                }
            }

            img.profile_pic {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
                transform: translate(0px, 55%);
                border: 5px solid var(--dashboard-main);
                padding: 2px;

            }

            h1 {
                color: #ffff;
                font-weight: 900;
            }
        }

        .card-body {
            form {
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

            table.table {
                tr {
                    cursor: pointer;
                }
            }
        }
    }
}
</style>