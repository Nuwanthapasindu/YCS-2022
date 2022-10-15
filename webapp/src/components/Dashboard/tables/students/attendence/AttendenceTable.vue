<template>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Attendance</th>


                </tr>
            </thead>
        </table>
        <div class="table-responsive">
            <table class="table table-hover">

                <tbody>

                    <tr v-for="(attendance, key) in attendance_details" :key="key">

                        <td>{{ attendance.student.admission_number }}</td>
                        <td>{{ attendance.student.full_name }}</td>
                        <td>

                            <input type="checkbox" @change.prevent="mark(attendance.student.uuid)" :value="true" />


                        </td>


                    </tr>
                </tbody>
            </table>
        </div>

    </div>


</template>

<script>

import axios from 'axios';
export default {
    props: {
    
        attendance_details: {
            type: Object,
            
        },
 },

   
    data() {
        return {
            attendance: {},
          
        }
    },
    methods: {

    
     
        mark(id) {       
            axios.get('student/attendance/'+id).then(() => {
                this.$emit('reload',true);
            })
        },

    },
}
</script>

<style lang="scss" scoped>

.heading {
    font-weight: 800;
    color: var(--dashboard-color);
    text-transform: uppercase;
}


.row {
    overflow-x: hidden;
.table-responsive{
    max-height: 500px;
    overflow:auto;
}
    table {
        tr {
            th {
                text-transform: uppercase;
            }
        }

        tr {
            td {
                .d-none {
                    display: none;
                }

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

.card-body {
    table.table {
        tr {
            input[type="checkbox"] {
                width: 20px;
                height: 20px;
                accent-color: var(--dashboard-main);
            }
        }
    }
}
</style>