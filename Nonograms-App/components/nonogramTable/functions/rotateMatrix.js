export function rotateMatrix(matrix) {
  const result = [];
  for (let i = 0; i < matrix[0].length; i++) {
    const newRow = [];
    for (let j = matrix.length - 1; j >= 0; j--) {
      newRow.push(matrix[j][i]);
    }
    result.push(newRow.reverse());
  }
  return result;
}
