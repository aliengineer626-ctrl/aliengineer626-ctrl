 <!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            background: url('background.jpg') no-repeat center center/cover;
            font-family: Arial, sans-serif;
            position: relative;
        }
        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5); 
            z-index: -1;
        }
        .container {
            padding: 20px;
            border: 2px solid #333;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .button-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .button {
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: 0.3s;
        }
        .admin {
            background-color: #ff5733;
            color: white;
        }
        .admin:hover {
            background-color: #e74c3c;
        }
        .public {
            background-color: #ffd700;
            color: black;
            font-weight: bold;
        }
        .public:hover {
            background-color: #e6c200;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>مرحباً بك! اختر وجهتك:</h2>
        <div class="button-container">
        <a href="indexx.php?usertype=tt">
<button class="btn-17">
  <span >
    <span > تسوق</span>
  </span>
</button></a>

            <button class="button admin" onclick="window.location.href='print.php'">صفحة المشرف</button>
            <button class="button public" onclick="window.location.href='accu.php'">الصفحة العامة</button>
        </div>
    </div>
</body>
</html> -->
