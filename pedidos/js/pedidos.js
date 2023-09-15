function pedirInfoNuevoPedido()
{
    // alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_general_pedidos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pedirInfoNuevoPedido'
    );

}

function buscarSucursal()
{
    var idEmpresa = document.getElementById("idEmpresaCliente").value; 
    alert('Escogio algo '+idEmpresa); 

    // const http=new XMLHttpRequest();
    // const url = 'pedidos/pedidos.php';
    // http.onreadystatechange = function(){

    //     if(this.readyState == 4 && this.status ==200){
    //            document.getElementById("modalBodyPedido").innerHTML  = this.responseText;
    //     }
    // };
    // http.open("POST",url);
    // http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // http.send('opcion=pedirInfoNuevoPedido'
    // );


}

function continuarAItemsPedido()
{
    // alert('funcion javascript');
    var idEmpresaCliente = document.getElementById('idEmpresaCliente').value;
    // var idPrioridad = document.getElementById('idPrioridad').value;
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_general_pedidos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=continuarAItemsPedido'
    +'&idEmpresaCliente='+idEmpresaCliente
    // +'&idPrioridad='+idPrioridad
    );

}
function siguientePantallaPedido(idPedido)
{
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_general_pedidos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=siguientePantallaPedido'
    +'&idPedido='+idPedido
    );

}


function actulizarWoPedido(idPedido)
{
    var valor ;
    if(document.getElementById('checkwo').checked)
    {
        valor = 1;
    }
    else{
        valor = 0;
    }
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_general_pedidos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=actualizarWoPedido'
    +'&idPedido='+idPedido
    +'&valor='+valor
    );
    siguientePantallaPedido(idPedido);
}

function actulizarRPedido(idPedido)
{
    var valor ;
    if(document.getElementById('checkr').checked)
    {
        valor = 1;
    }
    else{
        valor = 0;
    }
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_general_pedidos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=actualizarRPedido'
    +'&idPedido='+idPedido
    +'&valor='+valor
    );
    siguientePantallaPedido(idPedido);
}

function actulizarIPedido(idPedido)
{
    var valor ;
    if(document.getElementById('checki').checked)
    {
        valor = 1;
    }
    else{
        valor = 0;
    }
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_general_pedidos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=actulizarIPedido'
    +'&idPedido='+idPedido
    +'&valor='+valor
    );
    siguientePantallaPedido(idPedido);
}



function formuAsignarItemPedidoATecnico(idItemPedido)
{
    // alert('idpedido '+ idPedido +' idItem '+ idItemPedido);
    // var valida = validarInfoTecnico();
    // if(valida==1)
    // {
        // var idPrioridad = document.getElementById('idPrioridad').value;
        // var idTecnico = document.getElementById('idTecnico').value;
        const http=new XMLHttpRequest();
        const url = 'pedidos/pedidos.php';
        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){
                document.getElementById("modalBodyPedidoAsignartecnico").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=formuAsignarItemPedidoATecnico'
        +'&idItemPedido='+idItemPedido
        );
//    }

}
function realizarAsignacionTecnicoAItem(idItemPedido)
{
    //  alert(' idItem '+ idItemPedido);
    var valida = validarInfoTecnico();
    if(valida==1)
    {
        var idPrioridad = document.getElementById('idPrioridad').value;
        var idTecnico = document.getElementById('idTecnico').value;
        const http=new XMLHttpRequest();
        const url = 'pedidos/pedidos.php';
        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){
                document.getElementById("modalBodyPedidoAsignartecnico").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=realizarAsignacionTecnicoAItem'
        +'&idItemPedido='+idItemPedido
        +'&idPrioridad='+idPrioridad
        +'&idTecnico='+idTecnico
        );
   }
//    pedidos();
}

function validarInfoTecnico()
{
    if( document.getElementById('idPrioridad').value == ''){
        alert('Por escoger urgencia');
        document.getElementById('idPrioridad').focus();
        return 0;
    }
    if( document.getElementById('idTecnico').value == ''){
        alert('Por escoger Tecnico');
        document.getElementById('idTecnico').focus();
        return 0;
    }
    return 1;
}

function mostrarTipoItem()
{
    // alert('cambio de opcion ');
    var tipoItem = document.getElementById('tipoItem').value;
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divTipoItemPedido").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=mostrarTipoItem'
    +'&tipoItem='+tipoItem
    );
}

function actualizarPedido(idPedido)
{
    
    var comentarios = document.getElementById('comentarios').value;
    // alert(comentarios);
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            document.getElementById("modalBodyPedidoActualizar").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=actualizarPedido'
    +'&idPedido='+idPedido
    +'&comentarios='+comentarios
    );
}
