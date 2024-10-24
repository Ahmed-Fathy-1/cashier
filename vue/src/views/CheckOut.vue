<template>
  <div class="payment-page pt-5 pb-5 container">
    <div class="row g-3">
      <!-- left section -->
      <div class="col-lg-12">
        <!-- drosat logo  -->
        <h2 class="fw-bold">Kashear Checkout</h2>

        <!-- breadcrump -->
        <div class="bread-crumb d-flex align-items-center">
          <router-link to="/" class="text-black text-decoration-none"
            >Kashear</router-link
          >
          <v-icon>mdi-chevron-right</v-icon>
          <router-link class="text-black text-decoration-none"
            >Checkout
          </router-link>
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-12 col-12">
            <!-- payment card -->
            <v-card class="p-3 mt-3 payment-card border-1" elevation="0">
              <!-- package name -->
              <h4 class="text-center fw-bold mb-4 mt-2">Package Name</h4>

              <div
                class="d-flex flex-lg-row flex-md-column flex-column text-md-center text-lg-start text-center justify-content-between"
              >
                <!-- left side -->
                <div class="left-side pb-lg-0 pb-md-4 pb-4">
                  <h5 class="fw-bold">Payment Amount</h5>
                  <p class="mb-0">
                    All Transactions Are Secure <br />
                    in both ways card and cash payment
                  </p>
                </div>

                <!-- Amount per year and per month -->
                <div
                  class="right-side d-flex gap-4 align-items-center justify-content-center"
                >
                  <!-- month -->
                  <div class="text-center">
                    <v-progress-circular
                      :model-value="valueMonth"
                      :rotate="360"
                      :size="70"
                      :width="2"
                      color="yellow"
                    >
                      <template v-slot:default> {{ valueMonth }} LE</template>
                    </v-progress-circular>
                    <p class="mb-0 pt-2">Month</p>
                  </div>

                  <!-- year -->
                  <div class="text-center">
                    <v-progress-circular
                      :model-value="valueYear"
                      :rotate="360"
                      :size="70"
                      :width="2"
                      color="yellow"
                    >
                      <template v-slot:default> {{ valueYear }} LE</template>
                    </v-progress-circular>
                    <p class="mb-0 pt-2">Year</p>
                  </div>
                </div>
              </div>
            </v-card>

            <!-- subdomain card -->
            <v-card class="p-3 mt-3 payment-card border-1" elevation="0">
              <!-- check subdomain button -->
              <div class="check-input">
                <label
                  for="subDomain"
                  class="form-label text-dark fw-semibold mb-2 mt-3"
                >
                  Enter Sub Domain :</label
                >

                <div class="d-flex gap-2 align-items-center">
                  <input
                    class="form-control rounded-5 py-2"
                    v-model="subDomain"
                    type="text"
                  />
                </div>
                <!-- <p :class="color" class="pt-2">{{ errorMsg }}</p> -->

                <!-- select plan -->
                <label
                  for="subDomain"
                  class="form-label text-dark fw-semibold mb-2 mt-3 d-flex justify-content-between align-items-center"
                >
                  <span>Select Plan :</span>
                  <span v-if="type == 1" class="fw-bold text-success pe-4"
                    >{{ valueMonth }} LE</span
                  >
                  <span v-if="type == 2" class="fw-bold text-success pe-4"
                    >{{ valueYear }} LE</span
                  >
                </label>

                <select
                  class="form-select rounded-5 py-2 mb-3"
                  aria-label="Default select example"
                  v-model="type"
                >
                  <option selected>Select Your Plan</option>
                  <option value="1">Monthly</option>
                  <option value="2">Yearly</option>
                </select>
              </div>

              <input
                class="btn btn-primary w-100 elevation-0 mt-2 text-white"
                type="button"
                value="submit"
              />
            </v-card>

            <v-btn
              class="elevation-0 mt-4 bg-primary text-capitalize d-lg-flex d-md-none d-none"
              prepend-icon="mdi-chevron-left"
              @click="$router.push('/')"
              >Go Back</v-btn
            >
          </div>

          <div class="col-lg-6 col-md-12 col-12">
            <!-- payment methods -->
            <div class="payment-methods mt-3">
              <div class="d-flex gap-2 align-items-center">
                <!-- cash payment -->
                <div
                  class="card d-flex justify-content-center align-items-center p-2 w-100"
                  :class="cash == 'wallet' ? 'active-method' : 'method-card'"
                  @click="cash = 'wallet'"
                >
                  <div class="text-center d-flex gap-2 align-items-center">
                    <!-- <img
                      src="../assets/images/cash_8993357.png"
                      width="30"
                      height="30"
                      alt=""
                      class=""
                    /> -->
                    <h6 class="m-0 fw-bold">Cash Payment</h6>
                  </div>
                </div>

                <!-- online payment -->
                <div
                  class="card method-card d-flex justify-content-center align-items-center p-2 w-100"
                  @click="cash = 'card'"
                  :class="cash == 'card' ? 'active-method' : 'method-card'"
                >
                  <div class="text-center d-flex align-items-center gap-2">
                    <!-- <img
                      src="../assets/images/shopping_13639761.png"
                      width="30"
                      height="30"
                      alt=""
                      class=""
                    /> -->
                    <h6 class="fw-bold m-0">Online Payment</h6>
                  </div>
                </div>
              </div>
            </div>

            <!-- wallet form -->
            <div class="form mt-4" v-if="cash == 'wallet'">
              <div class="card rounded-2 p-3">
                <div class="card-title fw-bold text-center">
                  <h4>
                    Please Send this amount
                    <span v-if="type == 1" class="fw-bold text-success">
                      {{ valueMonth }} EGP
                    </span>
                    <span v-if="type == 2" class="fw-bold text-success">
                      {{ valueYear }} EGP
                    </span>
                    <span v-if="type == ''" class="fw-bold text-success">
                      (select_plan...)
                    </span>
                    payment and upload the receipt
                  </h4>

                  <div
                    class="d-flex gap-1 align-items-center justify-content-center"
                  >
                    <div class="d-flex gap-1 align-items-center">
                      <img
                        src="../assets/images/vodafone-cash.png"
                        width="50"
                        alt=""
                      />
                      <h4 class="fw-bold">+994 5567 23</h4>
                    </div>
                  </div>
                </div>

                <div class="row g-3">
                  <div class="col-12">
                    <label
                      for="name"
                      class="form-label text-dark fw-semibold mb-1"
                    >
                      Amount :</label
                    >

                    <input
                      class="form-control rounded-5 py-2"
                      type="text"
                      v-model="amount"
                      disabled="disable"
                    />
                  </div>

                  <div class="col-12">
                    <label
                      for="name"
                      class="form-label text-dark fw-semibold mb-1"
                    >
                      Receipt :</label
                    >

                    <input
                      type="file"
                      class="form-control rounded-5"
                      id="inputGroupFile01"
                    />
                  </div>
                </div>

                <input
                  type="button"
                  class="btn btn-primary mt-3 text-white"
                  value="Submit"
                />
              </div>
            </div>

            <!-- stripe form -->
            <div v-if="cash == 'card'">
              <div class="mt-5">
                <input
                  class="w-100 btn btn-warning text-white"
                  value="Proceed to Payment"
                  type="button"
                />

                <div
                  class="text-center text-primary fs-5 mt-3"
                  v-if="isLoading"
                >
                  Loading...
                </div>
                <!-- <p class="text-danger text-center pt-3">
                  {{ domainMsg }}
                </p> -->
              </div>

              <div class="mt-3 bg-white p-3 rounded-4">
                <div class="d-flex gap-5">
                  <form class="mt-3">
                    <div id="card-element">
                      <!-- Stripe Element will be inserted here -->
                    </div>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                      <button class="btn btn-primary" type="submit">
                        Confirm Payment
                      </button>

                      <div class="btn btn-danger">Cancel</div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- customer servece -->
            <h6 class="fw-bold pt-3">
              <div
                class="phone d-flex align-items-center gap-2 justify-content-center"
              >
                <span class="text-center">
                  For Customer Servece :
                  <a href="tel:01110010489" class="text-primary">
                    <v-icon size="small" color="green">mdi-phone</v-icon
                    >01110010489</a
                  >
                  <br />
                  <span>OR</span>
                  <br />
                  <a href="mailto:omaradelbakry375@gmail.com">
                    <v-icon size="small" color="green">mdi-email</v-icon>
                    omaradelbakry375@gmail.com</a
                  >
                </span>
              </div>
            </h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "checkout",
  data: () => ({
    subDomain: "",
    errorMessage: "",
    mark: false,
    disable: true,
    errorMsg: "",
    color: "",
    res: {},
    cash: "wallet",
    isOpen: false,
    type: "",
    amount: "",
    image: null,
    plan: {},
    walletPhone: "",
    isPaying: false,
    domainMsg: "You must enter a valid sub domain first.",
    loader: false,
    valueMonth: 300,
    valueYear: 3000,

    // stripe data
    paymentIntentId: "",
    paymentIntent: "",
    clientSecret: "",

    stripe: null,
    cardElement: null,
    stripeKey:
      "pk_test_51NfHq4GMlC1CV659YL1B7Uzc5nAU2zBpj6vqj3qP34lR94dIFGuPlfEcwQF04C2kEPAwBNMeh4f0bC04OpSSrhQd00Ao40DeX8",
  }),

  //   components: {
  //     Loader,
  //   },

  //   computed: {
  //     ...mapState(useAuthStore, ["user"]),
  //   },

  //   methods: {
  //     domainAlert() {
  //       this.domainMsg = "You must enter a valid domain";
  //     },

  //     confirmDomain() {
  //       axios
  //         .post(
  //           `${url}/admin/check-subdomain`,
  //           { name: this.subDomain },
  //           {
  //             headers: {
  //               Authorization: `Bearer ${localStorage.getItem("token")}`,
  //             },
  //           }
  //         )
  //         .then((response) => {
  //           this.res = response.data;
  //           if (response.data == false) {
  //             this.errorMsg = "This is Valid Sub Domain.";
  //             this.color = "text-success";
  //             this.disable = false;
  //           }
  //         })
  //         .catch((error) => {
  //           this.errorMsg = error.response.data.message;
  //           this.color = "text-danger";
  //           this.disable = true;
  //           this.loader = false;
  //           console.log("error", error);
  //         });
  //     },

  //     handleImage(e) {
  //       this.image = e.target.files[0];
  //     },

  //     // wallet payment
  //     postWallet() {
  //       this.errorMessage = "";
  //       if (this.plan.id == 1) {
  //         this.loader = true;

  //         this.confirmDomain();

  //         axios
  //           .post(
  //             `${url}/admin/checkout-subdomain`,
  //             { id: localStorage.getItem("packageId"), name: this.subDomain },
  //             {
  //               headers: {
  //                 Authorization: `Bearer ${localStorage.getItem("token")}`,
  //               },
  //             }
  //           )
  //           .then((response) => {
  //             console.log("response", response);
  //             localStorage.setItem(
  //               "user",
  //               JSON.stringify(response.data.data.user)
  //             );
  //             localStorage.setItem(
  //               "manasa",
  //               JSON.stringify(this.user?.drosat?.name)
  //             );
  //             localStorage.setItem(
  //               "drosat",
  //               JSON.stringify(response.data.data.drosat)
  //             );

  //             this.$router.push(`/pricing/${localStorage.getItem("packageId")}`);

  //             this.loader = false;

  //             setTimeout(() => {
  //               window.location.reload();
  //             }, 500);
  //           })
  //           .catch((error) => {
  //             this.errorMessage = error.response.data.message;
  //             this.loader = false;
  //           });
  //       } else {
  //         this.errorMessage = "";

  //         const formData = new FormData();

  //         formData.append("id", localStorage.getItem("packageId"));
  //         formData.append("name", this.subDomain);
  //         formData.append("type", this.type);
  //         formData.append("method", "Wallet");
  //         formData.append("amount", this.amount);
  //         formData.append("receipt", this.image);

  //         this.loader = true;

  //         axios
  //           .post(`${url}/admin/checkout-subdomain`, formData, {
  //             headers: {
  //               Authorization: `Bearer ${localStorage.getItem("token")}`,
  //             },
  //           })
  //           .then((response) => {
  //             console.log("response", response);
  //             localStorage.setItem(
  //               "user",
  //               JSON.stringify(response.data.data.user)
  //             );
  //             localStorage.setItem(
  //               "manasa",
  //               JSON.stringify(this.user?.drosat?.name)
  //             );
  //             localStorage.setItem(
  //               "drosat",
  //               JSON.stringify(response.data.data.drosat)
  //             );

  //             this.$router.push(`/pricing/${localStorage.getItem("packageId")}`);

  //             this.loader = false;

  //             setTimeout(() => {
  //               window.location.reload();
  //             }, 500);
  //           })
  //           .catch((error) => {
  //             this.errorMessage = error.response.data.message;
  //             this.loader = false;
  //           });
  //       }
  //     },

  //     // git single plan
  //     getPlan() {
  //       axios
  //         .get(`${url}/drosat/package/${localStorage.getItem("packageId")}`)
  //         .then((response) => {
  //           this.plan = response.data.data.Package;
  //           this.valueMonth =
  //             response.data.data.Package.package_details.price_monthly;
  //           this.valueYear =
  //             response.data.data.Package.package_details.price_annually;

  //           console.log("plan", this.plan);
  //           console.log(this.valueMonth);
  //           console.log(this.valueYear);
  //         })
  //         .catch((error) => {
  //           console.error("Login error:", error);
  //         });
  //     },

  //     // git phone number
  //     getPhoneNumber() {
  //       axios.get(`${url}/drosat/setting`).then((response) => {
  //         this.walletPhone = response.data.data.setting.phone;
  //       });
  //     },

  //     // process to payment
  //     proceedToPayment() {
  //       // this.isLoading = true;

  //       const amount =
  //         this.type == "1"
  //           ? this.plan.package_details.price_monthly
  //           : this.plan.package_details.price_annually;

  //       axios
  //         .post(
  //           `${url}/admin/payment/${localStorage.getItem("packageId")}`,
  //           {
  //             amount,
  //             type: this.type,
  //             name: this.subDomain,
  //           },
  //           {
  //             headers: {
  //               Authorization: `Bearer ${localStorage.getItem("token")}`,
  //             },
  //           }
  //         )
  //         .then((response) => {
  //           this.isPaying = true;
  //           // this.isLoading = false;

  //           this.paymentIntentId = response.data.data.data.id;
  //           this.paymentIntent = response.data.data.data.payment_intent;
  //           this.clientSecret = response.data.data.data.client_secret;

  //           // Initialize Stripe
  //           return loadStripe(this.stripeKey);
  //         })
  //         .then((stripe) => {
  //           this.stripe = stripe;
  //           const elements = this.stripe.elements();
  //           this.cardElement = elements.create("card");
  //           this.cardElement.mount("#card-element");
  //         })
  //         .catch((error) => {
  //           console.error(error);
  //           // console.error("asd", typeof amount, typeof this.subscriptionType);
  //         });
  //     },

  //     // handle payment
  //     handleStripePayment() {
  //       this.loader = true;

  //       this.stripe
  //         .confirmCardPayment(this.clientSecret, {
  //           payment_method: {
  //             card: this.cardElement,
  //           },
  //         })
  //         .then(({ error, paymentIntent }) => {
  //           if (error) {
  //             console.error(error);
  //             alert("Payment failed");
  //           } else if (paymentIntent.status === "succeeded") {
  //             return axios.get(url + "/admin/payment-success", {
  //               headers: {
  //                 Authorization: `Bearer ${localStorage.getItem("token")}`,
  //               },
  //               params: {
  //                 id: this.paymentIntentId,
  //                 payment_intent: this.paymentIntent,
  //                 client_secret: this.clientSecret,
  //               },
  //             });
  //           }
  //         })
  //         .then((response) => {
  //           if (response) {
  //             // window.location.reload();

  //             localStorage.setItem(
  //               "user",
  //               JSON.stringify(response.data.data.user)
  //             );

  //             if (this.user?.drosat?.name) {
  //               localStorage.setItem(
  //                 "manasa",
  //                 JSON.stringify(this.user.drosat.name)
  //               );
  //             }

  //             this.$router.push(`/pricing/${localStorage.getItem("packageId")}`);

  //             this.loader = false;

  //             setTimeout(() => {
  //               window.location.reload();
  //             }, 500);
  //           }
  //         })
  //         .catch((error) => {
  //           console.error(error);
  //           alert("Failed to complete payment");
  //         });
  //     },
  //   },
  //   watch: {
  //     // Watch for changes in the 'type' value (plan type)
  //     type(newValue) {
  //       if (newValue == 1) {
  //         // User selected Monthly
  //         this.amount = this.valueMonth;
  //       } else if (newValue == 2) {
  //         // User selected Yearly
  //         this.amount = this.valueYear;
  //       } else {
  //         this.amount = ""; // Reset amount if no valid plan type is selected
  //       }
  //     },
  //   },

  //   mounted() {
  //     this.getPlan();
  //     this.getPhoneNumber();
  //   },
};
</script>

<style lang="scss">
.contact-card {
  box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px !important;
}

.payment-card {
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px !important;
}

.line {
  h6 {
    color: #939191;
  }
}

.method-card {
  background-color: #1869cc1f !important;
  cursor: pointer;
}

.active-method {
  background-color: var(--bs-primary) !important;
  border: 1px solid #dddd !important;
  color: var(--bs-white) !important;
  cursor: pointer;
}
</style>
