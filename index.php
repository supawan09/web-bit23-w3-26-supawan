<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Orders</title>
    <!-- นำเข้า Font Google เพื่อความโมเดิร์น -->
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        /* ตั้งค่าพื้นหลังไล่สีฟ้าไปชมพู */
        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 30%, #fbc2eb 70%, #e6aefc 100%);
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            box-sizing: border-box;
        }

        /* ตกแต่งตารางให้เป็นกระจกฝ้า (Glassmorphism) */
        .glass-table {
            width: 100%;
            max-width: 1200px;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            overflow: hidden;
        }

        /* หัวตาราง */
        .glass-table th {
            background: rgba(255, 255, 255, 0.35);
            color: #334155;
            font-weight: 600;
            padding: 16px;
            text-align: left;
            font-size: 16px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
        }

        /* เนื้อหาตาราง */
        .glass-table td {
            padding: 16px;
            color: #1e293b;
            font-size: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* เอฟเฟกต์สะท้อนแสงเมื่อเอาเมาส์ไปชี้แถว (Hover) */
        .glass-table tr:hover td {
            background: rgba(255, 255, 255, 0.2);
            transition: background 0.3s ease;
        }

        /* จัดแต่งรูปภาพในตารางให้ดูนุ่มนวล */
        .order-img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: transform 0.3s ease;
        }

        /* ขยายรูปภาพเล็กน้อยเมื่อชี้เมาส์ */
        .order-img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    
    <?php
        include "action/connect.php";
        $sql = "SELECT * FROM orders";
        $result = mysqli_query($con, $sql);
    ?>

    <!-- เอา border=1 ออก แล้วใส่ class กระจกเข้าไปแทน -->
    <table class="glass-table">
        <thead>
            <tr>
                <th>รหัสรายการ</th>
                <th>ชื่อผู้เข้าพัก</th>
                <th>ชำระเงิน</th>
                <th>ประเภท</th>
                <th>ห้อง</th>
                <th>ภาพ</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($result as $order){
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($order["order_id"]) ?></td>
                        <td><?= htmlspecialchars($order["name"]) ?></td>
                        <td><?= htmlspecialchars($order["payment"]) ?></td>
                        <td><?= htmlspecialchars($order["usage_type"]) ?></td>
                        <td><?= htmlspecialchars($order["room_id"]) ?></td>
                        <td>
                            <img 
                                src="<?= htmlspecialchars($order["image"]) ?>"
                                class="order-img"
                            >
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>

</body>
</html>