<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Google (Firebase)</title>
    <!-- Firebase SDK -->
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <script>
        // Firebase configuration
        const firebaseConfig = {
            "apiKey": "AIzaSyC_FRZU1Fhb-u8pteocdSvGGxoH5hHE3rU",
            "authDomain": "phuongtext-22955.firebaseapp.com",
            "projectId": "phuongtext-22955",
            "storageBucket": "phuongtext-22955.firebasestorage.app",
            "messagingSenderId": "432413458069",
            "appId": "1:432413458069:web:d5464c7f1b93bb82f9a59c",
            "measurementId": "G-FQLH0N6PCZ"
        };

        // Initialize Firebase
        const app = firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();

        // Google Sign-In
        function onSignIn(googleUser) {
            // Get the Google ID token
            const id_token = googleUser.getAuthResponse().id_token;

            // Use Firebase to sign in with the ID token
            const credential = firebase.auth.GoogleAuthProvider.credential(id_token);

            // Sign in with Firebase
            auth.signInWithCredential(credential)
                .then((userCredential) => {
                    const user = userCredential.user;
                    console.log('User signed in:', user);

                    // Send the ID token to the server for verification
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'verify_token.php'); // PHP script URL to handle token
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        console.log('Signed in as: ' + xhr.responseText);
                        // Redirect or handle response here
                        // window.location.href = 'dashboard.php'; // Example of redirection
                    };
                    xhr.send('idToken=' + id_token);
                })
                .catch((error) => {
                    console.error('Error during sign in:', error.message);
                });
        }

        // Firebase initialization and loading
        window.onload = function() {
            gapi.load('auth2', function() {
                gapi.auth2.init({
                    client_id: 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com' // Replace with your actual Google client ID
                });
            });
        };
    </script>
</head>

<body>
    <h2>Login with Google (Firebase)</h2>

    <!-- Google Sign-In Button -->
    <div class="g-signin2" data-onsuccess="onSignIn"></div>

    <div>
        <a href="./register.php">Đăng ký | </a>
        <a href="./login.php">Đăng nhập</a>
    </div>
</body>

</html>