import WPAPI from 'wpapi'
import Modal from '../services/modal'

export const UPDATE_CLIENT_ID = "UPDATE_CLIENT_ID"
export const UPDATE_CLIENT_SECRET = "UPDATE_CLIENT_SECRET"
export const POST_DATA = "POST_DATA"
export const GET_DATA = "GET_DATA"
export const API_SUCCESS = "API_SUCCESS"
export const API_FAILURE = "API_FAILURE"



export function updateClientId(value) {
	return { type: UPDATE_CLIENT_ID, value };
}

export function updateClientSecret(value) {
	return { type: UPDATE_CLIENT_SECRET, value };
}

export function postData() {
	return { type: POST_DATA }
}

export function getData({ clientId, clientSecret }) {
	return { type: GET_DATA, clientId, clientSecret }
}

export function apiFailure(msg) {
	return { type: API_FAILURE, msg }
}

export function apiSuccess(data) {
	return { type: API_SUCCESS, data }
}

export function saveFormData(state) {
	const wp = new WPAPI({
		endpoint: state.wpApi.endpoint,
		nonce: state.wpApi.nonce
	});
	const modal = new Modal(state);


	return async function(dispatch) {
		dispatch(postData);
		await wp.settings().update({
			'frm_salesforce': {
				client_id: state.salesForceCredentials.clientId,
				client_secret: state.salesForceCredentials.clientSecret
			}
		});
		modal.openRemote()
	}
}

