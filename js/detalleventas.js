function getDetalleVentas(){
    var bsc = $('#bsc').val();
//    if(bsc.length<3) return false;
    $.ajax({type: "POST", dataType: 'json', url: 'detalleventas.php?&mod=getDetalleVentas&bsc='+bsc,
        success: function (result){
            $('#data tbody').empty();
            $.each(result, function(id, c){
                var html = '<tr><td>'+c.precio+'</td>';
                html += '<td>'+c.cantidad+'</td>';
                html += '<td>'+c.importe+'</td>';
                html += '<td>'+c.producto+'</td>';
                html += '<td>'+c.numero+'</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Editar" onclick="Editar('+c.iddetalleventa+')">✏</span>️</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Eliminar" onclick="Eliminar('+c.iddetalleventa+')">❌</span>️</td></tr>';
                $('#data tbody').append(html);
            });
        },
    });
}
function Editar(iddetalleventa) {
    window.location.href='detalleventas.php?mod=editar&iddetalleventa='+iddetalleventa;
}
function Eliminar(iddetalleventa) {
    if (!confirm('¿Seguro que desea eliminar?')) {
        return false;
    }
    $.ajax({type: "POST", url: 'detalleventas.php?&mod=eliminar&iddetalleventa='+iddetalleventa,
        success: function (result){
            if (result==='Se ha eliminado corectamente.') {
                alert('Se eliminó');
                window.location.href='detalleventas.php';
            }
            
        },
    });
}