import { stringify, parse } from 'query-string'
import UUID from './uuid-generator'



function prepareOptions(options){
  const width  = options.width || 500;
  const height = options.height || 500;

  return Object.assign({},{
    left: ((screen.width / 2) - (width / 2)),
    top: ((screen.height / 2) - (height / 2)),
    width: width,
    height: height
  }, options);
}

function stringifyOptions(options){
  var optionsStrings = [];
  for (var key in options) {
    if (options.hasOwnProperty(key)) {
      var value;
      switch (options[key]) {
        case true:
          value = '1';
          break;
        case false:
          value = '0';
          break;
        default:
          value = options[key];
      }
      optionsStrings.push(
        key+"="+value
      );
    }
  }
  return optionsStrings.join(',');
}


export default class Modal {

  pendingRequestKey = null;

  authParams = null;

  options = null;

  queryParams = null;

  remote = null;

  url = 'https://login.salesforce.com/services/oauth2/authorize?';

  onStorage(storageEvent) {
    if(this.pendingRequestKey === storageEvent.key) {
      let params = storageEvent.newValue.split('?');
      this.authParams = parse(params[1]);
    }
    debugger;

  }

  openRemote() {
    const url = this.url + stringify(this.queryParams);
    window.localStorage.setItem('__frmsalesforce_request', this.pendingRequestKey);	
    window.addEventListener('storage', this.onStorage.bind(this));
    this.remote = window.open(url, this.pendingRequestKey, stringifyOptions(this.options));        
  }



  constructor(state, options = {}) {
    this.pendingRequestKey = 'frmsf-popup:' + UUID();
    this.options = prepareOptions(options);
    this.queryParams = {
      'client_id': state.salesForceCredentials.clientId,
      'response_type': 'code',
      'redirect_uri': state.wpApi.redirectUrl,
      'display': 'touch',
      'state': state.salesForceCredentials.stateNonce
    };
  }
}