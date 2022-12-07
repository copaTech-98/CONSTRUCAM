//variables

let fecha_entrega = "";
let fecha_devolucion = "";
let id_cliente = 0;
let dias = "";
let importe = 0;
let descuento = 0;
let total = 0;
let tarifa = "";
let value_maquinaria = "";
let codigo_maquinaria = "";
let garantia = 0;
let data = "";
let id_factura = "";
let system = {
  calculate: function (fecha_entrega, fecha_devolucion) {
    $.ajax({
      type: "POST",
      url: "serve.php",
      data: {
        action: "obtener_fecha",
        fecha_entrega: fecha_entrega,
        fecha_devolucion: fecha_devolucion,
      },
      success: function (response) {
        if (response != "error") {
          if (response < 0) {
            alert(
              "La fecha de devolucion no puede ser menor a la fecha entrega"
            );
          } else {
            dias = response;
            value_maquinaria = $("#maquinaria").val();
            tarifa = parseInt($("#" + value_maquinaria).attr("tarifa"));
            importe = tarifa * dias;
            garantia = importe * 0.1;
          }

          $("#importe").val(importe + "$");
          if (dias > 7) {
            descuento = importe * 0.1;
            let suma = importe - descuento;
            garantia = suma * 0.1;
            total = suma + garantia;
          } else {
            descuento = 0;
            garantia = importe * 0.1;
            total = importe + garantia;
          }
          $("#garantia").val(garantia + "$");
          $("#descuento").val(descuento + "$");
          $("#total").val(total + "$");
        }
      },
    });
  },
  save: function () {
    $.ajax({
      type: "POST",
      url: "serve.php",
      data: {
        action: "save_alquiler",
        id_cliente: id_cliente,
        id_maquinaria: value_maquinaria,
        fecha_entrega: fecha_entrega,
        fecha_devolucion: fecha_devolucion,
        importe: importe,
        descuento: descuento,
        garantia: garantia,
        total: total,
      },
      success: function (response) {
        if (response == "success") {
          window.location.reload();
        } else {
          alert(response);
        }
      },
    });
  },
};

$("#fecha_entrega").change(function () {
  fecha_entrega = $("#fecha_entrega").val();
});
$("#fecha_devolucion").change(function () {
  fecha_devolucion = $("#fecha_devolucion").val();
  system.calculate(fecha_entrega, fecha_devolucion);
  $("#save_alquiler").bind("click", (e) => {
    e.preventDefault();
    system.save();
  });
});

$("#search_cliente").bind("click", function (e) {
  let cedula_cliente = $("#cedula_cliente").val();
  if (cedula_cliente.length === 10) {
    $.ajax({
      type: "POST",
      url: "serve.php",
      async: true,
      data: {
        action: "recuperar_cliente",
        cedula_cliente: cedula_cliente,
      },
      success: function (response) {
        if (response != "error") {
          let jsonData = JSON.parse(response);
          id_cliente = parseInt(jsonData.id);
          console.log(id_cliente);
          $("#nombre").val(jsonData.nombres);
          $("#apellido").val(jsonData.apellidos);
        } else {
          alert("Invalid Credentials!");
        }
      },
    });
  }
});
$("#search_cliente_devolucion").bind("click", function (e) {
  let cedula_cliente = $("#cedula_cliente_devolucion").val();
  if (cedula_cliente.length === 10) {
    $.ajax({
      type: "POST",
      url: "serve.php",
      async: true,
      data: {
        action: "recuperar_cliente_devolucion",
        cedula_cliente_devolucion: cedula_cliente,
      },
      success: function (response) {
        let total_devolucion = "";
        
        if (response != "error") {
          let jsonData = JSON.parse(response);
          data = jsonData;
          id_cliente = parseInt(jsonData.id_cliente);
          console.log(id_cliente);
          $("#nombre_devolucion").val(jsonData.nombres);
          $("#apellido_devolucion").val(jsonData.apellidos);
          $("#facturas_pendientes").html(jsonData.facturas);
          id_factura = $("#facturas_pendientes").val();
          total_devolucion = $("#ss" + id_factura).attr("total");
          $("#total_devolucion").val(total_devolucion);
          $("#facturas_pendientes").bind("change", function () {
            id_factura = $("#facturas_pendientes").val();
            total_devolucion = $("#ss" + id_factura).attr("total");
            $("#total_devolucion").val(total_devolucion);
          });
        } else {
          alert("Invalid Credentials!");
        }
      },
    });
  }
});
$("#save_devolucion").bind("click",function(e){
  e.preventDefault();
  let fecha_devolucion = $("#ss_fecha_devolucion").val();
  
  $.ajax({
    type: "POST",
    url: "serve.php",
    data: {
            action:"save_devolucion",
            id_cliente: data.id_cliente,
            id_factura: id_factura,
            fecha_devolucion: fecha_devolucion
          },
    success: function (response) {
      if(response=="success"){
        console.log(response);
        alert("guardado");
        window.location.reload();
      }else{
        console.log(response);
      }
    }
  });
});
