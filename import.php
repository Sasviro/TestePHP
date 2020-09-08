<?php
	$conn = new mysqli("localhost", "root", "","testesuportephp");
    mysqli_set_charset($conn,"utf8");

	$arquivo 	= $_FILES["file"]["tmp_name"];
	$nome		= $_FILES["file"]["name"];
	
	$ext 	 	= explode(".", $nome);
	
	$extensao = end($ext);
		if($extensao != "csv"){
			echo "Extensão Inválida";
		}else{
	$objeto = fopen($arquivo, 'r');
		while(($dados = fgetcsv($objeto, 1000, ";")) !== FALSE)
		{
			$nome  = utf8_encode($dados[0]);
			$descricao_id  = utf8_encode($dados[1]);
			$valor  = utf8_encode($dados[2]);
			
			$result = $conn->query("INSERT INTO produtos(nome, descricao_id, valor) VALUES('$nome', '$descricao_id', '$valor')");
			
		}
		if($result){
			echo "Dados Inseridos";
		}else{
			echo "Erro na Inserção";
		}
	}
?>