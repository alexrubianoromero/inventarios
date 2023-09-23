function formuCreacionParte()
{
    // alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = 'partes/partes.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyCreacionParte").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuCreacionParte'
    );

}


function grabarNuevaParte()
{
    // alert('funcion javascript');
    var valida = validacionCamposParte();
    if(valida)
        {
        // var itipo = document.getElementById('itipo').value;
        var isubtipo = document.getElementById('isubtipo').value;
        var capacidad = document.getElementById('capacidad').value;
        var cantidad = document.getElementById('cantidad').value;

        const http=new XMLHttpRequest();
        const url = 'partes/partes.php';
        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){
                document.getElementById("modalBodyCreacionParte").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=grabarNuevaParte'
        +'&isubtipo='+isubtipo
        +'&capacidad='+capacidad
        +'&cantidad='+cantidad
        );
    }
}


function validacionCamposParte()
{
    if( document.getElementById("itipo").value == '-1')
    {
        document.getElementById("itipo").focus();
        alert('Por favor escojer tipo');
        return 0;
    }

    if( document.getElementById("isubtipo").value == '-1' || document.getElementById("isubtipo").value == '')
    {
        document.getElementById("isubtipo").focus();
        alert('Por favor escojer subtipo');
        return 0;
    }
    if( document.getElementById("capacidad").value == '')
    {
        document.getElementById("capacidad").focus();
        alert('Por favor digitar capacidad');
        return 0;
    }
    if( document.getElementById("cantidad").value == '')
    {
        document.getElementById("cantidad").focus();
        alert('Por favor digitar cantidad');
        return 0;
    }
     
    return 1;

}

function formuAdicionarRestarCantidadParte(idParte,tipoMov)
{
        const http=new XMLHttpRequest();
        const url = 'partes/partes.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyCargarDescargarInventario").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=formuAdicionarRestarCantidadParte'
                  +'&idParte='+idParte
                  +'&tipoMov='+tipoMov
        );
}
function AdicionarRstarExisatenciasParte(idParte,tipoMov)
{
    var cantidad = document.getElementById('cantidad').value;
        const http=new XMLHttpRequest();
        const url = 'partes/partes.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyCargarDescargarInventario").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=AdicionarRstarExisatenciasParte'
                  +'&idParte='+idParte
                  +'&tipoMov='+tipoMov
                  +'&cantidad='+cantidad
        );
}

function buscarParteOSerial(tipoItem)
{
        // alert('aqui '); 
        const http=new XMLHttpRequest();
        const url = 'partes/partes.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyPedidoBuscarParteOSerial").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=buscarParteOSerial'
                  +'&tipoItem='+tipoItem
        );
}

function buscarParteAgregarItemPedido(idItem)
{
    // alert('idItem')+ idItem; 
    const http=new XMLHttpRequest();
    const url = 'partes/partes.php';
    http.onreadystatechange = function(){
        
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("modalBodyPedidoBuscarParteOSerial").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=buscarParteAgregarItemPedido'
    +'&idItem='+idItem
    );
}
function relacionarparteAItemPedido(idParte)
{
    var idItemAgregar = document.getElementById('idItemAgregar').value;
    // alert('idhardware '+ idHardware +' idItem '+ idItemAgregar );
    const http=new XMLHttpRequest();
    const url = 'partes/partes.php';
    http.onreadystatechange = function(){
        
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("div_buscar_hardwareOparte").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=relacionarparteAItemPedido'
    +'&idParte='+idParte
    +'&idItemAgregar='+idItemAgregar
    );
}

function filtrarBusquedaParteTipoParte()
{
    var idTipoParteFiltro = document.getElementById('idTipoParteFiltro').value;
    // alert('idhardware '+ idHardware +' idItem '+ idItemAgregar );
    const http=new XMLHttpRequest();
    const url = 'partes/partes.php';
    http.onreadystatechange = function(){
        
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("resultadosBuscarSeriales").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=filtrarBusquedaParteTipoParte'
    +'&idTipoParteFiltro='+idTipoParteFiltro
    );
}

