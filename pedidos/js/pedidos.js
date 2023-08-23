function pedirInfoNuevoPedido()
{
    // alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = 'pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyPedido").innerHTML  = this.responseText;
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