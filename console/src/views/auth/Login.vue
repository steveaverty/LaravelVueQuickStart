<template>
  <div class="container mx-auto px-4 h-full">
    <div class="flex content-center items-center justify-center h-full">
      <div class="w-full lg:w-4/12 px-4">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0"
        >
          <div class="rounded-t mb-0 px-6 py-6">
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form  @submit.prevent="handleSubmit">
              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Email
                </label>
                <input
                  type="email"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Email"
                  v-model="email"
                />
                <InputError v-if="v$.email.required.$invalid && submitStatus === 'INVALID'" error="L'email est requis"></InputError>
                <InputError v-if="v$.email.email.$invalid && submitStatus === 'INVALID'" error="Le format d'email n'est pas correct"></InputError>

              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Password
                </label>
                <input
                  type="password"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Password"
                  v-model="password"
                />
                <InputError v-if="v$.password.required.$invalid && submitStatus === 'INVALID'" error="Le mot de passe est requis"></InputError>

              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input
                    id="customCheckLogin"
                    type="checkbox"
                    class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"
                  />
                  <span class="ml-2 text-sm font-semibold text-blueGray-600">
                    Remember me
                  </span>
                </label>
              </div>

              <div class="text-center mt-6">
                <button
                  class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                  type="submit"
                >
                  <span v-if="submitStatus === 'PENDING'">
                    <ButtonLoader :loading="loading" :color="color" :size="'20px'"></ButtonLoader>
                  </span>
                  <span v-else>
                    Se connecter
                  </span>
                </button>
              </div>

              <div class="text-center mt-4">
                <router-link
                    to="/auth/forgot-password"
                    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                >
                  Mot de passe oublié
                </router-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import InputError from "@/components/Errors/InputError"
import loginValidator from "@/validators/LoginValidator"
import ButtonLoader from "src/components/Loaders/ButtonLoader"
import {useStore} from "vuex";

export default {
  setup(){
    return {
      v$: useVuelidate(),
      $store: useStore(),
    }
  },
  data: function () {
    return {
      email: 'admin@boisle.io',
      password: 'secret1234',
      submitStatus: null,
      formErrors: []
    };
  },
  validations() {
    return loginValidator
  },
  methods: {
    handleSubmit(){
      this.submitStatus = 'PENDING';
      this.v$.$touch();
      if (this.v$.$invalid) {
        this.submitStatus = 'INVALID';
        return;
      }else{
        this.$store.dispatch('user/authenticate', {
          email: this.email,
          password: this.password,
          redirect: this.$route.query.redirect || null
        });

        this.submitStatus = 'SUCCESS';
      }
    }
  },
  components: {
    InputError,  ButtonLoader,
  },
};

</script>
