<?php
session_start();
if(!$_SESSION['ali']=='yes'){

    header("Location:back.php");
}

?>

<?php
include("connect.php");

$a=$_GET['as'];
$sql="SELECT * from  products where id_pr=$a";
$s=mysqli_query($con,$sql);
$rows=mysqli_fetch_assoc($s);

$product_price =$rows['price']; 
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>محاكاة الدفع مع التكلفة</title>
  <style>
    body {
      font-family: 'Cairo', sans-serif;
      font-family: Arial, sans-serif;
    background-image:url("logo/img.jpg");

background-size: cover;
   
background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .pay-btn {
      padding: 12px 30px;
      background-color:rgb(25, 32, 42);
      color: white;
      border: none;
      border-radius: 50px;
      font-size: 18px;
      cursor: pointer;
    }

    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
      z-index: 999;
    }

    .modal-content {
      background:  rgba(7,32,54,0.8);;
      padding: 25px 30px;
      border-radius: 20px;
      color: antiquewhite;
      width: 400px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      position: relative;
    }

    .close {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 24px;
      color: #555;
      cursor: pointer;
    }

    .payment-methods label {
      display: block;
      text-align: right;
      margin: 10px 0;
    }

    .fields {
      text-align: right;
      margin-top: 15px;
    }

    .fields input {
      width: 100%;
      padding: 8px;
      margin: 6px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .price-box {
      margin-top: 20px;
      padding: 10px;
      background: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 10px;
      font-size: 16px;
      color: #333;
    }

    .confirm-btn {
      margin-top: 20px;
      padding: 10px 25px;
      background-color:rgb(13, 20, 15);
      border: none;
      border-radius: 50px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>
<body>


<button class="pay-btn" onclick="openModal()">اختيار طريقة الدفع</button>

<div class="modal" id="paymentModal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>اختر طريقة الدفع</h>

    <div class="payment-methods">
      <label><input type="radio" name="payment" value="wallet" onchange="showFields()"> محفظة إلكترونية</label>
      <label><input type="radio" name="payment" value="card" onchange="showFields()"> بطاقة بنكية</label>
      <label><input type="radio" name="payment" value="paypal" onchange="showFields()"> PayPal</label>
    </div>

    <div class="fields" id="fieldsArea">
    </div>

    <div class="price-box">
      المبلغ الإجمالي:$ <strong><?php echo number_format($product_price); ?></strong> 
    </div>

    <button class="confirm-btn" onclick="confirmPayment()">تأكيد الدفع</button>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('paymentModal').style.display = 'flex';
    
  }

  function closeModal() {
    document.getElementById('paymentModal').style.display = 'none';
  }

  function showFields() {
    const selected = document.querySelector('input[name="payment"]:checked').value;
    const fields = document.getElementById('fieldsArea');

    let html = '';

    if (selected === 'wallet') {
      html = `
        <label>رقم الهاتف:</label>
        <input type="text" placeholder="مثلاً: 777xxxxxx">
        <label>الرقم السري للمحفظة:</label>
        <input type="password" placeholder="****">
      `;
    } else if (selected === 'card') {
      html = `
        <label>رقم البطاقة:</label>
        <input type="text" placeholder="xxxx-xxxx-xxxx-xxxx">
        <label>تاريخ الانتهاء:</label>
        <input type="text" placeholder="MM/YY">
        <label>رمز CVV:</label>
        <input type="text" placeholder="123">
      `;
    } else if (selected === 'paypal') {
      html = `
        <label>البريد الإلكتروني لحساب PayPal:</label>
        <input type="email" placeholder="you@example.com">
      `;
    } 

    fields.innerHTML = html;
  }

  function confirmPayment() {
    const selected = document.querySelector('input[name="payment"]:checked');
    if (!selected) {
      alert("الرجاء اختيار طريقة دفع.");
      return;
    }

    alert("تم اختيار طريقة الدفع: " +selected.nextSibling.textContent.trim());
 window.location.href('print.php');
    closeModal();
  }
</script>

</body>
</html>