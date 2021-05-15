<template>
  <div>
    <div class="form-group row">
      <label
        class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required"
        >Şifre</label
      >
      <div class="col-lg-9">
        <input
                  
                    type="password"
                    class="form-control text-3 h-auto py-2"
                    @blur="$v.password.$touch()"
                    v-model="password"
                    :class="{'is-invalid' : $v.password.$error}"
                  />

                  <!-- <small v-if="!$v.password.required" class="form-text text-danger"
                    >Bu alan zorunludur...</small
                  > -->
                  <small v-if="!$v.password.minLength" class="form-text text-danger"
                    >Lütfen şifreniz en az
                    {{ $v.password.$params.minLength.min }} karakterden oluşmalıdır...
                  </small>
                  <small v-if="!$v.password.maxLength" class="form-text text-danger"
                    >Lütfen şifreniz en fazla
                    {{ $v.password.$params.maxLength.max }} karakterden oluşmalıdır...
                  </small>
      </div>
    </div>
    <div class="form-group row">
      <label
        class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required"
        >Şifre Tekrarı</label
      >
      <div class="col-lg-9">
             <input
                    name="pwd_confirm"
                    type="password"
                    class="form-control text-3 h-auto py-2"
                    @blur="$v.password_confirmation.$touch()"
                    v-model="password_confirmation"
                    :class="{'is-invalid' : $v.password_confirmation.$error}"
                  />


                  <small
                    v-if="!$v.password_confirmation.minLength"
                    class="form-text text-danger"
                    >Lütfen şifreniz en az
                    {{ $v.password_confirmation.$params.minLength.min }} karakterden
                    oluşmalıdır...
                  </small>
                  <small
                    v-if="!$v.password_confirmation.maxLength"
                    class="form-text text-danger"
                    >Lütfen şifreniz en fazla
                    {{ $v.password_confirmation.$params.maxLength.max }} karakterden
                    oluşmalıdır...
                  </small>
                  <small
                    v-if="!$v.password_confirmation.sameAs"
                    class="form-text text-danger"
                    >Girdiğiniz şifreler birbirleriyle uyuşmuyor...
                  </small>
      </div>
    </div>
     <div class="form-group row">
      <div class="form-group col-lg-9"></div>
      <div class="form-group col-lg-3">
        <button
          @click.prevent="savePassword"
          class="btn btn-primary btn-modern float-end"
          :disabled="$v.$invalid"
        >
        <span v-if="loading">
            <i class="fas fa-circle-notch fa-spin"></i> Gönderiliyor...
          </span>
          <span v-else>
            <i class="fas fa-edit"></i> Kaydet
          </span></button>
      </div>
    </div>
  </div>
</template>

<script>
import {
  required,
  email,
  numeric,
  minLength,
  maxLength,
  sameAs,
  between,
} from "vuelidate/lib/validators";
import { mapGetters} from 'vuex'
export default {
  data() {
    return {
      password:'',
      password_confirmation:'',
      loading: false,
    }
  },
  computed:{
    ...mapGetters(['getUser'])
  },
  validations: {
   
    password: {
      required,

      minLength: minLength(8),
      maxLength: maxLength(18),
    },
    password_confirmation: {
      required,
      minLength: minLength(8),
      maxLength: maxLength(18),
      // sameAs : sameAs('password'),
      sameAs: sameAs((vm) => {
        return vm.password;
      }),
    },
  },
  methods:{
   async savePassword(){
      let formData=new FormData();
    
       
        formData.append('id',this.getUser.id),
        formData.append('password',this.password),
        formData.append('password_confirmation',this.password_confirmation),
        
        await axios.post('/api/password',formData).then((res)=>{
          
          Swal.fire("Kaydedildi!", "Şifreniz başarılı bir şekilde kaydedildi.", "success");
        }).catch((err)=>{ 
              inputError(Object.values(err.response.data.errors));
             
           
    })
    }
  }
};
</script>

<style lang="scss" scoped></style>
