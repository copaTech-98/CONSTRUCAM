<?php
include 'pages/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'pages/plantilla/meta.php' ?>
</head>
<body> 
    <div class="content"> 
        

        
        <?php
         $existe = false;
         $msg = "";
         if(!$conect){
            echo "<h1>Error no se ha establecido conexion con el servidor!</h1>";
         }else{
            
            $query = mysqli_query($conect, "show DATABASES");
            if(!$query){
                $msg =  "Error de consulta";
            }else{
               while($row = $query -> fetch_assoc()){
                    
              
                 if($row["Database"] === 'constructora'){
                   
                    $existe = true; 
                    break;
                 }        
                }
            }
        }
        if($existe){?>
            <!-- <div class="loading"> 
            <div class="spin"></div>
        </div> -->
       
    </div>
    <nav class='nav navbar'>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Registrar devolucion</a></li>
        <li><a href="data.php">Database</a></li>
      </ul>
      <span>Contrucam</span>
   
    </nav>
    <div class='contentData'>
    <table class="table">
        <thead class='table-dark'>
                        <tr class="bg-primary text-white" >
                            <th scope="col" colspan="2">Cliente</th>
                            <th scope="col">Maquinaria</th>
                            <th scope="col">Fecha Entrega</th>
                            <th scope="col">Fecha Devolucion</th>
                            <th scope="col">Días</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">Garantía</th>
                            <th scope="col">Total a Pagar</th>
                        </tr>
        </thead>

    </table>
    </div>
    
</body>

</html>
       <?php
       
    
        }else{
            $msg = "Creando base de datos"; 
            $query = mysqli_query($conect, "create database 'constructora' ");
            if($query){
                $msg = "base de datos se ha creado correctamente"; 
            }
        }
       
       
       ?>      
       
