/** SCRIPT BASE JS ELDEN BUILD */

/**--------------------- BACKGROUND & DEFILEMENT ---------------------*/

const IMAGES_BACKGROUNDS_URL = "/ressources/images/backgrounds";

const images = [
    `${IMAGES_BACKGROUNDS_URL}/liurnia.webp`,
    `${IMAGES_BACKGROUNDS_URL}/dephts.webp`,
    `${IMAGES_BACKGROUNDS_URL}/wyvern.webp`
];

let indexImages = 0;
changeBackGround("liurnia");

// Defilement arrière-plan
// const chb = setInterval(changeBackGroundSuivant, 20000);

function changeBackGroundSuivant(){
    document.body.style.backgroundImage = `url('${images[indexImages]}')`;
    indexImages = (indexImages + 1) % images.length;
}

function changeBackGround(nom){
    document.body.style.backgroundImage = `url('${IMAGES_BACKGROUNDS_URL}/${nom}.webp')`;
}

function lancerDefilement(){
    const chb = setInterval(changeBackGroundSuivant, 20000);
}

function stopperDefilement(){
    clearInterval(chb);
}

/**--------------------- BACKGROUND & DEFILEMENT ---------------------*/

function creerItem(data){
    // div principal
    const item = document.createElement('div');
    item.classList.add('item');

    // Ajoute div principal dans la liste
    document.getElementById('item-list').appendChild(item);

    // nom
    const name = document.createElement('h2');
    name.textContent = `${data.name}`;
    item.appendChild(name);
}