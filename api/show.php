<?php
require('../config.php');
require('../dao/NoteDaoMysql.php');

$note = new NoteDaoMysql($pdo);

$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'get'){

    $id = filter_input(INPUT_GET,'id');
    

    if($id){
        if($note->findById($id) === true){
            $data = $note->show($id);

            $array['result'][] = [
                'id' => $data->id,
                'title' => $data->title,
                'body' => $data->body
            ];
        }else{
            $array['error'] = 'ID não existe';
        }

    }else {
        $array['error'] = 'ID não preenchido';
    }
}else{
    $array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');