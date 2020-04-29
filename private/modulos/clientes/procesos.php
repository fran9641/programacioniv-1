<?php 
include('../../config/config.php');
$clientes = new clientes($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$clientes->$proceso( $_GET['clientes'] );
print_r(json_encode($clientes->respuesta));

class clientes{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($clientes){
        $this->datos = json_decode($clientes, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del cliente';
        }
        if( empty($this->datos['direccion']) ){
            $this->respuesta['msg'] = 'por favor ingrese la direccion del cliente';
        }
        if( empty($this->datos['telefono']) ){
            $this->respuesta['msg'] = 'por favor ingrese la telefono del cliente';
        }
        $this->almacenar_clientes();
    }
    private function almacenar_clientes(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO clientes (nombre,direccion,telefono,dui) VALUES(
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['direccion'] .'",
                        "'. $this->datos['telefono'] .'",
                        "'. $this->datos['dui'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE clientes SET
                        nombre     = "'. $this->datos['nombre'] .'",
                        direccion  = "'. $this->datos['direccion'] .'",
                        telefono   = "'. $this->datos['telefono'] .'",
                        dui   = "'. $this->datos['dui'] .'"
                    WHERE idCliente = "'. $this->datos['idCliente'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarCliente($valor = ''){
        $this->db->consultas('
            select clientes.idCliente, clientes.nombre, clientes.direccion, clientes.telefono, clientes.dui
            from clientes
            where clientes.nombre like "%'. $valor .'%"  or clientes.telefono like "%'. $valor .'%" or clientes.dui like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarCliente($idCliente = 0){
        $this->db->consultas('
            DELETE clientes
            FROM clientes
            WHERE clientes.idCliente="'.$idCliente.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';
    }
}
?>