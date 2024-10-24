import { landing } from "./landing";
import { auth } from "./auth";

export default [
  ...landing,
  ...auth,
  {
    path: "/check-out",
    name: "checkout",
    component: () => import("@/views/CheckOut.vue"),
  },
];
