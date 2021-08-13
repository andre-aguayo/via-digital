<style scoped>
#msg_danger {
  color: red;
  text-align: center;
}
</style>
<template id="app">
  <p id="msg_danger">@{{ msg }}</p>
</template>

<script>
import { required, email, minLength } from "vuelidate/lib/validators";

export default {
  name: "validation",
  data() {
    return {
      user: {
        user_email: "",
        user_password: "",
      },
      submitted: false,
    };
  },
  validations: {
    user: {
      user_email: {
        required,
        email,
      },
      user_password: {
        required,
        minLength: minLength(8),
      },
    },
  },
  methods: {
    handleSubmit(e) {
      this.submitted = true;

      // stop here if form is invalid
      this.$v.$touch();
      if (this.$v.$invalid) {
        return { msg: this };
      }
    },
  },
};
</script>