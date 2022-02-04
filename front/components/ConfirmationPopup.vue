<template>
  <div>
    <PrimaryRoundButton icon-name="trash" @click.native="isVisible = true" />
    <div v-if="isVisible" class="absolute top-1/3 left-1/3 w-1/4 h-1/4 bg-primary rounded text-accent font-francoisOne flex flex-col justify-center items-center text-2xl">
      C'est sûr ?
      <AccentButton name="Oui" class="my-4" @click.native="submit" />
      <AccentButton name="Non" @click.native="isVisible = false" />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    confirm: {
      type: Function,
      required: true
    }
  },
  data () {
    return {
      isVisible: false
    }
  },
  methods: {
    submit () {
      this.confirm()
      this.isVisible = false
    }
  }
}
</script>

<style scoped>

</style>
