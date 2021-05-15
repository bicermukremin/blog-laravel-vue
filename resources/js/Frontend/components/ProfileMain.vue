<template>
  <form role="form" class="needs-validation">
    <div class="form-group row">
      <label
        class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required"
        >İsim</label
      >
      <div class="col-lg-9">
        <input
         @blur="$v.user.name.touch()"
          v-model="user.name"
          class="form-control text-3 h-auto py-2"
          type="text"
          placeholder="İsim"
          required
          :class="{'is-invalid' : $v.user.name.$error}"
        />
        <small v-if="!$v.user.name.minLength" class="form-text text-danger">Lütfen isminiz en az {{
                            $v.user.name.$params.minLength.min }} karakterden oluşmalıdır...
                        </small>
                        <small v-if="!$v.user.name.maxLength" class="form-text text-danger">Lütfen isminiz en fazla {{
                            $v.user.name.$params.maxLength.max }} karakterden oluşmalıdır...
                 </small>
      </div>
    </div>
    <div class="form-group row">
      <label
        class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required"
        >Hakkımda</label
      >
      <div class="col-lg-9">
        <ckeditor
        @blur="$v.form.about.touch()"
          v-model="form.about"
          class="form-control text-3 h-auto py-2"
          value="Hakkımda"
          required
          :class="{'is-invalid' : $v.form.about.$error}"
        ></ckeditor>
         <small v-if="!$v.form.about.minLength" class="form-text text-danger">Lütfen hakkınızda kısmı en az {{
                            $v.form.about.$params.minLength.min }} karakterden oluşmalıdır...
                        </small>
                        <small v-if="!$v.form.about.maxLength" class="form-text text-danger">Lütfen hakkınızda kısmı en fazla {{
                            $v.form.about.$params.maxLength.max }} karakterden oluşmalıdır...
                        </small>
      </div>
    </div>
    <div class="form-group row">
      <label
        class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required"
        >Mail Adresi</label
      >
      <div class="col-lg-9">
        <input
          @blur="$v.user.email.$touch()"
          v-model="user.email"
          class="form-control text-3 h-auto py-2"
          type="email"
          name="email"
          placeholder="email@gmail.com"
          required
          :class="{'is-invalid' : $v.user.email.$error}"
        />
         <small v-if="!$v.user.email.email" class="form-text text-danger">Lütfen geçerli bir e-posta adresi
                            giriniz...
         </small>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >FaceBook</label
      >
      <div class="col-lg-9">
        <input
         @blur="$v.form.facebook.touch()"
         v-model="form.facebook"
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="Facebook"
          :class="{'is-invalid' : $v.form.facebook.$error}"
        />
         <small v-if="!$v.form.facebook.minLength" class="form-text text-danger">Lütfen facebook kısmı en az {{
                            $v.form.facebook.$params.minLength.min }} karakterden oluşmalıdır...
                        </small>
                        <small v-if="!$v.form.facebook.maxLength" class="form-text text-danger">Lütfen facebook kısmı en fazla {{
                            $v.form.facebook.$params.maxLength.max }} karakterden oluşmalıdır...
                        </small>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >Twitter</label
      >
      <div class="col-lg-9">
        <input
        @blur="$v.form.twitter.touch()"
        v-model="form.twitter"
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="Twitter"
          :class="{'is-invalid' : $v.form.twitter.$error}"
        />
        <small v-if="!$v.form.twitter.minLength" class="form-text text-danger">Lütfen twitter kısmı en az {{
                            $v.form.twitter.$params.minLength.min }} karakterden oluşmalıdır...
                        </small>
                        <small v-if="!$v.form.twitter.maxLength" class="form-text text-danger">Lütfen twitter kısmı en fazla {{
                            $v.form.twitter.$params.maxLength.max }} karakterden oluşmalıdır...
                        </small>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >İnstagram</label
      >
      <div class="col-lg-9">
        <input
         @blur="$v.form.instagram.touch()"
        v-model="form.instagram"
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="İnstagram"
          :class="{'is-invalid' : $v.form.instagram.$error}"
        />
        <small v-if="!$v.form.instagram.minLength" class="form-text text-danger">Lütfen instagram kısmı en az {{
                            $v.form.instagram.$params.minLength.min }} karakterden oluşmalıdır...
                        </small>
                        <small v-if="!$v.form.instagram.maxLength" class="form-text text-danger">Lütfen instagram kısmı en fazla {{
                            $v.form.instagram.$params.maxLength.max }} karakterden oluşmalıdır...
                        </small>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >Youtube</label
      >
      <div class="col-lg-9">
        <input
         @blur="$v.form.youtube.touch()"
          v-model="form.youtube"
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="Youtube"
          :class="{'is-invalid' : $v.form.youtube.$error}"
        />
         <small v-if="!$v.form.youtube.minLength" class="form-text text-danger">Lütfen youtube kısmı en az {{
                            $v.form.instagram.$params.minLength.min }} karakterden oluşmalıdır...
                        </small>
                        <small v-if="!$v.form.youtube.maxLength" class="form-text text-danger">Lütfen youtube kısmı en fazla {{
                            $v.form.youtube.$params.maxLength.max }} karakterden oluşmalıdır...
                        </small>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >LinkedIn</label
      >
      <div class="col-lg-9">
        <input
        @blur="$v.form.linkedIn.touch()"
          v-model="form.linkedIn"
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="LinkedIn"
          :class="{'is-invalid' : $v.form.linkedIn.$error}"
        />
         <small v-if="!$v.form.linkedIn.minLength" class="form-text text-danger">Lütfen linkedIn kısmı en az {{
                            $v.form.linkedIn.$params.minLength.min }} karakterden oluşmalıdır...
                        </small>
                        <small v-if="!$v.form.linkedIn.maxLength" class="form-text text-danger">Lütfen linkedIn kısmı en fazla {{
                            $v.form.linkedIn.$params.maxLength.max }} karakterden oluşmalıdır...
                        </small>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >Website</label
      >
      <div class="col-lg-9">
        <input
        @blur="$v.form.web.touch()"
          v-model="form.web"
          class="form-control text-3 h-auto py-2"
          type="url"
          name="website"
          placeholder="Website Adresi"
          :class="{'is-invalid' : $v.form.web.$error}"
        />
         <small v-if="!$v.form.web.minLength" class="form-text text-danger">Lütfen web kısmı en az {{
                            $v.form.web.$params.minLength.min }} karakterden oluşmalıdır...
                        </small>
                        <small v-if="!$v.form.web.maxLength" class="form-text text-danger">Lütfen web kısmı en fazla {{
                            $v.form.web.$params.maxLength.max }} karakterden oluşmalıdır...
                        </small>
      </div>
    </div>

    <div class="form-group row">
      <div class="form-group col-lg-9"></div>
      <div class="form-group col-lg-3">
        <button
          @click.prevent="saveProfile"
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
  </form>
</template>

<script>
import {required, email, numeric, minLength, maxLength} from "vuelidate/lib/validators"

export default {
   validations: {
           form:{
            about: {
                
                minLength: minLength(6),
                maxLength: maxLength(300)
            },
            facebook: {
                
                minLength: minLength(6),
                maxLength: maxLength(195),
            },
            instagram: {
                
                minLength: minLength(6),
                maxLength: maxLength(195),
            },
             twitter: {
                
                minLength: minLength(6),
                maxLength: maxLength(195),
            },
            youtube: {
                
                minLength: minLength(6),
                maxLength: maxLength(195),
            },
            linkedIn: {
                
                minLength: minLength(6),
                maxLength: maxLength(195),
            },
            web: {
                
                minLength: minLength(6),
                maxLength: maxLength(195),
            },
           
           },
           user:{
             name:{
               required,
               
                minLength: minLength(3),
                maxLength: maxLength(70),
             },
            email: {
                required,
                email,
               
            },
           }
        },
  props:{
    user: {
      type:Object,
      required:true
    }, 
    form: {
      type:Object,
      required:true
    }
  },
  
  data() {
    return {
      loading: false
    }
  },
  methods: {
    saveProfile(){
      this.loading=true
      this.$emit("saveProfile",{form:this.form,user:this.user,loading:this.loading});
        this.loading=false
      
    }
  },
 /*  watch:{
    user:function () {
      this.userForm.email=this.user.email;
      this.userForm.name=this.user.name;
    },
    form:function () {
      
      this.formProfile=this.form
      
    }
  } */
};
</script>

<style lang="scss" scoped></style>
