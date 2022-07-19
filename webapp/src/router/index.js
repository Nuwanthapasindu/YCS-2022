import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '@/views/login/LoginPage'
import DashboardIndex from '@/views/Dashboard/DashboardIndex'
import AddSection from '@/views/Dashboard/sections/add/AddSection'
import AddClasses from '@/views/Dashboard/Classses/add/AddClasses'
import StudentAdd from '@/views/Dashboard/students/add/StudentAdd'
import AttendanceMark from '@/views/Dashboard/attendance/AttendanceMark'
import AttendanceHistory from '@/views/Dashboard/attendance/history/AttendanceHistory'
import LogOut from '@/views/Dashboard/LogOut'
import AccountDetails from '@/views/Dashboard/Account/AccountDetails'
import AccessDenied from '@/views/errors/AccessDenied'
import UserComplete from '@/views/errors/UserComplete'
import OtherAttendance from '@/views/Dashboard/attendance/other/OtherAttendance'
import { admin, sectionHead, teacher, common, dashboard } from '@/guards';


const routes = [
  // Dashboard URLs
  {
    path: '/dashboard',
    name: 'DashboardIndex',
    component: DashboardIndex,
    beforeEnter: dashboard
  },
  {
    path: '/dashboard/add-section',
    name: 'AddSection',
    component: AddSection,
    beforeEnter: admin
  },
  {
    path: '/dashboard/add-class',
    name: 'AddClasses',
    component: AddClasses,
    beforeEnter: sectionHead
  },
  {
    path: '/dashboard/add-students',
    name: 'StudentAdd',
    component: StudentAdd,
    beforeEnter: teacher
  },
  {
    path: '/dashboard/attendance',
    name: 'AttendanceMark',
    component: AttendanceMark,
    beforeEnter: teacher
  },
  {
    path: '/dashboard/attendance/others',
    name: 'OtherAttendance',
    component: OtherAttendance,
    beforeEnter: teacher
  },
  {
    path: '/dashboard/attendance/history',
    name: 'AttendanceHistory',
    component: AttendanceHistory,
    beforeEnter: teacher
  },
  {
    path: '/dashboard/account',
    name: 'AccountDetails',
    component: AccountDetails,
    beforeEnter: dashboard
  },
  {
    path: '/dashboard/logout',
    name: 'LogOut',
    component: LogOut,
    beforeEnter: dashboard
  },


  // Public Access Url

  {
    path: '/',
    redirect: '/login',
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage,

  },

  //  Error Pages URL

  {
    path: '/access-denied',
    name: 'AccessDenied',
    component: AccessDenied,

  },
  { path: '/:pathMatch(.*)*', redirect: '/login' },

  //  Verify Pages URL
  {
    path: '/account-complete',
    name: 'UserComplete',
    component: UserComplete,
    beforeEnter: common,

  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
