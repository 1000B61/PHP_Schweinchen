<?php
if(isset($_GET["spieler1"])) $spieler1=$_GET["spieler1"]; else $spieler1=0;
if(isset($_GET["spieler2"])) $spieler2=$_GET["spieler2"]; else $spieler2=0;
if(isset($_GET["spieler"])) $Spieler=$_GET["spieler"]; else $Spieler=1;
$i=0;
function spiel(&$s){
    global $runde;
    global $i;
    global $Spieler;
    if (!isset($_GET["ende"])){
        if(isset($_GET["wurf"])){
            $i=$_GET["i"];
            if($i>0) for($a=0;$a<$i;$a++) $runde[$a]=$_GET["$a"];
            $wurf=rand(1,6);
            if($wurf==1){
                $runde=[];
                $i=0;
                $wurf=0;
                $Spieler=$_GET["spieler"];
                if($Spieler==1) $Spieler=2; else if ($Spieler==2) $Spieler=1;
                return;
            } else {
                $runde[$i]=$wurf;
                $i++;
            }
        }
    } else if(isset($_GET["ende"])){
        $i=$_GET["i"];
        if($i>0) for($a=0;$a<=$i-1;$a++) $runde[$a]=$_GET["$a"];
        $s=$s+array_sum($runde);
        $runde=[];
        $i=0;
        $Spieler=$_GET["spieler"];
        if($Spieler==1) $Spieler=2; else if ($Spieler==2) $Spieler=1;
        return;    
        }

}

if($Spieler==1) spiel($spieler1); else if ($Spieler==2) spiel($spieler2);


?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schweinchen</title>
</head>
<body>
<?php if($spieler1<100&&$spieler2<100) { ?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="GET">
<label for="spieler1"><?php if($Spieler==1){ ?><b>Spieler 1</b><?php } else { ?>Spieler 1<?php } ?></label>
<input type="text" name="spieler1" value="<?php if(isset($spieler1)) echo $spieler1;?>" readonly>    
<label for="spieler2"><?php if($Spieler==2){ ?><b>Spieler 2</b><?php } else { ?>Spieler 2<?php } ?></label>
<input type="text" name="spieler2" value="<?php if(isset($spieler1)) echo $spieler2;?>" readonly>
<input type="hidden" name="i" value="<?php if(isset($i))echo $i; else echo "0";?>">
<input type="hidden" name="spieler" value="<?php if(isset($Spieler))echo $Spieler;?>">
<br><br>
<input type="submit" name="wurf" value="Würfeln">
<?php if($i>0){?>
<input type="submit" name="ende" value="Runde beenden">
    <?php }?>
<?php if(isset($runde)) foreach($runde as $key => $v){?>
    <input type="text" size="1" name="<?php echo $key ?>" value="<?php echo $v ?>" readonly>

    <?php } ?>
    <?php } else if($spieler1>=100){ ?>
        <b>Spieler 1 gewinnt</b><br>
        <a href="schweinchen.php">Nochmal</a>
        <?php } else if($spieler2>=100){ ?>
        <b>Spieler 2 gewinnt</b><br>
        <a href="schweinchen.php">Nochmal</a>
        <?php } ?>
</form>
</body>
</html>