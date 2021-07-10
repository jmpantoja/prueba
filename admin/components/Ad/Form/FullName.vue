<template>
  <el-form-item :label="label" :prop="prop">

    <el-form-item
      label="Name"
      :prop="prop + '.name'"
      :rules="rules.name"
    >
      <el-input v-model="data.name" autocomplete="off"/>
    </el-form-item>

    <el-form-item
      label="last name"
      :prop="prop + '.lastName'"
      :rules="rules.lastName"
    >
      <el-input v-model="data.lastName" autocomplete="off"/>
    </el-form-item>

  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, mixins} from 'nuxt-property-decorator'

@Component({
  name: 'FullName'
})
export default class extends mixins(Field) {

  rules: Object = {
    name: [
      {required: true, message: 'es requerido'},
      {min: 4, message: 'name is too short', trigger: 'blur'}
    ],
    lastName: [
      {required: true, message: 'es requerido'},
      {min: 4, message: 'name is too short', trigger: 'blur'}
    ]
  }
}

</script>

