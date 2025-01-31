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
      $sql = parent::query('select u.id, u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, u.fecha, c.ciudad from usuario u inner join fire_step f on u.id = f.usuario_id inner join contacto c on u.id = c.usuario_id where u.estado = "I" and f.step ="5" and u.cargo = "2" order by u.id desc');

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
      $id = parent::salvar($id);
      parent::query('update usuario set estado ="A" where id="'.$id.'"');

      $user = parent::consultaArreglo('select primer_nombre, email from usuario where id="'.$id.'"');
      $myList = '';

      $actividades = parent::query('select descripcion from brain where usuario_id="'.$id.'"');

      while($row = mysqli_fetch_array($actividades)){
        $myList .= ' ' . $row['descripcion'] . ' ';
      }

      $actividad1 = 'Proyectos innovadores';
      $actividad2 = 'Mentoring';
      $actividad3 = 'Asesoramiento';
      $actividad4 = 'Formaci&oacute;n';
      $actividad5 = 'Contenidos';

       /* Notificar email */

       //título
       $titulo = 'Bienvenido a Mentes a la Carta';

       $mensaje = '
       <html>
         <head>
           <meta charset="utf-8">
           <title>Perfil Aprobado</title>
         </head>
         <body>
       ';

       $mensaje .= '
       <div align="center">
         <img src="http://www.mentesalacarta.com/images/bradlogo.png" alt="logo mentes a la carta">
       </div>

       <div style="padding: 2em; border-radius:4px;border:1px #eaeaea solid; width: 100%; margin: 0px auto; color:#444444; font-size:11pt; font-family:proxima_nova,Arial,Verdana,Tahoma; max-width:454px">

           <div style="text-align: center;">
             <h1>¡Felicitaciones '.ucfirst($user['primer_nombre']).'!</h1>
           </div>

           <span>
             Tu perfil de <span style="font-weight: bold;">Mentes a la Carta</span> ha sido aprobado, ahora puedes participar en las siguientes <span style="font-weight: bold;">actividades:</span>
           </span>

           <div style="margin-top: 1.5em;">
             <ul style="list-style: none;">';

               if(strpos($myList, 'Proyectos innovadores')){
                 $mensaje .= '
                 <li style="margin-top: 0.5em; color: #EBA820;">
                   Proyectos innovadores<br>
                   <span style="color: #767676;">Participar en proyectos innovadores </span>
                 </li>
                 ';
               }

               if(strpos($myList, $actividad2)){
                 $mensaje .= '
                 <li style="margin-top: 0.5em; color: #EBA820;">
                   Mentoring<br>
                   <span style="color: #767676;">Ser mentor de emprendimientos y proyectos innovadores </span>
                 </li>
                 ';
               }

               if(strpos($myList, $actividad3)){
                 $mensaje .= '
                 <li style="margin-top: 0.5em; color: #EBA820;">
                   Asesoramiento<br>
                   <span style="color: #767676;">Brindar asesoría a empresas y emprendedores</span>
                 </li>
                 ';
               }

               if(strpos($myList, $actividad4)){
                 $mensaje .= '
                 <li style="margin-top: 0.5em; color: #EBA820;">
                   Formación<br>
                   <span style="color: #767676;">Impartir charlas y formación</span>
                 </li>
                 ';
               }

               if(strpos($myList, $actividad5)){
                 $mensaje .= '
                 <li style="margin-top: 0.5em; color: #EBA820;">
                   Contenidos<br>
                   <span style="color: #767676;">Generar contenido escrito o audiovisual </span>
                 </li>
                 ';
               }

             $mensaje .='</ul>
           </div>

           <div style="margin-top: 2.5em;">
             <a href="http://www.mentesalacarta.com/?view=acceder" style="border-radius:3px; font-size:15px; color:white; border:1px #DF980B solid; text-decoration:none; padding:14px 7px 14px 7px; width:210px; max-width:210px; font-family:proxima_nova,arial,verdana,tahoma,sans-serif; margin:6px auto; display:block; background-color:#EBA820; text-align:center" target="_blank">
               Iniciar sesión
             </a>
           </div>
       </div>
       ';

       $mensaje .="
        </body>
       </html>
       ";


       # Cabeceras
       $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
       $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $cabeceras .= "From:". "info@mentesalacarta.com";

       # Envio de mensaje
       if(mail($user['email'], $titulo, $mensaje, $cabeceras)){
         echo 'se envio: ' .$user['email'] . ' ' . $myList;
       }else{
         echo 'no se envio';
       }


      parent::cerrar();
    }

    # Funcion que aprueba al wits
    public function desAprobarWit($id)
    {
      parent::conectar();
      $consulta = parent::query('update usuario set estado ="N" where id="'.$id.'"');
      parent::cerrar();
    }

    public function getSectores()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.sector) from experiencia b inner join usuario u on b.usuario_id = u.id where u.estado ="A" ORDER BY b.sector');

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
      $sql = parent::query('select DISTINCT(b.name_business) from experiencia b inner join usuario u on b.usuario_id = u.id where u.estado ="A" ORDER BY b.name_business');

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
      $sql = parent::query('select DISTINCT(b.ciudad) from contacto b inner join usuario u on b.usuario_id = u.id where u.estado ="A" ORDER BY b.ciudad');

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
      $sql = parent::query('select DISTINCT(b.position) from experiencia b inner join usuario u on b.usuario_id = u.id where u.estado ="A" ORDER BY b.position');

      while($row = mysqli_fetch_array($sql)){
        if(!empty($row['position'])){
          $datos[] = ucwords($row['position']);
        }
      }

      return $datos;
      parent::cerrar();
    }

    public function getBrains()
    {
      parent::conectar();
      $datos = array();
      $sql = parent::query('select DISTINCT(b.descripcion) from brain b inner join usuario u on b.usuario_id = u.id where u.estado ="A" ORDER BY b.descripcion');

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
      $sql = parent::query('select DISTINCT(b.pais) from contacto b inner join usuario u on b.usuario_id = u.id where u.estado ="A" ORDER BY b.pais');

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
      $sql = parent::query('select DISTINCT(b.des) from idiomas b inner join usuario u on b.usuario_id = u.id where u.estado ="A" ORDER BY b.des');

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
      $sql = parent::query('select DISTINCT(b.descripcion) from habilidades b inner join usuario u on b.usuario_id = u.id where u.estado ="A" ORDER BY b.descripcion');

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

    public function consultBySector($sectores)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join experiencia e on e.usuario_id = u.id inner join contacto c on u.id = c.usuario_id where u.estado = "A" and ('.$sectores.')';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
            <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
            <td>'.ucwords($row['ciudad']).'</td>
            <td>'.ucwords($row['pais']).'</td>
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

      $consulta = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join experiencia e on e.usuario_id = u.id inner join contacto c on u.id = c.usuario_id where u.estado = "A" and ('.$empresas.')';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
            <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
            <td>'.ucwords($row['ciudad']).'</td>
            <td>'.ucwords($row['pais']).'</td>
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
      $sql = parent::query('select u.id, u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join contacto c on u.id = c.usuario_id where estado ="A" LIMIT 20');
      while($row = mysqli_fetch_array($sql)){
        echo '
        <tr class="verPerfil" id="'.$row['id'].'">
          <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
          <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
          <td>'.ucwords($row['ciudad']).'</td>
          <td>'.ucwords($row['pais']).'</td>
        </tr>
        ';
      }

      parent::cerrar();
    }

    public function consultByCiudad($ciudad)
    {
      parent::conectar();

      $consulta = 'select u.id, u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join contacto c on c.usuario_id = u.id where u.estado = "A" and ('.$ciudad.') ORDER BY c.ciudad';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
            <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
            <td>'.ucwords($row['ciudad']).'</td>
            <td>'.ucwords($row['pais']).'</td>
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

      $consulta = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join experiencia e on e.usuario_id = u.id inner join contacto c on u.id = c.usuario_id where u.estado = "A" and ('.$cargos.') LIMIT 15';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
            <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
            <td>'.ucwords($row['ciudad']).'</td>
            <td>'.ucwords($row['pais']).'</td>
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

      $consulta = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join brain b on b.usuario_id = u.id inner join contacto c on u.id = c.usuario_id where u.estado = "A" and ('.$actividad.')';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
            <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
            <td>'.ucwords($row['ciudad']).'</td>
            <td>'.ucwords($row['pais']).'</td>
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

      $consulta = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join habilidades h on h.usuario_id = u.id inner join contacto c on  u.id = c.usuario_id where u.estado = "A" and ('.$aptitudes.') LIMIT 15';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
            <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
            <td>'.ucwords($row['ciudad']).'</td>
            <td>'.ucwords($row['pais']).'</td>
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

      $consulta = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join contacto c on c.usuario_id = u.id where u.estado = "A" and ('.$sectores.') LIMIT 15';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
            <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
            <td>'.ucwords($row['ciudad']).'</td>
            <td>'.ucwords($row['pais']).'</td>
          </tr>

        ';
        }

      }else{
        echo ' No hay registros';
      }

      parent::cerrar();
    }

    public function consultByIdioma($idiomas)
    {
      parent::conectar();

      $consulta = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u inner join idiomas i on i.usuario_id = u.id inner join contacto c on c.usuario_id = u.id where u.estado = "A" and ('.$idiomas.') LIMIT 15';

      $verificar = parent::verificarRegistros($consulta);

      if($verificar > 0){
        $sql = parent::query($consulta);
        while($row = mysqli_fetch_array($sql)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
            <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
            <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
            <td>'.ucwords($row['ciudad']).'</td>
            <td>'.ucwords($row['pais']).'</td>
          </tr>

        ';
        }

      }else{
        echo 'No hay registros';
      }

      parent::cerrar();
    }

    # Funcion que permite consulta dinamica con varias parametros en una sola palabra
    public function buscarWit($busqueda)
    {
      parent::conectar();
      $busqueda = parent::salvar($busqueda);


      $sql = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u
      inner join
      brain b
      on u.id = b.usuario_id
      inner join
      contacto c
      on u.id = c.usuario_id
      inner join
      experiencia e
      on u.id = e.usuario_id
      inner join
      fire_step f
      on u.id = f.usuario_id
      inner join
      habilidades h
      on u.id = h.usuario_id
      inner join
      idiomas i
      on u.id = i.usuario_id
      where
      u.estado = "A"
      and
      (
        u.primer_nombre like "%'.$busqueda.'%"
        or
        u.segundo_nombre like "%'.$busqueda.'%"
        or
        u.primer_apellido like "%'.$busqueda.'%"
        or
        u.segundo_apellido like "%'.$busqueda.'%"
        or
        b.descripcion like "%'.$busqueda.'%"
        or
        c.ciudad like "%'.$busqueda.'%"
        or
        c.tel like "%'.$busqueda.'%"
        or
        c.pais like "%'.$busqueda.'%"
        or
        e.name_business like "%'.$busqueda.'%"
        or
        e.sector like "%'.$busqueda.'%"
        or
        e.position like "%'.$busqueda.'%"
        or
        e.country like "%'.$busqueda.'%"
        or
        h.descripcion like "%'.$busqueda.'%"
        or
        i.des like "%'.$busqueda.'%"
        )';

        $verificar = parent::verificarRegistros($sql);
        if($verificar > 0 ){

          $consulta = parent::query($sql);

          while($row = mysqli_fetch_array($consulta)){
            echo '
            <tr class="verPerfil" id="'.$row['id'].'">
              <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
              <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
              <td>'.ucwords($row['ciudad']).'</td>
              <td>'.ucwords($row['pais']).'</td>
            </tr>
            ';
          }
        }else{
          echo 'No se encontraron registros';
        }


      parent::cerrar();
    } // End function


    public function buscarByNombre($busqueda)
    {
      parent::conectar();

      $palabras = count($busqueda);

      if($palabras == 2){
        $busqueda[2] = 'lopez gobez hos dakjs';
        $busqueda[3] = 'lopez gobez hos dakjs';
      }else if($palabras == 3){
        $busqueda[3] = 'lopez gobez hos dakjs';
      }

      $busqueda[0] = parent::salvar($busqueda[0]);
      $busqueda[1] = parent::salvar($busqueda[1]);
      $busqueda[2] = parent::salvar($busqueda[2]);
      $busqueda[3] = parent::salvar($busqueda[3]);

      $sql = 'select DISTINCT(u.id), u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido, c.ciudad, c.pais from usuario u
      inner join
      brain b
      on u.id = b.usuario_id
      inner join
      contacto c
      on u.id = c.usuario_id
      inner join
      experiencia e
      on u.id = e.usuario_id
      inner join
      fire_step f
      on u.id = f.usuario_id
      inner join
      habilidades h
      on u.id = h.usuario_id
      inner join
      idiomas i
      on u.id = i.usuario_id
      where
      u.estado = "A"
      and
      (
        u.primer_nombre like "%'.$busqueda[0].'%"
        or
        u.primer_nombre like "%'.$busqueda[1].'%"
        or
        u.primer_nombre like "%'.$busqueda[2].'%"
        or
        u.primer_nombre like "%'.$busqueda[3].'%"
        or
        u.segundo_nombre like "%'.$busqueda[0].'%"
        or
        u.segundo_nombre like "%'.$busqueda[1].'%"
        or
        u.segundo_nombre like "%'.$busqueda[2].'%"
        or
        u.segundo_nombre like "%'.$busqueda[3].'%"
        or
        u.primer_apellido like "%'.$busqueda[0].'%"
        or
        u.primer_apellido like "%'.$busqueda[1].'%"
        or
        u.primer_apellido like "%'.$busqueda[2].'%"
        or
        u.primer_apellido like "%'.$busqueda[3].'%"
        or
        u.segundo_apellido like "%'.$busqueda[0].'%"
        or
        u.segundo_apellido like "%'.$busqueda[1].'%"
        or
        u.segundo_apellido like "%'.$busqueda[2].'%"
        or
        u.segundo_apellido like "%'.$busqueda[3].'%"
      )';

      $verificar = parent::verificarRegistros($sql);
      if($verificar > 0){
        $consulta = parent::query($sql);

        while($row = mysqli_fetch_array($consulta)){
          echo '
          <tr class="verPerfil" id="'.$row['id'].'">
          <td>'.ucwords($row['primer_nombre']). ' ' .ucwords($row['segundo_nombre']).'</td>
          <td>'.ucwords($row['primer_apellido']). ' ' .ucwords($row['segundo_apellido']).'</td>
          <td>'.ucwords($row['ciudad']).'</td>
          <td>'.ucwords($row['pais']).'</td>
          </tr>
          ';
        }

      }else{
        echo 'No se encontraron registro';
      }

      parent::cerrar();
    }


    public function totalAdmintidos()
    {
      parent::conectar();
      $datos = parent::verificarRegistros('select id from usuario where estado ="A" and cargo = 2');
      parent::cerrar();
      return $datos;
    }

    public function totalNoAdmintidos()
    {
      parent::conectar();
      $datos = parent::verificarRegistros('select u.id from usuario u inner join fire_step f on f.usuario_id = u.id where u.estado ="I" and u.cargo = "2" and f.step ="5"');
      parent::cerrar();
      return $datos;
    }

    # Crea un proyecto
    public function crearProyecto($nombre, $descripcion)
    {
      parent::conectar();
      $nombre = parent::filtrar($nombre);
      $validar = parent::verificarRegistros('select nombre from proyecto where nombre = "'.$nombre.'"');

      if($validar > 0)
      {
        echo 'error_2';
      }else{
        $descripcion = parent::filtrar($descripcion);
        parent::query('insert into proyecto(nombre, descripcion, estado) values("'.$nombre.'", "'.$descripcion.'", "A")');
        echo 'success';
      }

      parent::cerrar();
    }

    public function loadProyectos()
    {
      parent::conectar();
      $sql = 'select id, nombre, descripcion from proyecto where estado ="A" order by id desc';
      $verificar = parent::verificarRegistros($sql);
      if($verificar > 0){
        $datos = array();
        $proyectos = parent::query($sql);
        while($row = mysqli_fetch_array($proyectos)){
          $datos[] = array($row['id'], $row['nombre'], $row['descripcion']);
        }
        return $datos;
      }else{
        return 0;
      }
      parent::cerrar();
    }


    public function loadproyecto($id)
    {
      parent::conectar();
      $id = parent::salvar($id);
      $validar = parent::verificarRegistros('select nombre from proyecto where id="'.$id.'" and estado ="A"');
      if($validar > 0 ){
        $datos = array();
        $proyecto = parent::consultaArreglo('select nombre, descripcion from proyecto where id="'.$id.'" and estado ="A"');
        $datos = array($proyecto['nombre'], $proyecto['descripcion']);
        return $datos;
      }else{
        return false;
      }
      parent::cerrar();
    }

    public function loadProyectosNuevos()
    {
      parent::conectar();
      $consulta = parent::query('select * from proyecto where estado ="A" order by id desc');
      while($row = mysqli_fetch_array($consulta)){
        echo '
        <div class="row">
          <div class="col s12 m10">
            <div style="width: 100%;" class="card card-spacing hover">
              <span class="grey-text text-darken-2" style="font-size: 1.4rem;">
                '.ucfirst($row['nombre']).'
              </span>
              <br>
              <span class="grey-text spacing-parrafo">
                '.ucfirst($row['descripcion']).'
              </span>
              <br>
              <a href="?view=adminProyect&proyect='.$row['id'].'">
                <button type="button" name="button" class="btn orange lighten-1 waves-effect waves-light">Administrar</button>
              </a>
            </div>
          </div>
        </div>
        ';
      }
      parent::cerrar();
    }

    public function deleteProyecto($id)
    {
      parent::conectar();
      $id = parent::salvar($id);
      parent::query('update proyecto set estado = "I" where id="'.$id.'"');
      parent::cerrar();
    }

    public function actualizarProyecto($id, $nombre, $descripcion)
    {
      parent::conectar();

      $id = parent::filtrar($id);
      $nombre = parent::filtrar($nombre);
      $descripcion = parent::filtrar($descripcion);

      parent::query('update proyecto set nombre ="'.$nombre.'", descripcion="'.$descripcion.'" where id="'.$id.'"');

      parent::cerrar();
    }

    public function loadMentesProyecto($proyecto)
    {
      parent::conectar();

      $proyecto = parent::filtrar($proyecto);

      $validar = parent::verificarRegistros('select id from proyecto_mente where proyecto_id="'.$proyecto.'"');

      if($validar > 0){

        $id_mente = parent::query('select usuario_id from proyecto_mente where proyecto_id="'.$proyecto.'" ');

        $datos = array();

        while($row = mysqli_fetch_array($id_mente)){

          $datos_mente = parent::query('select u.id, u.primer_nombre, u.primer_apellido, c.imagen from usuario u inner join contacto c on u.id = c.usuario_id  where u.id="'.$row['usuario_id'].'"');

          while($mente = mysqli_fetch_array($datos_mente)){
            $datos[] = array($mente['id'], $mente['primer_nombre'], $mente['primer_apellido'], $mente['imagen']);
          }

        }

        return $datos;

      }else{
        return 0;
      }
      parent::cerrar();
    }


    public function asignarProyect($id, $wit)
    {
      parent::conectar();
      $id = parent::filtrar($id);
      $wit = parent::filtrar($wit);
      $validar = parent::verificarRegistros('select id from proyecto_mente where usuario_id="'.$wit.'" and proyecto_id="'.$id.'" ');
      if($validar > 0)
      {
        echo 'error_1';
      }else{
        parent::query('insert into proyecto_mente(usuario_id, proyecto_id) values("'.$wit.'", "'.$id.'")');
        $proyecto = parent::consultaArreglo('select nombre from proyecto where id="'.$id.'"');
        echo ucfirst($proyecto['nombre']);
      }
      parent::cerrar();
    }

    public function desasignarProyect($id, $wit)
    {
      parent::conectar();

      $id = parent::filtrar($id);
      $wit = parent::filtrar($wit);

      parent::query('delete from proyecto_mente where usuario_id="'.$wit.'" and proyecto_id="'.$id.'"');
      parent::cerrar();
    }

  } // END Class



?>
