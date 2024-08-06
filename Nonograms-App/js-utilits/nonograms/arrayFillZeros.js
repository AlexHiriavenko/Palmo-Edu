export function arrFillZeros(length = 0) {
  return Array.from({ length }, () => Array(length).fill(0));
}
