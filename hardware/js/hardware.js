function formularioSubirArchivo()
{
    // alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = 'hardware/hardware.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodySubirArchivo").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formularioSubirArchivo'
    );

}
// const btnEnviar = document.querySelector("#btnEnviar");
// const inputFile = document.querySelector("#imagen");
function realizarCargaArchivo()
{
    var inputFile = document.getElementById('imagen');

    if (inputFile.files.length > 0) {
        let formData = new FormData();
        formData.append("file", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
        formData.append("opcion", 'cargarArchivo'); // En la posición 0; es decir, el primer elemento
        // fetch("cargues/cargues.php", {
        fetch("cargues/cargar_stickers.php", {
            method: 'POST',
            body: formData,
        })
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                console.log(decodificado.archivo);
                document.getElementById("div_cargue_archivo").innerHTML = 'Cargue Realizado!!';
            });
    } else {
        alert("Selecciona un archivo");
    }
}

// const btnEnviar = document.querySelector("#btnEnviar");
// const inputFile = document.querySelector("#imagen");

btnEnviar.addEventListener("click", () => {
    console.log('passoooo11111'); 
    if (inputFile.files.length > 0) {
        let formData = new FormData();
        formData.append("archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
        console.log('llego aqui'); 
        fetch("cargues/cargues.php", {
            method: 'POST',
            body: formData,
        })
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                // alert(decodificado);
                console.log(decodificado.archivo);
                document.getElementById("demo").innerHTML = 'ya termino!!';
            });
    } else {
        // El usuario no ha seleccionado archivos
        alert("Selecciona un archivo");
    }
});


function verHardware(id)
{
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyHardwareMostrar").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=verHardware'
                    +'&id='+id
                );
}

function quitarRam(idHardware,idRam)
{
     let response = confirm("Esta seguro que desea quitar la ram de este hardware");
    // alert(response);
    // alert(idHardware + idRam);
    if(response == 1)
    {
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyAgregarRam").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=quitarRam'
                  +'&idHardware='+idHardware
                  +'&idRam='+idRam
        );
    }

}
function agregarRam(idHardware)
{
     let response = confirm("Esta seguro que desea Agregar la ram a este hardware");
    // alert(response);
    // alert(idHardware + idRam);
    if(response == 1)
    {
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyAgregarRam").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=agregarRam'
                  +'&idHardware='+idHardware
        );
    }

}

function quitarDisco(idHardware,idDisco)
{
    // alert(idDisco);
    let response = confirm("Esta seguro que desea quitar el disco de este hardware");
    // alert(response);
    // alert(idHardware + idRam);
    if(response == 1)
    {
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyAgregarRam").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=quitarDisco'
                  +'&idHardware='+idHardware
                  +'&idDisco='+idDisco
        );
    }
}
function formuAgregarRam(idHardware,numeroRam)
{
        // alert(idHardware);
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyAgregarRam").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=formuAgregarRam'
                  +'&idHardware='+idHardware
                  +'&numeroRam='+numeroRam
        );
    
}
function agregarMemoriaRam(idHardware,idRam)
{
    let response = confirm("Esta seguro que desea agregar esta parte?");
    if(response == 1)
    {
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyAgregarRam").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=agregarMemoriaRam'
                  +'&idHardware='+idHardware
                  +'&idRam='+idRam
        );
    }
}
function agregarDisco(idHardware,idDisco)
{
    let response = confirm("Esta seguro que desea  agregar esta parte?");
    if(response == 1)
    {
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyAgregarRam").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=agregarDisco'
                  +'&idHardware='+idHardware
                  +'&idDisco='+idDisco
        );
    }
}


function formuAgregarDisco(idHardware)
{
   
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyAgregarRam").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=formuAgregarDisco'
                  +'&idHardware='+idHardware
        );
    
}
function formuDividirRam(idHardware)
{
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyDividirRam").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=formuDividirRam'
        +'&idHardware='+idHardware
        );
        
    }
    
function agregarTemporalDividirMemoria(idHardware)
{
    // alert('tempoiral');
    var valida = validarCamposAgregarRam();
    if(valida)
    {
        var idSubTipoRamHardware = document.getElementById('idSubTipoRamHardware').value;
        var capacidadRamHardware = document.getElementById('capacidadRamHardware').value;
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
            
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_resultados_dividir_ram").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=agregarTemporalDividirMemoria'
        +'&idHardware='+idHardware
        +'&idSubTipoRamHardware='+idSubTipoRamHardware
        +'&capacidadRamHardware='+capacidadRamHardware
        );
        document.getElementById('idSubTipoRamHardware').value = -1;
        document.getElementById('capacidadRamHardware').value = '' ;
    }
}

    

function validarCamposAgregarRam()
{
    if( document.getElementById("idSubTipoRamHardware").value == '-1')
    {
        document.getElementById("idSubTipoRamHardware").focus();
        alert('Por favor escojer tipo de ram');
        return 0;
    }

    if( document.getElementById("capacidadRamHardware").value == '')
    {
        document.getElementById("capacidadRamHardware").focus();
        alert('Por favor digitar capacidad');
        return 0;
    }
return 1;
}   

function registrarRamDividaHardware(idHardware)
{
    const http=new XMLHttpRequest();
    const url = 'hardware/hardware.php';
    http.onreadystatechange = function(){
        
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("modalBodyDividirRam").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=registrarRamDividaHardware'
    +'&idHardware='+idHardware
    );
}



function formuNuevoHardware()
{
//    alert('buenas ');
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("modalBodyNuevoHardware").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=formuNuevoHardware'
                //   +'&idHardware='+idHardware
        );
    
 }

function grabarNuevoHardware()
{
    // alert('grabar');
    var valida = validacionCamposNuevoHardware();
    if(valida)
    {

        var itipo = document.getElementById('itipo').value;
        var isubtipo = document.getElementById('isubtipo').value;
        var idImportacion = document.getElementById('idImportacion').value;
        var lote = document.getElementById('lote').value;
        var serial = document.getElementById('serial').value;
        var marca = document.getElementById('marca').value;
        var chasis = document.getElementById('chasis').value;
        var modelo = document.getElementById('modelo').value;
        var pulgadas = document.getElementById('pulgadas').value;
        var procesador = document.getElementById('procesador').value;
        var generacion = document.getElementById('generacion').value;
        
        const http=new XMLHttpRequest();
        const url = 'hardware/hardware.php';
        http.onreadystatechange = function(){
            
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("modalBodyNuevoHardware").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=grabarNuevoHardware'
        +'&itipo='+itipo
        +'&isubtipo='+isubtipo
        +'&idImportacion='+idImportacion
        +'&lote='+lote
        +'&serial='+serial
        +'&marca='+marca
        +'&chasis='+chasis
        +'&modelo='+modelo
        +'&pulgadas='+pulgadas
        +'&procesador='+procesador
        +'&generacion='+generacion
        );
    }
        
 }


function validacionCamposNuevoHardware()
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
    if( document.getElementById("idImportacion").value == '')
    {
        document.getElementById("idImportacion").focus();
        alert('Por favor digitar idImportacion');
        return 0;
    }
    if( document.getElementById("lote").value == '')
    {
        document.getElementById("lote").focus();
        alert('Por favor digitar lote');
        return 0;
    }
  
    if( document.getElementById("serial").value == '')
    {
        document.getElementById("serial").focus();
        alert('Por favor digitar serial');
        return 0;
    }
  
    if( document.getElementById("marca").value == '-1')
    {
        document.getElementById("marca").focus();
        alert('Por favor escoja la  marca');
        return 0;
    }
  
    if( document.getElementById("chasis").value == '-1')
    {
        document.getElementById("chasis").focus();
        alert('Por favor digite el   chasis');
        return 0;
    }
  
    if( document.getElementById("modelo").value == '')
    {
        document.getElementById("modelo").focus();
        alert('Por favor digitar modelo');
        return 0;
    }
  
    return 1;

}