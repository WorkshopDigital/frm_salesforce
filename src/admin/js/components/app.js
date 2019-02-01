import React from 'react';
import VisiblePostBoxForm from '../containers/visible-post-box-form'

const App = () => {
	return (
		<div className="postbox">
			<h2 className="handle"><span>OAuth Configuration</span></h2>
			<VisiblePostBoxForm />
		</div>	
	)
}

export default App;