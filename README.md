# Frontegg Hosted Login Flow

Implementation example of the [Frontegg Hosted Login Flow](https://developers.frontegg.com/guides/management/frontegg-idp/native-hosted)


## How to run

- Clone this repo `git clone https://github.com/fxcircus/frontegg-hosted-login-flow.git`
- Add the values with your Frontegg account configuration ➜
  ```
  const clientId = 'YOUR_CLIENT_ID'; // 'Client ID' from 'Frontegg Portal ➜ [ENVIRONMENT] ➜ Keys & domains', OR the application ID of the application you're loggign in to
  const redirectUri = `http://localhost:${port}/callback`;
  const gateway = 'YOUR_GATEWAY'; // 'Domain name' from 'Frontegg Portal ➜ [ENVIRONMENT] ➜ Keys & domains ➜ Domains tab'. i.e 'https://app-frtqiefxjqn1'
  ```

- Install the dependencies `npm init -y && npm install`
- Start the server `node hosted_login_flow.js`
- Open the browser, navigate to `http://localhost:3000` and login!
