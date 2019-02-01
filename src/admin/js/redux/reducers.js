import { combineReducers } from 'redux'
import { 
	UPDATE_CLIENT_ID, 
	UPDATE_CLIENT_SECRET,
	POST_DATA,
	GET_DATA,
	API_SUCCESS,
	API_FAILURE
} from './actions';

const initialState = {
	isFetching: false,
	apiError: false,
	apiErrorMsg: '',
	clientId: null,
	clientSecret: null,
}

function wpApi(state = initialState, action) {
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

function salesForceCredentials(state = initialState, action) {
	switch(action.type) {
		case UPDATE_CLIENT_ID:
			return Object.assign({}, state, {clientId: action.value});
		case UPDATE_CLIENT_SECRET:
			return Object.assign({}, state, {clientSecret: action.value});
		default:
			return state;
	}
}

const rootReducer = combineReducers({
	salesForceCredentials,
	wpApi	
})

export default rootReducer