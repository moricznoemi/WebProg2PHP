<?php
class Allat {
    public $id;
    public $nev;
    public $katid;
    public $kategorianev;

    public function __construct($id, $nev, $katid, $kategorianev) {
        $this->id = $id;
        $this->nev = $nev;
        $this->katid = $katid;
        $this->kategorianev = $kategorianev;
    }
}

class Kategoria {
    public $id;
    public $nev;
    

    public function __construct($id, $nev) {
        $this->id = $id;
        $this->nev = $nev;
        
    }
}
