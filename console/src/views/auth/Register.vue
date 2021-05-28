<template>
  <div class="container mx-auto px-4 h-full">
    <div class="flex content-center items-center justify-center h-full">
      <div class="w-full lg:w-6/12 px-4">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0"
        >
          <div class="rounded-t mb-0 px-6 py-6">

            <div class="btn-wrapper text-center">

            </div>
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form @submit.prevent="handleSubmit">
              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Nom
                </label>
                <input
                  type="text"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Nom"
                  v-model="name"
                />
                <InputError v-if="v$.name.required.$invalid && submitStatus === 'INVALID'" error="Le nom est requis"></InputError>

              </div>

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
                <InputError v-if="v$.email.email.$invalid && submitStatus === 'INVALID'" error="L'email n'est pas correct"></InputError>

              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Mot de passe
                </label>
                <input
                  type="password"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Password"
                  v-model="password"

                />
                <InputError v-if="v$.password.required.$invalid && submitStatus === 'INVALID'" error="Le mot de passe est requis"></InputError>

              </div>

              <div class="relative w-full mb-3">
                <label
                    class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                    htmlFor="grid-password"
                >
                  Confirmation du mot de passe
                </label>
                <input
                    type="password"
                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    placeholder="Confirmation du mot de passe"
                    v-model="password_confirmation"

                />
                <InputError v-if="v$.password_confirmation.sameAsPassword.$invalid && submitStatus === 'INVALID'" error="Les mots de passe ne sont pas identiques"></InputError>

              </div>

              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input
                    id="customCheckLogin"
                    type="checkbox"
                    class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"
                    v-model="cgu"
                  />
                  <span class="ml-2 text-sm font-semibold text-blueGray-600">
                    J'accepte
                    <a href="javascript:void(0)" class="text-emerald-500">
                      les conditions générales d'utilisation
                    </a>
                  </span>

                </label>
                <InputError v-if="v$.cgu.sameAs.$invalid && submitStatus === 'INVALID'" error="Vous devez accepter les conditions générales d'utilisations"></InputError>

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
                    Créer mon compte
                  </span>
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import useVuelidate from "@vuelidate/core";
import {useStore} from "vuex";
import InputError from "@/components/Errors/InputError";
import ButtonLoader from "@/components/Loaders/ButtonLoader";
import registerValidator from "@/validators/RegisterValidator"

export default {
  setup(){
    return {
      v$: useVuelidate(),
      $store: useStore(),
    }
  },
  validations() {
    return registerValidator
  },
  data() {
    return {
      email: 'new@manager.io',
      name: 'John Die',
      password: 'secret1234',
      password_confirmation: 'secret1234',
      submitStatus: null,
      formErrors: [],
      cgu: false
    };
  },
  methods: {
    handleSubmit(){
      this.submitStatus = 'PENDING';
      this.v$.$touch();
      if (this.v$.$invalid) {
        this.submitStatus = 'INVALID';
        return;
      }else{
        this.$store.dispatch('user/register', {
          email: this.email,
          name: this.name,
          password: this.password,
          password_confirmation: this.password_confirmation,
          redirect: null
        });

        this.submitStatus = 'SUCCESS';
      }
    }
  },
  components: {
    InputError,  ButtonLoader
  }
};
</script>
