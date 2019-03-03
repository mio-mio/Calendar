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
            $date = Date("w", mktime(0,0,0,$this->month,$i,$this->year));
            $row[$date] = $i;

            if($date == 6|| $i == $last_day){
                $rows []= $row;
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
    }
    th {
    background-color: red;
    font-size: 13px;
    text-align: center;
    }
    th {
    background-color: #C0C0C0;
    font-size: 13px;
    text-align: center;
    }
    .sat {
    background-color: #99CCFF;
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

echo $cal->get_info();


echo <<< EOL
</h1>
<table>

<colgroup span="1" class="sun"></colgroup>
<colgroup span="5" class="weekdays"></colgroup>
<colgroup span="1" class="sat"></colgroup>
<tr>
<th class="sun">日</th>
  <th>月</th>
  <th>火</th>
  <th>水</th>
  <th>木</th>
  <th>金</th>
  <th class="sat">土</th>
  <!--   <th class="sun">日</th> -->
</tr>

EOL;

foreach( $cal->create_rows() as $row ){
    echo "<tr>";

    // for($i=1;$i<=6;$i++){
    for($i=0;$i<=6;$i++){
        echo "<td>".$row[$i]."</td>";
    }


    // if 土曜日であれば、青くする


    // $first = $row[0];
    // echo "<td>".$first."</td>";
    // if 日曜日の最初が＊であれば、それを消して表示　else そのまま
    // if( === "*"){

    // }else{
        // echo "<td>".$row[0]."</td>";
    // }
    
    
    echo "</tr>";
}

echo <<< EOL
</table>

</body>
</html>
EOL;

?>