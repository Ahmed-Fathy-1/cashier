import { landing } from "./landing";
import { auth } from "./auth";

export default [
  ...landing,
  ...auth,
  {
    path: "/check-out/:packageId",
    name: "Checkout",
    component: () => import("@/views/CheckOut.vue"),
  },
];
