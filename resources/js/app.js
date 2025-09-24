import initLanguageSwitcher from "./components/language-switcher";
import initFreemodeCarousel from "./components/freemode";
import initPlayCrewFreemodeCarousel from "./components/play-crew-carousel";
import initActorsFreemodeCarousel from "./components/actors-carousel";
import initAwardFreemodeCarousel from "./components/award-carousel";
import initStatisticsFreemodeCarousel from "./components/statistics-carousel";
import initDirectorsFreemodeCarousel from "./components/directors-carousel";
import "./components/hero-carousel";
import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    initLanguageSwitcher();
    initFreemodeCarousel();
    initPlayCrewFreemodeCarousel();
    initActorsFreemodeCarousel();
    initAwardFreemodeCarousel();
    initStatisticsFreemodeCarousel();
    initDirectorsFreemodeCarousel();
});
