<?php
include("connection.php");

$native_name_sl1 = "";
$lang_id_sl1 = "";
$lang_code_sl1 = "";
$native_name_sl2 = "";
$lang_id_sl2 = "";
$lang_code_sl2 = "";


$native_name_tl1 = "";
$lang_id_tl1 = "";
$lang_code_tl1 = "";
$native_name_tl2 = "";
$lang_id_tl2 = "";
$lang_code_tl2 = "";





$sql="SELECT * FROM languages WHERE source_lang > 0 ORDER BY source_lang";


if($result = mysqli_query($link, $sql)){
if(mysqli_num_rows($result)>0){
$lang_id="";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
if($lang_id!=$row["lang_id"]){
$source_lang_num= $row["source_lang"];
if($source_lang_num ==1){
$lang_code_sl1=$row["lang_code"];
$lang_id_sl1=$row["lang_id"];
$native_name_sl1= $row["native_name"];


}elseif($source_lang_num ==2){
$lang_code_sl2=$row["lang_code"];
$lang_id_sl2=$row["lang_id"];
$native_name_sl2= $row["native_name"];


}

}else{

}
}
//close the result set
mysqli_free_result($result);
}else{
echo "<p>Não foram encontrados resultados para a busca.</p>";
}
}else{
echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
}









$sql="SELECT * FROM languages WHERE target_lang > 0 ORDER BY target_lang";


if($result = mysqli_query($link, $sql)){
if(mysqli_num_rows($result)>0){
$lang_id="";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
if($lang_id!=$row["lang_id"]){
$target_lang_num= $row["target_lang"];
if($target_lang_num ==1){
$lang_code_tl1=$row["lang_code"];
$lang_id_tl1=$row["lang_id"];
$native_name_tl1= $row["native_name"];


}elseif($target_lang_num ==2){
$lang_code_tl2=$row["lang_code"];
$lang_id_tl2=$row["lang_id"];
$native_name_tl2= $row["native_name"];


}

}else{

}
}
//close the result set
mysqli_free_result($result);
}else{
echo "<p>Não foram encontrados resultados para a busca.</p>";
}
}else{
echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
}



return $native_name_sl1;
return $lang_id_sl1;
return $lang_code_sl1;
return $native_name_sl2;
return $lang_id_sl2;
return $lang_code_sl2;


return $native_name_tl1;
return $lang_id_tl1;
return $lang_code_tl1;
return $native_name_tl2;
return $lang_id_tl2;
return $lang_code_tl2;


?>
