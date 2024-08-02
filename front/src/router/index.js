import Vue from 'vue'
import VueRouter from 'vue-router'
import store from "@/store";
import goTo from "vuetify/es5/services/goto";

//Middlewares
import Auth from './middleware/Auth';
import Guest from './middleware/Guest';

Vue.use(VueRouter)

const routes = [
  {
    path: '',
    redirect: "/guest",
  },
  {
    path: '/guest',
    component: () => import(/* webpackChunkName: "LayoutGuest" */ '../views/layouts/LayoutGuest.vue'),
    children: [
      {
        path: '/guest',
        redirect: "/login",
      },
      {
        name: "Login",
        path: "/login",
        meta: { middleware: Guest },
        component: () => import(/* webpackChunkName: "Login" */ "@/views/guest/Login.vue")
      },
      {
        path: "/logout",
        name: "Logout",
        component: () => import(/* webpackChunkName: "Logout" */ "@/views/guest/Logout.vue")
      },
    ]
  },
  {
    path: '/app',
    component: () => import(/* webpackChunkName: "LayoutAuth" */ '../views/layouts/LayoutAuth.vue'),
    children: [
      {
        path: '/app',
        redirect: "/app/home",
      },
      {
        path: '/app/home',
        name: 'Home',
        meta: { middleware: Auth },
        component: () => import(/* webpackChunkName: "Home" */ "@/views/auth/Home.vue"), 
        meta: { 
          middleware: Auth,
        },
      },
      {
        path: "/app/users",
        name: "UsersIndex",
        component: () => import(/* webpackChunkName: "UsersIndex" */ "@/views/auth/users/UsersIndex.vue"), 
        meta: { 
          middleware: Auth,
        },
      },
      {
        path: "/app/users/:user/edit",
        name: "UsersEdit",
        component: () => import(/* webpackChunkName: "UsersEdit" */ "@/views/auth/users/UsersEdit.vue"), 
        meta: { 
          middleware: Auth,
        },
      },
      {
        path: '/app/users/create',
        name: 'UsersCreate',
        component: () => import(/* webpackChunkName: "UsersCreate" */ '../views/auth/users/UsersCreate.vue'),
        meta: { 
          middleware: Auth,
        },
      },
      {
        path: "/app/trainings",
        name: "TrainingsIndex",
        component: () => import(/* webpackChunkName: "TrainingsIndex" */ "@/views/auth/trainings/TrainingsIndex.vue"), 
        meta: { 
          middleware: Auth,
        },
      },
      {
        path: "/app/trainings/:training/edit",
        name: "TrainingsEdit",
        component: () => import(/* webpackChunkName: "TrainingsEdit" */ "@/views/auth/trainings/TrainingsEdit.vue"), 
        meta: { 
          middleware: Auth,
        },
      },
      {
        path: '/app/trainings/create',
        name: 'TrainingsCreate',
        component: () => import(/* webpackChunkName: "TrainingsCreate" */ '../views/auth/trainings/TrainingsCreate.vue'),
        meta: { 
          middleware: Auth,
        },
      },
      {
        path: "/app/*",
        name: "Notfound",
        component: () => import("@/views/auth/NotFound.vue")
      },
    ]
  },
  {
    path: "*",
    component: () => import(/* webpackChunkName: "LayoutGuest" */ '../views/layouts/LayoutGuest.vue'),
    children: [
      {
        path: "",
        component: () => import("@/views/guest/NotFound.vue"),
      }
    ]
  }
]

const router = new VueRouter({
  scrollBehavior: (to, from, savedPosition) => {
    let scrollTo = 0

    if (to.hash) {
      scrollTo = to.hash
    } else if (savedPosition) {
      scrollTo = savedPosition.y
    }

    return goTo(scrollTo)
  },
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach(async (to, from, next) => {
  if(!to.meta.middleware) {
    return next();
  }

  const middleware = to.meta.middleware;
  const context = {
    to,
    from,
    next,
    store
  };

  return middleware({
    ...context
  });
});

export default router
