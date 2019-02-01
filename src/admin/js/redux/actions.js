const UPDATE_CLIENT_ID = "UPDATE_CLIENT_ID";
const UPDATE_CLIENT_SECRET = "UPDATE_CLIENT_SECRET";

function updateClientId(value) {
	return { type: UPDATE_CLIENT_ID, value };
}

function updateClientSecret(value) {
	return { type: UPDATE_CLIENT_SECRET, value };
}

export {
	updateClientId,
	updateClientSecret,
	UPDATE_CLIENT_ID,
	UPDATE_CLIENT_SECRET		
}