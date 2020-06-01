<?php
require('../config.php');
require('../dao/NoteDaoMysql.php');

$note = new NoteDaoMysql($pdo);
$novoNote = new Note();

$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'post'){

    $title = filter_input(INPUT_POST,'title');
    $body = filter_input(INPUT_POST,'body');

    if($title && $body){
       
            $novoNote = new Note();
            $novoNote->title = $title;
            $novoNote->body = $body;
            $id = $note->create($novoNote);

            $array['result'][] = [
                'id'=>$id,
                'title'=>$title,
                'body' =>$body
            ];

    }else {
        $array['error'] = 'Campos inválidos';
    }
}else{
    $array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');