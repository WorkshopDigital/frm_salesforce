import { connect } from 'react-redux'
import { updateClientId, updateClientSecret } from '../redux/actions'
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
		updateClientSecret: e => dispatch(updateClientSecret(e.target.value))
	}
}

const VisiblePostBoxForm = connect( 
	mapStateToProps, 
	mapDispatchToProps 
)(PostBoxForm)



export default VisiblePostBoxForm