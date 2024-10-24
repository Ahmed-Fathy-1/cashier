<template>
  <footer class="bg-footer text-white">
    <div class="container pt-5 pb-5">
      <div
        class="free-trail d-flex justify-content-between align-items-center pb-4"
      >
        <h4>
          Start your 30 days free <br />
          trail today!
        </h4>
        <v-btn class="text-capitalize elevation-0">Contact Us</v-btn>
      </div>

      <hr />

      <div class="row gy-3 pt-4">
        <div class="col-lg-6 col-md-12 col-12">
          <h6>About Rareblocks</h6>

          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
            dictum aliquet accumsan porta lectus ridiculus in mattis. Netus
            sodales in volutpat ullamcorper amet adipiscing fermentum.
          </p>

          <div class="scoial-icons d-flex align-items-center gap-3">
            <router-link to="/" class="text-white">
              <v-icon>mdi-facebook</v-icon>
            </router-link>

            <router-link to="/" class="text-white">
              <v-icon>mdi-twitter</v-icon>
            </router-link>

            <router-link to="/" class="text-white">
              <v-icon>mdi-instagram</v-icon>
            </router-link>

            <router-link to="/" class="text-white">
              <v-icon>mdi-youtube</v-icon>
            </router-link>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
          <h6>Quick Links</h6>

          <div class="scoial-icons d-flex align-items-center gap-3">
            <router-link to="/" class="text-white"> Home </router-link>

            <router-link to="/" class="text-white"> About Us </router-link>

            <router-link to="/" class="text-white"> Contact Us </router-link>

            <router-link to="/" class="text-white"> Pricing </router-link>
          </div>
        </div>
      </div>
    </div>
    <p class="text-center mb-0 pb-3">&copy; Aitech All Right Reserved.</p>
  </footer>
</template>

<style lang="scss" scoped>
p {
  font-size: 14px;
  color: #ffffffc7;
}
</style>
