function pedirInfoUsuario()
{
    // alert('verificando credenciales');
    const http=new XMLHttpRequest();
    const url = 'users/users.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyUsuario").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pedirInfoUsuario'
    );

    //  verificarCredencialesJsonAsignarSessionStorage(user,clave);
}
function crearUsuario()
{
    var valida =  validaInfoUsuario();
    // alert(valida);
    if(valida == '1')
    {
        // alert('validacion correcta');
        var nombreUsuario = document.getElementById('nombreUsuario').value;
        var apellidoUsuario = document.getElementById('apellidoUsuario').value;
        var password = document.getElementById('password').value;
        var email = document.getElementById('email').value;
        const http=new XMLHttpRequest();
        const url = 'users/users.php';
        http.onreadystatechange = function(){
            
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyUsuario").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=crearUsuario'
                    +'&nombreUsuario='+nombreUsuario
                    +'&apellidoUsuario='+apellidoUsuario
                    +'&password='+password
                    +'&email='+email
                );
                
    }
}
function  validaInfoUsuario()
{
    if( document.getElementById('nombreUsuario').value == ''){
        alert('Por favor digitar nombre usuario');
        document.getElementById('nombreUsuario').focus();
        return 0;
    }
    if( document.getElementById('apellidoUsuario').value == ''){
        alert('Por favor digitar apellido usuario');
        document.getElementById('apellidoUsuario').focus();
        return 0;
    }
    if( document.getElementById('password').value == ''){
        alert('Por favor digitar password ');
        document.getElementById('password').focus();
        return 0;
    }
    if( document.getElementById('email').value == ''){
        alert('Por favor digitar email ');
        document.getElementById('email').focus();
        return 0;
    }

    return 1;
}

function mostrarUsuarios()
{
    
}




