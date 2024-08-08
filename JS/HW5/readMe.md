# HW5

## Deploy:

- [tasks 1-9](https://alexhiriavenko.github.io/Palmo-Edu/JS/HW5/tasks1-9/)
- [task10. Form](https://alexhiriavenko.github.io/Palmo-Edu/JS/HW5/Form/)
- [task11. Calculator](https://alexhiriavenko.github.io/Palmo-Edu/JS/HW5/Calculator/)
- [task12. Shopping Cart](https://alexhiriavenko.github.io/Palmo-Edu/JS/HW5/ShoppingCart/)

## Task:

1. Создайте кнопку на странице. При клике на нее выведите в alert сообщение Hello, Palmo.

2. Создайте кнопку и инпут с текстом Hello, Palmo. При клике на кнопку в инпуте текст должен замениться на Hello, World!

3. Создайте кнопку и инпут. При клике на кнопку в console.log выведите содержимое инпута.

4. Создайте 2 заголовка h1 и кнопку. При клике на кнопку текст в заголовках должен замениться друг на друга.

5. Создайте абзац (<p>) с люыбым текстом и кнопку. При клике на кнопку цвет текста должен поменять на красный, кликнув еще раз,
   текст должен вернуть исходный цвет.

6. Создайте кнопку и инпут. При клике на кнопку инпут должен стать заблокированным (disabled). При повторном клике должен разблокироваться.

7. Создайте 2 квадрата (зеленый и красный). При клике на зеленый - цвет зеленого квадрата должен стать красным, красный - зеленым. И наоброт.

8. Создайте кнопку и пустой список ul на странице. При каждом клике должен появляться новый элемент списка с порядковым номером.

9. Создайте textarea и кнопку на странице. При клике на кнопку внизу должен появиться список с каждым значением в textarea,
   перечисленном через запятую. Например: в textarea ввели - яблоко, груша, помидор, апельсин, манго. Внизу должен появиться список 1. яблоко 2. груша 3. помидор 4. апельсин 5. манго

10. Создайте форму для регистрации с полями логин, емейл, возраст, пароль, повтор пароля и кнопка Зарегистрироваться.
    При нажатии на кнопку нужно проверить все поля по следующим правилам:
    логин - значние не менее 4х и не более 20 символов, не должен содержать символы . \_ / \ | ,
    емейл - быть не пустым и меть формать text@text.text
    возраст - не пустой, только числа, числа не могут быть отрицательными
    пароль - должен быть не пустым, не менее 6 символов, иметь хотя бы одну заглавную букву и хотя бы одну цифру
    Если все правила выполнены, над формой должно появиться уведомление, что регистрация пройдена успешно и поля должны очиститься.
    Если какое-то поле заполненно некорректно - инпуту с некорректным значнием дать красный бордер и под инпутом вывести текст ошибки.

11. Создайте простейший кальякулятор. На странице должны быть кнопки от 0 до 9 и знаки + - \* / =.
    При клике на каждую цифру или знак, значние должно появляться в строке. При нажатаии на кнопку "=" - вывести результат
    математического выражения. Не забудьте добавить все проверки.

12. Создайте простую корзину товаров. На странице выведите несколько товаров (не важно в каком виде, просто название товара
    и кнопка Добавить в корзину). Также на странице должна быть иконка с корзиной, при нажатии на которую, открывается модальное
    окно со списком добавленных товаров. В корзине должна быть кнопка "Очистить корзину", при нажатии на которую все элементы с корзины удаляются.