
function buscarCep() {
    
    let cep = document.getElementById('inputCep').value;
    
    var validacep =/^[0-9]+$/;

    responseField = document.getElementById('response')

    if (String(cep).length == 8 && cep.match(validacep)) {

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {   
        
            if(this.response.length == 89) {     
                response = `
                    <div class="alert alert-danger" role="alert">
                        <h3><i class="far fa-sad-tear"></i> Que Pena, nenhum CEP encontrado!</h3>
                    </div>
                `;
            }else{
                response = this.response
            }    
        }
        xmlhttp.open('GET', './app/controller/Endereco.php?cep=' + cep, true)
        xmlhttp.send()

        timeOut();

    } else {
        alert('Digite o cep corretamente.\nExemplo: 46430000.')
    }
    
}

document.getElementById( 'imgCarregando' ).style.display = 'none';
function timeOut(){ 
    responseField.innerHTML = "";
    document.getElementById( 'imgCarregando' ).style.display = 'block';       
    setTimeout(function () {
        document.getElementById( 'imgCarregando' ).style.display = 'none';             
        responseField.innerHTML = ""
        responseField.innerHTML = response
    }, 2000);
}