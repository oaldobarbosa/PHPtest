 <?php

include_once "../Database/Conexao.php";

$cep = $_REQUEST['cep'];

$dados = readUnit($cep);

if (isset($dados['cep']) == $cep) {

    echo '<div class="msg">
            <div class="alert alert-success" role="alert">
                <h3><i class="far fa-laugh-beam"></i> CEP encontrado!</h3>
            </div>
        </div>';
    
    echo "<div class='dadosCep'>";
        
        echo "<p class='line'><label class='key'>CEP: </label>{$dados['cep']}</p>";

        if (isset($dados['longradouro'])) {
            echo "<p class='line'><label class='key'>LONGRADOURO: </label>{$dados['longradouro']}</p>";
        }
        if (isset($dados['complemento'])) {
            echo "<p class='line'><label class='key'>COMPLEMENTO: </label>{$dados['complemento']}</p>";
        }
        if (isset($dados['bairro'])) {
            echo "<p class='line'><label class='key'>BAIRRO: </label>{$dados['bairro']}</p>";
        }
        
        echo "<p class='line'><label class='key'>LOCALIDADE: </label>{$dados['localidade']}</p>";
        echo "<p class='line'><label class='key'>UF: </label>{$dados['uf']}</p>";
        echo "<p class='line'><label class='key'>IBGE: </label>{$dados['ibge']}</p>";
        
        if (isset($dados['gia'])) {
            echo "<p class='line'><label class='key'>GIA: </label>{$dados['gia']}</p>";
        }
        
        echo "<p class='line'><label class='key'>DDD: </label>{$dados['ddd']}</p>";
        echo "<p class='line'><label class='key'>SIAFI: </label>{$dados['siafi']}</p>";
        
    echo "</div>";


} else {
    $url = "https://viacep.com.br/ws/$cep/xml/";
    $xml = simplexml_load_file($url);

    if (isset($xml->erro) && $xml->erro == 'true') {
        echo '<div class="msg">
            <div class="alert alert-danger" role="alert">
                <h3><i class="far fa-sad-tear"></i> Que Pena, nenhum CEP encontrado!</h3>
            </div>
        </div>';
    } else {

        create($xml);

        echo '<div class="msg">
            <div class="alert alert-success" role="alert">
                <h3><i class="far fa-laugh-beam"></i> CEP encontrado!</h3>
            </div>
        </div>';

        echo "<div class='dadosCep'>";

            echo "<p class='line'><label class='key'>CEP: </label>{$xml->cep}</p>";

            if ($xml->longradouro != "") {
                echo "<p class='line'><label class='key'>LONGRADOURO: </label>{$xml->longradouro}</p>";
            }
            if ($xml->complemento != '') {
                echo "<p class='line'><label class='key'>COMPLEMENTO: </label>{$xml->complemento}</p>";
            }
            if ($xml->bairro != '') {
                echo "<p class='line'><label class='key'>BAIRRO: </label>{$xml->bairro}</p>";
            }
            
            echo "<p class='line'><label class='key'>LOCALIDADE: </label>{$xml->localidade}</p>";
            echo "<p class='line'><label class='key'>UF: </label>{$xml->uf}</p>";
            echo "<p class='line'><label class='key'>IBGE: </label>{$xml->ibge}</p>";
            
            if ($xml->gia != '') {
                echo "<p class='line'><label class='key'>GIA: </label>{$xml->gia}</p>";
            }
            
            echo "<p class='line'><label class='key'>DDD: </label>{$xml->ddd}</p>";
            echo "<p class='line'><label class='key'>SIAFI: </label>{$xml->siafi}</p>";
            
        echo "</div>";

    }
}

//read
function readUnit($cep){
    try {
        //var_dump((int)$cep);
        $sql = "SELECT * FROM dadosCep WHERE cep = :cep";
        $p_sql = Conexao::getConexao()->prepare($sql);
        $p_sql->bindValue(":cep", $cep);	        
        $p_sql->execute();
        $result = $p_sql->fetch();

        return $result;

    } catch (Exception $e) {
        print "Erro ao buscar CEP";
    }

}

//create
function create($xml){
    
    try {
        $sql = "INSERT INTO dadosCep(cep, longradouro, complemento, bairro, localidade, uf, ibge, gia, ddd, siafi) VALUES(:cep, :longradouro, :complemento, :bairro, :localidade, :uf, :ibge, :gia, :ddd, :siafi)";
        $p_sql = Conexao::getConexao()->prepare($sql);

        $cep = str_replace("-", "", $xml->cep);

        $p_sql->bindValue(":cep", $cep);
        $p_sql->bindValue(":longradouro", $xml->longradouro);
        $p_sql->bindValue(":complemento", $xml->complemento);
        $p_sql->bindValue(":bairro", $xml->bairro);
        $p_sql->bindValue(":localidade", $xml->localidade);
        $p_sql->bindValue(":uf", $xml->uf);
        $p_sql->bindValue(":ibge", $xml->ibge != "" ? $xml->ibge : null);
        $p_sql->bindValue(":gia", $xml->gia != "" ? $xml->gia : null );
        $p_sql->bindValue(":ddd", $xml->ddd != "" ? $xml->ddd : null);
        $p_sql->bindValue(":siafi", $xml->siafi != "" ? $xml->siafi : null);

        return $p_sql->execute();

    } catch (Exception $e) {
        print "Erro ao inserir CEP" . $e;	
    }

}
