class Timer {
  constructor(container) {
    this.container = container;
    this.time = Number(localStorage.getItem("timer")) || 0;
    this.intervalId = null;
    this.isRunning = false;
    this.render();
  }

  start() {
    if (this.intervalId) return; // Не позволять запускать несколько интервалов
    this.intervalId = setInterval(() => {
      this.time += 1;
      this.update();
    }, 1000);
    this.isRunning = true;
  }

  stop() {
    if (this.intervalId) {
      clearInterval(this.intervalId);
      this.intervalId = null;
      this.isRunning = false;
    }
  }

  reset() {
    this.stop();
    this.time = 0;
    this.update();
  }

  render() {
    if (this.container instanceof Element) {
      this.container.textContent = this.formatTime(this.time);
    }
  }

  update() {
    if (this.container instanceof Element) {
      this.container.textContent = this.formatTime(this.time);
      this.setLocalStorage();
    }
  }

  getTime() {
    return this.time;
  }

  setLocalStorage() {
    localStorage.setItem("timer", this.time);
  }

  formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    const formattedMinutes = String(minutes).padStart(2, "0");
    const formattedSeconds = String(remainingSeconds).padStart(2, "0");
    return `${formattedMinutes}:${formattedSeconds}`;
  }
}

export default Timer;
