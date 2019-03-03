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
        return $this->year . "-" . $this->month;
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
$month = Date("n"); //今月
$cal = new Calendar($year, $month);

// $next_month = Date("++n"); //来月？
// var_dump($next_month);


echo <<< EOL

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP Calendar</title>
    <style>
    h1 {
        font-size:18px;
        margin: 0;
        background-color: #FFFFCC;
    }
    th {
    background-color: #C0C0C0;
    font-size: 13px;
    text-align: center;
    }
    .sat {
    background-color: #99CCFF;
    font-weight: bold;
    }
    .sun {
    background-color: #FF99CC;
    }

    input[type="text"] {
    width: 35px;
    }
  </style>
</head>
<body>

<h1>
EOL;

echo "今月: ". $cal->get_info();


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

</body>
</html>
EOL;

?>