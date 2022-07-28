<template>
    <section class="container-fluid">
        <div class="container shadow-lg">
            <div class="row">
                <div class="col-lg-6 col-md-12 py-5 ">
                    <div class="container py-5">
                        <div class="row my-5">
                            <h1 class="text-center">Forgot Password</h1>
                            <small class="text-center">
                                Please enter Your Email Address
                            </small>
                        </div>
                        <form>
                            <div class="alert alert-danger" v-for="(erMessage, key) in state.errorMessage" :key="key">
                                {{ erMessage[0] }}
                            </div>
                            <div class="alert alert-success" v-if="state.successMessage">{{ state.successMessage }}
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <span class="d-block text-danger font-weight-bold animate__animated animate__fadeIn"
                                    v-if="v$.email.$error">* &nbsp;{{
                                            v$.email.$errors[0].$message
                                    }}</span>
                                <input type="email" placeholder="Enter Your Email Address" class="form-control"
                                    v-model="state.email" :class="v$.email.$error ? 'error' : null" />
                            </div>
                            <button type="submit" class="btn form-control mt-2 login-button" @click.prevent="validation"
                                v-if="!state.show">Verify Email</button>

                            <LoaderView v-if="state.show" />
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
import axios from 'axios'
import { reactive, computed } from 'vue';
import useVuelidate from '@vuelidate/core'
import { required, email, helpers } from '@vuelidate/validators'
import LoaderView from '@/components/loader/LoaderView.vue';

export default {
    setup() {
        const state = reactive({
            email: "",
            show: false,
            successMessage: "",
            errorMessage: "",
        });
        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage("The email field is required", required),
                    email: helpers.withMessage("The email you typed is not a valid email address", email),
                },
            };
        });
        const v$ = useVuelidate(rules, state);
        return { state, v$ };
    },
    methods: {
        validation() {
            this.v$.$validate();
            if (!this.v$.$error) {
                this.state.show = true;
                axios.post("auth/email-verification", { email: this.state.email }).then(response => {
                    this.state.successMessage = response.data.message;
                    this.state.show = false;

                }).catch(e => {
                    this.state.errorMessage = e.response.data.message
                    this.state.show = false;
                });
            }
        },
    },
    components: { LoaderView }
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
        background-image: url('@/assets/ForgotPassword/ForgotPassword.jpg');
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