<template>
    <div id="content">
        <top-nav></top-nav>

        <div class="container-fluid">
            <form class="user" v-on:submit.prevent="saveChangesToUser">
                <div>
                    <label for="name">Name: </label>
                    <input type="text" v-model="name">
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
        }
    }
}
</script>
