
const ROOT_API_URL = "https://eldenring.fanapis.com/api";

function getSearchInput() {
    return document.getElementById('search-input').value;
}

/** --------------------- REQUETE API EQUIPEMENT --------------------- */

async function getEquipment (type, name = "", param = "name") {
    try {
        const url = `${ROOT_API_URL}/${type}?${param}=${name}`;
        console.log(url);
        let req = await fetch(url);
        let resultat = await req.json();

        if (resultat.success === true && resultat.data.length > 0) {
            console.log("success");
            return resultat.data;
        }
        else {console.log("ECHEC");}
    } catch (error) {console.log(error);}
}