<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b4a99a93aa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app/public/style.css">
    <title>Buscador de CEP - PHPtest CD2</title>
</head>
<body>
    <div class="container">

        <h1><i class="fas fa-map-marked"></i> BUSCADOR DE CEP</h1>
        <p class="subtitle">Busque dados do CEP desejado digitando-o logo abaixo ;)</p>

        <div class="row campoBusca">
            <div class="col-md-6">
                <div class="input-group">
                    <input class="form-control" type="number" id="inputCep" placeholder="Ex: 46430000" />
                    <div class="input-group-btn">
                        <button style="margin-left: 10px;" onclick="buscarCep()" class="btn btn-success" type="button">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="carregando">
            <img src="app/public/img/carregando.gif" alt="carregando" id="imgCarregando">
        </div>
        <div id="response" class="col-md-06">
        </div>       
        
    </div>

    <footer class="text-center text-white" style="background-color: #101C3B;">   
        
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">            
            <a class="text-white iconF" href="https://www.linkedin.com/in/oaldobarbosa/"><i class="fab fa-linkedin"></i></a>
            <a class="text-white iconF" href="https://github.com/oaldobarbosa"><i class="fab fa-github-square"></i></a>
        </div>
        
    </footer>
</body>
<script src="app/public/scripts.js"></script>
</html>
