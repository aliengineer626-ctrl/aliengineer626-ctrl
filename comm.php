<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>اتصل بنا - متجر الإلكترونيات</title>
  <link rel="stylesheet" href="backcss.css">
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "lya150434@gmail.com"; 
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $subject = "رسالة جديدة من موقعك";
    $body = "الاسم: $name\nالبريد الإلكتروني: $email\n\nالرسالة:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "تم إرسال رسالتك بنجاح. شكراً لتواصلك معنا.";
    } else {
        echo "حدث خطأ أثناء إرسال الرسالة. الرجاء المحاولة لاحقاً.";
    }
}
?>
<body>
  <div class="background-overlay"></div>

  <header>
    <h1>اتصل بنا</h1>
  </header>

  <main>
    <section class="contact-form">
      <h2>نحن هنا لخدمتك</h2>
      <h4>  <a href="whats.php">اتصل بنا وتس</a>
      </h4>
    <a action="comm.php" method="post">
        <label for="name">الاسم الكامل:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">البريد الإلكتروني:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">رسالتك:</label>
        <textarea id="message" name="message" rows="6" required></textarea>

        <button type="submit">إرسال</button>
        
      </form>
    </section>
  </main>

  <footer>
    <p>جميع الحقوق محفوظة &copy; متجر الإلكترونيات 2025</p>
  </footer>
</body>
</html>
