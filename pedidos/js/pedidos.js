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