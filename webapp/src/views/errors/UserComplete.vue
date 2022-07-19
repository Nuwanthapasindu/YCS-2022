<template>
    <main class="d-flex">

        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Form -->

            <div class="container py-4 my-5">
                <!-- Form -->
                <div class="row">
                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-head">
                                <h1>Fill your account</h1>
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
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="exampleInputEmail1" class="form-label">Address</label>
                                            <span
                                                class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                                v-if="v$.Address.$error">* &nbsp;{{
                                                        v$.Address.$errors[0].$message
                                                }}</span>
                                            <input type="text" class="form-control" v-model="state.Address" />
                                        </div>

                                    </div>
                                    <div class="row my-3">
                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <label for="" class="form-label">Password</label>
                                            <span
                                                class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                                v-if="v$.password.$error">* &nbsp;{{
                                                        v$.password.$errors[0].$message
                                                }}</span>
                                            <input type="password" class="form-control" v-model="state.password" />
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label for="" class="form-label">Re Type Your Password</label>
                                            <span
                                                class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                                v-if="v$.confirm_password.$error">* &nbsp;{{
                                                        v$.confirm_password.$errors[0].$message
                                                }}</span>
                                            <input type="password" class="form-control"
                                                v-model="state.confirm_password" />
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
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>
import ImageUploader from '@/components/Dashboard/uploads/ImageUploader.vue';
import router from '@/router';
import useVuelidate from '@vuelidate/core'
import { reactive, computed } from 'vue';
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex'
import { required, requiredIf, helpers, minLength, sameAs } from '@vuelidate/validators'
export default {
    computed: mapGetters({
        user: 'auth/GET_USER'
    }),
    setup() {
        const state = reactive({
            Full_name: '',
            Mobile_number: '',
            Address: '',
            password: '',
            confirm_password: '',
            errorMessages: '',
            successMessage: '',

        });

        const rules = computed(() => {
            return {
                Full_name: {
                    required: helpers.withMessage('The Full Name field is required', required),
                },
                Mobile_number: {
                    required: helpers.withMessage('The mobile number is required', required),
                    minLength: helpers.withMessage('The mobile number must be at least 9 characters', minLength(9))
                },
                Address: {
                    required: helpers.withMessage('The address is required', required),
                },
                password: {
                    required: helpers.withMessage('The password field is required', required),
                    minLength: helpers.withMessage('The password must be at least 8 characters', minLength(8)),
                },
                confirm_password: {
                    requiredIf: helpers.withMessage('Please Retype Your Password', requiredIf(state.password)),
                    sameAs: helpers.withMessage('The password and confirmation password do not match.', sameAs(state.password)),
                },
            }
        })

        const v$ = useVuelidate(rules, state);


        return { state, v$ }
    },

    methods: {
        ...mapActions({
            'attempt': 'auth/attempt'
        }),

        handleSubmit() {
            this.v$.$validate();
            if (!this.v$.$error) {
                axios.post('auth/complete/' + this.user.uuid, {
                    'Full_name': this.state.Full_name,
                    'mobile_number': this.state.Mobile_number,
                    'Address': this.state.Address,
                    'password': this.state.password,
                }).then(response => {
                    this.state.successMessage = response.data.message
                    this.attempt(localStorage.getItem('token'))
                    router.push('/dashboard');
                }).catch(e => {
                    this.state.errorMessages = e.response.data.message
                })
            }

        }

    },
    components: { ImageUploader }
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