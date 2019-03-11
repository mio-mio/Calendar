<?php

class Calendar{
    private $year;
    private $month;

    public function __construct($y,$m){
        $this->year = $y;
        $this->month = $m;
    }
    public function create_rows(){
        $last_day = date("j", mktime(0,0,0,$this->month+1,0,$this->year));
      
        //  echo $this->year."年".$this->month."月の最終日は".$last_day."日です";

        $rows = array();
        $row = self::init_row();

        for($i=1;$i <= $last_day; $i++){
            //番号で曜日を取得
            $date = Date("w", mktime(0,0,0,$this->month,$i,$this->year));
            $row[$date] = $i;
            //$date==6（土曜日）指定を0(日曜日)に変更
            if($date == 0|| $i == $last_day){
                $rows[]= $row;
                $row = self::init_row();
            }
        }
        return $rows;
    }
    public function get_info(){
        return " month : " . $this->year . "-" . $this->month;
    }

    private static function init_row(){
        $ary = array();
        for( $i = 0; $i <= 6; $i++ ){
            $ary[] = "*";
        }
        return $ary;
    }
}

$year = Date("Y"); //今年
// $month = Date("n"); //今月
$this_month = Date("n"); //今月
$next_month =strval(intval($this_month)+1); //来月
$cal = new Calendar($year, $this_month);
$cal_n = new Calendar($year, $next_month);

echo <<< EOL

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="custom.css" type="text/css">
  <title>PHP Calendar</title>
</head>
<body>
<div class="container">
<h1>
EOL;

echo 'This' . $cal->get_info();


echo <<< EOL
</h1>
<table>


<colgroup span="5"></colgroup>
<colgroup span="1" class="sat"></colgroup>
<colgroup span="1" class="sun"></colgroup>
<tr>
  <th>月</th>
  <th>火</th>
  <th>水</th>
  <th>木</th>
  <th>金</th>
  <th class="sat">土</th>
  <th class="sun">日</th>
</tr>
</div>
EOL;

foreach( $cal->create_rows() as $row ){
    echo "<tr>";
    //$i=1（月曜日）から開始で6（土曜日）までループ、最後に0(日曜日)をecho
    
    for($i=1;$i<=6;$i++){
        echo "<td>".$row[$i]."</td>";
    }
    echo "<td>".$row[0]."</td>";
    
    echo "</tr>";
}

echo <<< EOL
</table>
<div class="space"></div>
<!--来年のカレンダー-->


<h1>
EOL;

echo 'Next' . $cal_n->get_info();


echo <<< EOL
</h1>
<table>


<colgroup span="5"></colgroup>
<colgroup span="1" class="sat"></colgroup>
<colgroup span="1" class="sun"></colgroup>
<tr>
  <th>月</th>
  <th>火</th>
  <th>水</th>
  <th>木</th>
  <th>金</th>
  <th class="sat">土</th>
  <th class="sun">日</th>
</tr>
</div>
EOL;

foreach( $cal_n->create_rows() as $row ){
    echo "<tr>";
    //$i=1（月曜日）から開始で6（土曜日）までループ、最後に0(日曜日)をecho
    
    for($i=1;$i<=6;$i++){
        echo "<td>".$row[$i]."</td>";
    }
    echo "<td>".$row[0]."</td>";
    
    echo "</tr>";
}

echo <<< EOL
</table>

</body>
</html>
EOL;

//祝日の表示
require_once("vendor/autoload.php");

use \Yasumi\Yasumi;


$holidays = Yasumi::create('Japan', $year, 'ja_JP');


print_r($holidays->getHolidayDates());

// Get a list all of the holiday dates
// foreach ($holidays->getHolidayDates() as $date) {
//     echo $date . '<br/>';
// }

?>