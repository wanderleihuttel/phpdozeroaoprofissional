<?php
require_once("contato.php");
echo "<pre>";

$contato = new Contato();


// Adicionar contato
if($contato->adicionar('wanderlei@gmail.com', 'Wanderlei')){
    echo "Contato adicionado com sucesso!\n";
}
if($contato->adicionar('fabiane@gmail.com')){
    echo "Contato adicionado com sucesso!\n";   
}

if($contato->adicionar('fulane@hotmail.com')){
    echo "Contato adicionado com sucesso!\n";
}

// getNome
$nome = $contato->getNome('wanderlei@gmail.com');
echo "Nome: " .$nome . "\n";

// getAll
$lista = $contato->getAll();
print_r($lista);

//Editar
if($contato->editar('Fulano', 'fulane@hotmail.com')){
    echo "Contato alterado com sucesso!\n";
}
if($contato->editar('Wanderlei', 'wanderlei@gmail.com')){
    echo "Contato alterado com sucesso!\n";
}

// excluir
if($contato->excluir('fabiane@gmail.com.br')){
    echo "Contato excluido com sucesso!\n";
}
if($contato->excluir('wanderlei@gmail.com')){
    echo "Contato excluido com sucesso!\n";
}
