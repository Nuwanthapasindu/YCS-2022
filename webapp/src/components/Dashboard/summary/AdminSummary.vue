<template>
    <div class="row my-5">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow w-100">
                <div class="card-header card-head py-3">
                    <h1 class="heading">Section Attendance</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        Class
                                    </th>
                                    <th>
                                        Attendance
                                    </th>
                                    <th>
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="(row, key) in data.sectionsWiseAttendance" :key="key">
                                    <td>
                                        {{ row.section.name }}
                                    </td>
                                    <td>
                                        {{ row.attendance }}
                                    </td>

                                    <td>
                                        <button class="btn btn-success" @click="getData(row.section.id)"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Details
                                        </button>
                                    </td>

                                </tr>
                                <tr>
                                    <td>ALL attendance</td>
                                    <td>{{ data.allSchoolAttendance }}</td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
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
                                        <th>Class Name</th>
                                        <th>Class Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, key) in sectionData" :key="key">
                                        <td>{{ row.class }}</td>
                                        <td>{{ row.attendance }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    setup() {


        return {}
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            sectionData: {}
        }
    },
    methods: {
        getData(id) {
            axios.get(`sections/${id}/attendance-summery`).then(response => this.sectionData = response.data.selectedSectionAttendance);
        }
    }
}
</script>

<style lang="scss" scoped>
.container {
    overflow-x: hidden;

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
                text-align: center;
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