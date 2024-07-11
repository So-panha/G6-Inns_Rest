import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin/dashboard',
      name: 'dashboard',
      component: () => import('../views/Admin/DashboardView.vue'),
      meta: {
        requiresAuth: true,
        role: 'admin'
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/rigister',
      name: 'rigister',
      component: () => import('../views/Admin/Auth/RigisterView.vue')
    },
    {
      path: '/qrCode',
      name: 'qrCode',
      component: () => import('../views/Web/QrCode/QRCodeGeneratorView.vue')
    },
    {
      path: '/ticket',
      name: '/ticket',
      component: () => import('../views/Web/Ticket/TicketView.vue')
    },
    {
      path: '/ticketNoti',
      name: '/ticketNoti',
      component: () => import('../views/Web/TicketNoti/TicketNotiView.vue')
    },
    {
      path: '/bookingUser',
      name: 'bookingUser',
      component: () => import('../views/Web/Booking/BookingUserView.vue')
    },
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Web/HomeView.vue')
    },
    {
      path: '/post',
      name: 'post',
      component: () => import('../views/Web/Post/ListView.vue')
    },
    {
      path: '/service-detail',
      name: 'service-detail',
      component: () => import('../views/serviceDetail/ServiceDetail.vue')
    },
    {
      path: '/ListRoom',
      name: 'ListRoom',
      component: () => import('../views/serviceDetail/ListRoom.vue')
    }

  ]
})

router.beforeEach(async (to, from, next) => {
  const publicPages = ['/login']
  const authRequired = !publicPages.includes(to.path)
  const store = useAuthStore()

  try {
    const { data } = await axiosInstance.get('/me')

    store.isAuthenticated = true
    store.user = data.data

    store.permissions = data.data.permissions.map((item: any) => item.name)
    store.roles = data.data.roles.map((item: any) => item.name)

    const rules = () =>
      defineAclRules((setRule) => {
        store.permissions.forEach((permission: string) => {
          setRule(permission, () => true)
        })
      })

    simpleAcl.rules = rules()
  } catch (error) {
    /* empty */
  }

  if (authRequired && !store.isAuthenticated) {
    next()
  } else {
    next()
  }
})

export default { router, simpleAcl }
