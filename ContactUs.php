<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="ContactUs.css">
    <!-- You can link your external CSS file here -->
</head>

<body>
    <!-- Header -->
    <header class="header">
        <a href="Personal.php" class="logo">Personal Space.</a>
        <div class="navigation">
            <input type="checkbox" class="toggle-menu">
            <div class="hamburger"></div>
            <ul class="menu">
                <li><a href="Personal.php">Home</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="Skills.php" class="active">Skills</a></li>
                <li><a href="ContactUs.php">Contact</a></li>
            </ul>
        </div>
    </header>

    <div class="contact-container">
        <form action="https://api.web3forms.com/submit" method="POST" class="contact-left">
            <div class="contact-left-title">
                <h2>Contact Me!</h2>
                <hr>
            </div>
            <input type="hidden" name="access_key" value="2c4725c5-4bf4-4cf6-90f4-8bd37073aad9">
            <input type="text" name="name" placeholder="Your Name" class="contact-inputs" required>
            <input type="text" name="email" placeholder="Your Email" class="contact-inputs" required>
            <textarea name="message" placeholder="Your Message" class="contact-inputs" required></textarea>
            <button type="submit">Submit <img src="arrow_icon.png" alt=""></button>
        </form>
    </div>
</body>
</html>
