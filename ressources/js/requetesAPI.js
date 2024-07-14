
/** REQUETES API */

const ROOT_API_URL = "https://eldenring.fanapis.com/api";

async function getItemAPI (nameOrIndex) {
    try {
        console.log(`${ROOT_API_URL}/items?name=${nameOrIndex}`);
        let req = await fetch(`${ROOT_API_URL}/items?name=${nameOrIndex}`);
        let resultat = await req.json();
        if (resultat.success === true && resultat.data.length > 0){
            console.log("success");
            console.log("Description : "+resultat.data[0].description);
        }
        else {console.log("ECHEC");}
    } catch (error) {console.log(error);}
}

// TEST
// getItemAPI("Blue Cipher Ring");