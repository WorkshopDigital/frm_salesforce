import { UPDATE_CLIENT_ID, UPDATE_CLIENT_SECRET } from './actions';

const initialState = {
	clientId: null,
	clientSecret: null
}

function frmSalesforceApp(state = initialState, action) {
	switch(action.type) {
		case UPDATE_CLIENT_ID:
			return Object.assign({}, state, {clientId: action.value});
		case UPDATE_CLIENT_SECRET:
			return Object.assign({}, state, {clientSecret: action.value});
		default:
			return state;
	}
}

export default frmSalesforceApp