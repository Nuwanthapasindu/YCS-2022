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
                                <h1>Add Student</h1>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">admission number</span>
                                            <input type="number" class="form-control" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">full name</span>
                                            <input type="text" class="form-control" />
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">mobile number </span>
                                            <input type="text" class="form-control" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">address</span>
                                            <input type="text" class="form-control" />
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">mother's name </span>
                                            <input type="text" class="form-control" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 my-2">
                                            <span class="label">father's name</span>
                                            <input type="text" class="form-control" />
                                        </div>

                                    </div>
                                    <button type="submit" class="btn">Add Student</button>

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
import TableWidget from '@/components/Dashboard/tables/TableWidget.vue';
export default {
    data() {
        return {
            nav_active: false,
            TableConfig: {
                TableData: {},
                TableHeaders: ['#', 'admission_number', 'student name', 'mobile number', 'address', 'mother\'s name', 'father\'s name'],
                Heading: "Students"
            }
        };
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        },
    },
    components: { TableWidget, }
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
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('@/assets/Dashboard/Student/banner.jpg');
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
                span.label {
                    text-transform: capitalize;
                }

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