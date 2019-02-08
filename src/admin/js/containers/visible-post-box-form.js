import { store } from '../redux/store'
import { connect } from 'react-redux'
import { updateClientId, updateClientSecret, saveFormData } from '../redux/actions'
import PostBoxForm from '../components/post-box-form'

const mapStateToProps = ({salesForceCredentials}) => {
	return {
		clientId: salesForceCredentials.clientId, 
		clientSecret: salesForceCredentials.clientSecret,
	}
}

const mapDispatchToProps = dispatch => {
	return {
		updateClientId:     e => dispatch(updateClientId(e.target.value)), 
		updateClientSecret: e => dispatch(updateClientSecret(e.target.value)),
		saveFormData:       e => {
			e.preventDefault();
			dispatch(saveFormData(store.getState()))
		},
		getTokens: (code, urlParams) => dispatch(getTokens(code, urlParams, store.getState()))
	}
}

const VisiblePostBoxForm = connect( 
	mapStateToProps, 
	mapDispatchToProps
)(PostBoxForm)

export default VisiblePostBoxForm