import { 
	UPDATE_CLIENT_ID, 
	UPDATE_CLIENT_SECRET,
	POST_DATA,
	GET_DATA,
	API_SUCCESS,
	API_FAILURE
} from './actions';

const initialStateWpApi = {
	isFetching: false,
	apiError: false,
	apiErrorMsg: '',
	endpoint: null,
	nonce: null
}

const initialStateSalesForceCredentials = {
	clientId: null,
	clientSecret: null,
}

export function wpApi(state = initialStateWpApi, action) {
	switch(action.type) {
		case POST_DATA:
			return Object.assign({}, state, {
				isFetching: true,
			})		
		case GET_DATA:
			return Object.assign({}, state, {
				isFetching: true,
			})	
		case API_SUCCESS:
			return Object.assign({}, state, {
				isFetching: false,
				apiError: false,
				apiErrorMsg: ''
			})			
		case API_FAILURE:
			return Object.assign({}, state, {
				isFetching: false,
				apiError: true,
				apiErrorMsg: action.msg
			})			
		default:
			return state;
	}
}

export function salesForceCredentials(state = initialStateSalesForceCredentials, action) {
	switch(action.type) {
		case UPDATE_CLIENT_ID:
			return Object.assign({}, state, {clientId: action.value});
		case UPDATE_CLIENT_SECRET:
			return Object.assign({}, state, {clientSecret: action.value});
		default:
			return state;
	}
}