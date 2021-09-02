<style scoped>
.message-error {
  font-size: 0.7em;
  color: red;
}
</style>
<template>
  <form
    ref="form"
    method="POST"
    action="requisitar-novo-quadro-de-trabalho"
    @submit.prevent="submit"
  >
    <input type="hidden" name="_token" :value="csrf" />
    <div class="modal-body">
      <div v-if="errors.workboard_name">
        <div class="message-error">{{ errors.workboard_name }}</div>
      </div>
      <input
        type="text"
        class="form-control"
        id="workboard_name"
        name="workboard_name"
        v-model="workboard_name"
      />
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">
        Cancelar
      </button>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
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
      workboard_name: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      errors: [],
    };
  },
  validations() {
    return {
      workboard_name: {
        required,
      },
    };
  },
  methods: {
    submit() {
      this.v$.$touch();
      if (!this.v$.$invalid || !this.v$.$error) return this.$refs.form.submit();

      this.errors = [];

      if (this.v$.$errors[0].$property === "workboard_name") {
        if (this.v$.$errors[0].$params.type === "required") {
          this.errors.workboard_name =
            "Por favor, insira um nome para o novo quadro de trabalho.";
        }
      }
    },
  },
};
</script>