
/** REQUETES API */

const ROOT_API_URL = "https://eldenring.fanapis.com/api";

async function getItemAPI (nameOrIndex) {
    try {
        console.log(`${ROOT_API_URL}/items?name=${nameOrIndex}`);
        let req = await fetch(`${ROOT_API_URL}/items?name=${nameOrIndex}`);
        let data = await req.json();
        if (data.success === true){
            console.log("OUI");
            console.log(data.data);
        }
        else {console.log("NON");}
    } catch (error) {console.log(error);}
}

// TEST
// getItemAPI("Blue Cipher Ring");