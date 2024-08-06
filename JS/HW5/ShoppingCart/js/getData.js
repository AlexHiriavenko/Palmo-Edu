async function getData(path) {
  try {
    const response = await fetch(path);
    if (!response.ok) {
      throw new Error("Ошибка загрузки данных");
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(error.message);
    return null;
  }
}

export default getData;
