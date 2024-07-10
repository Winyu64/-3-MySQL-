<!DOCTYPE html>
<html>
<head>
    <title>บันทึกและแสดงข้อมูลพื้นที่การวิเคราะห์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
            padding: 20px;
        }
        h2 {
            color: #333333;
        }
        form {
            width: 50%;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #333333;
        }
        input[type="text"], input[type="submit"], textarea {
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 10px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
include 'db.php';

// เพิ่มข้อมูลพื้นที่การวิเคราะห์
if(isset($_POST['add_area'])) {
    $area_name = $_POST['area_name'];
    $creator_name = $_POST['creator_name'];
    $target_area_analysis = $_POST['target_area_analysis'];
    $strengths = $_POST['strengths'];
    $weaknesses = $_POST['weaknesses'];
    $opportunities = $_POST['opportunities'];
    $threats = $_POST['threats'];
    $resources = $_POST['resources'];
    $reporter_name = $_POST['reporter_name'];
    $report_date = date('Y-m-d');

    $sql = "INSERT INTO areas (area_name, creator_name, target_area_analysis, strengths, weaknesses, opportunities, threats, resources, reporter_name, report_date) 
            VALUES ('$area_name', '$creator_name', '$target_area_analysis', '$strengths', '$weaknesses', '$opportunities', '$threats', '$resources', '$reporter_name', '$report_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// ลบข้อมูลพื้นที่การวิเคราะห์
if(isset($_POST['delete_area'])) {
    $area_id = $_POST['area_id'];

    $sql = "DELETE FROM areas WHERE area_id=$area_id";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>ลบข้อมูลเรียบร้อยแล้ว</h2>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>รายงานการวิเคราะห์พื้นที่</h2>
<h2>ผู้สร้างเว็บรายงานการวิเคราะห์พื้นที่ นายวิญญู พรมภิภักดิ์ รหัสนักศึกษา 643450084-0</h2>
<form method="POST">
    <label for="area_name">ชื่อพื้นที่:</label>
    <input type="text" id="area_name" name="area_name" required><br>
    <label for="creator_name">ชื่อผู้สร้าง:</label>
    <input type="text" id="creator_name" name="creator_name" required><br>
    <label for="target_area_analysis">การวิเคราะห์พื้นที่เป้าหมาย:</label><br>
    <textarea id="target_area_analysis" name="target_area_analysis" rows="4" required></textarea><br>
    <label for="strengths">จุดแข็งของพื้นที่ (พื้นที่มีจุดเด่นและความเข้มแข็งอะไรบ้าง):</label><br>
    <textarea id="strengths" name="strengths" rows="4" required></textarea><br>
    <label for="weaknesses">จุดอ่อนของพื้นที่ (พื้นที่มีปัญหาและความไม่เข้มแข็งอะไรบ้าง):</label><br>
    <textarea id="weaknesses" name="weaknesses" rows="4" required></textarea><br>
    <label for="opportunities">โอกาสและความท้าทายในพื้นที่ (ในพื้นที่คาดว่าจะมีโอกาสที่จะพัฒนาอะไรบ้างเพื่อให้พื้นที่หรือตัวท่านเองมีคุณภาพชีวิตที่ดีขึ้น):</label><br>
    <textarea id="opportunities" name="opportunities" rows="4" required></textarea><br>
    <label for="threats">อุปสรรคและปัจจัยคุกคามในพื้นที่ (มีปัจจัยใดหรืออุปสรรคใดที่ทำให้พื้นที่ไม่สามารถพัฒนาได้):</label><br>
    <textarea id="threats" name="threats" rows="4" required></textarea><br>
    <label for="resources">ทรัพยากรท้องถิ่นที่สำคัญ:</label><br>
    <textarea id="resources" name="resources" rows="4" required></textarea><br>
    <label for="reporter_name">ชื่อผู้รายงาน:</label>
    <input type="text" id="reporter_name" name="reporter_name" required><br>
    <input type="submit" name="add_area" value="บันทึกข้อมูล">
</form>

<h2>ลบข้อมูลพื้นที่การวิเคราะห์</h2>
<form method="POST">
    <label for="area_id">รหัสพื้นที่:</label>
    <input type="text" id="area_id" name="area_id" required><br>
    <input type="submit" name="delete_area" value="ลบข้อมูล">
</form>

<h2>รายการพื้นที่การวิเคราะห์</h2>
<table border="1">
    <tr>
        <th>รหัสพื้นที่ (ID)</th>
        <th>ชื่อพื้นที่</th>
        <th>ผู้สร้าง</th>
        <th>การวิเคราะห์พื้นที่เป้าหมาย</th>
        <th>จุดแข็ง</th>
        <th>จุดอ่อน</th>
        <th>โอกาส</th>
        <th>ความท้าทาย</th>
        <th>ทรัพยากร</th>
        <th>ชื่อผู้รายงาน</th>
        <th>วันที่รายงาน</th>
    </tr>
    <?php
    // เชื่อมต่อฐานข้อมูล
    include 'db.php';

    // สร้างคำสั่ง SQL เพื่อดึงข้อมูล
    $sql = "SELECT area_id, area_name, creator_name, target_area_analysis, strengths, weaknesses, opportunities, threats, resources, reporter_name, report_date FROM areas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["area_id"] . "</td>";
            echo "<td>" . $row["area_name"] . "</td>";
            echo "<td>" . $row["creator_name"] . "</td>";
            echo "<td>" . $row["target_area_analysis"] . "</td>";
            echo "<td>" . $row["strengths"] . "</td>";
            echo "<td>" . $row["weaknesses"] . "</td>";
            echo "<td>" . $row["opportunities"] . "</td>";
            echo "<td>" . $row["threats"] . "</td>";
            echo "<td>" . $row["resources"] . "</td>";
            echo "<td>" . $row["reporter_name"] . "</td>";
            echo "<td>" . $row["report_date"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11'>ไม่พบข้อมูลพื้นที่การวิเคราะห์</td></tr>";
    }
    ?>
</table>

<?php
if (isset($_GET['area_id'])) {
    $area_id = $_GET['area_id'];

    $sql = "SELECT * FROM areas WHERE area_id=$area_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='report'>";
        echo "<h2>รายงานการวิเคราะห์พื้นที่</h2>";
        echo "ผู้สร้างเว็บ: ……….….ชื่อนักศึกษา…………………<br>";
        echo "<b>การวิเคราะห์พื้นที่เป้าหมาย:</b> " . nl2br($row['target_area_analysis']) . "<br>";
        echo "<b>SWOT Analysis</b><br>";
        echo "<b>จุดแข็งของพื้นที่:</b> " . nl2br($row['strengths']) . "<br>";
        echo "<b>จุดอ่อนของพื้นที่:</b> " . nl2br($row['weaknesses']) . "<br>";
        echo "<b>โอกาสและความท้าทายในพื้นที่:</b> " . nl2br($row['opportunities']) . "<br>";
        echo "<b>อุปสรรคและปัจจัยคุกคามในพื้นที่:</b> " . nl2br($row['threats']) . "<br>";
        echo "<b>ทรัพยากรท้องถิ่นที่สำคัญ</b><br>";
        echo "สถานที่ท่องเที่ยวหรือสถานที่สำคัญในพื้นที่: " . nl2br($row['resources']) . "<br>";
        echo "ชื่อผู้รายงาน: " . $row['reporter_name'] . "<br>";
        echo "วันที่: " . $row['report_date'] . "<br>";
        echo "</div>";
    } else {
        echo "<p>ไม่พบข้อมูลที่เลือก</p>";
    }
}
$conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
?>

</body>
</html>