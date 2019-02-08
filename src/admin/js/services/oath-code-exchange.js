export function getTokens(code, state) {
	const wp = new WPAPI({
		endpoint: state.wpApi.endpoint,
		nonce: state.wpApi.nonce
	});

	return async function(dispatch) {
		let queryParams = '';
		const params = {
			redirect_uri: 'https://www.workshopdigital.test/wp-admin/admin.php?page=frm_salesforce',
			grant_type: 'authorization_code',
			code: code,
			client_id: state.salesForceCredentials.clientId,
			client_secret: state.salesForceCredentials.clientSecret
		}

		Object.keys(params).forEach((key, i, keys) => {
			let paramString = `${queryParams}${key}=${params[key]}`; 
			if(keys.length > i) paramString = paramString + '&';
			queryParams = queryParams + paramString;
		});

		const res = await fetch(`https://login.salesforce.com/services/oauth2/token?${queryParams}`);
		const data = res.json();
	}
}