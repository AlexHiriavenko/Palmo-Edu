### Напишіть функцію, яка за допомогою рядка тексту (можливо, із знаками пунктуації та розривами рядків) 
### повертає масив із трьох найбільш часто зустрічаються слів у порядку спадання кількості входжень.

### Припущення:

- Слово — це рядок літер (від A до Z), який необов’язково містить один або більше апострофів (') у ASCII.
- Апостроф може стояти на початку, в середині або в кінці слова ('abc, abc', 'abc', ab'c усі дійсні)
- Будь-які інші символи (наприклад, #, \, /, . ...) не є частиною слова і повинні розглядатися як пробіли.
- Збіги мають бути нечутливими до регістру, а слова в результаті мають бути написані малими літерами.
- Зв'язки можуть бути розірвані довільно.
- Якщо текст містить менше трьох унікальних слів, то повинні бути повернуті або перші 2 або перші слова, або порожній масив, якщо текст не містить слів.

### Приклад
top_3_words("In a village of La Mancha, the name of which I have no desire to call to
mind, there lived not long since one of those gentlemen that keep a lance
in the lance-rack, an old buckler, a lean hack, and a greyhound for
coursing. An olla of rather more beef than mutton, a salad on most
nights, scraps on Saturdays, lentils on Fridays, and a pigeon or so extra
on Sundays, made away with three-quarters of his income.")
# => ["a", "of", "on"]

top_3_words("e e e e DDD ddd DdD: ddd ddd aa aA Aa, bb cc cC e e e")
# => ["e", "ddd", "aa"]

top_3_words("  //wont won't won't")
# => ["won't", "wont"]

Уникайте створення масиву, обсяг пам’яті якого приблизно такий же, як і вхідний текст.
Уникайте сортування всього масиву унікальних слів.
