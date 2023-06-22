<?php
// 讀取 CSV 檔案
$csvFile = 'data.csv';

if (($handle = fopen($csvFile, 'r')) !== false) 
{
    $data = array();

    $isTitle = true;
    while (($row = fgetcsv($handle, 1000, ',')) !== false) 
    {
        if(!$isTitle){
            $date = isset($row[0]) ? $row[0] : '';
            $money = isset($row[1]) ? $row[1] : '';
            $remark = isset($row[2]) ? $row[2] : '';

            // 建立 JSON 物件
            $jsonObject = array("date" => $date,"money" => $money,"remark" => $remark);

            $data[] = $jsonObject;
        }
        else{
            $isTitle = false;
        }

        
    }

    fclose($handle);

    // 按日期降序排列
    usort($data, function ($a, $b) 
    {
        $dateA = strtotime($a['date']);
        $dateB = strtotime($b['date']);
        return $dateB <=> $dateA;
    });

    // 將資料包裝為 item 屬性的 JSON 物件
    $jsonData = json_encode(array("item" => $data), JSON_UNESCAPED_UNICODE);

    // 輸出 JSON 資料
    echo $jsonData;
} else {
    echo "無法開啟 CSV 檔案。";
}
?>
