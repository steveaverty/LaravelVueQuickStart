<template>
  <div>
    <p class="text-red-500 text-xs">
      {{error}}
    </p>
  </div>
</template>


<script>

export default {
  props: [
      'error'
  ],
  data() {
    return {};
  },
};
</script>