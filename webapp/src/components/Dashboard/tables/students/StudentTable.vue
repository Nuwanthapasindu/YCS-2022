<template>
    <div class="row mt-5">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow w-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 heading">{{ Heading }}</h6>

                    <button class="btn btn-success" @click="$emit('refresh', null)">
                        <box-icon name='refresh' color="white"></box-icon>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th v-for=" (TableHeader, key) in TableHeaders" :key="key">{{ TableHeader }}</th>
                                    <th>action</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="TableData == null">
                                    <td colspan="8"></td>
                                </tr>
                                <tr v-for=" (row, key) in TableData.data" :key="key">

                                    <td>{{ row.student.admission_number }}</td>
                                    <td>{{ row.student.full_name }}</td>
                                    <td>{{ row.student.mobile_number }}</td>
                                    <td>{{ row.student.address }}</td>
                                    <td>{{ row.student.mother_name }}</td>
                                    <td>{{ row.student.father_name }}</td>
                                    <td>
                                        <button class="btn btn-warning" @click="get_details(row.student.uuid)"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Edit
                                        </button>


                                    </td>
                                    <td> <button class="btn btn-danger" @click="delete_details(row.student.uuid)">
                                            Delete
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
                    <form>
                        <div class="alert alert-danger my-3" v-for="(messages, key) in ermessage" :key="key">
                            <ul>

                                <li v-for="(msg, key) in messages" :key="key">
                                    {{ msg }}
                                </li>

                            </ul>

                        </div>
                        <div class="modal-body">

                            <div class="alert alert-success my-3" v-if="message">{{ message }}</div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>

                                            <th>admission number</th>
                                            <th>full_name</th>
                                            <th>mobile number</th>
                                            <th>address</th>
                                            <th>mother name</th>
                                            <th>father name</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td><input type="text" class="form-control"
                                                    v-model="student_details.admission_number"></td>
                                            <td><input type="text" class="form-control"
                                                    v-model="student_details.full_name">
                                            </td>
                                            <td><input type="text" class="form-control"
                                                    v-model="student_details.mobile_number"></td>
                                            <td><input type="text" class="form-control"
                                                    v-model="student_details.address">
                                            </td>
                                            <td><input type="text" class="form-control"
                                                    v-model="student_details.mother_name"></td>
                                            <td><input type="text" class="form-control"
                                                    v-model="student_details.father_name"></td>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"
                                @click.prevent="update_details(student_details.uuid)">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import axios from 'axios';

export default {
    props: {
        url: {
            type: String,
        },
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
            student_details: {
                uuid: '',
                admission_number: '',
                full_name: '',
                mobile_number: '',
                address: '',
                mother_name: '',
                father_name: '',
            },
            details: {},
            ermessage: '',
            message: '',
        }
    },
    methods: {

        get_details(id) {
            axios.get('student/edit/' + id).then(response => {
                this.details = response.data.student[0]
                this.student_details.uuid = response.data.student[0].uuid
                this.student_details.admission_number = response.data.student[0].admission_number
                this.student_details.full_name = response.data.student[0].full_name
                this.student_details.mobile_number = response.data.student[0].mobile_number
                this.student_details.address = response.data.student[0].address
                this.student_details.mother_name = response.data.student[0].mother_name
                this.student_details.father_name = response.data.student[0].father_name

            }).catch(e => {
                console.log(e);

            })
        },

        delete_details(id) {

            this.$emit('delete_student', id)
        },
        update_details(id) {

            let student_details = {
                admission_number: this.details.admission_number !== this.student_details.admission_number ? this.student_details.admission_number : '',
                full_name: this.details.full_name !== this.student_details.full_name ? this.student_details.full_name : '',
                mobile_number: this.details.mobile_number !== this.student_details.mobile_number ? this.student_details.mobile_number : '',
                address: this.details.address !== this.student_details.address ? this.student_details.address : '',
                mother_name: this.details.mother_name !== this.student_details.mother_name ? this.student_details.mother_name : '',
                father_name: this.details.father_name !== this.student_details.father_name ? this.student_details.father_name : '',
            };
            axios.put('student/update/' + id, student_details).then(response => {
                if (response.data.status == 200) {
                    this.message = response.data.message
                    this.ermessage = '';
                }

            }).catch(e => {
                this.ermessage = e.response.data.message;
                this.message = ''

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


    }
}
</style>