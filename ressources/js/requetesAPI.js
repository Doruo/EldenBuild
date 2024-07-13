
/** REQUETES API */

const ROOT_API_URL = "https://eldenring.fanapis.com/api/";

async function getItemAPI (nameOrIndex) {
    try {
        console.log(`${ROOT_API_URL}/items/${nameOrIndex}/`);
        let req = await fetch(`${ROOT_API_URL}/items/${nameOrIndex}/`);
        let data = await req.json();
    } catch (error) {console.log(error);}
}