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
  {
    path: "/check-out-2/:packageId",
    name: "Checkout2",
    component: () => import("@/views/CheckOut2.vue"),
  },
  {
    path: "/stripe",
    name: "Stripe",
    component: () => import("@/views/StripePage.vue"),
  },
  {
    path: "/stripe-test",
    name: "StripeTest",
    component: () => import("@/views/StripeTest.vue"),
  },
  {
    path: "/success",
    name: "Success",
    component: () => import("@/views/Success.vue"),
  },
];
