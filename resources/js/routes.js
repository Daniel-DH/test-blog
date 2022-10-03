import Register from "./components/Register";
import Login from "./components/Login";
import Dashboard from "./components/Dashboard";
import NotFound from "./components/NotFound";

import PostsIndex from "./Routes/PostsIndex.js";
import PostsRoute from "./Posts/PostsRoute.vue";

export default {
    mode: "history",
    linkActiveClass: "font-semibold",
    routes: [
        {
            path: "*",
            component: NotFound,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/authenticated")
                    .then((response) => {
                        if (response?.status != 200)
                            next({ path: "/login" });
                        next();
                    })
                    .catch(() => {
                        next({ path: "/login" });
                    });
            },
        },
        {
            path: "/register",
            component: Register,
            name: "Register",
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/authenticated")
                    .then((response) => {
                        if (response?.status != 200)
                            next();
                        else
                            next({ path: "/Posts" });
                    })
                    .catch(() => {
                        return next();
                    });
            },
        },
        {
            path: "/login",
            component: Login,
            name: "Login",
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/authenticated")
                    .then((response) => {
                        if (response?.status != 200)
                            next();
                        else
                            next({ path: "/Posts" });
                    })
                    .catch(() => {
                        return next();
                    });
            },
        },
        {
            path: "/dashboard",
            name: "Dashboard",
            component: Dashboard,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/authenticated")
                    .then((response) => {
                        if (response?.status != 200)
                            next({ path: "/login" });
                        next();
                    })
                    .catch(() => {
                        next({ path: "/login" });
                    });
            },
        },
        {
            path: "/posts",
            component: PostsRoute,
            children: PostsIndex,
            name: "Posts",
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/authenticated")
                    .then(() => {
                        next();
                    })
                    .catch(() => {
                        return next({ path: "/login" });
                    });
            },
        },
    ],
};
