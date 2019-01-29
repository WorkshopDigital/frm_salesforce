import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { document } from 'global';

class Hello extends React.Component {
  render() {
    return <div>Hello {this.props.toWhat}</div>;
  }
}

ReactDOM.render(
  <Hello toWhat="World" />,
  document.getElementById('root')
);