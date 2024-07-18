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
    }
    else if (menuToggle.classList.contains("menuOn")) {

        menuToggle.textContent = "▽";
        menuToggle.classList.remove("menuOn");
        menuToggle.classList.add("menuOff");

        let items = document.querySelectorAll('.navbar-nav .nav-item.visible');
        items.forEach(function (item) {
            item.classList.remove('visible');
            item.classList.remove('slide-in');
            item.classList.add('slide-out');
            setTimeout(() => item.classList.add('hidden'), 500); // Durée de l'animation
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
changeBackGround('liurnia');
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

let input = document.getElementById('search-input');
//input.addEventListener("input",()=> requeteAJAX(input.value,callback_2));

// Gestion Event Elements Autocompletion
let div = document.getElementById("autocompletion");

/*

div.addEventListener("click", (event) => {
    if (event.target.tagName === 'P' && event.target.parentNode.id === 'autocompletion') {
        input.value = event.target.textContent; // Récupère le texte du paragraphe
    }
});

*/

/** --------------------- LIEN TEST REQUETE API --------------------- */

let lienTestApi = document.getElementById('testAPI-link');

if (lienTestApi !== null){
    lienTestApi.addEventListener('click', () =>
        getEquipment("armors","","",20)
            .then(data =>addArmorCard(data[randomMinMax(0,data.length)]))
    );
}

/** --------------------- ITEMS --------------------- */

function addItemCard(data) {
    // fragment de document
    const fragment = document.createDocumentFragment();

    const card = document.createElement('div');
    card.className = 'card';

    const cardBody = document.createElement('div');
    cardBody.className = 'card-body';
    card.appendChild(cardBody);

    // Name
    const name = document.createElement('h2');
    name.className = "card-title";
    name.textContent = data.name;
    cardBody.appendChild(name);

    // Type
    const type = document.createElement('p');
    type.className = "card-text";
    type.textContent = data.type;
    cardBody.appendChild(type);

    // Image
    const image = document.createElement('img');
    image.alt = data.name;
    image.src = data.image;
    //image.width = 300; // A CHANGER
    //image.height = 168;
    cardBody.appendChild(image);

    // Effet
    const effect = document.createElement('p');
    effect.className = "card-text";
    effect.textContent = data.effect;
    cardBody.appendChild(effect);

    // Description
    const description = document.createElement('p');
    description.className = "card-text";
    description.textContent = data.description;
    description.width = "100";
    cardBody.appendChild(description);

    // Ajoute fragment au conteneur
    fragment.appendChild(card);
    document.getElementById('card-list').appendChild(fragment);
}

/** --------------------- ITEMS --------------------- */

function addArmorCard(data) {
    // fragment de document
    const fragment = document.createDocumentFragment();

    const card = document.createElement('div');
    card.className = 'card';

    const cardBody = document.createElement('div');
    cardBody.className = 'card-body';
    card.appendChild(cardBody);

    // Name
    const name = document.createElement('h2');
    name.className = "card-title";
    name.textContent = data.name;
    cardBody.appendChild(name);

    // category
    const category = document.createElement('p');
    category.className = "card-text";
    category.textContent = data.category;
    cardBody.appendChild(category);

    // Image
    const image = document.createElement('img');
    image.alt = data.name;
    image.src = data.image;
    //image.width = 300; // A CHANGER
    //image.height = 168;
    cardBody.appendChild(image);

    // Weight
    const weight = document.createElement('p');
    weight.className = "card-text";
    weight.textContent = "Weight : "+data.weight;
    cardBody.appendChild(weight);

    // dmgNegation
    const nameDmgNegation = document.createElement('h3');
    nameDmgNegation.className = "card-title";
    nameDmgNegation.textContent = "Dmg Negation";
    cardBody.appendChild(nameDmgNegation);

    const dmgNegation = document.createElement('p');
    dmgNegation.className = "card-text";
    data.dmgNegation.forEach(elem => dmgNegation.insertAdjacentText('beforeend',elem.name+" : "+elem.amount+" - " ))
    cardBody.appendChild(dmgNegation);

    // resistance
    const nameResistance = document.createElement('h3');
    nameResistance.className = "card-title";
    nameResistance.textContent = "Resistance";
    cardBody.appendChild(nameResistance);

    const resistance = document.createElement('p');
    resistance.className = "card-text";
    data.resistance.forEach(elem => resistance.insertAdjacentText('beforeend',elem.name+" : "+elem.amount+" - " ))
    cardBody.appendChild(resistance);

    // Description
    const nameDescription = document.createElement('h3');
    nameDescription.className = "card-title";
    nameDescription.textContent = "Description";
    cardBody.appendChild(nameDescription);

    const description = document.createElement('p');
    description.className = "card-text";
    description.textContent = data.description;
    description.width = "100";
    cardBody.appendChild(description);

    // Ajoute fragment au conteneur
    fragment.appendChild(card);
    document.getElementById('card-list').appendChild(fragment);
}

/** --------------------- OPTIONS PARAMETRES --------------------- */

function optionsToolTip(event) {
    event.preventDefault();
    let tooltip = document.getElementById('param-content');
    if (tooltip.style.display === 'block') {
        tooltip.style.display = 'none';
    } else {
        tooltip.style.display = 'block';
    }
}

// Pour fermer la bulle lorsque l'utilisateur clique ailleurs sur la page
document.addEventListener('click', function(event) {
    let tooltip = document.getElementById('tooltip-content');
    let targetElement = event.target; // Élement cliqué
    if (!tooltip.contains(targetElement) && !targetElement.closest('.nav-item')) {
        tooltip.style.display = 'none';
    }
});

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