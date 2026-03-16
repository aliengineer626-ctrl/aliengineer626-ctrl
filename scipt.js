-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- المزود: localhost
-- أنشئ في: 12 أبريل 2025 الساعة 04:13
-- إصدارة المزود: 5.1.36
--  PHP إصدارة: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- قاعدة البيانات: `account`
--
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج الدفع</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .pay-btn {
            padding: 12px 30px;
            background-color: #0066ff;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .pay-btn:hover {
            background-color: #004dcc;
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 25px 30px;
            border-radius: 20px;
            width: 380px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            animation: fadeIn 0.4s ease;
            position: relative;
        }

        .modal-content h3 {
            margin-top: 0;
            color: #333;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            color: #555;
            cursor: pointer;
            transition: 0.3s;
        }

        .close:hover {
            color: #000;
        }

        .payment-methods label {
            display: block;
            margin: 12px 0;
            padding: 8px 15px;
            background: #f1f1f1;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.3s ease;
            text-align: right;
        }

        .payment-methods label:hover {
            background: #e0e0e0;
        }

        .payment-fields {
            margin-top: 20px;
            text-align: right;
            display: none;
        }

        .payment-fields input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }

        .confirm-btn {
            padding: 12px 25px;
            background-color: #28a745;
            border: none;
            border-radius: 50px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease;
            margin-top: 15px;
        }

        .confirm-btn:hover {
            background-color: #1e7e34;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<button class="pay-btn" onclick="openModal()">اختيار طريقة الدفع</button>

<div class="modal" id="paymentModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>اختر طريقة الدفع</h3>
        <div class="payment-methods">
            <label><input type="radio" name="payment" value="حوالة"> حوالة مصرفية</label>
            <label><input type="radio" name="payment" value="محفظة"> محفظة الكترونية</label>
            <label><input type="radio" name="payment" value="بطاقة"> بطاقة ائتمان</label>
        </div>

        <div id="dynamicFields" class="payment-fields"></div>

        <button class="confirm-btn" onclick="submitPayment()">تأكيد الدفع</button>
    </div>
</div>

<script>
    const dynamicFields = document.getElementById('dynamicFields');

    document.querySelectorAll('input[name="payment"]').forEach(radio => {
        radio.addEventListener('change', function() {
            switch (this.value) {
                case 'حوالة':
                    dynamicFields.innerHTML = `
                        <label>رقم الحوالة:</label>
                        <input type="text" id="transferNumber" placeholder="ادخل رقم الحوالة">
                    `;
                    break;
                case 'محفظة':
                    dynamicFields.innerHTML = `
                        <label>رقم المحفظة:</label>
                        <input type="text" id="walletNumber" placeholder="ادخل رقم المحفظة">
                        <label>الرمز السري:</label>
                        <input type="password" id="walletPIN" placeholder="ادخل الرمز السري">
                    `;
                    break;
                case 'بطاقة':
                    dynamicFields.innerHTML = `
                        <label>رقم البطاقة:</label>
                        <input type="text" id="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx">
                        <label>تاريخ الانتهاء:</label>
                        <input type="text" id="expiryDate" placeholder="MM/YY">
                        <label>CVV:</label>
                        <input type="password" id="cvv" placeholder="رقم CVV">
                    `;
                    break;
                default:
                    dynamicFields.innerHTML = '';
            }
            dynamicFields.style.display = 'block';
        });
    });

    function openModal() {
        document.getElementById('paymentModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('paymentModal').style.display = 'none';
        dynamicFields.style.display = 'none';
        dynamicFields.innerHTML = '';
    }

    function submitPayment() {
        let selected = document.querySelector('input[name="payment"]:checked');
        if (!selected) {
            alert('من فضلك اختر طريقة الدفع.');
            return;
        }

        let details = '';
        switch (selected.value) {
            case 'حوالة':
                const transfer = document.getElementById('transferNumber').value;
                details = transfer ? `رقم الحوالة: ${transfer}` : 'يرجى إدخال رقم الحوالة!';
                break;
            case 'محفظة':
                const wallet = document.getElementById('walletNumber').value;
                const pin = document.getElementById('walletPIN').value;
                details = (wallet && pin) ? `المحفظة: ${wallet}\nكود سري: ${pin}` : 'يرجى إدخال كل بيانات المحفظة!';
                break;
            case 'بطاقة':
                const card = document.getElementById('cardNumber').value;
                const expiry = document.getElementById('expiryDate').value;
                const cvv = document.getElementById('cvv').value;
                details = (card && expiry && cvv) ? `بطاقة: ${card}\nانتهاء: ${expiry}\nCVV: ${cvv}` : 'يرجى استكمال بيانات البطاقة!';
                break;
        }

        if (details.includes('يرجى')) {
            alert(details);
        } else {
            alert('تم استلام بيانات الدفع:\n' + details);
            closeModal();
        }
    }
</script>

</body>
</html>
-- --------------------------------------------------------

--
-- بنية الجدول `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id_ac` int(4) NOT NULL AUTO_INCREMENT,
  `name_ac` varchar(60) NOT NULL,
  `phone_ac` varchar(14) NOT NULL,
  `adderss_ac` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pasword` varchar(255) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `date_ac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ac`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- إرجاع أو إستيراد بيانات الجدول `account`
--

INSERT INTO `account` (`id_ac`, `name_ac`, `phone_ac`, `adderss_ac`, `email`, `pasword`, `gender`, `date_ac`) VALUES
(1, 'ali', '781619732', 'hamdan', 'ali@gmail.com', '202cb962ac59075b964b07152d234b70', '???', '2025-04-11 22:35:58'),
(2, 'ali', '77288998', 'hamdan', 'abd@gmail.com', ' 202cb962ac59075b964b07152d234b70', '???', '2025-04-11 21:42:52');

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--
CREATE TABLE IF NOT EXISTS `product_customer` (
    `idp` int(4) NOT NULL,
    `product_name_costomer` varchar(60) CHARACTER SET utf8 NOT NULL,
    `price_product` int(6) NOT NULL,
    `type_many` varchar(10) CHARACTER SET utf8 NOT NULL,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  
  --
--
-- إرجاع أو إستيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id_pr`, `name`, `price`, `image`, `ROM`, `RAM`, `propertie`) VALUES
(1, 'Ù‡ÙˆØ§ÙˆÙŠ', '1200.00', 'Realme-12-4G.webp', 264, 16, 'Ù‡ÙˆØ§ÙˆÙŠ'),
(2, 'Ø±Ø¯Ù…ÙŠ', '1500.00', 'Realme-12-4G.webp', 264, 32, 'Ø±Ø¯ÙŠ Ø§ØµÙ„ÙŠ'),
(3, 'LT', '1000.00', 'LT-M20.jpg', 124, 8, 'LT Ù‚ÙˆØ©'),
(4, 'Ø±Ø¯Ù…ÙŠ', '800.00', 'Realme-12-5G-1.webp', 128, 16, 'Ø±Ø¯Ù…ÙŠ Ø§Ù„ÙØ§Ø¦Ù‚'),
(5, 'hp', '800.00', 'hp.jpg', 1, 32, 'Ù…ÙˆØ§ØµÙØ§Øª');

-- --------------------------------------------------------

--
-- بنية الجدول `product_customer`
--

CREATE TABLE IF NOT EXISTS `product_customer` (
  `idp` int(4) NOT NULL,
  `product_name_costomer` varchar(60) CHARACTER SET utf8 NOT NULL,
  `price_product` int(6) NOT NULL,
  `type_many` varchar(10) CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- إرجاع أو إستيراد بيانات الجدول `product_customer`
--

INSERT INTO `product_customer` (`idp`, `product_name_costomer`, `price_product`, `type_many`, `date`) VALUES
(1, 'Ø±Ø¯Ù…ÙŠ', 1500, 'nagd', '2025-04-11 22:43:21'),
(1, 'Ø±Ø¯Ù…ÙŠ', 1500, 'nagd', '2025-04-11 22:43:02'),
(1, 'Ø±Ø¯Ù…ÙŠ', 1500, 'nagd', '2025-04-11 22:44:05');

-- --------------------------------------------------------

--
-- بنية الجدول `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `details` text CHARACTER SET utf8,
  `type` enum('dain','madeen') CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- إرجاع أو إستيراد بيانات الجدول `transactions`
--


-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `usertype` varchar(15) CHARACTER SET utf8 NOT NULL,
  `user` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- إرجاع أو إستيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `uname`, `username`, `password`, `usertype`, `user`) VALUES
(1, 'ali', 'ali', '202cb962ac59075b964b07152d234b70', 'ADMIN', 'ta');
<label for="payment">اختر طريقة الدفع:</label>
<select name="payment" id="payment">
    <option value="cash">نقد</option>
    <option value="credit_card">بطاقة ائتمان</option>
    <option value="paypal">باي بال</option>
</select>
$payment_method = mysqli_real_escape_string($conn, $_POST["payment"]);
$sqla = "INSERT INTO product_customer (type_many, product_name_costomer, price_product, payment_method, idp) 
         VALUES ('nagd', '$product_name', '$price', '$payment_method', '$x')";
