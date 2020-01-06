<template>
    <div id="content">
        <top-nav></top-nav>

        <div class="container-fluid">
            <form class="user" v-on:submit.prevent="saveChangesToUser">
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" v-model="name" class="form-control form-control-user" id="name" required>
                </div>

                <div class="form-group">
                    <label for="name">Email: </label>
                    <input type="email" :placeholder="email" class="form-control form-control-user" id="email" disabled>
                </div>

                <div class="form-group">
                    <label for="name">NIF: </label>
                    <input type="text" v-model="nif" class="form-control form-control-user" id="nif" required maxlength="9" pattern="[0-9]{9}" title="9 digit number">
                </div>

                <div class="form-group">
                    <label for="name">Photo: </label>
                    <input type="file" id="photo" accept="image/png, image/jpeg" @change="onChange">
                </div>

                <div class="form-group">
                    <label for="name">Old Password: </label>
                    <input type="text" v-model="password" class="form-control form-control-user" id="oldPassword" required>
                    <span>Required to save changes.</span>
                </div>

                <div class="form-group">
                    <label for="newPassword">New Password: </label>
                    <input type="text" v-model="newPassword" class="form-control form-control-user" id="newPassword">

                    <label for="newPasswordConfirmed">New Password Confirmation: </label>
                    <input type="text" v-model="newPasswordConfirmed" class="form-control form-control-user" id="newPasswordConfirmed">
                </div>

                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button class="btn btn-primary text-white btn-user" type="submit">Save Changes</button>
                    </div>
                </div>

                <div class="btn-group">
                    <a class="btn btn-danger text-white btn-user" @click="cancelChanges()">Cancel</a>
                </div>
            </form>
        </div>

        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright">
                    <span>Copyright Â© Virtual Wallets 2019</span>
                </div>
            </div>
        </footer>
    </div>

</template>
<script>
import TopNav from "./TopNavComponent.vue";

export default {
    name: "UserSettings",
    components: {
        TopNav
    },
    data() {
        return {
            title: "New User Registration",
            name: this.$store.state.user.name,
            email: this.$store.state.user.email,
            nif: this.$store.state.user.nif,
            photo: this.$store.state.user.photo,
            password: "",
            newPassword: "",
            newPasswordConfirmed: ""
        }
    },
    computed: {

    },
    methods: {
        saveChangesToUser () {
            console.log("Entered saving changes to user.");
            this.$store
                .dispatch("saveUserChanges", {
                    name: this.name,
                    email: this.email,
                    nif: this.nif,
                    photo: this.photo,
                    password: this.password,
                    newPassword: this.newPassword,
                    newPasswordConfirmed: this.newPasswordConfirmed
                })
                .then(response => {
                    this.$store.dispatch("saveUserChanges").then(response => {
                        console.log("Success"); //TODO Trigger success warning
                        this.$router.push("/home"); //TODO user verification?
                    });
                })
                .catch(function(error) {
                    console.log("Error changing user.");
                    console.log(error); //TODO: Error page?
                });
        },

        cancelChanges() {
            this.$router.push("/home")
        },

        onChange (image) {
            console.log('New picture selected!')
            if (image) {
                console.log('Picture loaded.')
                this.photo = image;
            } else {
                console.log('FileReader API not supported: use the <form>, Luke!')
            }
        }
    }
}
</script>
