<template>
  <div class="container">
    {{ user }}
    <hr/>
    <hr/>


    <el-row :gutter="10">
      <el-col :span="6">
        <div class="column">*</div>
      </el-col>
      <el-col :span="6">
        <div class="column">*</div>
      </el-col>
    </el-row>


    <el-form v-model="model">


      <el-form-item label="full name" prop="fullName" label-width="15em">
        <el-row>
          <el-form-item
            class="el-col-10"
            label="Name"
            prop="fullName.name">
            <el-input v-model="model.fullName.name" autocomplete="off"/>
          </el-form-item>

          <el-form-item
            class="el-col-10"
            label="Last Name"
            prop="fullName.lastName">
            <field-lang-select v-model="model.fullName.lastName" />
<!--            <el-input v-model="model.fullName.lastName" autocomplete="off"/>-->
          </el-form-item>
        </el-row>

        <el-row>
          <el-form-item
            class="el-col-6"
            label="Name"
            prop="fullName.name">
            <el-input v-model="model.fullName.name" autocomplete="off"/>
          </el-form-item>

          <el-form-item
            class="el-col-6"
            label="Last Name"
            prop="fullName.lastName">
            <el-input v-model="model.fullName.lastName" autocomplete="off"/>
          </el-form-item>
        </el-row>

      </el-form-item>

    </el-form>

  </div>
</template>


<script lang="ts">
import {Component, Provide, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  name: 'Dashboard',
  computed: mapGetters({
    'user': 'user/user',
  }),
})
export default class extends Vue {
  @Provide('admin')
  public get admin() {
    return this.$adminManager.byName('entries')
  }

  public model: object = {
    fullName: {
      name: 'pepe',
      lastName: 'lopez'
    }
  }
}
</script>

<style scoped lang="scss">

.el-form-item.el-col-1,
.el-form-item.el-col-2,
.el-form-item.el-col-3,
.el-form-item.el-col-4,
.el-form-item.el-col-5,
.el-form-item.el-col-6,
.el-form-item.el-col-7,
.el-form-item.el-col-8,
.el-form-item.el-col-9,
.el-form-item.el-col-10,
.el-form-item.el-col-11,
.el-form-item.el-col-12,
.el-form-item.el-col-13,
.el-form-item.el-col-14,
.el-form-item.el-col-15,
.el-form-item.el-col-16,
.el-form-item.el-col-17,
.el-form-item.el-col-18,
.el-form-item.el-col-19,
.el-form-item.el-col-20,
.el-form-item.el-col-21,
.el-form-item.el-col-22,
.el-form-item.el-col-23,
.el-form-item.el-col-24,
{
  padding-left: 1rem;
}

</style>


