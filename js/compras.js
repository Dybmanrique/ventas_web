function getCompras(){
    var bsc = $('#bsc').val();
//    if(bsc.length<3) return false;
    $.ajax({type: "POST", dataType: 'json', url: 'compras.php?&mod=getCompras&bsc='+bsc,
        success: function (result){
            $('#data tbody').empty();
            $.each(result, function(id, c){
                var html = '<tr><td>'+c.fecha+'</td>';
                html += '<td>'+c.serie+'</td>';
                html += '<td>'+c.numero+'</td>';
                html += '<td>'+c.subtotal+'</td>';
                html += '<td>'+c.total+'</td>';
                html += '<td>'+c.razonsocial+'</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Editar" onclick="Editar('+c.idcompra+')">✏</span>️</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Eliminar" onclick="Eliminar('+c.idcompra+')">❌</span>️</td></tr>';
                $('#data tbody').append(html);
            });
        },
    });
}
function Editar(idcompra) {
    window.location.href='compras.php?mod=editar&idcompra='+idcompra;
}
function Eliminar(idcompra) {
    if (!confirm('¿Seguro que desea eliminar?')) {
        return false;
    }
    $.ajax({type: "POST", url: 'compras.php?&mod=eliminar&idcompra='+idcompra,
        success: function (result){
            if (result==='Se ha eliminado corectamente.') {
                alert('Se eliminó');
                window.location.href='compras.php';
            }
            
        },
    });
}
