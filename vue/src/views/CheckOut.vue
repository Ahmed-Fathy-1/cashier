<template>
  <div class="payment-page pt-5 pb-5 container">
    <div class="row g-3">
      <div class="col-lg-12">
        <h2 class="fw-bold">Kashear Checkout</h2>
        <div class="bread-crumb d-flex align-items-center">
          <router-link to="/" class="text-black text-decoration-none">Kashear</router-link>
          <v-icon>mdi-chevron-right</v-icon>
          <router-link to="/" class="text-black text-decoration-none">Checkout</router-link>
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-12 col-12">
            <!-- Payment Card -->
            <v-card class="p-3 mt-3 payment-card border-1" elevation="0">
              <h4 class="text-center fw-bold mb-4 mt-2">{{ packageInfo.dataFromObject.name }}</h4>
              <div class="d-flex justify-content-between">
                <div>
                  <h5 class="fw-bold">Payment Amount</h5>
                  <p class="mb-0">{{ packageAmount }} <br /> in both ways card and cash payment</p>
                </div>
                <div class="d-flex gap-4 align-items-center justify-content-center">
                  <PaymentCircular :model-value="valueMonth" label="Month" />
                  <PaymentCircular :model-value="valueYear" label="Year" />
                </div>
              </div>
            </v-card>

            <!-- Subdomain Input and Plan Selection -->
            <v-card class="p-3 mt-3 payment-card border-1" elevation="0">
              <label for="subDomain" class="form-label text-dark fw-semibold mb-2 mt-3">Enter Sub Domain:</label>
              <input class="form-control rounded-5 py-2" v-model="subDomain" type="text" />

              <label class="form-label text-dark fw-semibold mb-2 mt-3 d-flex justify-content-between align-items-center">
                <span>Select Plan:</span>
                <span v-if="type === '1'" class="fw-bold text-success pe-4">{{ monthlyPrice }} LE</span>
                <span v-else class="fw-bold text-success pe-4">{{ yearlyPrice }} LE</span>
              </label>
              <select class="form-select rounded-5 py-2 mb-3" @change="handlePlan" v-model="type">
                <option selected>Select Your Plan</option>
                <option value="1">Monthly</option>
                <option value="2">Yearly</option>
              </select>

              <input class="btn btn-primary w-100 elevation-0 mt-2 text-white" type="button" value="Submit" @click="handleStripeSubmit" />
            </v-card>

            <v-btn class="elevation-0 mt-4 bg-primary text-capitalize" prepend-icon="mdi-chevron-left" @click="$router.push('/')">Go Back</v-btn>
          </div>

          <div class="col-lg-6 col-md-12 col-12">
            <!-- Payment Methods -->
            <div class="payment-methods mt-3">
              <PaymentMethodCard title="Cash Payment" :active="cash === 'wallet'" @click="cash = 'wallet'" />
              <PaymentMethodCard title="Online Payment" :active="cash === 'card'" @click="cash = 'card'" />
            </div>

            <!-- Wallet Form -->
            <div v-if="cash === 'wallet'" class="form mt-4">
              <div class="card rounded-2 p-3">
                <h4 class="fw-bold text-center">Please Send this amount
                  <span v-if="type == '1'" class="fw-bold text-success">{{ monthlyPrice }} EGP</span>
                  <span v-if="type == '2'" class="fw-bold text-success"> {{yearlyPrice}} EGP</span>
                  <span v-if="type === ''" class="fw-bold text-success">(select_plan...)</span>
                  payment and upload the receipt
                </h4>
                <div class="d-flex gap-1 align-items-center justify-content-center">
                  <img src="../assets/images/vodafone-cash.png" width="50" />
                  <h4 class="fw-bold">+994 5567 23</h4>
                </div>

                <label for="amount" class="form-label text-dark fw-semibold mb-1">Amount: {{ amount }}</label>
                <input class="form-control rounded-5 py-2" type="text" :value="amount"  readonly />

                <label for="receipt" class="form-label text-dark fw-semibold mb-1">Receipt:</label>
                <input type="file" class="form-control rounded-5" @change="handleImage" />

                <input type="button" class="btn btn-primary mt-3 text-white" value="Submit" @click="postWallet" />
              </div>
            </div>

            <!-- Stripe Form -->
            <div v-if="cash === 'card'">
              <input class="w-100 btn btn-warning text-white" value="Proceed to Payment" type="button" @click="proceedToPayment" />
              <div v-if="isLoading" class="text-center text-primary fs-5 mt-3">Loading...</div>
              <div class="mt-3 bg-white p-3 rounded-4">
                <div class="d-flex gap-5">
                  <form @submit.prevent="handleStripePayment">
                    <div id="card-element"></div>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                      <button class="btn btn-primary" type="submit">Confirm Payment</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Customer Service -->
            <h6 class="fw-bold pt-3">
              <div class="phone d-flex align-items-center gap-2 justify-content-center">
                <span>For Customer Service:
                  <a href="tel:01110010489" class="text-primary">01110010489</a>
                  <br />
                  <span>OR</span>
                  <br />
                  <a href="mailto:omaradelbakry375@gmail.com">omaradelbakry375@gmail.com</a>
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
import fetchPageData from '@/api/get/fetchPageData';
import sendFormData from '@/api/post/secdFormData';
import { computed, onMounted, ref, toRaw } from 'vue';
import { useRoute, useRouter } from 'vue-router';

export default {
    name: "Checkout",
    setup() {
      const route = useRoute();
      const isLoading = ref(false);
      const packageInfo = ref({
        subDomain: '',
        cash: 'wallet',
        type: '',
        dataFromObject: {},
        dataFromList: {},
      });
      
      const packageAmount = ref(0);
      const subDomain = ref("");
      const cash = ref("wallet");
      const type = ref("");
      const amount = ref(0);

      const monthlyPrice = computed(() => packageInfo.value?.dataFromList.Price_monthly || 0);
      const yearlyPrice = computed(() => packageInfo.value?.dataFromList.Price_annually || 0);

      const stripePaymentInfo = computed(()=>{
        return {
          package_id:route.params.packageId,
          package_type:type.value,
          domain_name:subDomain.value
        }
      })


      onMounted(async () => {
        const packageId = route.params.packageId;
        try {
          packageInfo.value.dataFromObject = await fetchPageData(`/packages/${packageId}`);

          const packages = await fetchPageData('/packages');

          packageInfo.value.dataFromList = packages[+packageId - 1].package_details;

          console.log(packageInfo);
          
          packageAmount.value = type.value === '2' ? packageInfo.value.dataFromList.package_details.Price_annually : packageInfo.value.dataFromList.package_details?.Price_monthly;

        } catch (error) {
          console.error("Error fetching package data:", error);
        }
      });

      const handlePlan = () => {
        amount.value = type.value === '2' ?  toRaw(packageInfo.value.dataFromList.Price_annually) :  toRaw(packageInfo.value.dataFromList.Price_monthly);
      };

      const handleStripeSubmit = async () => {
        console.log(stripePaymentInfo.value);
        
       /* try {        
          await  sendFormData('pay-package' , stripePaymentInfo.value)
        } catch (error) {
          console.log(error);    
        }*/
      };

      const handleVodafoneSubmit = async () => {
        try {        
          await  sendFormData('pay-package' , stripePaymentInfo.value)
        } catch (error) {
          console.log(error);    
        }
      };

      const handleImage = (event) => {
        const image = event.target.files[0];
      };

      return {
        packageInfo,
        packageAmount,
        subDomain,
        cash,
        type,
        amount,
        monthlyPrice,
        yearlyPrice,
        isLoading,
        handlePlan,
        handleStripeSubmit,
        //postWallet,
        handleImage,      
      };
    },
    
  beforeRouteEnter(to, from, next) {
    const token = localStorage.getItem('token');

    if (!token || token === 'undefined') {
      next('/login');
    } else {
      next(); 
    }
  },

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
  </style>