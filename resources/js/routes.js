import Create from "./components/Create";
import Show from "./components/Show";
import Edit from "./components/Edit";

export const routes = [
    {
        name: "create",
        path: "/create",
        component: Create,

    },
    {
        name: 'user',
        path: "/user",
        component: Show
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: Edit
    }
]