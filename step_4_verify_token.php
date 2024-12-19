<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('./fisebase.json');
$firebase = (new Factory)->withServiceAccount($serviceAccount)->createAuth();

// Get the ID Token from the client (assumed to be passed via POST or GET)
$idTokenString = $_POST['idToken'];  // or from GET: $_GET['idToken']

try {
    // Verify the ID token and get the Firebase user
    $verifiedIdToken = $firebase->verifyIdToken($idTokenString);
    $uid = $verifiedIdToken->getClaim('sub'); // Get the user ID (uid)

    // Get user data
    $user = $firebase->getUser($uid);
    echo "User ID: " . $user->uid . "\n";
    echo "User Email: " . $user->email . "\n";
    echo "User Name: " . $user->displayName . "\n";
} catch (\Kreait\Firebase\Exception\Auth\FailedToVerifyToken $e) {
    echo 'The token is invalid: ' . $e->getMessage();
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
