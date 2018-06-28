<?php
require_once 'db.php';

class Alicuota{
	private $db;
	private $alicuota;

	public function __construct(){
		$this->db=db::conexion();
		$this->alicuota=array();
	}

	//Metodos CRUD
	public function addAlicuota($alicuota, $monto){
        $sql = "INSERT INTO alicuotas(id_alicuota, alicuota, monto)VALUES(
            NULL, '{$alicuota}', '{$monto}')";
            return $this->db->query($sql);
    }

    public function getAlicuota(){
        $sql = $this->db->query("SELECT * FROM alicuotas");
        while($filas = $sql->fetch_assoc()){
            $this->alicuota[] = $filas;
        }
        return $this->alicuota;
    }

    public function getAlicuotaId($id_alicuota){
        $sql = $this->db->query("SELECT * FROM alicuotas WHERE id_alicuota = '{$id_alicuota}'");
        while($filas = $sql->fetch_assoc()){
            $this->alicuota[] = $filas;
        }
        return $this->alicuota;
    } 

    public function editAlicuota($id_alicuota, $alicuota, $monto){
        $sql = "UPDATE alicuotas SET alicuota='{$alicuota}', monto='{$monto}'
                  WHERE id_alicuota='{$id_alicuota}'";
        return $this->db->query($sql);
    }
    public function delAlicuota($id_alicuota){
        $sql = "DELETE FROM alicuotas WHERE id_alicuota={$id_alicuota}";
        return $this->db->query($sql);
    }
}