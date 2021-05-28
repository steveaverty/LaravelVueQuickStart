import Admin from "@/layouts/Admin";
import Dashboard from "@/views/admin/Dashboard";
import Auth from "@/layouts/Auth";
import Login from "@/views/auth/Login";
import Register from "@/views/auth/Register";
import Landing from "@/views/Landing";
import Profile from "@/views/Profile";
import Index from "@/views/Index";
import {createRouter, createWebHistory} from "vue-router";
import store from "@/store";

const USER = 'user'

const routes = [
    {
        path: "/admin",
        redirect: "/admin/dashboard",
        component: Admin,
        children: [
            {
                path: "/admin/dashboard",
                component: Dashboard,
                meta: {
                    requiredRole: [USER]
                }
            }
        ],
    },
    {
        path: "/auth",
        redirect: "/auth/login",
        component: Auth,
        children: [
            {
                path: "/auth/login",
                component: Login,
            },
            {
                path: "/auth/register/:invitation_token",
                component: Register,
            }
        ],
    },
    {
        path: "/landing",
        component: Landing
    },
    {
        path: "/profile",
        component: Profile,
    },
    {
        path: "/",
        component: Index,
    },
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to) => {
    if(to.meta?.requiredRole?.length > 0){
        for(var i = 0; i < to.meta.requiredRole.length; i++){
            switch (to.meta.requiredRole[i]) {
                case USER:
                    if(store.state.user.token !== null){
                        return true
                    }
                    break;
            }
        }
        return {
            path: '/auth/login',
            // save the location we were at to come back later
            query: { redirect: to.fullPath },
        }
    }else{
        return true
    }

})

export default router;
