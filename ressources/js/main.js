/** SCRIPT BASE JS ELDEN BUILD */

const absoluteURL = "http://eldenring.eldenbuild.com/src/vue/web/controleurFrontal.php";

/** --------------------- MENU NAVBAR --------------------- */

const menuToggle = document.getElementById('menu-toggle');

menuToggle.addEventListener('click', function () {

    if (menuToggle.classList.contains("menuOff")) {
        menuToggle.textContent = "▻";
        menuToggle.classList.remove("menuOff");
        menuToggle.classList.add("menuOn");

        let items = document.querySelectorAll('.navbar-nav .nav-item.hidden');

        items.forEach(function (item) {
            item.classList.remove('hidden');
            item.classList.add('visible');
            item.classList.remove('slide-out');
            item.classList.add('slide-in');
        });
    } else if (menuToggle.classList.contains("menuOn")) {
        menuToggle.textContent = "▽";
        menuToggle.classList.remove("menuOn");
        menuToggle.classList.add("menuOff");

        let items = document.querySelectorAll('.navbar-nav .nav-item.visible');

        items.forEach(function (item) {
            item.classList.remove('slide-in');
            item.classList.add('slide-out');
            setTimeout(function () {
                item.classList.add('hidden');
            }, 500); // Durée de l'animation
        });
    }
});

/**--------------------- BACKGROUND ---------------------*/

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

function changeBackGroundSuivant() {
    document.body.style.backgroundImage = `url('${images[indexImages]}')`;
    indexImages = (indexImages + 1) % images.length;
}

function changeBackGround(nom) {
    document.body.style.backgroundImage = `url('${IMAGES_BACKGROUNDS_URL}/${nom}.webp')`;
}

function lancerDefilement() {
    const chb = setInterval(changeBackGroundSuivant, 20000);
}

function stopperDefilement() {
    clearInterval(chb);
}

/** --------------------- BARRE RECHERCHE API --------------------- */

let searchBar = document.getElementById('search-input');
searchBar.addEventListener('change', async () => {
    const searchValue = await getSearchInput();
});

/** --------------------- LIEN TEST REQUETE API --------------------- */

let lienTestApi = document.getElementById('testAPI-link');

if (lienTestApi !== null)
    lienTestApi.addEventListener('click', () => getRandomFromAPI("weapons"));


/** --------------------- ITEMS --------------------- */

function addItemCard(data) {
    // card
    const card = document.createElement('div');
    card.className = 'card';

    // card body
    const cardBody = document.createElement('div');
    cardBody.className = 'card-body';
    card.appendChild(cardBody);

    // card title
    const name = document.createElement('h2');
    name.className = "card-title";
    name.textContent = `${data.name}`;
    cardBody.appendChild(name);

    // type
    const type = document.createElement('p');
    type.className = "card-text";
    type.textContent = `${data.type}`;
    cardBody.appendChild(type);

    //image
    const image = document.createElement('img');
    image.alt = name.textContent;
    image.src = data.image;
    cardBody.appendChild(image);

    // effect
    const effect = document.createElement('p');
    effect.className = "card-text";
    effect.textContent = `${data.effect}`;
    cardBody.appendChild(effect);

    // Description
    const description = document.createElement('p');
    description.className = "card-text";
    description.textContent = `${data.description}`;
    cardBody.appendChild(description);

    // Ajoute div principal dans la liste
    document.getElementById('card-list').appendChild(card);
}

/** --------------------- FONCTIONS UTILITAIRES --------------------- */

function randomMinMax(min, max) {
    // échange leur valeurs si erronés
    if (min > max) {
        let temp = min;
        min = max;
        max = temp;
    }
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

/** --------------------- * --------------------- */