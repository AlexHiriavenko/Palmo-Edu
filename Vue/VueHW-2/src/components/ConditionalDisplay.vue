<template>
  <div>
    <!-- 
    Створіть компонент, який відображає два різних повідомлення на основі булевої змінної. 
    Переключайте змінну для перевірки умовного виведення обох повідомлень. 
    -->
    <div class="toggle-text">
      <p v-if="showMessage">
        Это
        <span class="accent-text">первое</span>
        сообщение, отображаемое при
        <span class="accent-text">true</span>
        значении.
      </p>
      <p v-else>
        Это
        <span class="accent-text">второе</span>
        сообщение, отображаемое при
        <span class="accent-text">false</span>
        значении.
      </p>
      <button @click="toggleMessage">Переключить сообщение</button>
    </div>

    <!-- 
        Створіть два елементи, один з v-show, інший з v-if, з однаковими умовами. 
        Змініть умову і спостерігайте за відмінностями у DOM. 
        Дослідіть, в яких ситуаціях краще використовувати кожну директиву. 
    -->
    <div class="display-changes">
      <h3 class="subtitle">Display Changes</h3>
      <p v-if="showElement">Элемент с использованием v-if.</p>
      <p v-show="showElement">Элемент с использованием v-show.</p>
      <button @click="toggleElement">Переключить отображение элементов</button>
    </div>

    <!-- 
        Використовуючи v-bind, динамічно додавайте або видаляйте атрибути елемента (наприклад, disabled, readonly) в залежності від умови.
    -->
    <div class="attribute-binding">
      <h3 class="subtitle">Dynamic Attribute Binding</h3>
      <input
        type="text"
        :disabled="isDisabled"
        :readonly="isReadonly"
        placeholder="Введите текст"
      />
      <button @click="toggleAttributes">Переключить атрибуты</button>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        showMessage: true,
        showElement: true,
        isDisabled: false,
        isReadonly: false,
      };
    },
    methods: {
      toggleMessage() {
        this.showMessage = !this.showMessage;
      },
      toggleElement() {
        this.showElement = !this.showElement;
      },
      toggleAttributes() {
        this.isDisabled = !this.isDisabled;
        this.isReadonly = !this.isReadonly;
      },
    },
  };
</script>

<style>
  .toggle-text {
  background-color: lightgreen;
  padding-block: 20px;
}

.accent-text {
  color: white;
}

.display-changes {
  background-color: azure;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 162px;
  align-items: center;
  padding-block: 20px;
}

.attribute-binding {
  background-color: lightgreen;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding-block: 20px;
}

h3.subtitle {
  margin: 0;
}

input[type="text"] {
  margin-bottom: 10px;
  padding: 5px;
}
</style>
