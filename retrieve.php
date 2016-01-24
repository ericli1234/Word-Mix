<?php
include 'config.php';
$sql = "SELECT * FROM leaderboard";
$result = $conn->query($sql);
$res = "";
$res = $res . "[";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if (!empty($row)) {
            $res = $res . json_encode($row) . ",";
        }
    }
    $res = rtrim($res, ",");
}
$res = $res . "]";
echo $res;
$conn->close();
?>
