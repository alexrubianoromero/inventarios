function agregarItemInicialPedido(tipoItem)
{
    // alert('funcion javascript');
    
    var valida = validaInfoNuevoItem();
    if(valida == 1)
    {
    var idPedido = document.getElementById('idPedido').value;
    var icantidad = document.getElementById('icantidad').value;
    var itipo = document.getElementById('itipo').value;
    var imodelo = document.getElementById('imodelo').value;
    var ipulgadas = document.getElementById('ipulgadas').value;
    var iprocesador = document.getElementById('iprocesador').value;
    var igeneracion = document.getElementById('igeneracion').value;
    var iram = document.getElementById('iram').value;
    var icapacidadram = document.getElementById('icapacidadram').value;
    var idisco = document.getElementById('idisco').value;
    var icapacidaddisco = document.getElementById('icapacidaddisco').value;
    var idEstadoInicio = document.getElementById('idEstadoInicio').value;
    var iprecio = document.getElementById('iprecio').value;
    var iobservaciones = document.getElementById('iobservaciones').value;
    var tipoItem = document.getElementById('tipoItem').value;
    var isubtipo = document.getElementById('isubtipo').value;

    const http=new XMLHttpRequest();
    const url = 'pedidos/itemInicioPedido.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_items_solicitados_pedido").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=agregarItemInicialPedido'
    +'&idPedido='+idPedido
    +'&icantidad='+icantidad
    +'&itipo='+itipo
    +'&imodelo='+imodelo
    +'&ipulgadas='+ipulgadas
    +'&iprocesador='+iprocesador
    +'&igeneracion='+igeneracion
    +'&iram='+iram
    +'&icapacidadram='+icapacidadram
    +'&idisco='+idisco
    +'&icapacidaddisco='+icapacidaddisco
    +'&idEstadoInicio='+idEstadoInicio
    +'&iprecio='+iprecio
    +'&iobservaciones='+iobservaciones
    +'&tipoItem='+tipoItem
    +'&isubtipo='+isubtipo
    );
    limpiarCampos();
    } //fin de valida
}

function limpiarCampos()
{
    document.getElementById('icantidad').value = '';
    document.getElementById('itipo').value = '';
    document.getElementById('imodelo').value = '';
    document.getElementById('ipulgadas').value = '';
    document.getElementById('iprocesador').value= '';
    document.getElementById('igeneracion').value= '';
    document.getElementById('iram').value= '';
    document.getElementById('idisco').value= '';
    document.getElementById('idEstadoInicio').value= '';
    document.getElementById('iprecio').value= '';


}

function validaInfoNuevoItem()
{
    
    if( document.getElementById('icantidad').value == ''){
        alert('Por favor digitar cantidad');
        document.getElementById('icantidad').focus();
        return 0;
    }
    if( document.getElementById('itipo').value == ''){
        alert('Por favor digitar itipo');
        document.getElementById('itipo').focus();
        return 0;
    }
    if( document.getElementById('imodelo').value == ''){
        alert('Por favor digitar imodelo');
        document.getElementById('imodelo').focus();
        return 0;
    }
    if( document.getElementById('ipulgadas').value == ''){
        alert('Por favor digitar ipulgadas');
        document.getElementById('ipulgadas').focus();
        return 0;
    }
    if( document.getElementById('iprocesador').value == ''){
        alert('Por favor digitar iprocesador');
        document.getElementById('iprocesador').focus();
        return 0;
    }
    if( document.getElementById('igeneracion').value == ''){
        alert('Por favor digitar igeneracion');
        document.getElementById('igeneracion').focus();
        return 0;
    }
    if( document.getElementById('iram').value == ''){
        alert('Por favor digitar iram');
        document.getElementById('iram').focus();
        return 0;
    }
    if( document.getElementById('idisco').value == ''){
        alert('Por favor digitar idisco');
        document.getElementById('idisco').focus();
        return 0;
    }
    if( document.getElementById('idEstadoInicio').value == ''){
        alert('Por favor digitar idEstadoInicio');
        document.getElementById('idEstadoInicio').focus();
        return 0;
    }
    if( document.getElementById('iprecio').value == ''){
        alert('Por favor digitar iprecio');
        document.getElementById('iprecio').focus();
        return 0;
    }
    if( document.getElementById('iobservaciones').value == ''){
        alert('Por favor digitar observaciones');
        document.getElementById('iobservaciones').focus();
        return 0;
    }
    return 1;
}


function eliminarItemInicialPedido(id)
{
    // alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = 'pedidos/itemInicioPedido.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_items_solicitados_pedido").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=eliminarItemInicialPedido'
    +'&id='+id
    );

}