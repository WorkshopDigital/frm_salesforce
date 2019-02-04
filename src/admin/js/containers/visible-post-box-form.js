import { store } from '../redux/store'
import { connect } from 'react-redux'
import { updateClientId, updateClientSecret, saveFormData } from '../redux/actions'
import PostBoxForm from '../components/post-box-form'

const mapStateToProps = state => {
	return {
		clientId: state.clientId, 
		clientSecret: state.clientSecret,
	}
}

const mapDispatchToProps = dispatch => {
	return {
		updateClientId:     e => dispatch(updateClientId(e.target.value)), 
		updateClientSecret: e => dispatch(updateClientSecret(e.target.value)),
		saveFormData:       e => {
			e.preventDefault();
			dispatch(saveFormData(store.getState()))
		}
	}
}

const VisiblePostBoxForm = connect( 
	mapStateToProps, 
	mapDispatchToProps 
)(PostBoxForm)



export default VisiblePostBoxForm