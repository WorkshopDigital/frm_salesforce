import React from 'react';
import FormInput from './form-input';


const PostBoxForm = ({ clientId, clientSecret, updateClientId, updateClientSecret, saveFormData }) => {

	return (
		<div className="inside">
			<form method="post" action="options.php" onSubmit={saveFormData}>
				<table className="form-table">
					<tbody>
						<tr>
							<th scope="row">Client Id</th>
							<td>
								<FormInput
									id="client-id"
									name="frmsf[client_id]"
									type="text"
									className="widefat"
									onChange={updateClientId}
									value={clientId} />
							</td>
						</tr>
						<tr>
							<th scope="row">Client Secret</th>
							<td>
								<FormInput
									id="client-secret"
									name="frmsf[client_secret]"
									type="text"
									className="widefat"
									onChange={updateClientSecret}
									value={clientSecret} />								
							</td>
						</tr>			
						<tr>
							<td><input type="submit" value="submit"/></td>
						</tr>				
					</tbody>
				</table>
			</form>
		</div>	
	)
}

export default PostBoxForm
