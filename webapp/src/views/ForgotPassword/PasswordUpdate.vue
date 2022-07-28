<template>
    <div class="container">

        <div class="card shadow-sm">
            <div class="card-head">
                <h1>Update Password</h1>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="state.errorMessage">{{ state.errorMessage }} </div>
                <div class="alert alert-success" v-if="state.successMessage">{{ state.successMessage }} You are
                    Automatically redirect in {{
                            state.count
                    }}'s</div>
                <form class="py-2">

                    <div class="row my-3">
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="" class="form-label">Password</label>
                            <span class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                v-if="v$.password.$error">* &nbsp;{{
                                        v$.password.$errors[0].$message
                                }}</span>
                            <input type="password" class="form-control" autocomplete v-model="state.password" />
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for="" class="form-label">Re Type Your Password</label>
                            <span class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                v-if="v$.confirm_password.$error">* &nbsp;{{
                                        v$.confirm_password.$errors[0].$message
                                }}</span>
                            <input type="password" class="form-control" autocomplete v-model="state.confirm_password" />
                        </div>
                    </div>

                    <button class="btn" @click.prevent="handlePassword" v-if="!state.isLoading">Update Password</button>
                    <LoaderView v-if="state.isLoading" />
                    <router-link to="/" class="mx-5" v-if="!state.isLoading">
                        back to Login
                    </router-link>

                </form>
            </div>
        </div>

    </div>
</template>

<script>

import axios from 'axios';
import useVuelidate from '@vuelidate/core'
import { reactive, computed } from 'vue';
import { helpers, minLength, required, sameAs, requiredIf } from '@vuelidate/validators'
import LoaderView from '@/components/loader/LoaderView.vue';
export default {
    setup() {
        const state = reactive({
            password: "",
            confirm_password: "",
            successMessage: "",
            errorMessage: "",
            count: 10,
            Token: "",
            isLoading: false,
        });
        const rules = computed(() => {
            return {
                password: {
                    required: helpers.withMessage("The password field is required", required),
                    minLength: helpers.withMessage("The password must be at least 8 characters", minLength(8)),
                },
                confirm_password: {
                    requiredIf: helpers.withMessage("Please Retype Your Password", requiredIf(state.password)),
                    sameAs: helpers.withMessage("The password and confirmation password do not match.", sameAs(state.password)),
                },
            };
        });
        const v$ = useVuelidate(rules, state);
        return { state, v$ };
    },
    mounted() {
        if (!this.$route.query.token) {
            this.$router.push("/");
        }
        this.state.Token = this.$route.query.token;
    },
    methods: {
        handlePassword() {
            this.v$.$validate();
            if (!this.v$.$error) {
                this.state.isLoading = true
                axios.post("auth/forgot-password-update/" + this.state.Token, {
                    "password": this.state.password,
                }).then(response => {
                    this.state.successMessage = response.data.message;
                    setInterval(() => this.state.count == 0 ? this.$router.push("/login") : this.state.count--, 1000);
                    this.state.isLoading = false

                }).catch(e => {
                    this.state.errorMessage = e.response.data.message
                    if (e.response.data.message == "Invalid token.") {
                        setTimeout(() => this.$router.push('/login'), 2000);

                    } else {

                        this.state.isLoading = false
                    }

                });
            }
        }
    },
    components: { LoaderView }
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
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    max-height: 100vh;

    .card {
        border-radius: 20px;
        overflow: hidden;
        z-index: 1;
        width: 100%;

        .card-head {
            height: 300px;
            background-image: url('@/assets/Dashboard/MyProfile/banner.jpg');
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
}
</style>