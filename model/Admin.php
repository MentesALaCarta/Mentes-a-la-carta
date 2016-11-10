<?php

  # Incluimos la clase de conexion
  require_once('Conexion.php');

  /**
   *
   */
  class Admin extends Conexion
  {

    public function listarWitsNoAprovados()
    {
      parent::conectar();
      $datos = array();

      # Consultamos todos los wits que no estan aprobados
      $sql = parent::query('select * from usuario inner join fire_step f on usuario.id = f.usuario_id where usuario.estado = "I" and step ="5" order by usuario.id ');

      while($row = mysqli_fetch_array($sql)){

        $ciudad = parent::consultaArreglo('select ciudad from contacto where usuario_id="'.$row['id'].'"');

        # Juntamos los nombres
        $nombres = $row['primer_nombre'] . ' ' . $row['segundo_nombre'];

        # Juntamos los apellido
        $apellidos = $row['primer_apellido'] . ' ' . $row['segundo_apellido'];

        $datos[] = array(
                         $row['id'], // 0
                         $nombres, // 1
                         $apellidos, // 2
                         $row['fecha'], // 5
                         $ciudad['ciudad'] // 6
                       );

      }

      return $datos;

      parent::cerrar();
    }


    # Funcion que aprueba al wits
    public function aprobarWit($id)
    {
      parent::conectar();
      parent::query('update usuario set estado ="A" where id="'.$id.'"');
      parent::cerrar();
    }

    # Funcion que aprueba al wits
    public function desAprobarWit($id)
    {
      parent::conectar();
      parent::query('update usuario set estado ="N" where id="'.$id.'"');
      parent::cerrar();
    }

    public function getSectores()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.sector) from experiencia b inner join usuario u on b.usuario_id = u.id where u.estado ="A"');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['sector'])){
          $datos[] = $row['sector'];
        }
      }

      return $datos;
      parent::cerrar();
    }

    public function getEmpresas()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.name_business) from experiencia b inner join usuario u on b.usuario_id = u.id where u.estado ="A"');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['name_business'])){
          $datos[] = $row['name_business'];
        }
      }

      return $datos;
      parent::cerrar();
    }

    public function getCiudades()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.ciudad) from contacto b inner join usuario u on b.usuario_id = u.id where u.estado ="A"');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['ciudad'])){
          # Reemplazamos los acentos
          $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
          $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');

          $datos[] = str_replace($buscar, $reemplazar, $row['ciudad']);
        }
      }

      return $datos;
      parent::cerrar();
    }

    public function getCargos()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.position) from experiencia b inner join usuario u on b.usuario_id = u.id where u.estado ="A"');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['position'])){
          $datos[] = $row['position'];
        }
      }

      return $datos;
      parent::cerrar();
    }

    public function getBrains()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.descripcion) from brain b inner join usuario u on b.usuario_id = u.id where u.estado ="A"');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['descripcion'])){
          $datos[] = $row['descripcion'];
        }
      }

      return $datos;
      parent::cerrar();
    }

    public function getPaises()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.pais) from contacto b inner join usuario u on b.usuario_id = u.id where u.estado ="A"');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['pais'])){

          # Reemplazamos los acentos
          $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
          $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');

          $datos[] = str_replace($buscar, $reemplazar, $row['pais']);

        }
      }

      return $datos;
      parent::cerrar();
    }

    public function getIdiomas()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.des) from idiomas b inner join usuario u on b.usuario_id = u.id where u.estado ="A"');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['des'])){

          # Reemplazamos los acentos
          $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
          $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');

          $datos[] = str_replace($buscar, $reemplazar, $row['des']);

        }
      }

      return $datos;
      parent::cerrar();
    }

    public function getHabilidades()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.descripcion) from habilidades b inner join usuario u on b.usuario_id = u.id where u.estado ="A"');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['descripcion'])){

          # Reemplazamos los acentos
          $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
          $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');

          $datos[] = str_replace($buscar, $reemplazar, $row['descripcion']);

        }
      }

      return $datos;
      parent::cerrar();
    }


    public function busqueda($busqueda)
    {

      parent::conectar();

      # Busqueda por primer nombre
      $sql = parent::query('select u.id, u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido,  e.sector, c.ciudad, c.pais from usuario u inner join experiencia e on u.id = e.usuario_id inner join contacto c on u.id = c.usuario_id where (primer_nombre like "%'.$busqueda.'%" and u.estado ="A")  or (segundo_nombre like "%'.$busqueda.'%" and u.estado ="A")  or (primer_apellido like "%'.$busqueda.'%" and u.estado ="A")  or (segundo_apellido like "%'.$busqueda.'%" and u.estado ="A") or (e.name_business like "%'.$busqueda.'%" and u.estado ="A")  or (e.sector like "%'.$busqueda.'%" and u.estado ="A") or (e.position like "%'.$busqueda.'%" and u.estado ="A") or (e.country like "%'.$busqueda.'%" and u.estado ="A")  or (c.ciudad like "%'.$busqueda.'%" and u.estado ="A") or (c.tel like "%'.$busqueda.'%" and u.estado ="A") or (c.pais like "%'.$busqueda.'%" and u.estado ="A") ');

      while($row = mysqli_fetch_array($sql)){
        echo '
        <tr class="verPerfil" id="'.$row['id'].'">
          <td>'.$row['primer_nombre']. ' ' .$row['segundo_nombre'].'</td>
          <td>'.$row['primer_apellido']. ' ' .$row['segundo_apellido'].'</td>
          <td>'.$row['ciudad'].'</td>
          <td>'.$row['pais'].'</td>
        </tr>
        ';
      }

      parent::cerrar();

    }

    # Funcion que consulta  wits aprobados por nombre de empresa y sector
    public function consultBySectorAndEmpresa($sectores, $empresas)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join experiencia e on e.usuario_id = u.id where u.estado = "A" and ('.$sectores.') and ('.$empresas.')';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }


    public function consultBySector($sectores)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join experiencia e on e.usuario_id = u.id where u.estado = "A" and ('.$sectores.') ';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }

    public function consultByEmpresa($empresas)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join experiencia e on e.usuario_id = u.id where u.estado = "A" and ('.$empresas.') ';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }


    public function getWitsAprobados()
    {
      parent::conectar();
      $sql = parent::query('select u.id, u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join contacto c on u.id = c.usuario_id where estado ="A"');
      while($row = mysqli_fetch_array($sql)){
        echo '
        <tr class="verPerfil" id="'.$row['id'].'">
          <td>'.$row['primer_nombre']. ' ' .$row['segundo_nombre'].'</td>
          <td>'.$row['primer_apellido']. ' ' .$row['segundo_apellido'].'</td>
          <td>'.$row['ciudad'].'</td>
          <td>'.$row['pais'].'</td>
        </tr>
        ';
      }

      parent::cerrar();
    }

    public function consultByCiudad($ciudad)
    {
      parent::conectar();

      $consulta = 'select u.id, u.primer_nombre from usuario u inner join contacto c on c.usuario_id = u.id where u.estado = "A" and ('.$ciudad.') ';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }

    public function consultByCargo($cargos)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join experiencia e on e.usuario_id = u.id where u.estado = "A" and ('.$cargos.') ';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }

    public function consultByActividad($actividad)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join brain b on b.usuario_id = u.id where u.estado = "A" and ('.$actividad.') ';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }

    public function consultByAptitudes($aptitudes)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join habilidades h on h.usuario_id = u.id where u.estado = "A" and ('.$aptitudes.') ';
      echo $consulta;
      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }


    # Funcion que consulta  wits aprobados por nombre de empresa y sector
    public function consultByPaisAndIdioma($sectores, $empresas)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join idiomas i on i.usuario_id = u.id inner join contacto c on c.usuario_id = u.id where u.estado = "A" and ('.$sectores.') and ('.$empresas.')';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }


    public function consultByPais($sectores)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join contacto c on c.usuario_id = u.id where u.estado = "A" and ('.$sectores.') ';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }

    public function consultByIdioma($empresas)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre from usuario u inner join idiomas i on i.usuario_id = u.id where u.estado = "A" and ('.$empresas.') ';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.$row['id'].'</td>
            <td>'.$row['primer_nombre'].'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }

  }



?>
