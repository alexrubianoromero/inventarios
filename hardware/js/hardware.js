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
function formuAgregarRam(idHardware)
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
        http.send('opcion=formuAgregarRam'
                  +'&idHardware='+idHardware
        );
    
}
function agregarMemoriaRam(idHardware,idRam)
{
    let response = confirm("Esta seguro que desea quitar este disco?");
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
    let response = confirm("Esta seguro que desea quitar este disco?");
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



