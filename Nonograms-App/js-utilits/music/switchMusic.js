import AudioPlayer from "./AudioPlayer";

// path deploy version
const musicPath = "/Palmo-Edu/nonograms/music/";

// path dev version
// const musicPath = "./app-files/music/";

const musicPlaylist = [
  `${musicPath}alexander-nakarada-emotional-piano-improvisation.mp3`,
  `${musicPath}alexander-nakarada-winter.mp3`,
];

const audioPlayer = new AudioPlayer(musicPlaylist);

function switchMusic(event) {
  audioPlayer.togglePlayPause();
  event.currentTarget.classList.toggle("off");
}

const musicSwitcher = document.querySelector(".header__btn.turn-music");

export { musicSwitcher, switchMusic };
