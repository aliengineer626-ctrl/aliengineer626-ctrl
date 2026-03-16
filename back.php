<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>متجر الإلكترونيات</title>
  <link rel="stylesheet" href="backcss.css">
</head>
<script>
  function toggleMenu() {
    const menu = document.getElementById("dropdownMenu");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
  }
  window.addEventListener('click', function(e) {
    const button = document.querySelector('.menu-button');
    const menu = document.getElementById("dropdownMenu");
    if (!button.contains(e.target) && !menu.contains(e.target)) {
      menu.style.display = "none";
    }
  });
</script>
<body>
  <div class="background-overlay"></div>

  <header>
    <h1>متجر الإلكترونيات الحديث</h1>
    <nav>
     <div class="menu-container">
  <button class="menu-button" onclick="toggleMenu()">☰ القائمة</button>
  <ul class="dropdown-menu" id="dropdownMenu">
    <li><a href="main1.php">Sign Up</a></li>
    <li><a href="login1.php">Login</a></li>
    <li><a href="indexx.php?usertype=ADMIN">Admin</a></li>
    <li><a href="comm.php">اتصل بنا</a></li>
  </ul>
</div>
    </nav>
  </header>

  <main>
    <section class="welcome">
      <h2>مرحباً بك في عالم التقنية</h2>
      <p>
        نحن متجر متخصص في بيع أحدث الأجهزة الإلكترونية والتقنية الحديثة، من هواتف ذكية، حواسيب، شاشات، ملحقات، والمزيد.
        نقدم منتجات عالية الجودة بأسعار تنافسية، مع شحن سريع وخدمة عملاء ممتازة.
      </p>
      <p>
        تصفح مجموعتنا من الإلكترونيات المميزة واغتنم أفضل العروض اليوم!
      </p>
    </section>
  </main>

  <footer>
    <p>جميع الحقوق محفوظة &copy; متجر الإلكترونيات 2025</p>
  </footer>
</body>
</html>