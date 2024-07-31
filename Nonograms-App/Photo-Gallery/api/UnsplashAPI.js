// const apiKey = import.meta.env.VITE_UNSPLASH_API_KEY;
const apiKey = import.meta.env.VITE_UNSPLASH_API_KEY_ALTERNATIVE;

class UnsplashAPI {
  constructor(apiKey) {
    this.apiKey = apiKey;
    this.baseURL = "https://api.unsplash.com";
  }

  async fetchFromAPI(endpoint) {
    const response = await fetch(`${this.baseURL}${endpoint}`, {
      headers: {
        Authorization: `Client-ID ${this.apiKey}`,
      },
    });

    if (!response.ok) {
      if (response.status === 401 || response.status === 403) {
        alert(
          "Превышен лимит запросов на сервер, попробуйте другой API ключ. Ищите в readMe."
        );
        throw new Error("Превышен лимит запросов на сервер");
      }
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();
    return data;
  }

  async getRandomPhotos(count = 1, orientation = "landscape") {
    const endpoint = `/photos/random/?count=${count}&orientation=${orientation}`;
    return await this.fetchFromAPI(endpoint);
  }

  async searchPhotos(query, perPage = 30, page = 1, orientation = "landscape") {
    const endpoint = `/search/photos/?query=${query}&per_page=${perPage}&page=${page}&orientation=${orientation}`;
    const { results } = await this.fetchFromAPI(endpoint);
    return results || [];
  }
}

export const unsplash = new UnsplashAPI(apiKey);
