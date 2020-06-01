<?php
require('../config.php');
require('../dao/NoteDaoMysql.php');

$note = new NoteDaoMysql($pdo);
$method = strtolower($_SERVER['REQUEST_METHOD']);
$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'put'){
    parse_str(file_get_contents('php://input'),$input);
    $id = filter_var($input['id'] ?? null);
    $title = filter_var($input['title'] ?? null);
    $body = filter_var($input['body'] ?? null);

    if($id && $title && $body){
        if($note->findById($id)){
            $new = new Note();
            $new->id = $id;
            $new->title = $title;
            $new->body = $body;
            $note->update($new);

            $array['result'][] = [
                'id'=>$id,
                'title'=>$title,
                'body' =>$body
            ];
        }else {
            $array['error'] = 'ID não encontrado';
        }
    }else {
        $array['error'] = 'Campos não enviados';
    }

}else{
    $array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');