import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '@/views/login/LoginPage'
import DashboardIndex from '@/views/Dashboard/DashboardIndex'
import AddSection from '@/views/Dashboard/sections/add/AddSection'
import AddClasses from '@/views/Dashboard/Classses/add/AddClasses'
import AttendanceMark from '@/views/Dashboard/attendance/AttendanceMark'
import LogOut from '@/views/Dashboard/LogOut'
import AccountDetails from '@/views/Dashboard/Account/AccountDetails'

const routes = [
  {
    path: '/dashboard',
    name: 'DashboardIndex',
    component: DashboardIndex,
  },
  {
    path: '/dashboard/add-section',
    name: 'AddSection',
    component: AddSection,
  },
  {
    path: '/dashboard/add-class',
    name: 'AddClasses',
    component: AddClasses,
  },
  {
    path: '/dashboard/attendance',
    name: 'AttendanceMark',
    component: AttendanceMark,
  },
  {
    path: '/dashboard/account',
    name: 'AccountDetails',
    component: AccountDetails,
  },
  {
    path: '/dashboard/logout',
    name: 'LogOut',
    component: LogOut,
  },
  {
    path: '/',
    name: 'LoginPage',
    component: LoginPage,
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
