hALLO
<?php
error_reporting(E_ALL);
$pdo = new PDO('sqlite:dataBase.db');

$action = $_GET["action"];
if($action == "themen"){
    echo "test";
    $erg = $pdo->query("SELECT * FROM Topics")->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($erg);
    
}

function getKey($table,$keyName,$key){
    return $pdo->query("SELECT * FROM "+$table+" WHERE "+$keyName+" ='"+$key+"' ")->fetchAll(PDO::FETCH_ASSOC);
}

if($action == "getForTopic"){
    $para = $_GET("topicID");
    $argumentL = getKey("Argument","topicID",$para);
    foreach($argumentL as $argumentRow){
        $argumentRow["reason"] = array()
        $reasonL = getKey("Reason","argumentID",$argumentRow["ID"]);
        foreach($reasonL as $reasonRow){
            
            $exampleL = getKey("Example","reasonID",reasonRow["ID"]);
            $reasonRow["example"] = exampleL;
            $argumentRow["reason"][] = $reasonRow;2
        }
        
    }
    
    
}

func

echo "<br>";


echo "HAllo!";


$erg = $pdo->query("SELECT * FROM Argument");
foreach($erg as $row){
    echo $row['ID'];
}
echo "s";
?>