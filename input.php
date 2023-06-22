<?php
// 接收 POST 資料
$data = $_POST['data'];
//$data = json_decode($jsonData, true);

// 按日期降序排列
usort($data, function ($a, $b) 
{
    $dateA = strtotime($a['date']);
    $dateB = strtotime($b['date']);
    return $dateB <=> $dateA;
}
);

$handle = fopen('data.csv', 'w');
fputcsv($handle, array('date', 'money', 'remark'));

foreach ($data as $item) 
{
    fputcsv($handle, array($item['date'], $item['money'], $item['remark']));
}

fclose($handle);
echo "儲存完成";
?>
