<template>
  <form class="user" action="#" @submit.prevent="registerIncome">
    <div class="form-group">
      <label for="email">Email</label>
      <input
        class="form-control"
        type="email"
        id="email"
        aria-describedby="emailHelp"
        placeholder="Enter Email Address..."
        name="email"
        v-model="email"
        required
      />
    </div>
    <div class="form-group">
      <label for="value">Value to transfer</label>
      <input
        class="form-control"
        type="number"
        id="value"
        placeholder="Transfer value"
        name="value"
        step="0.01"
        min="0.01"
        max="5000"
        v-model="value"
        required
      />
    </div>
    <div class="form-group">
      <label>Type of Payment</label>
      <div class="dropdown">
        <select
          class="form-control btn btn-outline-primary dropdown-toggle"
          data-toggle="dropdown"
          aria-expanded="false"
          name="paytype"
          v-model="type_payment"
          id="ptype"
          required
        >
          <option class="dropdown-item" role="presentation" value="c">Cash</option>
          <option class="dropdown-item" role="presentation" value="bt">Bank Transfer</option>
        </select>
      </div>
    </div>
    <div class="form-group" v-if="type_payment == 'bt'">
      <label for="iban">IBAN</label>
      <input
        class="form-control"
        type="text"
        name="iban"
        v-model="iban"
        id="iban"
        @blur="checkIban()"
        placeholder="IBAN"
        required
      />
    </div>
    <div class="form-group">
      <label>Source Description</label>
      <textarea
        class="form-control"
        name="source_description"
        id="srcdscpt"
        cols="20"
        rows="5"
        placeholder="Small description of the income"
      ></textarea>
    </div>
    <button class="btn btn-primary text-white btn-user" type="submit">Confirm</button>
  </form>
  <!-- TODO On completion, emit to home page to say done or something like that -->
</template>
<script>
export default {
  name: "RegisterIncomeComponent",
  data() {
    return {
      email: "",
      value: 0.0,
      type_payment: "",
      iban: "",
      source_description: ""
    };
  },
  mounted() {
    let script = document.createElement("script");
    script.setAttribute("src", "http://dad.prj.test/js/iban.js");
    document.body.appendChild(script);
  },
  methods: {
    registerIncome() {
      /* 
      TODO 
      Send to the API to save a new Movement
      Check values there
      If errors, sendo appropriate errors. Check here after answer if there are erros and display them in error box
      If not, success message
      After that hide the register new income (do I need to redirect to home page?)
      */
      /* 
     transfer = 0
     start_balance –balance of the associated wallet before the movement is registered;
     end_balance - balance of the associated wallet after the movement is registered;
     */
      axios
        .get("/api/wallet/" + this.email)
        .then(response => {
          axios
            .post("/api/movements", {
              email: this.email,
              value: this.value,
              type: "i",
              type_payment: this.type_payment,
              iban: this.iban,
              source_description: this.source_description
            })
            .then(function(response) {
              console.log("RESPONSE" + response);
            })
            .catch(function(error) {
              console.log(error);
            });
        })
        .catch(error => {
          this.$toasted.show(
            "There isn't a wallet registered with that email",
            {
              position: "bottom-right",
              duration: 2000,
              type: "error"
            }
          );
        });
    },
    checkIban() {
      if (!IBAN.isValid(this.iban) && this.iban.trim() !== "") {
        this.iban = "";
        this.$toasted.show("IBAN is incorrect", {
          action: {
            text: "X",
            onClick: (e, toastObject) => {
              document.getElementById("iban").focus();
              toastObject.goAway(0);
            }
          },
          position: "bottom-right",
          duration: 2000,
          type: "error",
          onComplete() {
            document.getElementById("iban").focus();
          }
        });
      }
    }
  }
};
</script>

<style>
label {
  display: inline-block;
  margin-bottom: 0.3rem;
}
.form-group {
  text-align: left;
}
</style>