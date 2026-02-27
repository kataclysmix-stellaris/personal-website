/* DEVLOG
* Created on Thursday, October 9, 2025, 1:58:09 PM
* Last Modified on Tuesday, October 14, 2025, 10:43:25 AM
*/
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $message = htmlspecialchars($_POST['message']);

  $to = "your-email@example.com";
  $subject = "New message from contact form";
  $headers = "From: " . $email . "\r\n" .
             "Reply-To: " . $email . "\r\n" .
             "Content-Type: text/plain; charset=utf-8";

  $body = "From: $name\nEmail: $email\nMessage:\n$message";

  if (preg_match("/[\r\n]/", $email)) {
    die("Invalid email address.");
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
  }
  if (mail($to, $subject, $body, $headers)) {
    header("Location: Thanks.html");
    exit;
  }
  else {
    echo "Message sending failed. Try again later.";
  }
}
?>