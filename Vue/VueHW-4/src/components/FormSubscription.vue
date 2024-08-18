<template>
  <form
    @submit.prevent="submitForm"
    class="component"
  >
    <div>
      <label for="username">Name:</label>
      <input
        type="text"
        id="username"
        v-model="formData.username"
        :class="{ invalid: errors.username }"
      />
      <span
        v-if="errors.username"
        class="error"
      >
        имя должно содержать не менее 2х символов
      </span>
    </div>

    <div>
      <label for="email">Email:</label>
      <input
        type="text"
        id="email"
        v-model="formData.email"
        :class="{ invalid: errors.email }"
      />
      <span
        v-if="errors.email"
        class="error"
      >
        введите почту в формате: mail@domain.com
      </span>
    </div>

    <button type="submit">Відправити</button>

    <p
      v-if="submitStatusText"
      :style="{ color: submitStatus ? 'green' : 'red' }"
    >
      {{ submitStatusText }}
    </p>
  </form>
</template>

<script>
  export default {
    name: 'FormSubscription',
    data() {
      return {
        formData: {
          username: '',
          email: '',
        },
        errors: {
          username: false,
          email: false,
        },
        submitStatusText: '',
        submitStatus: false,
      };
    },

    methods: {
      clearForm() {
        Object.keys(this.formData).forEach((field) => {
          this.formData[field] = '';
        });
        this.errors.username = false;
        this.errors.email = false;
      },
      validateUserName() {
        this.errors.username = this.formData.username.trim().length < 2;
      },
      validateEmail() {
        const RFC_5322_STANDARD =
          /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\u0021\u0023-\u005b\u005d-\u007f]|\\[\u0021-\u007f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\u0021-\u005a\u0053-\u007f]|\\[\u0021-\u007f])+)\])/;

        this.errors.email = !RFC_5322_STANDARD.test(this.formData.email);
      },
      validateForm() {
        this.validateEmail();
        this.validateUserName();
        const isValid = Object.values(this.errors).every(
          (error) => error === false,
        );

        return isValid;
      },

      submitForm() {
        this.submitStatus = this.validateForm();
        this.submitStatusText = this.submitStatus
          ? 'Форма успешно отправлена'
          : 'Форма заполнена не корректно';

        if (this.submitStatus) {
          this.clearForm();
        }
      },
    },
  };
</script>

<style>
  .error {
    color: red;
    display: block;
  }
  
  .invalid {
    border-color: red;
  }

  form {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: start;
    gap: 16px;
  }

  label {
    padding-inline: 8px;
  }

  input {
    min-width: 260px;
  }
</style>
