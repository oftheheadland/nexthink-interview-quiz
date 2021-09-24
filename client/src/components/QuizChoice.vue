<template>
  <label class="dark-label">
    <input
      type="radio"
      :value="weight"
      @input="$emit('update:weight', $event.target.value)"
    />
    <span>{{ value }}</span>
  </label>
</template>

<script>
export default {
  props: {
    weight: String.required,
    value: String.required,
  },
};
</script>

<style scoped></style>
