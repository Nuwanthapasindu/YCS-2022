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
                                            <input type="text" class="form-control" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">Year</span>
                                            <YearSelector @year="selected_year" />
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">Section Head Email</span>
                                            <input type="email" class="form-control" />
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
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12 col-md-12 my-2">

                                            <span class="label">Other Details</span>
                                            <textarea class="form-control py-4 px-4 mt-3"></textarea>

                                        </div>


                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <TableWidget :TableData="TableConfig.TableData" :TableHeaders="TableConfig.TableHeaders"
                    :Heading="TableConfig.Heading" />
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
import TableWidget from '@/components/Dashboard/tables/TableWidget.vue';
export default {
    data() {
        return {
            nav_active: false,
            year: '',
            section: '',
            password: '',
            TableConfig: {
                TableData: {},
                TableHeaders: ['#', 'Section', 'SectionHead', 'mobile number', 'address', 'email', 'profile picture'],
                Heading: "Sections"
            }
        };
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        },
        selected_year(year) {
            this.year = year;
        },
        selected_section(section) {
            this.section = section;
        },
        generator(password) {
            this.password = password;
        }
    },
    components: { SectionList, YearSelector, RandomPassword, TableWidget }
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