export function sortRecords(records) {
  const difficultyOrder = { easy: 1, medium: 2, hard: 3 };

  return records.sort((a, b) => {
    // Сравнение по сложности
    const difficultyDifference =
      difficultyOrder[b.difficulty] - difficultyOrder[a.difficulty];

    // Если сложности одинаковы, сравниваем по времени
    if (difficultyDifference === 0) {
      return a.time - b.time;
    }

    // Если сложности разные, возвращаем разницу
    return difficultyDifference;
  });
}
