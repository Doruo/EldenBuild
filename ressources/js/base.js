
/** SCRIPT JS ELDEN BUILD */

const URL_BACKGROUNDS_ROOT = "/ressources/images/backgrounds";

const images = [
    `${URL_BACKGROUNDS_ROOT}/liurnia.png`,
    `${URL_BACKGROUNDS_ROOT}/dephts.png`,
    `${URL_BACKGROUNDS_ROOT}/wyvern.png`
];

let indexImages = 0;
changeBackGround();

// Defilement arrière-plan
//const chb = setInterval(changeBackGround, 20000);

function changeBackGround(){
    document.body.style.backgroundImage = `url('${images[indexImages]}')`;
    indexImages = (indexImages + 1) % images.length;
}

function lancerDefilement(){
    const chb = setInterval(changeBackGround, 20000);
}

function stopperDefilement(){
    clearInterval(chb);
}