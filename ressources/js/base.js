
/** SCRIPT BASE JS ELDEN BUILD */

/** --------------------- MENU NAVBAR --------------------- */

const menuToggle = document.getElementById('menu-toggle');

menuToggle.addEventListener('click', function() {

    if (menuToggle.classList.contains("menuOff"))
    {
        menuToggle.textContent="▻";
        menuToggle.classList.remove("menuOff");
        menuToggle.classList.add("menuOn");
        
        let items = document.querySelectorAll('.navbar-nav .nav-item.hidden');

        items.forEach(function(item) {
            item.classList.remove('hidden');
            item.classList.add('visible');
            item.classList.remove('slide-out');
            item.classList.add('slide-in');
        });
    }
    else if (menuToggle.classList.contains("menuOn"))
    {
        menuToggle.textContent="▽";
        menuToggle.classList.remove("menuOn");
        menuToggle.classList.add("menuOff");

        let items = document.querySelectorAll('.navbar-nav .nav-item.visible');

        items.forEach(function(item) {
            item.classList.remove('slide-in');
            item.classList.add('slide-out');
            setTimeout(function() {
                item.classList.add('hidden');
            }, 500); // Durée de l'animation
        });
    }
});

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