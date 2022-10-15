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
                    <div class="col-lg-6 col-md-12">
                        <div class="card shadow w-100">
                            <div class="card-head">
                                <h1>Student Attendance</h1>
                            </div>
                            <AttendanceTable @reload="this.getData()" :attendance_details="attendance_details" />

                        </div>
                    </div>
                    <!-- TODAY STUDENT -->
                    <!-- <div class="row my-5"> -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card shadow w-100">
                            <div class="card-head">
                                <h1>Today Attendance</h1>
                            </div>
                            <AttendanceHistory :TableData="attendance_history" />

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
import AttendanceTable from '@/components/Dashboard/tables/students/attendence/AttendenceTable.vue';
import AttendanceHistory from '@/components/Dashboard/tables/students/attendence/AttendanceHistory.vue';
export default {
    created() {
        this.getStudentData()
        this.getData()

    },
    data() {
        return {
            nav_active: false,
            attendance_history: {},
            attendance_details: {}
        };
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        },
        getData() {
            axios.get('student/today-attendance').then(response => {
                this.attendance_history = response.data.attendance
            
            }).catch(e => {
                console.log(e.response.data)
            })
        },
        getStudentData() {
            axios.get('student/std-attendance').then(response => {
                this.attendance_details = response.data.Students

            }).catch(e => {
                console.log(e.response.data)
            })
        },
    },
    components: { AttendanceTable, AttendanceHistory },

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


    }
}
</style>