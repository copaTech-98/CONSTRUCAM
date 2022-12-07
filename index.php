<?php
 //incluir conexion a base de datos
  include 'pages/connection.php';  
 //Clase de registro
 
 class registerCl{
    public $nombres;
    public $apellidos = "";
    public $cedula = "";
    public $direccion = "";
    public $telefono = "";
    public $email = "";
    public $conect;
    public $db;
    public $msg;
    public function save(){
        $query = mysqli_query($this->conect, 
                "INSERT INTO clientes(cedula,nombres,apellidos,direccion,telefono,email)
                VALUES('$this->cedula','$this->nombres','$this->apellidos','$this->direccion','$this->telefono','$this->email')");
       if($query){
         $this->msg = "<p class='msgdsuccess'>Se ha guardado correctamente</p>";
       }
       
    }
    public function recuperarCliente($cicliente){
        echo $cicliente;
    }
    public function msg(){
        echo $this->msg;
    }
 }
 $client = new registerCl();
 $multa = 0;
 class registerAl{
    public $cliente;
 }
//verificar post alquiler
if(!empty($_POST)){
    if(empty($_POST['cliente'])||empty($_POST['fecha_entrega'])||empty($_POST['maquinaria'])||empty($_POST['fecha_devolucion'])){
       $client->msg = "<p class='msgdError'>Se requiere ingresar todos los datos</p>";
    }else{
        $client->recuperarCliente($_POST['cliente']);
    }
}
 
 //verificar el post
 if(!empty($_POST)){
    if(empty($_POST['nombre'])||empty($_POST['apellidos'])||empty($_POST['cedula'])||empty($_POST['direccion'])||empty($_POST['telefono'])||empty($_POST['email']))
    {
       $client->msg = "<p class='msgdError'>Se requiere ingresar todos los datos</p>";
    }else{
        //recoger datos del post
        $client->conect = $conect;
        $client->db = $db;
        $client-> nombres =  $_POST['nombre'];
        $client -> apellidos = $_POST['apellidos'];
        $client -> cedula = $_POST['cedula'];
        $client -> direccion = $_POST['direccion'];
        $client -> telefono = $_POST['telefono'];
        $client -> email= $_POST['email'];
        //guardas datos en base de datos
        $client->save();
    }
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include 'pages/plantilla/meta.php' ?>
</head>
<body>
    
    <div class="content">
        <h1><?php echo $razon_social; ?></h1>
        <div class="btn-group me-2" role="group" aria-label="First group">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal"  data-bs-target="#alquiler">Nuevo alquiler</button>
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal"  data-bs-target="#devolucion">Registrar devolucion</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"  data-bs-target="#regCliente">Registrar Cliente</button>
        </div>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-danger">Cliente en Mora</button>
            <button type="button" class="btn btn-warning">Igual a la fecha</button>
            <button type="button" class="btn btn-success">Menor a la fecha</button>
        </div>
        <!-- Modal Cliente-->
        <div class="modal fade" id="regCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method='POST'>
            <div class="row g-3">
                <div class='col-md-6 '>
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" name='nombre' class="form-control">
                </div>
                <div class='col-md-6'>
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" name='apellidos' class="form-control">
                </div>
            </div>
            
            <div class="row g-3">
                <div class='col-md-6'>
                    <label for="cedula" class="form-label">Cedula</label>
                    <input type="text" name='cedula' class="form-control">
                </div>
                <div class='col-md-6'>
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" name='direccion' class="form-control">
                </div>
            </div>
            
            
            <div class="row g-3">
                <div class='col-md-6'>
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" name='telefono' class="form-control">
                </div>
                <div class='col-md-6'>
                    <label for="email" class="form-label">Correo electronico</label>
                    <input type="email" name='email' class="form-control">
                </div>   
            </div>
            
            
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Cliente-->
<!-- Modal Alquiler-->
<div class="modal fade" id="alquiler" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alquiler</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method='POST'>
           
     <!--Datos del cliente-->
      <div class="datacliente">
        <h2>Cliente</h2>
        <div class="msgd"></div>
            <div class="input-group g-3">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <input type="text" class="form-control cedula" placeholder="CEDULA" id="cedula_cliente">
                        <button type="button" class="btn btn-primary" id="search_cliente"><i class="bi bi-search"></i></button>
                    </div>
            </div>      
            <div class="row g-3">
                <div class='col-md-6'>
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" name='nombre' id='nombre' class="form-control" readonly>
                </div>
                <div class='col-md-6'>
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" name='apellido' class="form-control" readonly id="apellido">
                </div>
            </div>     
      </div>
                    
        <div class="dataalquiler">
        <div class='mb-3'>
                <label for="maquinaria" class="form-label">Maquinaria</label>
                <select name="maquinaria" id="maquinaria" class="form-control">
                    <?php
                    //mostrar lista desde base de datos 
                    if($conect){
                        $query = mysqli_query($conect, "SELECT * FROM maquinaria");
                        if($query){
                            while($rows = $query->fetch_assoc()){?>

                                <option value="<?php echo $rows['id']?>"  tarifa="<?php echo $rows["tarifa"]?>" id="<?php echo $rows['id']?>" codigo="<?php echo $rows['codigo']?>"><?php echo $rows['maquina']?> </option>
                    
                    
                <?php
                    }
                      }
                        }
                          ?>
                </select>
                </div>
            
            
            <div class="row g-3">
                <div class='col-md-6'>
                    <label for="fecha_entrega" class="form-label">Fecga de entrega</label>
                    <input type="date" name='fecha_entrega' id='fecha_entrega' class="form-control">
                </div>
                <div class='col-md-6'>
                    <label for="fecha_devolucion" class="form-label">Fecha de devolucion</label>
                    <input type="date" name='fecha_devolucion' class="form-control" id="fecha_devolucion">
                </div>
            </div>
            
            
            <div class="row g-3">
                <div class='col-md-6'>
                    <label for="importe" class="form-label">Importe</label>
                    <input type="text" name='importe' id="importe" class="form-control" readonly>
                </div>
                <div class='col-md-6'>
                    <label for="descuento" class="form-label">Descuento</label>
                    <input type="text" name='desceunto' class="form-control" readonly id="descuento">
                </div>   
                <div class="mb-3">
                    <label for="total" class="label-control">Garantia</label>
                    <input type="text" class='form-control' name="garantia" id="garantia" readonly>
                </div>
                <div class="mb-3">
                    <label for="total" class="label-control">Total</label>
                    <input type="text" class='form-control' name="total" id="total" readonly id="total">
                </div>
            </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save_alquiler">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Alquiler-->
<!--Modal Devolucion-->
<div class="modal fade" id="devolucion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Devolucion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method='POST'>
           
     <!--Datos del cliente-->
      <div class="datacliente">
        <h2>Cliente</h2>
        <div class="msgd"></div>
            <div class="input-group g-3">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <input type="text" class="form-control cedula" placeholder="CEDULA" id="cedula_cliente_devolucion">
                        <button type="button" class="btn btn-primary" id="search_cliente_devolucion"><i class="bi bi-search"></i></button>
                    </div>
            </div>      
            <div class="row g-3">
                <div class='col-md-6'>
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" name='nombre' id='nombre_devolucion' class="form-control" readonly>
                </div>
                <div class='col-md-6'>
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" name='apellido' class="form-control" readonly id="apellido_devolucion">
                </div>
            </div>     
      </div>
    <!--Datos del cliente-->             
        <div class="dataalquiler">
        <div class='mb-3'>
                <label for="maquinaria" class="form-label">Facturas pendientes</label>
                <select name="maquinaria" id="facturas_pendientes" class="form-control">
                   <!--Mostrar facturas-->
                          
                   <!--Mostrar facturas-->
                </select>
                </div>
                <div class='mb-3'>
                    <label for="fecha_devolucion" class="form-label">Fecha de devolucion</label>
                    <input type="date" name='fecha_devolucion' class="form-control" id="ss_fecha_devolucion">
                </div>
            
            
            
            
                <div class="mb-3">
                    <label for="total" class="label-control">Total</label>
                    <input type="text" class='form-control' name="total" id="total_devolucion" readonly>
                </div>
            
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save_devolucion">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Modal Devolucion-->
    </div>
    <div class='contentData'>
    <div class="msgd"> <?php $client->msg() ?> </div>
    <p>POR PAGAR!</p>
    <table class="table">
        <thead class='table-dark'>
                        <tr class="bg-primary text-white" >
                            <td scope="col" colspan="0">Cliente</td>
                            <td scope="col">Maquinaria</td>
                            <td scope="col">Fecha Entrega</td>
                            <td scope="col">Fecha Devolucion</td>
                            <td scope="col">Días</td>
                            <td scope="col">Importe</td>
                            <td scope="col">Descuento</td>
                            <td scope="col">Garantía</td>
                            <td scope="col">Multa</td>
                            <td scope="col">Total a Pagar</td>
                        </tr>
        </thead>
        <tbody>
            

            
            <?php
               $fecha_Actual = date('d');
               
               
               if($conect){
                $query = mysqli_query($conect, "SELECT c.nombres,c.apellidos,c.cedula,m.codigo, a.fechaentrega, a.fechadevolucion, a.importe ,a.descuento,a.garantia FROM clientes c INNER JOIN alquiler a INNER JOIN maquinaria m ON a.cliente = c.id AND a.maquinaria = m.id AND a.status=0");
                if($query){
                    while($rows = $query->fetch_assoc()){?>
                             
                             <tr class="
                                        <?php 
                                            $fecha_devolucion_entero = strtotime($rows['fechadevolucion']);
                                            if($fecha_Actual - date('d',$fecha_devolucion_entero)<0){
                                                echo "green";
                                            }else if($fecha_Actual - date('d',$fecha_devolucion_entero) === 0){
                                                echo "yellow";
                                            }else if($fecha_Actual - date('d',$fecha_devolucion_entero)>0){
                                                echo "red";
                                            }   
                                        ?>">
                                <td><?php echo $rows['nombres'].$rows['apellidos'];?></td>
                                <td><?php echo $rows['codigo']; ?></td>
                                <td><?php echo $rows['fechaentrega']; ?></td>
                                <td><?php echo $rows['fechadevolucion']; ?></td>
                                
                                <td><?php 
                                         $fecha_entrega_entero = strtotime($rows['fechaentrega']);
                                         echo date('d',$fecha_devolucion_entero) - date('d',$fecha_entrega_entero);
                                    ?>
                                </td>
                                <td><?php echo $rows['importe']."$"; ?></td>
                                <td><?php echo $rows['descuento']; ?></td>
                                <td><?php echo $rows['garantia']."$"; ?></td>
                                <td> 
                                    <?php 
                                        if($fecha_Actual - date('d',$fecha_devolucion_entero)<=0)
                                        {
                                            $multa = 0;
                                        }else if($fecha_Actual - date('d',$fecha_devolucion_entero)>0)
                                        {
                                            $interes = intval($rows['importe'])*0.1;
                                            $multa=  $interes + intval($rows['garantia']);
                                           
                                        }
                                        echo $multa."$";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                       if($multa!= 0){
                                        $total = intval($rows['importe']) - intval($rows["descuento"]) + intval($rows['garantia'])+$multa;
                                       
                                       }else{
                                        $total = intval($rows['importe']) - intval($rows["descuento"]) + intval($rows['garantia']);
                                       }
                                       echo $total."$";
                                    ?>
                                </td>

                             </tr>
                    <?php
                    }
                }
               }
            ?>
        </tbody>

    </table>
    <p>PAGADO!</p>
    <table class="table">
        <thead class='table-dark'>
                        <tr class="bg-primary text-white" >
                            <td scope="col" colspan="0">Cliente</td>
                            <td scope="col">Maquinaria</td>
                            <td scope="col">Fecha Entrega</td>
                            <td scope="col">Fecha Devolucion</td>
                            <td scope="col">Fecha Devuelve</td>
                            <td scope="col">Días</td>
                            <td scope="col">Importe</td>
                            <td scope="col">Descuento</td>
                            <td scope="col">Garantía</td>
                            <td scope="col">Multa</td>
                            <td scope="col">Total a Pagar</td>
                        </tr>
        </thead>
        <tbody>
            <?php
               $fecha_Actual = date('d');
               
               
               if($conect){
                $query = mysqli_query($conect, "SELECT c.nombres,c.apellidos,c.cedula,m.codigo, a.fechaentrega, a.fechadevolucion, a.fechadevuelve,a.importe ,a.descuento,a.garantia FROM clientes c INNER JOIN alquiler a INNER JOIN maquinaria m ON a.cliente = c.id AND a.maquinaria = m.id AND a.status=1");
                if($query){
                    while($rows = $query->fetch_assoc()){?>
                             
                             <tr class="
                                        <?php 
                                            $fecha_devolucion_entero = strtotime($rows['fechadevolucion']);
                                            if($fecha_Actual - date('d',$fecha_devolucion_entero)<0){
                                                echo "green";
                                            }else if($fecha_Actual - date('d',$fecha_devolucion_entero) === 0){
                                                echo "yellow";
                                            }else if($fecha_Actual - date('d',$fecha_devolucion_entero)>0){
                                                echo "red";
                                            }   
                                        ?>">
                                <td><?php echo $rows['nombres'].$rows['apellidos'];?></td>
                                <td><?php echo $rows['codigo']; ?></td>
                                <td><?php echo $rows['fechaentrega']; ?></td>
                                <td><?php echo $rows['fechadevolucion']; ?></td>
                                <td><?php echo $rows['fechadevuelve'];?></td>
                                <td><?php 
                                         $fecha_entrega_entero = strtotime($rows['fechaentrega']);
                                         echo date('d',$fecha_devolucion_entero) - date('d',$fecha_entrega_entero);
                                    ?>
                                </td>
                                <td><?php echo $rows['importe']."$"; ?></td>
                                <td><?php echo $rows['descuento']; ?></td>
                                <td><?php echo $rows['garantia']."$"; ?></td>
                                <td> 
                                    <?php 
                                        if($fecha_Actual - date('d',$fecha_devolucion_entero)<=0)
                                        {
                                            $multa = 0;
                                        }else if($fecha_Actual - date('d',$fecha_devolucion_entero)>0)
                                        {
                                            $interes = intval($rows['importe'])*0.1;
                                            $multa=  $interes + intval($rows['garantia']);
                                           
                                        }
                                        echo $multa."$";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                       if($multa!= 0){
                                        $total = intval($rows['importe']) - intval($rows["descuento"]) + intval($rows['garantia'])+$multa;
                                       
                                       }else{
                                        $total = intval($rows['importe']) - intval($rows["descuento"]) + intval($rows['garantia']);
                                       }
                                       echo $total."$";
                                    ?>
                                </td>

                             </tr>
                    <?php
                    }
                }
               }
            ?>
        </tbody>

    </table>
    </div>
</body>
<?php  include 'pages/plantilla/scripts.php' ?>
</html>
<?php
       
    
       
       