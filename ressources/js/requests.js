
/** --------------------- REQUETE API EQUIPEMENT --------------------- */

const ROOT_API_URL = "https://eldenring.fanapis.com/api";

async function getEquipment (type, param = "name", name = "") {
    try {
        const url = `${ROOT_API_URL}/${type}?${param}=${name}`;
        console.log(url);
        let req = await fetch(url);
        let resultat = await req.json();

        if (resultat.success === true && resultat.data.length > 0) return resultat.data;
        else console.log("request to API - FAILED");
    }
    catch (error) {console.log(error);}
}

/** --------------------- REQUETE RECHERCHE --------------------- */

function getSearchInput() {
    return document.getElementById('search-input').value;
}