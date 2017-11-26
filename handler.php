
<?php
$pdo = new PDO('sqlite:dataBase.db');

$action = $_GET["action"];
header('Content-Type: application/json');

function getKey($table,$keyName,$key){
    $pdo = new PDO('sqlite:dataBase.db');
    $str = "SELECT * FROM ".$table." WHERE ".$keyName." ='".$key."' ";
    return $pdo->query($str)->fetchAll(PDO::FETCH_ASSOC);
}
function makeRequest($string){
    global $pdo;
    //echo $string;
    return $pdo->query($string);
    
}
function responsSucsess(){
    echo json_encode(true);
}

if($action == "topic"){

    $erg = $pdo->query("SELECT * FROM Topic")->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($erg);
    
}



if($action == "getForTopic"){
    
    $para = $_GET["par1"];
    
    $topic = makeRequest("SELECT * FROM Topic WHERE ID='".$para."'")->fetchAll(PDO::FETCH_ASSOC);
    $topic = $topic[0];
    
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
    $topic["Argument"] = $argumentL;

    echo json_encode($topic);
    
    

}

//add---------------------------------
function addRow($table,$name1,$name2,$par1,$par2){
    /*try{
    global $pdo;
    $str = "INSERT INTO ".$table." (".$name1.",".$name2.")
VALUES (:par1,:par2)";
    
    $prep = $pdo ->prepare($str);
    $prep->bindParam(":par1",$par1);
    $prep->bindParam(":par2",$par2);
    
    /*$parameter1 = $par1;
    $parameter2 = $par2;
    
    $pdo->beginTransaction();
    $prep->execute();
    $pdo->commit();
    $prep->closeCursor();
    
    }catch(Exception $e){
        echo $e->getMessage();
        
    }*/
    
/*     $str = "INSERT INTO ".$table." (".$name1.",".$name2.")
VALUES ('".$par1."','".$par2."')";
    echo makeRequest($str);*/
    //echo makeRequest("INSERT INTO Topic (name,question) VALUES ('hauptThema','Sehrhehrehwaegfsicher')");
    
    //echo $value;
    /*echo $str;
    $prep = $pdo->prepare( $str) ;
    $prep ->execute();
    echo $value;*/
    //echo $str;
    //echo makeRequest($str);
    //echo "la";
    global $pdo;
    $str = "INSERT INTO ".$table." (".$name1.",".$name2.")
VALUES ('".$par1."','".$par2."')";
    makeRequest($str);
}


if($action == "addTopic"){
    $par1 = $_GET["par1"];
    $par2 = $_GET["par2"];
    
    $name1 = "name";
    $name2 = "question";
    
    $table = "Topic";
    
    
    addRow($table,$name1,$name2,$par1,$par2);
    responsSucsess();
    
}
if($action == "addArgument"){
    $par1 = $_GET["par1"];
    $par2 = $_GET["par2"];
    $par3 = $_GET["par3"];
    
    $name1 = "text";
    $name2 = "topicID";
    $name3 = "isPro";
    
    $table = "Argument";
    
    global $pdo;
    $str = "INSERT INTO ".$table." (".$name1.",".$name2.",".$name3.")
VALUES ('".$par1."','".$par2."',".$par3.")";
    
    makeRequest($str);
    responsSucsess();
}

if($action == "addExample"){
        $par1 = $_GET["par1"];
    $par2 = $_GET["par2"];
    
    $name1 = "text";
    $name2 = "reasonID";
    
    $table = "Example";
    
    addRow($table,$name1,$name2,$par1,$par2);
    responsSucsess();
}

if($action == "addReason"){
        $par1 = $_GET["par1"];
    $par2 = $_GET["par2"];
    
    $name1 = "text";
    $name2 = "argumentID";
    
    $table = "Reason";
    
    addRow($table,$name1,$name2,$par1,$par2);
    responsSucsess();
}
//--------------------ifRemove
if($action == "removeTopic"){
    $par1 = $_GET["par1"];
    removeTopic($par1);
    responsSucsess(); 
}
if($action == "removeArgument"){
    $par1 = $_GET["par1"];
    removeArgument($par1);
    responsSucsess();
}
if($action == "removeReason"){
    $par1 = $_GET["par1"];
    removeReason($par1);
    responsSucsess();
}
if($action == "removeExample"){
    $par1 = $_GET["par1"];
    removeExample($par1);
    responsSucsess();
}
//-----------------------------------Remove 

function removeTopic($topicID){
    $topicL = makeRequest("SELECT * FROM Topic WHERE ID='".$topicID."'");//->fetchAll(PDO::FETCH_ASSOC);
    
    $argumentL =  makeRequest("SELECT * FROM Argument WHERE topicID='".$topicID."'");//->fetchAll(PDO::FETCH_ASSOC);
    foreach($argumentL as $line){
        removeArgument($line["ID"]);
    }
    
    makeRequest("DELETE  FROM Topic WHERE ID='".$topicID."'");
    
            
     
}

function removeArgument($argumentID){
    $reasonL =  makeRequest("SELECT * FROM Reason WHERE argumentID='".$argumentID."'");//->fetchAll(PDO::FETCH_ASSOC);
    foreach($reasonL as $line){
        removeReason($line["ID"]);
    }
    makeRequest("DELETE  FROM Argument WHERE ID='".$argumentID."'");
}
function removeReason($reasonID){
    $exampleL = makeRequest("SELECT * FROM Example WHERE reasonID='".$reasonID."'");//->fetchAll(PDO::FETCH_ASSOC);
    foreach($exampleL as $line){
        makeRequest("DELETE  FROM Example WHERE ID='".$line["ID"]."'");
    }
    makeRequest("DELETE  FROM Reason WHERE ID='".$reasonID."'");
}
function removeExample($exampleID){
    
    makeRequest("DELETE  FROM Example WHERE ID='".$exampleID."'");
}

//--------------------------

//echo "fertig"


?>