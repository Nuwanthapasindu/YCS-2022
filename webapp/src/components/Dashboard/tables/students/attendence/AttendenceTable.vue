<template>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Attendance</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>


</template>

<script>
import axios from 'axios';
export default {
    created() {
        this.get_students
    },
    data() {
        return {
            attendance_details: {}
        }
    },
    methods: {
        get_students() {
            axios.get('student/attendance').then(response => {
                // this.attendance_details = response.data.Section_classes;
                console.log(response.data);
            }).catch(e => {
                console.log(e);

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