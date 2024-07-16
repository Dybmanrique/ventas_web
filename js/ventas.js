function getVentas() {
    var bsc = $('#bsc').val();
    //    if(bsc.length<3) return false;
    $.ajax({
        type: "POST", dataType: 'json', url: 'ventas.php?&mod=getVentas&bsc=' + bsc,
        success: function (result) {
            $('#data tbody').empty();
            $.each(result, function (id, c) {
                var html = '<tr><td>' + c.fecha + '</td>';
                html += '<td>' + c.serie + '-' + c.numero + '</td>';
                html += '<td>' + c.subtotal + '</td>';
                html += '<td>' + c.igv + '</td>';
                html += '<td>' + c.total + '</td>';
                html += '<td>' + c.razonsocial + '</td>';
                html += '<td align="center"><button type="button" onclick="accederDatos(this)" data-id="' + c.idventa + '" style="all: unset; cursor: pointer;" title="Detalles">👁️</button>️</td>';
                html += '<td align="center"><span title="Editar" style="cursor: pointer;" onclick="Editar(' + c.idventa + ')">✏</span>️</td>';
                html += '<td align="center"><span title="Eliminar" style="cursor: pointer;" onclick="Eliminar(' + c.idventa + ')">❌</span>️</td></tr>';
                $('#data tbody').append(html);
            });
        },
    });
}
function Editar(idventa) {
    window.location.href = 'ventas.php?mod=editar&idventa=' + idventa;
}
function Eliminar(idventa) {
    alertify.confirm("¿Esta seguro de eliminar?",
        function () {
            $.ajax({
                type: "POST", url: 'ventas.php?&mod=eliminar&idventa=' + idventa,
                success: function (result) {
                    if (result === 'Se ha eliminado corectamente.') {
                        alertify.success('Se eliminó');
                        getVentas();
                    }

                },
            });
        },
        function () {
            return;
        });
}

$(document).ready(function () {
    $('#frmClt').on('submit', function (event) {
        event.preventDefault(); // Prevenir el envío predeterminado del formulario

        // Crear una instancia de FormData
        let formData = new FormData(this);

        let params = new URLSearchParams(window.location.search);
        let isEdition = false;
        if (params.get('idventa')) {
            // si tiene un id para la edición
            formData.append('idventa', params.get('idventa'));
            isEdition = true;
        }

        let detalles = [];
        $('#detalle-venta tbody tr').each(function () {
            let id = $(this).data('id');
            let producto = $(this).find('td').eq(0).text();
            let precio = $(this).find('td').eq(1).text();
            let cantidad = $(this).find('td').eq(2).text();
            let total = $(this).find('td').eq(3).text();
            detalles.push({
                id: id,
                producto: producto,
                cantidad: cantidad,
                precio: precio,
                total: total
            });
        });

        if (detalles.length < 1) {
            alertify.warning('Agrege productos');
            return;
        }

        formData.append('detalles', JSON.stringify(detalles));
        formData.append('subtotal', sumarColumna(3));

        // Enviar los datos por AJAX
        $.ajax({
            url: 'ventas.php', // Cambia esto por la URL de tu servidor
            method: 'POST', // Método de la solicitud (POST o GET)
            data: formData, // Datos que se van a enviar
            processData: false, // Evita que jQuery procese los datos
            contentType: false, // Evita que jQuery establezca el tipo de contenido
            success: function (response) {
                // Manejar la respuesta del servidor
                respuesta = JSON.parse(response);
                if (respuesta.code == 200) {
                    alertify.success(respuesta.message);
                    if (isEdition == false) {
                        $("#frmClt")[0].reset();
                        numero = $("#numero").val();
                        $("#numero").val(parseInt(numero) + 1);
                        $('#detalle-venta tbody').html(null);
                    }
                    getVentas();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Manejar los errores de la solicitud
                $('#respuesta').html('<p>Error al enviar los datos: ' + textStatus + '</p>');
                console.error('Error: ' + textStatus + ', ' + errorThrown);
            }
        });
    });

    $('#form-producto').on('submit', function (event) {
        event.preventDefault(); // Prevenir el envío predeterminado del formulario
        idProducto = $('#idproducto').val();
        producto = $('#idproducto').find('option:selected').text();
        precio = $('#precio').val();
        cantidad = $('#cantidad').val();
        totalProducto = $('#totalProducto').val();
        var html = `<tr data-id='${idProducto}'><td>${producto}</td>`;
        html += `<td>${parseInt(precio).toFixed(2)}</td>`;
        html += `<td>${parseInt(cantidad).toFixed(2)}</td>`;
        html += `<td>${totalProducto}</td>`;
        html += '<td align="center"><span style="cursor:pointer;" title="Eliminar" onclick="eliminarFila(this)">❌</span>️</td></tr>';
        $('#detalle-venta tbody').append(html);
        $(this)[0].reset();
        // $('#subtotal').val(sumarColumna(3));
        subtotal = sumarColumna(3);
        document.getElementById("subtotal").value = subtotal;
        igv = subtotal * 0.18;
        document.getElementById("igv").value = igv.toFixed(2);
        document.getElementById("total").value = parseFloat(subtotal + igv).toFixed(2);
    });
});

function eliminarFila(boton) {
    // Obtener la fila que contiene el botón
    let fila = boton.closest('tr');

    // Eliminar la fila de la tabla
    fila.remove();

    subtotal = sumarColumna(3);
    document.getElementById("subtotal").value = subtotal;
    igv = subtotal * 0.18;
    document.getElementById("igv").value = igv.toFixed(2);
    document.getElementById("total").value = parseFloat(subtotal + igv).toFixed(2);
}

function sumarColumna(indiceColumna) {
    let tabla = document.getElementById("detalle-venta");
    let filas = tabla.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    let suma = 0;

    for (let i = 0; i < filas.length; i++) {
        let celdas = filas[i].getElementsByTagName("td");
        let valor = parseFloat(celdas[indiceColumna].textContent);
        if (!isNaN(valor)) {
            suma += valor;
        }
    }

    return suma.toFixed(2);
}

function accederDatos(boton) {
    // Obtener la fila (tr) que contiene el botón
    let fila = boton.closest('tr');
    let idventa = boton.getAttribute('data-id');
    // Obtener los datos de las celdas de la fila
    fecha = fila.cells[0].textContent;
    serieNum = fila.cells[1].textContent;
    subtotal = fila.cells[2].textContent;
    igv = fila.cells[3].textContent;
    total = fila.cells[4].textContent;
    cliente = fila.cells[5].textContent;

    $("#fecha-detalle").html(fecha);
    $("#nComprobante-detalle").html(serieNum);
    $("#cliente-detalle").html(cliente);
    $("#subtotal-detalle").html(subtotal);
    $("#igv-detalle").html(igv);
    $("#total-detalle").html(total);
    buscarDetalleVenta(idventa, total);
    $("#modal-registros").modal("show");
}

function buscarDetalleVenta(idventa, total) {

    mod = "getDetalleVentas";
    $.post("ventas.php", { mod, idventa }, (respuesta) => {
        plantilla = '';
        resultados = JSON.parse(respuesta);

        resultados.forEach(registro => {
            plantilla += `                
                <tr id="${registro.id}">
                <td>${registro.producto}</td>                    
                <td>${registro.precio}</td>                    
                    <td>${registro.cantidad}</td>
                    <td class="text-right">${registro.importe}</td>
                </tr>
            `;
        });
        plantilla += `                
        <tr class="table-secondary">                   
            <td colspan="4" class="text-center font-weight-bold">Total: S/. ${total}</td>                    
        </tr>
    `;
        $("#tabla-ver-detalles tbody").html(plantilla);
    });
}