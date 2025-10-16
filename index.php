<?php
// YOUR reCAPTCHA KEYS - REPLACE THESE!
$site_key = "6Lf8ZewrAAAAAO5sWOwxkXW7_Dp3tLm0auSyj_W9";
$secret_key = "6Lf8ZewrAAAAANiJAos8XLq_oOWFsY-CqfCRyONN";

$show_form = true;
$message = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify reCAPTCHA
    $recaptcha_response = $_POST['g-recaptcha-response'];
    
    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $secret_key,
        'response' => $recaptcha_response
    ];
    
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    
    $context = stream_context_create($options);
    $result = file_get_contents($verify_url, false, $context);
    $result_json = json_decode($result, true);
    
    // Check if reCAPTCHA was successful
    if ($result_json['success']) {
        // reCAPTCHA PASSED - Process your form here
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        // Do whatever you want with the form data
        // Send email, save to database, etc.
        
        $message = "<div style='color: green;'>Success! Form submitted. (Hello, $name!)</div>";
        $show_form = false; // Hide form after success
    } else {
        // reCAPTCHA FAILED
        $message = "<div style='color: red;'>Please complete the reCAPTCHA!</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple reCAPTCHA Form</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <h2>Contact Form</h2>
    
    <?php echo $message; ?>
    
    <?php if ($show_form): ?>
    <form method="POST" action="">
        <p>
            <label>Name:</label><br>
            <input type="text" name="name" required>
        </p>
        
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </p>
        
        <!-- reCAPTCHA Widget -->
        <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
        <br>
        
        <input type="submit" value="Submit">
    </form>
    <?php endif; ?>
</body>
</html>