<template>
  <div class="container">
    {{ user }}
    <hr />
    <br/>
    <br/>

    <el-form ref="form" :model="model" label-width="10rem">

      <ad-form-full-name v-model="model.fullName" prop="fullName"/>
      <el-button type="primary" @click="submitForm('form')">Submit</el-button>

    </el-form>


    <pre style="text-align: left; display: block">
{{ model }}
    </pre>

  </div>
</template>


<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  name: 'Admin',
  computed: mapGetters({
    'user': 'user/roles',
  }),
})
export default class Dashboard extends Vue {

  roles: string[] = [];

  model: object = {
    age: 0,
    age2: 2,
    fullName: {
      name: null,
      lastName: null
    }
  }

  submitForm(formName: string) {
    // @ts-ignore
    this.$refs[formName].validate((valid: boolean) => {
      if (valid) {
        alert('submit!');
      } else {
        console.log('error submit!!');
        return false;
      }
    });
  }

  // resetForm(formName) {
  //  //this.$refs[formName].resetFields();
  // }

}

</script>

<style scoped lang="scss">

</style>


