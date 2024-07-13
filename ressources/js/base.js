/** SCRIPT BASE JS ELDEN BUILD */

/**--------------------- BACKGROUND & DEFILEMENT ---------------------*/

const IMAGES_BACKGROUNDS_URL = "/ressources/images/backgrounds";

const images = [
    `${IMAGES_BACKGROUNDS_URL}/liurnia.png`,
    `${IMAGES_BACKGROUNDS_URL}/dephts.png`,
    `${IMAGES_BACKGROUNDS_URL}/wyvern.png`
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

/**--------------------- BACKGROUND & DEFILEMENT ---------------------*/