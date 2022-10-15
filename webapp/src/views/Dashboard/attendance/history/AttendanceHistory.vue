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
                                <h1 class="text-center">Student Attendance History</h1>
                            </div>
                            <div class="card-body">
                                <h3 class="text-center my-2">Please Select The Date</h3>
                                <DateSelector @SelectDate="getDates" />
                            </div>
                        </div>
                    </div>
                </div>
                <AttendanceHistory :TableData="TableData" :TableHeaders="TableHeaders" :Heading="Heading"
                    v-if="table_show" />
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>

</template>

<script>
import axios from 'axios';
import AttendanceHistory from '@/components/Dashboard/tables/students/attendence/history/AttendanceTable.vue'
import DateSelector from '@/components/times/DateSelector.vue'
export default {

    data() {
        return {
            nav_active: false,
            table_show: false,
            TableData: {},
            selectedDate: null,
            TableHeaders: ['#', 'Student', 'Attendance', 'Time','Marked by'],
            Heading: " Attendance Records",
        }
    },
    components: { AttendanceHistory, DateSelector },
 
    methods: {
        toggle(value) {
            this.nav_active = value;
        },
        getDates(date) {
            
            this.Heading = `${date} Attendance Records`;
            axios.get('student/history/attendance-data?attendanceDate=' + date).then((response) => {
                this.TableData = response.data.data
                this.table_show = true

            });
        }
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