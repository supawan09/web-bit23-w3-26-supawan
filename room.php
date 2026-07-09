<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management</title>
    <!-- นำเข้า Google Font เพื่อความโมเดิร์น อ่านง่าย -->
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        /* จัดการพื้นหลังไล่สีฟ้า Ocean Light แบบหน้าแรก */
        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 40%, #7dd3fc 100%);
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            box-sizing: border-box;
        }

        /* กล่องคอนเทนเนอร์กรอบลูกแก้ว */
        .glass-container {
            width: 100%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 12px 40px 0 rgba(15, 23, 42, 0.08);
            padding: 24px;
            box-sizing: border-box;
            margin-bottom: 24px;
        }

        /* ตกแต่งโครงสร้างตาราง */
        .glass-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px; /* เว้นระยะห่างระว่างแถวให้ดูมีมิติ */
        }

        /* หัวตาราง */
        .glass-table th {
            color: #0369a1;
            font-weight: 600;
            padding: 16px;
            text-align: left;
            font-size: 15px;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        }

        /* เนื้อหาในแต่ละช่อง */
        .glass-table td {
            padding: 16px;
            color: #0f172a;
            font-size: 15px;
            background: rgba(255, 255, 255, 0.25);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        /* ทำมุมโค้งมนให้ตัวเนื้อหาตารางแยกรายแถว */
        .glass-table tr td:first-child {
            border-left: 1px solid rgba(255, 255, 255, 0.3);
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }
        .glass-table tr td:last-child {
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* เอฟเฟกต์สะท้อนแสงกระจกเงาเมื่อไฮไลท์เมาส์ */
        .glass-table tr:hover td {
            background: rgba(255, 255, 255, 0.45);
            transform: scale(1.005);
            box-shadow: 0 4px 12px rgba(3, 105, 161, 0.05);
        }

        /* ตกแต่งปุ่มลิงก์ ย้อนกลับไปหน้า Index */
        .btn-link {
            display: inline-flex;
            align-items: center;
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 600;
            color: #0369a1;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(3, 105, 161, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ปุ่มลอยขึ้นเมื่อชี้เมาส์ */
        .btn-link:hover {
            color: #0284c7;
            background: rgba(255, 255, 255, 0.6);
            border-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(3, 105, 161, 0.15);
        }
    </style>
</head>
<body>
    
    <?php
        include "action/connect.php";
        // ดึงข้อมูลทั้งหมดจากตาราง rooms
        $sql = "SELECT * FROM rooms";
        $result = mysqli_query($con, $sql);
    ?>

    <!-- บรรจุตารางห้องพักในกรอบแก้วลูกแก้วใส -->
    <div class="glass-container">
        <table class="glass-table">
            <thead>
                <tr>
                    <th>รหัสรายการ</th>
                    <th>สูบบุหรี่</th>
                    <th>อ่างอาบน้ำ</th>
                    <th>ราคา</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($result as $room){
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($room["room_id"]) ?></td>
                            <td><?= htmlspecialchars($room["smoke"]) ?></td>
                            <td><?= htmlspecialchars($room["bathtub"]) ?></td>
                            <td><?= number_format($room["price"], 2) ?> บาท</td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- ปุ่มลิงก์ขยับไปด้านซ้ายให้ขนานกับขอบคอนเทนเนอร์ -->
    <div style="width: 100%; max-width: 1200px; display: flex; justify-content: flex-start; padding-left: 24px;">
        <a href="index.php" class="btn-link">⬅️ กลับไปที่หน้าหลัก</a>
    </div>
</body>
</html>