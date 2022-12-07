<?php 
    include "pages/connection.php";
    //recuperar cliente
    if (!empty($_POST['cedula_cliente'])&&$_POST["action"] == "recuperar_cliente") {
        $cedula_cliente = $_POST['cedula_cliente'];
        $querys = mysqli_query($conect, "select * from clientes where cedula = $cedula_cliente");
        mysqli_close($conect);
        if(mysqli_num_rows($querys)>0){
            $data = mysqli_fetch_assoc($querys);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
        }else{
            echo "error";
        }
   
        exit;
    }
    //formatear fecha
    if($_POST["action"] == "obtener_fecha"){
        if(!empty($_POST["fecha_entrega"])&&!empty($_POST["fecha_devolucion"])){
            $fecha_entrega = strtotime($_POST["fecha_entrega"]) ;
            $fecha_devolucion = strtotime($_POST["fecha_devolucion"]);
            $day_entrega = date('d',$fecha_entrega);
            $day_devolucion = date('d',$fecha_devolucion);
            echo $day_devolucion - $day_entrega;
        }
    }
    if($_POST["action"] == "save_alquiler"){
        if(!empty($_POST["id_cliente"])||!empty($_POST["id_maquinaria"])||!empty($_POST["fecha_entrega"])||!empty($_POST["fecha_devolucion"])||!empty($_POST["importe"])||!empty($_POST["descuento"])||!empty($_POST["garantia"])||!empty($_POST["total"]))
        {
            $id_cliente   = $_POST["id_cliente"];
            $id_maquinaria = $_POST["id_maquinaria"];
            $fecha_entrega = $_POST["fecha_entrega"];
            $fecha_devolucion = $_POST["fecha_devolucion"];
            $importe  = $_POST["importe"];
            $descuento = $_POST["descuento"];
            $garantia = $_POST["garantia"];
            $total = $_POST["total"];
            $query = mysqli_query($conect, "INSERT INTO alquiler(cliente,maquinaria,fechaentrega,fechadevolucion,importe,descuento,garantia,total,status)
            VALUES('$id_cliente','$id_maquinaria','$fecha_entrega','$fecha_devolucion','$importe','$descuento','$garantia','$total','0')");
            mysqli_close($conect);
            if($query)
            {
                echo "success";
                exit;
            }else{
                echo "no se guardo";
                exit;
            }
        }else{
            echo "error";
            exit;
        }
    }
    if($_POST["action"] == "recuperar_cliente_devolucion"){
        if(!empty($_POST["cedula_cliente_devolucion"])){
            $cedula_cliente = $_POST["cedula_cliente_devolucion"];
            $query = mysqli_query($conect, "select * from clientes where cedula = $cedula_cliente");
           
            if(mysqli_num_rows($query)>0){
                $data = mysqli_fetch_assoc($query);
                $id_cliente = $data["id"];
                $facturas = mysqli_query($conect,"select * from alquiler where cliente = $id_cliente and status = 0");
                mysqli_close($conect);
                if(mysqli_num_rows($facturas)>0){
                    $dataEnv = "";
                    while($rows = mysqli_fetch_assoc($facturas)){
                        $dataEnv .="<option value=".$rows['id']." id="."ss".$rows['id']." total=".$rows['total'].">".$rows["fechaentrega"]."/".$rows["fechadevolucion"]."=".$rows["total"]."$"."</option>"; 
                    }
                    echo json_encode(array("nombres"=>$data['nombres'],"apellidos"=>$data["apellidos"],"id_cliente"=>$id_cliente,"facturas"=>$dataEnv),JSON_UNESCAPED_UNICODE);
                    exit;
                }else{
                    echo "error";
                    exit;
                }
                exit;
            }
            exit;
        }
        exit;
    }
    if($_POST["action"] == "save_devolucion")
    {
        if(!empty($_POST["id_cliente"])||!empty($_POST["id_factura"])||!empty($_POST["fecha_devolucion"]))
        {
            $id_cliente =  $_POST["id_cliente"];
            $id_factura = $_POST["id_factura"];
            $fecha_devolucion = $_POST["fecha_devolucion"];
            $query = mysqli_query($conect, "UPDATE alquiler SET status = 1  WHERE alquiler.id = $id_factura and alquiler.cliente = $id_cliente");
            // mysqli_close($conect);
            if($query){
                $update_fecha = mysqli_query($conect,"UPDATE alquiler SET fechadevuelve = $fecha_devolucion  WHERE alquiler.id = $id_factura and alquiler.cliente = $id_cliente");
                if($update_fecha){
                    echo "success";
                    exit;
                }else{
                    echo "error";
                }
                
            }else{
                echo "error";
                exit;
            }
            
            exit;
        }
        exit;
    }
    exit;
?>