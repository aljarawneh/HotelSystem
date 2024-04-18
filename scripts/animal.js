// Variables
import key from "./apiKey.js";

const options = {
	method: "GET",
	headers: {
		"X-Api-Key": key,
		"Content-Type": "application/json",
	},
};

// ASYNC function to fetch API data
async function fetchAnimalData(name) {
	try {
		const response = await fetch(`https://api.api-ninjas.com/v1/animals?name=${name}`, options);
		const data = await response.json();

		// Log the result
		console.log(data);
	} catch (error) {
		// Handle errors
		console.error("Error fetching data:", error);
	}
}

// fetchAnimalData("cheetah");
