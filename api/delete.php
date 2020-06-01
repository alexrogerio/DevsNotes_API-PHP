<?php
require('../config.php');
require('../dao/NoteDaoMysql.php');

$note = new NoteDaoMysql($pdo);
$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'delete'){
    parse_str(file_get_contents('php://input'),$input);
    $id = filter_var($input['id'] ?? null);

    if($id){
        $note->delete($id);
    }else {
        $array['error'] = 'ID não enviado';
    }


}else{
    $array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');