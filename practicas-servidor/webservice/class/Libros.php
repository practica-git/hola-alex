<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Libros
 *
 * @author daw
 */
require_once 'Tabla.php';

class Libros extends Tabla {
    
    private $id;
    private $titulo;
    private $autor;
    private $paginas;
    private $isbn;
    private $num_fields = 5;
    
    public function __construct()
    {
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("Libros", "Id", $fields);
    }

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAutor() {
        return $this->autor;
    }

    function getPaginas() {
        return $this->paginas;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getNum_fields() {
        return $this->num_fields;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setPaginas($paginas) {
        $this->paginas = $paginas;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setNum_fields($num_fields) {
        $this->num_fields = $num_fields;
    }

    function __get($name)
    {
        $metodo = "get$name";
        if (method_exists($this, $metodo)) {
            return $this->$metodo();
        } else {
            throw new Exception("Propiedad no encontrada");
        }
    }

    function __set($name, $value)
    {
        $metodo = "set$name";
        if (method_exists($this, $metodo)) {
            return $this->$metodo($value);
        } else {
            throw new Exception("Propiedad no encontrada");
        }
    }
        
    function tocho() {
        try {
            
            $res = self::$conn->query("SELECT * FROM Libros WHERE Paginas = (SELECT MAX(Paginas) FROM Libros);");
            return $res->fetch(PDO::FETCH_ASSOC);
            
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }
    
    function obras($nombre) {
        
        try {
            
            $res = self::$conn->query("SELECT * FROM Libros WHERE Autor = '". $nombre . "'");
            return $res->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        
    }
}
