<?php
require_once('../model/Note.php');

class NoteDaoMysql implements NoteDAO {
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function all(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM notes");
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $item){
                $u = new Note();
                $u->id = $item['id'];
                $u->title = $item['title'];
                $u->body = $item['body'];

                $array[] = $u;
            }
        }

        return $array;
    }
    
    public function create(Note $note){
        $sql = $this->pdo->prepare("INSERT INTO notes(title,body) VALUES (:title,:body)");
        $sql->bindValue(':title', $note->title);
        $sql->bindValue(':body',$note->body);
        $sql->execute();

        return $this->pdo->lastInsertId();
    }
    public function show($id){
        $sql = $this->pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $note = new Note();
            $note->id = $data['id'];
            $note->title = $data['title'];
            $note->body = $data['body'];

            return $note;
        }

        return false;
    }
     public function update(Note $note){
         $sql = $this->pdo->prepare("UPDATE notes SET title = :title, body = :body WHERE id = :id");
         $sql->bindValue(':id', $note->id);
         $sql->bindValue(':title', $note->title);
         $sql->bindValue(':body', $note->body);
         $sql->execute();

         return true;

     }
    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            return true;
        }

        return false;
    }

    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}