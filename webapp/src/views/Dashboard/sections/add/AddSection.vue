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
                                <h1>Add Sections</h1>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">Section Head Name</span>
                                            <input type="text" class="form-control" v-model="state.Section_head_name" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">Year</span>
                                            <YearSelector @year="selected_year" />
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">Section Head Email</span>
                                            <input type="email" class="form-control" v-model="state.email" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">Temporary Password</span>
                                            <RandomPassword @generator="generator" />
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-5 col-md-12 my-2">

                                            <span class="label">Select the section</span>

                                            <SectionList @selected_section="selected_section" />
                                        </div>
                                        <span
                                            class="text-center d-flex align-items-center justify-contents-center col-lg-2 col-md-12">
                                            OR
                                        </span>
                                        <div class="col-lg-5 col-md-12 my-2">
                                            <span class="label">Type The Section</span>
                                            <input type="text" class="form-control" v-model="state.section" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12 col-md-12 my-2">

                                            <span class="label">Other Details</span>
                                            <textarea class="form-control py-4 px-4 mt-3"
                                                v-model="state.other_details"></textarea>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <button type="submit" class="btn">Add Section</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="card shadow w-100">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 heading">{{ TableConfig.Heading }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th v-for=" (TableHeader, key) in TableConfig.TableHeaders" :key="key">
                                                    {{
                                                            TableHeader
                                                    }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for=" (row, key) in TableConfig.TableData" :key="key">
                                                <td>{{ key + 1 }}</td>
                                                <td>{{ row.name }}</td>
                                                <td>{{ row.additional_data }}</td>
                                                <td><button class="btn btn-success">
                                                        Details
                                                    </button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>
import SectionList from '@/components/Dashboard/sections/SectionList.vue';
import YearSelector from '@/components/Dashboard/years/YearSelector.vue';
import RandomPassword from '@/components/Dashboard/passwords/RandomPassword.vue';
import axios from 'axios';
import { reactive, computed } from 'vue';
import useVuelidate from '@vuelidate/core'
import { required, email, minLength, helpers } from '@vuelidate/validators'
export default {
    created() {
        this.sections();
    },
    setup() {
        const state = reactive({
            Section_head_name: 'hnpkdias@gmail.com',
            section: '',
            password: '',
            year: '',
            email: '',
            other_details: '',
        });

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage('The email field is required', required),
                    email: helpers.withMessage('The email you typed is not a valid email address', email),
                },
                password: {
                    required: helpers.withMessage('The password field is required', required),
                    minLength: helpers.withMessage('The mobile number must be at least 9 characters', minLength(8)),
                },

            }
        })

        const v$ = useVuelidate(rules, state);
        return { state, v$ }
    },
    data() {
        return {
            nav_active: false,
            TableConfig: {
                TableData: {},
                TableHeaders: ['#', 'Section', 'Additional Data', 'more details'],
                Heading: "Sections"
            }
        };
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        },
        selected_year(year) {
            this.state.year = year;
        },
        selected_section(section) {
            this.state.section = section;
        },
        generator(password) {
            this.state.password = password;
        },
        sections() {
            axios.get('sections/all').then(r => {
                this.TableConfig.TableData = r.data.sections
            }).catch(e => {
                console.log(e);
            })
        }
    },
    components: { SectionList, YearSelector, RandomPassword }
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
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('@/assets/Dashboard/Sections/banner.jpg');
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

        .heading {
            font-weight: 800;
            color: var(--dashboard-color);
            text-transform: uppercase;
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