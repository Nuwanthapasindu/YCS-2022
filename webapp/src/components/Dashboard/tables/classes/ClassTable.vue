<template>
    <div class="row my-5">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow w-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 heading">{{ Heading }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th v-for=" (TableHeader, key) in TableHeaders" :key="key">{{ TableHeader }}</th>
                                    <th>
                                        More details
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for=" (row, key) in TableData" :key="key">
                                    <td>{{ key + 1 }}</td>
                                    <td>{{ row.class_name }}</td>
                                    <td>{{ row.year }}</td>
                                    <td>{{ row.other }}</td>
                                    <td> <button class="btn" @click="get_details(row.id)" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Details
                                        </button></td>

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
                                    <tr v-for=" (row, key) in class_details" :key="key">
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

                                            <button class="btn d-block my-2" v-if="row.get_user.status == true"
                                                @click.prevent="block(row.get_user.id)">Block
                                                User</button>

                                            <span class="badge bg-danger"
                                                v-if="row.get_user.status == false">Block</span>
                                            <button class="btn d-block my-2" v-if="row.get_user.status == false"
                                                @click.prevent="unblock(row.get_user.id)">UnBlock
                                                User</button>
                                        </td>
                                        <td>
                                            <span class="badge bg-success"
                                                v-if="row.get_user.completed == true">Completed</span>
                                            <span class="badge bg-danger" v-if="row.get_user.completed == false">Not
                                                Completed</span>
                                        </td>



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
    props: {

        TableData: {
            type: Object,
            required: true
        },
        TableHeaders: {
            type: Array,
            required: true
        },
        Heading: {
            type: String,
            required: true
        },
    },
    data() {
        return {
            class_details: {}
        }
    },
    methods: {
        get_details(id) {
            axios.get('classes-teacher/details/' + id).then(response => {
                this.class_details = response.data.Section_classes;
            }).catch(e => {
                console.log(e);

            })
        },
        unblock(id) {
            axios.get('classes-teacher/unblock/' + id).then(response => {
                if (response.data.status == "UnBlocked") {
                    this.get_details(id)
                }
            }).catch(e => {
                console.log(e);

            })
        },
        block(id) {
            axios.get('classes-teacher/block/' + id).then(response => {
                if (response.data.status == "Blocked") {
                    this.get_details(id)
                }
            }).catch(e => {
                console.log(e);

            })
        }
    },
}
</script>

<style lang="scss" scoped>
.heading {
    font-weight: 800;
    color: var(--dashboard-color);
    text-transform: uppercase;
}

.modal {
    .profilePic {
        width: 100px;
        height: 100px;
        object-fit: cover;
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

        tr {
            td {
                .btn {
                    background: var(--dashboard-color);
                    border-radius: 5px;
                    font-weight: 800;
                    color: #fff;

                    &:hover {

                        color: #000;
                        background: var(--dashboard-main);
                    }
                }
            }
        }
    }
}
</style>