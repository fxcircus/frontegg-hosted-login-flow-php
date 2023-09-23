const express = require('express');
const axios = require('axios');
const crypto = require('crypto');
const { exec } = require('child_process');

const app = express();
const port = 3000;

// Replace these values with your Frontegg configuration
const clientId = 'YOUR_CLIENT_ID';
const redirectUri = `http://localhost:${port}/callback`;
const gateway = 'YOUR_GATEWAY';

// Store codeVerifier globally for later use in token exchange
let codeVerifier;

// Step 1: Generate a random code verifier
function createRandomString(length = 16) {
  let text = '';
  const possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

  for (let i = 0; i < length; i++) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }

  return text;
}

// Step 2: Generate code_challenge
function generateCodeChallenge(codeVerifier) {
  const codeChallenge = crypto
    .createHash('sha256')
    .update(codeVerifier)
    .digest('base64')
    .replace(/=/g, '')
    .replace(/\+/g, '-')
    .replace(/\//g, '_');
  return codeChallenge;
}

// Step 2: Request Auth Code
app.get('/login', (req, res) => {
  codeVerifier = createRandomString();
  const codeChallenge = generateCodeChallenge(codeVerifier);

  // Construct the authorization URL
  const authUrl = `${gateway}.frontegg.com/oauth/authorize?` +
    `response_type=code` +
    `&scope=openId` +
    `&client_id=${clientId}` +
    `&redirect_uri=${redirectUri}` +
    `&code_challenge=${codeChallenge}`;

  // Redirect the user to the authorization URL
  res.redirect(authUrl);
});

// Step 3: Handle the callback and exchange tokens
app.get('/callback', async (req, res) => {
  const authorizationCode = req.query.code;

  // Step 3: Exchange tokens
  const tokenEndpoint = `${gateway}.frontegg.com/oauth/token`;

  const requestBody = {
    grant_type: 'authorization_code',
    code: authorizationCode,
    redirect_uri: redirectUri,
    code_verifier: codeVerifier,
  };

  // Base64 encode the client ID and API Key for the Authorization header
  const authHeader = `Basic ${Buffer.from(`${clientId}:YOUR_API_KEY`).toString('base64')}`;

  try {
    const response = await axios.post(tokenEndpoint, requestBody, {
      headers: {
        Authorization: authHeader,
      },
    });

    console.log('Token exchange successful');
    console.log('ID Token:', response.data.id_token);
    console.log('Access Token:', response.data.access_token);
    res.send('Token exchange successful. You can now close this window.');
  } catch (error) {
    console.error('Token exchange failed:', error.message);
    res.send('Token exchange failed. Please try again.');
  }
});

// Start the local server
app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
  
  // Automatically open the login page in the default web browser
  exec(`open http://localhost:${port}/login`);
});
