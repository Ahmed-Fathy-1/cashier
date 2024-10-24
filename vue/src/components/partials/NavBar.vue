<template>
  <div
    class="header w-100 second-header"
    :class="{ 'position-absolute z-3': $route.path === '/' }"
  >
    <div class="container py-3 d-flex gap-5 align-items-center justify-content-between">
      <div class="nav-bar d-flex gap-5 w-100 align-items-center justify-content-between">
        <div class="logo-wrapper">
          <img src="@/assets/images/logos/logo.png" class="logo" alt="Logo" />
        </div>

        <!-- Links for large screens -->
        <ul class="d-none gap-4 align-items-center list-unstyled d-lg-flex d-md-none">
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/about">About Us</router-link></li>
          <li><router-link to="/pricing">Pricing</router-link></li>
          <li><router-link to="/contact">Contact Us</router-link></li>
          <li v-if="true">
            <v-btn
              class="elevation-0 text-capitalize"
              @click="handleLogout()"
              size="small"
            >
              <span>Sign Out</span>
              <img src="../../assets/images/sign-in.png" width="20" alt="Sign In" />
            </v-btn>
          </li>
          <li v-else>
            <v-btn
              class="elevation-0 text-capitalize"
              @click="navigateTo('/login')"
              size="small"
            >
              <span>Sign In</span>
              <img src="../../assets/images/sign-in.png" width="20" alt="Sign In" />
            </v-btn>
          </li>
        </ul>

        <!-- Toggle button for small screens -->
        <ToggleBtn @click="toggleMenu" />

        <!-- Mobile menu -->
        <div class="mobile-menu-container" :class="{ 'menu-active': menuActive }">
          <div class="mobile-menu d-flex justify-content-center align-items-center">
            <v-icon class="close-icon" color="#fff" @click="closeMenu">mdi-close</v-icon>
            <ul>
              <li><router-link to="/">Home</router-link></li>
              <li><router-link to="/about">About Us</router-link></li>
              <li><router-link to="/pricing">Pricing</router-link></li>
              <li><router-link to="/contact">Contact Us</router-link></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { auth } from '@/router/routes/auth';
import ToggleBtn from './ToggleBtn.vue';
import { useAuthStore } from '@/store/store';
import { defineComponent, ref } from 'vue';
import { useRouter } from 'vue-router';

export default defineComponent({
  components: { ToggleBtn },
  setup() {
    const authStore = useAuthStore();
    const router = useRouter();
    const menuActive = ref(false); 

    const toggleMenu = () => {
      menuActive.value = !menuActive.value;
    };

    const closeMenu = () => {
      menuActive.value = false;
    };

    const navigateTo = (route) => {
      router.push(route);
    };

    const checkIsLogined = () => {
      if (localStorage.getItem('token')) {
        console.log('loginned');
        return true;
      } else {
        console.log('not logined why');
        return false; // Return false if not logged in
      }
    };

    const handleLogout = () => {
      authStore.logout();
      router.push('/login');
    };

    return {
      menuActive,
      toggleMenu,
      closeMenu,
      navigateTo,
      checkIsLogined,
      handleLogout,
    };
  },
});
</script>


<style lang="scss" scoped>
ul {
  margin-bottom: -8px;
}

.logo {
  width: auto;
  height: 50px;
}

a {
  text-decoration: none;
  color: var(--bs-white);
}

.mobile-menu {
  position: fixed;
  background-color: rgba(0, 0, 0, 0.65);
  width: 94%;
  height: 97vh;
  left: 0;
  top: 0;
  margin: 13px;
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.45);
  backdrop-filter: blur(4px);
}

.mobile-menu-container {
  position: fixed;
  width: 100%;
  height: 100vh;
  left: -100%;
  top: 0;
  backdrop-filter: blur(4px);
  transition: all 0.3s ease;
}

.mobile-menu-container.menu-active {
  left: 0;
}

.close-icon {
  position: absolute;
  top: 16px;
  color: #fff;
  right: 15px;
  border: 1px solid;
  border-radius: 50%;
  padding: 14px;
  cursor: pointer;
}
</style>
