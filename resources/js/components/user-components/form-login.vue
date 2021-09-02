<style scoped>
.message-error {
  font-size: 0.7em;
  color: red;
}
</style>
<template>
  <form
    method="POST"
    ref="form"
    action="requisitar-login"
    @submit.prevent="submit"
  >
    <input type="hidden" name="_token" :value="csrf" />
    <div class="form-floating mb-3">
      <div v-if="errors.email">
        <div class="message-error">{{ errors.email }}</div>
      </div>
      <input
        type="text"
        name="user_email"
        class="form-control"
        placeholder="nome@exemplo.com"
        v-model="email"
      />
      <label for="user_email">Email</label>
    </div>
    <div class="form-floating mb-3">
      <div v-if="errors.password">
        <div class="message-error">{{ errors.password }}</div>
      </div>
      <input
        class="form-control"
        type="password"
        name="user_password"
        autocomplete="off"
        placeholder="Senha"
        v-model="password"
        @blur="submit"
      />
      <label for="user_password">Senha</label>
    </div>
    <div class="d-grid mb-12 text-center">
      <div class="d-grid mb-2">
        <button
          class="btn btn-primary btn-login fw-bold text-uppercase"
          type="submit"
        >
          Login
        </button>
      </div>
    </div>
    <a class="d-block text-center mt-2 small" href="/cadastro"
      >Não possui uma conta? Registrar</a
    >
    <hr class="my-4" />
  </form>
</template>
<script>
import useVuelidate from "@vuelidate/core";
import { required, email, minLength } from "@vuelidate/validators";

export default {
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      email: "",
      password: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      errors: [],
    };
  },
  validations() {
    return {
      email: {
        required,
        email,
      },
      password: {
        required,
        min: minLength(8),
      },
    };
  },
  methods: {
    submit() {
      this.v$.$touch();
      if (!this.v$.$invalid || !this.v$.$error) return this.$refs.form.submit();

      this.errors = [];

      this.v$.$errors.forEach((field) => {
        var fieldError = field.$validator;
        //Verifica os campos
        switch (true) {
          case field.$property === "email": {
            //Valida o campo do email
            if (fieldError === "required") {
              this.errors.email = "O email é obrigatório.";
            } else if (fieldError === "email") {
              this.errors.email =
                "Formato de email incorreto. Ex: exemplo@email.com";
            }
            break;
          }
          case field.$property === "password": {
            //Valida o campo da senha

            if (fieldError === "required") {
              this.errors.password = "A senha é obrigatória";
            } else if (fieldError === "min") {
              this.errors.password =
                "A senha deve conter no minimo 8 caracteres.";
            }
            break;
          }
        }
      });
    },
  },
};
</script>