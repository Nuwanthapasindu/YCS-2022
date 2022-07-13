<template>
    <section class="container-fluid">
        <div class="container shadow-lg">
            <div class="row">
                <div class="col-lg-6 col-md-12 py-5 ">
                    <div class="container py-5">
                        <div class="row my-5">
                            <h1 class="text-center">Welcome Back</h1>
                            <small class="text-center">
                                Welcome back! Please enter Your details
                            </small>
                        </div>
                        <form>
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <span class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                    v-if="v$.email.$error">* &nbsp;{{
                                            v$.email.$errors[0].$message
                                    }}</span>
                                <input type="email" placeholder="Enter Your Email Address" class="form-control"
                                    v-model="state.email" :class="v$.email.$error ? 'error' : null" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <span class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                    v-if="v$.password.$error">* &nbsp;{{
                                            v$.password.$errors[0].$message
                                    }}</span>
                                <div class="row password-row">
                                    <input :type="state.show ? 'text' : 'password'" placeholder="Enter Your Password"
                                        class="form-control" v-model="state.password"
                                        :class="v$.password.$error ? 'error' : null" />


                                    <box-icon :name='state.show ? "hide" : "show"' class="eye"
                                        @click="state.show = !state.show"></box-icon>

                                </div>
                            </div>
                            <button type="submit" class="btn form-control mt-2 login-button"
                                @click.prevent="validation">Sign In</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" id="img">

                </div>
            </div>
        </div>
    </section>
</template>

<script>

import { mapActions, mapState } from 'vuex';
import { reactive, computed } from 'vue';
import useVuelidate from '@vuelidate/core'
import { required, email, minLength, helpers } from '@vuelidate/validators'
export default {
    computed: mapState({
        User: state => state.auth.user
    }),
    watch: {
        User(newValue, oldValue) {

            if (newValue !== oldValue) {
                this.$router.push('dashboard');

            }

        }
    },

    setup() {
        const state = reactive({
            email: 'nuwanthadias@gmail.com',
            password: 'aG{|w!G?Rq',
            show: false,

        });

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage('The email field is required', required),
                    email: helpers.withMessage('The email you typed is not a valid email address', email),
                },
                password: {
                    required: helpers.withMessage('The password field is required', required),
                    minLength: helpers.withMessage('The password must be at least 9 characters', minLength(8)),
                },

            }
        })

        const v$ = useVuelidate(rules, state);
        return { state, v$ }
    },
    methods: {
        ...mapActions({
            'Login': 'auth/signIn'
        }),
        validation() {
            this.v$.$validate();
            if (!this.v$.$error) {
                this.Login({
                    email: this.state.email,
                    password: this.state.password,
                });

            }

        },
    },

}
</script>

<style lang="scss" scoped>
section.container-fluid {
    height: 100vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;

    .container {
        background: #fff;
        border-radius: 15px;
    }

    #img {
        background-image: url('@/assets/Login/login.jpg');
        background-size: cover;
        background-position: center center;
    }

    h1 {
        font-weight: 900;

    }

    form {
        input.error {
            border-bottom: 2px dashed var(--dashboard-color);
            outline: 0;

            &:focus {
                outline: 0;
                box-shadow: none;
                border-bottom: 2px dashed var(--dashboard-main);

            }

        }

        .password-row {
            position: relative;

            .eye {
                position: absolute;
                top: 5px;
                right: -82%;
                cursor: pointer;
            }
        }

        input {
            border: 0px;
            border-bottom: 1px solid var(--dashboard-color-light);
            outline: 0;

            &:focus {

                outline: 0;
                box-shadow: none;
                border-bottom: 1px solid var(--dashboard-warning);

            }

        }

        label {
            font-weight: 700;
        }

        .login-button {
            background: var(--dashboard-color);
            color: #fff;
            border-radius: 5px;
            font-weight: 800;
        }
    }

}
</style>