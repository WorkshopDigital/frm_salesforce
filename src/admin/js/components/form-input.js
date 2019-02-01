import React from 'react';

const FormInput = ({ id, name, type, className, onChange, value }) => (
	<input
	  id={id}
	  name={name}
	  type={type}
	  className={className}
	  onChange={onChange}
	  value={value}
	/>		
)

export default FormInput;