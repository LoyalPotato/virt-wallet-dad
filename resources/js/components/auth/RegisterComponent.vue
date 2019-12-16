<template>
<div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form class="user">
                                <div class="form-group">
                                    <!-- <label class="" for="photo">Photo:</label>
                                    <input type="file"> -->
                                    <picture-input
                                      ref="pictureInput"
                                      accept="image/jpeg,image/png"
                                      size="2"
                                      :removable="true"
                                      button-class="btn"
                                      :custom-strings="{
                                        upload: 'Something wen\'t wrong',
                                        drag: 'Click or drag to set your profile photo.',
                                        fileSize: 'The file size exceeds the limit', // Text only
                                        fileType: 'This file type is not supported.', // Text only
                                      }"
                                      @change="onChange">
                                    </picture-input>
                                </div>

                                <div class="form-group">
                                    <input class="form-control form-control-user" type="text" id="name" placeholder="Name" v-bind:name="name">
                                </div>

                                <div class="form-group"><input class="form-control form-control-user" type="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" v-bind:email="email"></div>

                                <div class="form-group"><input class="form-control form-control-user" placeholder="NIF" v-bind:nif="nif" id="nif" type="text" v-model.number="nif" required maxlength="9" pattern="[0-9]{9}" title="9 digit number"></div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="password" id="password" placeholder="Password" v-model="password" required></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password" id="exampleRepeatPasswordInput" placeholder="Repeat Password" name="password_repeat"></div>
                                </div>
                                <div class="btn-group btn-group-justified">
                                  <div class="btn-group">
                                    <button class="btn btn-primary text-white btn-user" type="submit">Register Account</button>
                                  </div>

                                  <div class="btn-group">
                                    <a class="btn btn-danger text-white btn-user" @click="cancelRegistration()">Cancel</a>
                                  </div>
                                </div>

                                <!-- <hr><a class="btn btn-primary btn-block text-white btn-google btn-user" role="button"><i class="fab fa-google"></i>; Register with Google</a><a class="btn btn-primary btn-block text-white btn-facebook btn-user" role="button"><i class="fab fa-facebook-f"></i>; Register with Facebook</a>
                                <hr> -->
                            </form>
                            <!-- <div class="text-center"><a class="small" href="forgot-password.html">Forgot Password?</a></div>
                            <div class="text-center"><a class="small" href="login.html">Already have an account? Login!</a></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import PictureInput from 'vue-picture-input'

export default {
name: "RegisterComponent",
  data() {
    return {
      title: "New User Registration",
      name: "",
      password: "",
      email: "",
      photo: "",
      nif: ""
    }
  },
  components: {
    PictureInput
  },
  methods: {
    register() {
      this.$store
        .dispatch("registerUser", {
          email: this.email,
          password: this.password,
          name: this.name,
          photo: this.photo,
          nif: this.nif
        })
        .then(response => {
          this.$store.dispatch("registerUser").then(response => {
            console.log("Success"); //TODO Trigger success warning
            this.$router.push("/home"); //TODO user verification?
          });
        })
        .catch(function(error) {
          console.log(error); //TODO: Error page?
        });

    },

    cancelRegistration() {
      this.$router.push("/");
    },

    onChange (image) {
      console.log('New picture selected!')
      if (image) {
        console.log('Picture loaded.')
        this.photo = image
      } else {
        console.log('FileReader API not supported: use the <form>, Luke!')
      }
    }
}



}
</script>
