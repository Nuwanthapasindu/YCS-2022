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
                                <div class="alert alert-success" v-if="success">
                                    {{ success }}
                                </div>
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
                                        <button type="submit" class="btn" @click.prevent="AddSection"
                                            v-if="!sending">Add
                                            Section</button>
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
                                                <td>{{ row.section }}</td>
                                                <td>{{ row.additional_data }}</td>
                                                <td><button class="btn btn-success" @click="get_details(row.id)"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
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
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title heading" id="exampleModalLabel">Section Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Year</th>
                                        <th>Class Name</th>
                                        <th>Class Details</th>
                                        <th>Profile Pic</th>
                                        <th>Class Teacher</th>
                                        <th>Class Teacher Address</th>
                                        <th>Class Teacher Mobile Number</th>
                                        <th>Class Teacher Email</th>
                                        <th>Class Teacher Profile Status</th>
                                        <th>Class Teacher Profile complete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for=" (row, key) in section_details" :key="key">
                                        <td>{{ key + 1 }}</td>
                                        <td>{{ row.get_class.year }}</td>
                                        <td>{{ row.get_class.class_name }}</td>
                                        <td>{{ row.get_class.other }}</td>
                                        <td><img :src="row.get_user.profile_pic" alt="Profile Picture"
                                                class="profilePic"></td>
                                        <td>{{ row.get_user.full_name }}</td>
                                        <td>{{ row.get_user.address }}</td>
                                        <td>{{ row.get_user.mobile_number }}</td>
                                        <td>{{ row.get_user.email }}</td>
                                        <td>
                                            <span class="badge bg-success"
                                                v-if="row.get_user.status == true">Active</span>
                                            <span class="badge bg-danger"
                                                v-if="row.get_user.status == false">Block</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success"
                                                v-if="row.get_user.completed == true">Completed</span>
                                            <span class="badge bg-danger" v-if="row.get_user.completed == false">Not
                                                Completed</span>
                                        </td>

                                        <!-- <td>Profile Pic</td> -->

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import SectionList from '@/components/Dashboard/sections/SectionList.vue';
import YearSelector from '@/components/Dashboard/years/YearSelector.vue';
import RandomPassword from '@/components/Dashboard/passwords/RandomPassword.vue';
import axios from 'axios';
import { reactive } from 'vue';
export default {
    created() {
        this.sections();
    },
    setup() {
        const state = reactive({
            Section_head_name: '',
            section: '',
            email: '',
            other_details: '',
        });



        return { state }
    },
    data() {
        return {
            errors: null,
            success: null,
            sending: false,
            section_details: null,
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

            this.state.Section_year = year;

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
        },
        AddSection() {
            this.sending = true;
            axios.post('sections/add', this.state).then(response => {
                if (response.data.status == 201) {

                    this.success = response.data.Message;
                    this.sections()
                    this.sending = false;
                }
            }).catch(e => {
                this.errors = e.response.data.message;
                this.sending = true;
            })
        },
        get_details(id) {
            axios.get('sections/details/' + id).then(response => {
                this.section_details = response.data.Section_classes;
            }).catch(e => {
                console.log(e);

            })
        }
    },
    components: { SectionList, YearSelector, RandomPassword, }
}
</script>

<style lang="scss" scoped>
main {
    width: 100vw;
    min-height: 100vh;
    height: auto;
    overflow-x: hidden;

    .modal {
        .profilePic {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    }
}

.heading {
    font-weight: 800;
    color: var(--dashboard-color);
    text-transform: uppercase;
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