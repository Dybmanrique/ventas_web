function getProveedores(){
    var bsc = $('#bsc').val();
//    if(bsc.length<3) return false;
    $.ajax({type: "POST", dataType: 'json', url: 'proveedor.php?&mod=getProveedores&bsc='+bsc,
        success: function (result){
            $('#data tbody').empty();
            $.each(result, function(id, c){
                var html = '<tr><td>'+c.razonsocial+'</td>';
                html += '<td>'+c.numero+'</td>';
                html += '<td>'+c.direccion+'</td>';
                html += '<td>'+c.celular+'</td>';
                html += '<td>'+c.url+'</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Editar" onclick="Editar('+c.idproveedor+')">✏</span>️</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Eliminar" onclick="Eliminar('+c.idproveedor+')">❌</span>️</td></tr>';
                $('#data tbody').append(html);
            });
        },
    });
}
function Editar(idproveedor) {
    window.location.href='proveedor.php?mod=editar&idproveedor='+idproveedor;
}
function Eliminar(idproveedor){
    if(!confirm('Estas seguro de eliminar?')){
        return false;  
    }
    $.ajax({type: "POST", url: 'proveedor.php?&mod=eliminar&idproveedor='+idproveedor,
        success: function (result){
            alert(result)
            if(result==='se ah eliminado correctamente.'){
                window.location.href='proveedor.php'
            }
        },
    });  
}

