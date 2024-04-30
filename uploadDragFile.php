<?php 
$filesTemp = $_FILES['archivo']["tmp_name"];
$filesName = $_FILES["archivo"]["name"];
$filesError = $_FILES["archivo"]["error"];
for($i=0; $i<count($filesTemp);$i++){
    if(is_uploaded_file($filesTemp[$i])){
        //mover el archivo del carpeta temporal al destino definitivo indicado por nosotros
        if(!file_exists("documents/")){
            if(mkdir("documents/",0777)) $is_carpeta = true;
        }else{
            $is_carpeta = true;
        }
        if($is_carpeta){
            $path = "documents/".$filesName[$i];
            if(move_uploaded_file($filesTemp[$i],$path)){
                $json = array("error"=>0, "msg"=> "OK");
               // echo "OK";
            }else{
                $json = array("error"=>1, "msg" => "Ha habido un error no se ha podido subir el archivo al servidor");
              //  echo "Ha habido un error no se ha podido subir el archivo al servidor";
            }
        }else{
            $json = array("error"=>1, "msg" => "no se ha podido subir el archivo porque no se ha podido crear la carpeta");
           // echo "no se ha podido subir el archivo porque no se ha podido crear la carpeta";
        } 
    }else{
        $json = array("error"=>1, "msg" => "Ha habido un error no se ha podido subir el archivo a la carpeta temporal ".$_FILES["archivo"]["error"]);
        //echo "Ha habido un error no se ha podido subir el archivo a la carpeta temporal ".$filesError[$i];
    }
}
header('Content-Type: application/json');
echo json_encode($json);
?>