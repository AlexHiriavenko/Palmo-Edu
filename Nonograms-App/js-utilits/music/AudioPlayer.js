class AudioPlayer {
  constructor(playlist) {
    this.playlist = playlist;
    this.currentTrackIndex = 0;
    this.isPlaying = false;
    this.audioPlayer = new Audio();
    this.audioPlayer.src = this.playlist[this.currentTrackIndex];
    this.audioPlayer.addEventListener("ended", () => this.playNextTrack());
  }

  playNextTrack() {
    this.currentTrackIndex =
      (this.currentTrackIndex + 1) % this.playlist.length;
    this.audioPlayer.src = this.playlist[this.currentTrackIndex];
    this.audioPlayer.play();
  }

  play() {
    this.audioPlayer.play();
    this.isPlaying = true;
  }

  pause() {
    this.audioPlayer.pause();
    this.isPlaying = false;
  }

  togglePlayPause() {
    if (this.isPlaying) {
      this.pause();
    } else {
      this.play();
    }
  }
}

export default AudioPlayer;
