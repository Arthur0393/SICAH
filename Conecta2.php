<?php

/**
 * @author Alfredo Mu�oz Xolocotzi IOCreations
 * @copyright 2009
 */
/*
$servidor='localhost';
$usuario='habitatbd';
$password='jNX4MR24pKd66Ddw';
$baseDatos='habitatbd';
*/


$servidor='localhost';
$usuario='uttlaxca_siseac';
$password='siseac2014';
$baseDatos='uttlaxca_siseac';


class Conexion {

    var $db_selected;
    var $dbmsMysql;

    function conectarBD() {

        global $servidor;
        global $usuario;
        global $password;
        global $baseDatos;

       


        $this->dbmsMysql = mysql_connect($servidor, $usuario, $password);
        if (!$this->dbmsMysql) {
            die('Imposible conectarse al DBMS: ' . mysql_error());
        }
        $this->db_selected = mysql_select_db($baseDatos, $this->dbmsMysql);
        if(!$this->db_selected) {
            die ('Imposible usar BD: ' .mysql_error());
        }
    }

    function seleccionarBD($BD) {
        $this->db_selected = mysql_select_db($BD, $this->dbmsMysql);
        if(!$this->db_selected) {
            die ('Imposible usar BD: ' .mysql_error());
        }
    }

    function consultar($sql) {
        $result = mysql_query($sql);
        if(!$result) {
            die('Consulta Inválida: ' .mysql_error());
        }
        return $result;
    }



    function buscar($sql) {
        $result = mysql_query($sql);
        if(!$result) {
            die('Busqueda Inválida: ' .mysql_error());
        }
        $num_rows = mysql_num_rows($result);//Numero de filas
        //$num_rows = mysql_num_fields($result);//Numero de columnas
        if($num_rows != 0) {
            return 1; //1 -> Existe
        }
        else {
            return 0;//0 -> No Existe
        }
    }

    function insertar($sql) {
        $result = mysql_query($sql);
        if(!$result) {
            die('Inserción Inválida: ' .mysql_error());
        }
        return $result;
    }

    function actualizar($sql) {
        $result = mysql_query($sql);
        if(!$result) {
            die('Actualización Inválida: ' .mysql_error());
        }
        return $result;
    }

    function borrar($sql) {
        $result = mysql_query($sql);
        if(!$result) {
            die('Eliminación Inválida: ' .mysql_error());
        }
        return $result;
    }

    function ultimoID() {
        return $id = mysql_insert_id();
    }






}










?>

