<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "area_analysis";

// สร้างการเชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// เพิ่มข้อมูลพื้นที่การวิเคราะห์
if (isset($_POST['add_area'])) {
    $area_name = $_POST['area_name'];
    $creator_name = $_POST['creator_name'];
    $target_area_analysis = $_POST['target_area_analysis'];
    $strengths = $_POST['strengths'];
    $weaknesses = $_POST['weaknesses'];
    $opportunities = $_POST['opportunities'];
    $threats = $_POST['threats'];
    $resources = $_POST['resources'];
    $reporter_id = $_POST['reporter_id'];
    $report_date = $_POST['report_date'];

    $sql = "INSERT INTO areas (area_name, creator_name, target_area_analysis, strengths, weaknesses, opportunities, threats, resources, reporter_id, report_date) 
            VALUES ('$area_name', '$creator_name', '$target_area_analysis', '$strengths', '$weaknesses', '$opportunities', '$threats', '$resources', '$reporter_id', '$report_date')";

    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มข้อมูลพื้นที่การวิเคราะห์สำเร็จ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// เพิ่มข้อมูลผู้รายงาน
if (isset($_POST['add_reporter'])) {
    $reporter_name = $_POST['reporter_name'];
    $contact_info = $_POST['contact_info'];

    $sql = "INSERT INTO reporters (reporter_name, contact_info) VALUES ('$reporter_name', '$contact_info')";

    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มข้อมูลผู้รายงานสำเร็จ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// เพิ่มข้อมูลทรัพยากรในพื้นที่
if (isset($_POST['add_resource'])) {
    $area_id = $_POST['area_id'];
    $resource_type = $_POST['resource_type'];
    $description = $_POST['description'];

    $sql = "INSERT INTO resources (area_id, resource_type, description) VALUES ('$area_id', '$resource_type', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มข้อมูลทรัพยากรสำเร็จ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>การจัดการข้อมูลการวิเคราะห์พื้นที่</title>
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
        input[type="text"], input[type="submit"], textarea, input[type="date"] {
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
        .container {
            display: flex;
            justify-content: space-between;
        }
        .form-container, .table-container {
            width: 48%;
        }
    </style>
</head>
<body>

<h2>รายงานการวิเคราะห์พื้นที่</h2>
<h2>ผู้สร้างเว็บรายงานการวิเคราะห์พื้นที่ นายวิญญู พรมภิภักดิ์ รหัสนักศึกษา 643450084-0</h2>
<div class="container">
    <div class="form-container">
        <form method="POST">
            <label for="area_name">ชื่อพื้นที่:</label>
            <input type="text" id="area_name" name="area_name" required>
            <label for="creator_name">ชื่อผู้สร้าง:</label>
            <input type="text" id="creator_name" name="creator_name" required>
            <label for="target_area_analysis">การวิเคราะห์พื้นที่เป้าหมาย:</label>
            <textarea id="target_area_analysis" name="target_area_analysis" required></textarea>
            <label for="strengths">จุดแข็งของพื้นที่:</label>
            <textarea id="strengths" name="strengths" required></textarea>
            <label for="weaknesses">จุดอ่อนของพื้นที่:</label>
            <textarea id="weaknesses" name="weaknesses" required></textarea>
            <label for="opportunities">โอกาสและความท้าทายในพื้นที่:</label>
            <textarea id="opportunities" name="opportunities" required></textarea>
            <label for="threats">อุปสรรคและปัจจัยคุกคามในพื้นที่:</label>
            <textarea id="threats" name="threats" required></textarea>
            <label for="resources">ทรัพยากรท้องถิ่นที่สำคัญ:</label>
            <textarea id="resources" name="resources" required></textarea>
            <label for="reporter_id">รหัสผู้รายงาน:</label>
            <input type="text" id="reporter_id" name="reporter_id" required>
            <label for="report_date">วันที่:</label>
            <input type="date" id="report_date" name="report_date" required>
            <input type="submit" name="add_area" value="เพิ่มข้อมูล">
        </form>
    </div>

    <div class="table-container">
        <h2>รายการข้อมูลการวิเคราะห์พื้นที่</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>ชื่อพื้นที่</th>
                <th>ชื่อผู้สร้าง</th>
                <th>การวิเคราะห์พื้นที่เป้าหมาย</th>
                <th>จุดแข็ง</th>
                <th>จุดอ่อน</th>
                <th>โอกาส</th>
                <th>อุปสรรค</th>
                <th>ทรัพยากร</th>
                <th>ชื่อผู้รายงาน</th>
                <th>วันที่</th>
            </tr>
            <?php
            $sql = "SELECT a.area_id, a.area_name, a.creator_name, a.target_area_analysis, a.strengths, a.weaknesses, a.opportunities, a.threats, a.resources, r.reporter_name, a.report_date 
                    FROM areas a 
                    JOIN reporters r ON a.reporter_id = r.reporter_id";
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
                echo "<tr><td colspan='11'>ไม่มีข้อมูล</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<h2>เพิ่มข้อมูลผู้รายงาน</h2>
<form method="POST">
    <label for="reporter_name">ชื่อผู้รายงาน:</label>
    <input type="text" id="reporter_name" name="reporter_name" required>
    <label for="contact_info">ข้อมูลติดต่อ:</label>
    <input type="text" id="contact_info" name="contact_info" required>
    <input type="submit" name="add_reporter" value="เพิ่มผู้รายงาน">
</form>

<h2>เพิ่มข้อมูลทรัพยากรในพื้นที่</h2>
<form method="POST">
    <label for="area_id">รหัสพื้นที่:</label>
    <input type="text" id="area_id" name="area_id" required>
    <label for="resource_type">ประเภททรัพยากร:</label>
    <input type="text" id="resource_type" name="resource_type" required>
    <label for="description">รายละเอียด:</label>
    <textarea id="description" name="description" required></textarea>
    <input type="submit" name="add_resource" value="เพิ่มทรัพยากร">
</form>

</body>
</html>

<?php
$conn->close();
?>
