import React from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux'
import initStore from './redux/store'
import App from './components/app'

const root  = document.getElementById('post-body-content')
const store = initStore(root.dataset);

render(
  <Provider store={store}>
    <App />
  </Provider>,
  root
);