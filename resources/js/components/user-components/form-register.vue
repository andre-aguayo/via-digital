<style scoped>
.message-error {
  font-size: 0.7em;
  color: red;
}
</style>
<template>
  <form
    @submit.prevent="submit"
    method="POST"
    ref="form"
    action="/requisitar-cadastro"
  >
    <input type="hidden" name="_token" :value="csrf" />
    <div class="form-floating mb-3">
      <div v-if="errors.name">
        <div class="message-error">{{ errors.name }}</div>
      </div>
      <input
        type="text"
        class="form-control"
        name="user_name"
        id="user_name"
        placeholder="Nome"
        autofocus
        v-model="name"
      />
      <label for="user_name">Nome</label>
    </div>
    <div class="form-floating mb-3">
      <div v-if="errors.email">
        <div class="message-error">{{ errors.email }}</div>
      </div>
      <input
        type="email"
        class="form-control"
        id="user_email"
        name="user_email"
        placeholder="nome@exemplo.com"
        v-model="email"
      />
      <label for="user_email">Email</label>
    </div>
    <hr />
    <div class="form-floating mb-3">
      <div v-if="errors.password">
        <div class="message-error">{{ errors.password }}</div>
      </div>
      <input
        type="password"
        class="form-control"
        name="user_password"
        id="user_password"
        placeholder="Senha"
        autocomplete="off"
        v-model="password"
      />
      <label for="user_password">Senha</label>
    </div>
    <div class="form-floating mb-3">
      <div v-if="errors.confirmPassword">
        <div class="message-error">{{ errors.confirmPassword }}</div>
      </div>
      <input
        type="password"
        class="form-control"
        id="user_confirm_password"
        placeholder="Confirmar senha"
        autocomplete="off"
        v-model="confirmPassword"
      />
      <label for="user_confirm_password">Confirmar senha</label>
    </div>
    <div class="d-grid mb-12 text-center">
      <div class="d-grid mb-2">
        <button
          class="btn btn-primary btn-login fw-bold text-uppercase text-center"
          type="submit"
        >
          Cadastrar
        </button>
      </div>
    </div>
    <a class="d-block text-center mt-2 small" href="/login"
      >Ja possui uma conta? Logar</a
    >
    <hr class="my-4" />
  </form>
</template>
<script>
import useVuelidate from "@vuelidate/core";
import { required, email, minLength, sameAs } from "@vuelidate/validators";

export default {
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      name: "",
      email: "",
      password: "",
      confirmPassword: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      errors: [],
    };
  },
  validations() {
    return {
      name: {
        required,
        min: minLength(3),
      },
      email: {
        required,
        email,
      },
      password: {
        required,
        min: minLength(8),
      },
      confirmPassword: {
        required,
        min: minLength(8),
        sameAsPassword: sameAs(this.password),
      },
    };
  },
  methods: {
    submit() {
      this.v$.$touch();
      if (!this.v$.$invalid || !this.v$.$error) return this.$refs.form.submit();

      this.errors = [];

      this.v$.$errors.forEach((field) => {
        console.log(field);
        var fieldError = field.$validator;
        //Verifica os campos
        switch (true) {
          case field.$property === "name": {
            //Valida o campo do email
            if (fieldError === "required") {
              this.errors.name = "Seu nome é obrigatório.";
            } else if (fieldError === "min") {
              this.errors.name = "O nome deve conter ao menos 3 caracteres";
            }
            break;
          }
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
          case field.$property === "confirmPassword": {
            //Valida o campo da senha

            if (fieldError === "required") {
              this.errors.confirmPassword = "A senha é obrigatória";
            } else if (fieldError === "min") {
              this.errors.confirmPassword =
                "A senha deve conter no minimo 8 caracteres.";
            } else if (fieldError === "sameAsPassword") {
              this.errors.confirmPassword = "As senhas deve ser iguais.";
            }
            break;
          }
        }
      });
    },
  },
};
</script>