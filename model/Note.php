<?php


class Note {
    
}

interface NoteDAO {
    public function all();
    public function create(Note $n);
    public function findById($id);
    public function show($id);
    public function update(Note $n);
    public function delete($id);


}