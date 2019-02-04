import { createStore, applyMiddleware } from 'redux'
import thunk from 'redux-thunk';
import { combineReducers } from 'redux'
import { salesForceCredentials, wpApi } from './reducers'

let store = null;

function initStore(props) {
	store = createStore(
		combineReducers({
			salesForceCredentials,
			wpApi	
		}),
		{
			salesForceCredentials: {
				clientId: props.clientId,
				clientSecret: props.clientSecret
			},
			wpApi: {
				endpoint: props.endpoint,
				nonce: props.nonce
			}				
		},
		applyMiddleware(thunk)		
	);

	return store;
}

export default initStore;
export { store }
