export function calcShadedCells(cells) {
  let res = [];
  let count = 1;

  if (!cells.includes(1)) {
    res.push(0);
    return res.join(" ");
  }

  for (let i = 0; i < cells.length; i += 1) {
    let cell = cells[i];
    let nextCell = cells[i + 1];

    if (cell === 1 && nextCell === 1) {
      count += 1;
    } else if (cell === 1 && !nextCell) {
      res.push(count);
      count = 1;
    }
  }
  return res.join(" ");
}
