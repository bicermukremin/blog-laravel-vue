<template>
  <form role="form" class="needs-validation">
    <div class="form-group row">
      <label
        class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required"
        >İsim</label
      >
      <div class="col-lg-9">
        <input
          class="form-control text-3 h-auto py-2"
          type="text"
          placeholder="İsim"
          required
        />
      </div>
    </div>
    <div class="form-group row">
      <label
        class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required"
        >Hakkımda</label
      >
      <div class="col-lg-9">
        <ckeditor
          class="form-control text-3 h-auto py-2"
          value="Hakkımda"
          required
        ></ckeditor>
      </div>
    </div>
    <div class="form-group row">
      <label
        class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required"
        >Mail Adresi</label
      >
      <div class="col-lg-9">
        <input
          class="form-control text-3 h-auto py-2"
          type="email"
          name="email"
          placeholder="email@gmail.com"
          required
        />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >FaceBook</label
      >
      <div class="col-lg-9">
        <input
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="Facebook"
        />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >Twitter</label
      >
      <div class="col-lg-9">
        <input
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="Twitter"
        />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >İnstagram</label
      >
      <div class="col-lg-9">
        <input
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="İnstagram"
        />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >Youtube</label
      >
      <div class="col-lg-9">
        <input
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="Youtube"
        />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >LinkedIn</label
      >
      <div class="col-lg-9">
        <input
          class="form-control text-3 h-auto py-2"
          type="text"
          name="company"
          placeholder="LinkedIn"
        />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"
        >Website</label
      >
      <div class="col-lg-9">
        <input
          class="form-control text-3 h-auto py-2"
          type="url"
          name="website"
          placeholder="Website Adresi"
        />
      </div>
    </div>

    <div class="form-group row">
      <div class="form-group col-lg-9"></div>
      <div class="form-group col-lg-3">
        <input
          type="submit"
          value="Save"
          class="btn btn-primary btn-modern float-end"
          data-loading-text="Loading..."
        />
      </div>
    </div>
  </form>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped></style>
