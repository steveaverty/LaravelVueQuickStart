<template>
  <div>
    <!-- Danger -->
    <div class="bg-red-200 p-4 rounded flex items-start text-red-500 my-4 shadow-lg mx-auto max-w-2xl" v-if="errors.length > 0">
      <div class="text-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z"/></svg>
      </div>
      <div class=" px-3">
        <h3 class="text-red-800 font-semibold tracking-wider">
          Certaines informations ne sont pas corrects
        </h3>
        <ul class="list-disc list-inside">
          <li v-bind:key="error" v-for="error in errors">
            {{error}}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>


<script>

export default {
  props: [
      'errors'
  ],
  data() {
    return {};
  },
};
</script>