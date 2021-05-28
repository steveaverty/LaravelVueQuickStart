<template>
  <div>
    <div class="flex flex-wrap">
      <div class="w-full xl:w-12">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
        >
          <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
            <div class="flex flex-wrap items-center">
              <div class="relative w-full max-w-full flex-grow flex-1">
                <h6 class="uppercase text-blueGray-400 mb-1 text-xs font-semibold">
                  Hello {{this.$store.state.user.name}} ({{this.$store.state.user.email}})
                </h6>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="flex flex-wrap mt-4">
      <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
        <card-page-visits />
      </div>
      <div class="w-full xl:w-4/12 px-4">
        <card-social-traffic />
      </div>
    </div>
  </div>
</template>
<script>
import CardPageVisits from "@/components/Cards/CardPageVisits.vue";
import CardSocialTraffic from "@/components/Cards/CardSocialTraffic.vue";
import {useStore} from "vuex";

export default {
  name: "dashboard-page",
  components: {
    CardPageVisits,
    CardSocialTraffic,
  },
  setup(){
    return {
      $store: useStore(),
    }
  },
};
</script>
