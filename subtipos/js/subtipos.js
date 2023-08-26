function buscarSuptiposParaSelect()
{
    var itipo = document.getElementById('itipo').value;
    // alert('funcion javascript para buscar suptipos');
    const http=new XMLHttpRequest();
    const url = 'subtipos/subtipos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("isubtipo").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=buscarSuptiposParaSelect'
    +'&itipo='+itipo
    );

}