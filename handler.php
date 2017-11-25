
<?php
$pdo = new PDO('sqlite:dataBase.db');

$action = $_GET["action"];
header('Content-Type: application/json');

function getKey($table,$keyName,$key){
    $pdo = new PDO('sqlite:dataBase.db');
    $str = "SELECT * FROM ".$table." WHERE ".$keyName." ='".$key."' ";
    return $pdo->query($str)->fetchAll(PDO::FETCH_ASSOC);
}

if($action == "topic"){

    $erg = $pdo->query("SELECT * FROM Topics")->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($erg);
    
}



if($action == "getForTopic"){
    
    $para = $_GET["topicID"];
    
    $argumentL = getKey("Argument","topicID",$para);

    for($i = 0;$i<count($argumentL);$i = $i+1){
        $argumentRow = $argumentL[$i];
        
        $reasonL = getKey("Reason","argumentID",$argumentRow["ID"]);
        $argumentL[$i]["reason"] =$reasonL;
        for($l = 0;$l<count($reasonL);$l = $l+1){

            $reasonRow = $reasonL[$l];
            $exampleL = getKey("Example","reasonID",$reasonRow["ID"]);
           $argumentL[$i]["reason"][$l]["example"] = $exampleL;
             
        }
        
    }

    echo json_encode($argumentL);
    
    
}







?>