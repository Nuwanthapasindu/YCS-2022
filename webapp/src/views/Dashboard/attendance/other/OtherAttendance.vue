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
                                <h1 class="text-center">Other Classes Student Attendance Mark</h1>
                            </div>
                            <div class="card-body">
                                <h3 class="text-center my-2">Please Select The Student Class</h3>
                                <ClassSelector @stdClass="getStudents" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-5" v-if="table_show">
                    <div class="col-lg-6 col-md-12">
                        <div class="card shadow w-100">
                            <div class="card-head">
                                <h1>Student Attendance</h1>
                            </div>
                            <AttendanceMark @reload="this.getData()" :attendance_details="attendance_details" />

                        </div>
                    </div>
                    <!-- TODAY STUDENT -->
                    <!-- <div class="row my-5"> -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card shadow w-100">
                            <div class="card-head">
                                <h1>Today Attendance</h1>
                            </div>
                            <AttendanceHistory :TableData="TableData" />

                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>

</template>

<script>
import axios from 'axios';
import AttendanceMark from '@/components/Dashboard/students/others/AttendanceMark'
import AttendanceHistory from '@/components/Dashboard/tables/students/attendence/AttendanceHistory.vue';
import ClassSelector from '@/components/Dashboard/students/classes/ClassSelector.vue';
export default {

    data() {
        return {
            nav_active: false,
            table_show: false,
            attendance_details: {},
            TableData: {},
            selectedDate: null,
            TableHeaders: ['#', 'Student', 'Attendance', 'Time', 'Marked by'],
            Heading: " Attendance Records",
        }
    },
    components: { ClassSelector, AttendanceHistory, AttendanceMark },

    methods: {
        toggle(value) {
            this.nav_active = value;
        },
        getStudents(class_id) {

            localStorage.setItem('selected_class', class_id)
            axios.get('student/classes/' + class_id).then((response) => {

                this.attendance_details = response.data.students
                this.table_show = true
            })
        },
        getData() {
          var classId =  localStorage.getItem('selected_class')
            axios.get(`student/other/today-attendance?classId=${classId}`).then(response => {
                this.TableData = response.data.attendance
            }).catch(e => {
                console.log(e.response.data)
            })
        },
   
    },


}
</script>

<style lang="scss" scoped>
@import '@vuepic/vue-datepicker/src/VueDatePicker/style/main.scss';

main {
    width: 100vw;
    min-height: 100vh;
    height: auto;
    overflow-x: hidden;
}

.container {
    overflow-x: hidden;

    .card {
        border-radius: 20px;
        overflow: hidden;
        z-index: 1;

        .card-head {
            height: 200px;
            background: linear-gradient(0deg, rgba(255, 0, 150, 0.3), rgba(255, 0, 150, 0.3)), url('@/assets/Dashboard/StudentAttendance/Banner.jpg');
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
    }
}
</style>