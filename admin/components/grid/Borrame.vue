<template>
  <div>
    {{ $auth.hasScope('ADMIN') }}

    <br>
    <v-text-field v-model="name" placeholder="name" label="name" />
    <v-btn @click="create">
      nuevo greeting
    </v-btn>
  </div>
</template>

<script>

export default {
  name: 'Borrame',
  data () {
    return {
      name: ''
    }
  },
  methods: {
    create () {
      this.$axios.$post('https://api.prueba.local/greetings', {
        name: this.name
      })
    }
  }

}
</script>
