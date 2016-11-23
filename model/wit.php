<?php

  # Incluimos la clase de conexion
  require_once('Conexion.php');


  class Wit extends Conexion
  {

    public function experiencia($id)
    {
      parent::conectar();
      $datos = array();
      $consulta = parent::query('select name_business, sector, position, country from experiencia where usuario_id="'.$id.'"');
      while($row = mysqli_fetch_array($consulta)){
        $datos[] = array($row['name_business'], $row['sector'], $row['position'], $row['country']);
      }
      return $datos;
      parent::cerrar();
    }

    public function aptitudes($id)
    {
      parent::conectar();
      $datos = array();
      $consulta = parent::query('select descripcion from habilidades where usuario_id="'.$id.'"');
      while($row = mysqli_fetch_array($consulta)){
        $datos[] = $row['descripcion'];
      }
      return $datos;
      parent::cerrar();
    }

    public function brain($id)
    {
      parent::conectar();
      $datos = array();
      $consulta = parent::query('select descripcion from brain where usuario_id="'.$id.'"');
      while($row = mysqli_fetch_array($consulta)){

        if($row['descripcion'] == 'Proyectos innovadores'){
          $datos[0] = true;
        }else if($row['descripcion'] == 'Mentoring'){
          $datos[1] = true;
        }else if($row['descripcion'] == 'Asesoramiento'){
          $datos[2] = true;
        }else if($row['descripcion'] == 'Formaci&oacuten'){
          $datos[4] = true;
        }else if($row['descripcion'] == 'Contenidos'){
          $datos[4] = true;
        }

      }

      if(!isset($datos[0])){
        $datos[0] = false;
      }

      if(!isset($datos[1])){
        $datos[1] = false;
      }

      if(!isset($datos[2])){
        $datos[2] = false;
      }

      if(!isset($datos[3])){
        $datos[3] = false;
      }

      if(!isset($datos[4])){
        $datos[4] = false;
      }

      return $datos;
      parent::cerrar();
    }

    public function contacto($id)
    {
      parent::conectar();
      $datos = array();

      $sql = parent::query('select * from contacto where usuario_id="'.$id.'"');

      while($row = mysqli_fetch_array($sql)){
        $datos[] = array(
                          $row['imagen'],
                          $row['ciudad'],
                          $row['tel'],
                          $row['des'],
                          $row['tweets']
                        );
      }

      return $datos;

      parent::cerrar();
    }

    public function idiomas($id)
    {
      parent::conectar();
      $datos = '';
      $consulta = parent::query('select DISTINCT(des) from idiomas where usuario_id="'.$id.'"');
      while($row = mysqli_fetch_array($consulta)){
        $datos .= $row['des'] . ', ';
      }

      $datos = substr($datos, 0, -2);

      return $datos;
      parent::cerrar();
    }

    public function usuario($id)
    {
      parent::conectar();
      $datos = array();
      $wit = parent::consultaArreglo('select * from usuario where id="'.$id.'"');

      $nombres = $wit['primer_nombre'] . ' ' . $wit['segundo_nombre'];
      $apellidos = $wit['primer_apellido'] . ' ' . $wit['segundo_apellido'];

      $pais = parent::consultaArreglo('select pais, imagen from contacto where usuario_id="'.$id.'"');

      $datos = array(
          'nombres'   => $nombres,
          'apellidos' => $apellidos,
          'imagen'    => $pais['imagen'],
          'email'     => $wit['email'],
          'pais'      => $pais['pais']
      );

      return $datos;

      parent::cerrar();
    }

    public function getWitsAprobados()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select id, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido from usuario where estado ="A"');
      while($row = mysqli_fetch_array($sql)){

        # Extraemos la ciudad y el pais
        $contacto = parent::consultaArreglo('select ciudad, pais from contacto where usuario_id="'.$row['id'].'"');
        $nombres = $row['primer_nombre'] . ' ' . $row['segundo_nombre'];
        $apellidos = $row['primer_apellido'] . ' ' . $row['segundo_apellido'];

        $datos[] = array($row['id'], $nombres, $apellidos, $contacto['ciudad'], $contacto['pais']);
      }
      return $datos;
      parent::cerrar();
    }

    # Extra el estado de la mente a la carta
    public function estado($id)
    {
      parent::conectar();
      parent::salvar($id);
      $estado = parent::consultaArreglo('select estado from usuario where id="'.$id.'"');
      return $estado['estado'];
      parent::cerrar();
    }

    # Valida si el usuario existe o no
    public function validarPerfil($id)
    {
      parent::conectar();
      $id = parent::salvar($id);
      $validar = parent::verificarRegistros('select id from usuario where id ="'.$id.'" and cargo="2"');
      if($validar > 0)
      {
        return true;
      }else{
        return false;
      }
      parent::cerrar();
    }


    # Extrae el nombre de la empresa
    public function getNameEmpresas(){
      parent::conectar();
      $datos = array();
      $sql = 'select id, name_business from experiencia where usuario_id="'.$_SESSION['id'].'" order by id desc';
      $verificar = parent::verificarRegistros($sql);
      if($verificar > 0){
        $consulta = parent::query($sql);

        while($row = mysqli_fetch_array($consulta)){
          $datos[] = array($row['id'], $row['name_business']);
        }
        return $datos;
      }else{
        return 0;
      }

      parent::cerrar();
    }

    # Carga los datos de la empresa
    public function loadEmpresa($id)
    {
      parent::conectar();
      $id = parent::salvar($id);
      $datos = array();
      // Validamos con id y con id de usuario por seguridad a algun hackeo
      $verificar = parent::verificarRegistros('select id from experiencia where id="'.$id.'" and usuario_id="'.$_SESSION['id'].'"');

      if($verificar > 0){
        $empresa = parent::consultaArreglo('select * from experiencia where id="'.$id.'"');

        $datos['identificador']  = $empresa['id'];
        $datos['nombre']         = $this->recuperar($empresa['name_business']);
        $datos['sector']         = $this->recuperar($empresa['sector']);
        $datos['cargo']          = $this->recuperar($empresa['position']);
        $datos['ciudad']         = $this->recuperar($empresa['country']);
        $datos['error']          = false;
      }else{
        $datos['error'] = true;
      }

      echo json_encode($datos);

      parent::cerrar();
    }

    public function recuperar($string){
      $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
      $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');

      $res = str_replace($buscar, $reemplazar, $string);

      return $res;
    }

    # Valida si el id enviado pertenece al usuario logueado
    public function esMiId($id){
      parent::conectar();
      $id = parent::salvar($id);

      if($id == 0){
        return true;
      }else{

        $verificar = parent::verificarRegistros('select id from experiencia where id="'.$id.'" and usuario_id="'.$_SESSION['id'].'"');

        if($verificar > 0 ){
          // Si es tu id
          return true;
        }else{
          // No es tu id
          return false;
        }

      }

      parent::cerrar();
    }


    # Registra o actualiza una experiencia
    public function setExperiencia($id, $empresa, $sector, $cargo, $pais)
    {
      parent::conectar();
      // FIltramos los datos de hackeo o mayusculas o acentos
      $id = parent::filtrar($id);
      $empresa = parent::filtrar($empresa);
      $sector = parent::filtrar($sector);
      $cargo = parent::filtrar($cargo);
      $pais = parent::filtrar($pais);

      if($id == 0){
        // Registrar
        $verificar = parent::query('insert into experiencia(name_business, sector, position, country, usuario_id) values("'.$empresa.'", "'.$sector.'", "'.$cargo.'", "'.$pais.'", "'.$_SESSION['id'].'")');
        $this->getExperiencia();
      }else{
        // Actualizar
        $verificar = parent::query('update experiencia set name_business="'.$empresa.'", sector = "'.$sector.'", position = "'.$cargo.'",  country= "'.$pais.'" where id="'.$id.'" and usuario_id="'.$_SESSION['id'].'"');
        $this->getExperiencia();
      }

      parent::cerrar();
    }

    public function getExperiencia()
    {
      $sql = parent::query('select id, name_business from experiencia where usuario_id="'.$_SESSION['id'].'" order by id desc');
      while($row = mysqli_fetch_array($sql)){
        echo '
        <tr>
          <td>'.ucfirst($row['name_business']).'</td>
          <td><i class="fa fa-pencil text-grey" aria-hidden="true"></i> <span class="underline text-grey editar_empresa" id="'.$row['id'].'">Editar</span></td>
          <td><i class="fa fa-trash text-grey" aria-hidden="true"></i> <span class="underline text-grey eliminar_empresa" id="'.$row['id'].'">Eliminar</span></td>
        </tr>
        ';
      }
    }


    public function deleteExperiencia($id)
    {
      parent::conectar();
      $id = parent::salvar($id);
      $verificar = parent::verificarRegistros('select id from experiencia where id="'.$id.'" and usuario_id="'.$_SESSION['id'].'"');
      if($verificar > 0){

        // Borrar
        $sql = parent::query('delete from experiencia where id="'.$id.'" and usuario_id="'.$_SESSION['id'].'"');
        if($sql){
          $this->getExperiencia();
        }else{
          echo 'error';
        }

      }else{
        echo 'error';
      }
      parent::cerrar();
    }

  } // End class


?>
