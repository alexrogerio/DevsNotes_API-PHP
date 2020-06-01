<?php
require('../config.php');
require('../dao/NoteDaoMysql.php');

$note = new NoteDaoMysql($pdo);
$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'get'){
    if(count($note->all()) > 0){
        $data = $note->all();

        foreach($data as $item){
            $array['result'][] = [
                'id' => $item->id,
                'title' => $item->title,
                'body' => $item->body
            ];
            
        }
    }else{
        $array['error'] = 'Tabela Vazia';

    }
    
}else{
    $array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');