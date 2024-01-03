<template>
  <p>Student form</p>
  <label for="">name</label>
  <input type="text" v-model="form.name" placeholder="name">

  <label for="">sex</label>
  <input type="text" v-model="form.sex" placeholder="sex">

  <button @click="saveData">save</button>
  {{ form }}
</template>

<script setup>

import { reactive } from 'vue'

const form = reactive({
  name: '',
  sex: '',
})

const saveData = () => {
  axios.post('/api/students', form).then(res => {
    console.log(res.data)
  })
}

</script>