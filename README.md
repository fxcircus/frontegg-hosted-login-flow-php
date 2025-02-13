# Frontegg Hosted Login Flow

This repository demonstrates the [Frontegg Hosted Login Flow](https://developers.frontegg.com/guides/management/frontegg-idp/native-hosted).


## How to run

- Clone this repo
```
git clone https://github.com/fxcircus/frontegg-hosted-login-flow.git
```
- Open the project, navigate to `hosted_login_flow.js` and update the following values with your Frontegg account details:
```
const clientId = 'YOUR_CLIENT_ID'; 
// Find this in Frontegg Portal ➜ [ENVIRONMENT] ➜ Keys & Domains ➜ 'Client ID' 
// Alternatively, use the Application ID for the app you're logging into.

const redirectUri = `http://localhost:${port}/callback`; 
// Use the callback URL for your local environment.

const gateway = 'YOUR_GATEWAY'; 
// Find this in Frontegg Portal ➜ [ENVIRONMENT] ➜ Keys & Domains ➜ Domains tab 
// Example: 'https://app-frtqiefxjqn1'
  ```

- Open the terminal, Install the dependencies
```
npm init -y && npm install
```
- Run the server with
```
node hosted_login_flow.js
```
- Open the browser, navigate to `http://localhost:3000/login`. You should see the login page. Enter your credentials and log in!
- The logs will be printed in the terminal window
