    function getClientes(){
        var bsc = $('#bsc').val();
    //    if(bsc.length<3) return false;
        $.ajax({type: "POST", dataType: 'json', url: 'clientes.php?&mod=getClientes&bsc='+bsc,
            success: function (result){
                $('#data tbody').empty();
                $.each(result, function(id, c){
                    var html = '<tr><td>'+c.razonsocial+'</td>';
                    html += '<td>'+c.numero+'</td>';
                    html += '<td>'+c.direccion+'</td>';
                    html += '<td align="center"><span style="cursor:pointer;" title="Editar" onclick="Editar('+c.idcliente+')">✏</span>️</td>';
                    html += '<td align="center"><span style="cursor:pointer;" title="Eliminar" onclick="Eliminar('+c.idcliente+')">❌</span>️</td></tr>';
                    $('#data tbody').append(html);
                });
            },
        });
    }
    function Editar(idcliente) {
        window.location.href='clientes.php?mod=editar&idcliente='+idcliente;
    }
    function Eliminar(idcliente){
        if(!confirm('Estas seguro de eliminar?')){
            return false;  
        }
        $.ajax({type: "POST", url: 'clientes.php?&mod=eliminar&idcliente='+idcliente,
            success: function (result){
                alert(result)
                if(result==='se ha eliminado correctamente.'){
                    window.location.href='clientes.php'
                }
            },
        }); 
    }

