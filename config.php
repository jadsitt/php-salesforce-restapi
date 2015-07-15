<?php
define("CLIENT_ID", "Your Salesforce CLIENT ID");
define("CLIENT_SECRET", "Your Salesforce Client Secret");
define("REDIRECT_URI", "This is not really needed with autologin using a hardcoded user. If you rely on the salesforce login screen this is the URL specified as callback for the application you creaated in salesforce");
define("LOGIN_URI", "https://login.salesforce.com");
define("SF_USER", "The user you are using in autologin");
define("SF_PWD", "The password");
define("SECURITY_TOKEN", "The salesforce generated security token for the user/password");
?>