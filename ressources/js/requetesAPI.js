
/** REQUETES API */

const ROOT_API_URL = "https://eldenring.fanapis.com/api";

function getSearchInput() {
    return document.getElementById('search-input').value;
}

/** --------------------- ITEMS --------------------- */

async function getItemAPI(nameOrIndex, type) {
    try {
        await console.log(`${ROOT_API_URL}/items?name=${nameOrIndex}`);
        let req = await fetch(`${ROOT_API_URL}/${type}?name=${nameOrIndex}`);
        let resultat = await req.json();

        if (resultat.success === true && resultat.data.length > 0) {
            console.log("success");
            addItemCard(resultat.data[0]);
        }
        else {console.log("ECHEC");}
    } catch (error) {console.log(error);}
}