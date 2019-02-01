import { createStore } from 'redux'
import frmSalesforceApp from './reducers'

function store(props) {
	return createStore(frmSalesforceApp, props);
}

export default store;