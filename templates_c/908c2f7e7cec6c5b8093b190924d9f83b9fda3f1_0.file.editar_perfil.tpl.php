<?php
/* Smarty version 3.1.30, created on 2017-01-03 15:40:52
  from "C:\xampp\htdocs\mentesCarta\view\wits\editar_perfil.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_586bb7f4acd1a2_52570921',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '908c2f7e7cec6c5b8093b190924d9f83b9fda3f1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentesCarta\\view\\wits\\editar_perfil.tpl',
      1 => 1483453826,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:view/principal/header.tpl' => 1,
    'file:view/principal/script.tpl' => 1,
  ),
),false)) {
function content_586bb7f4acd1a2_52570921 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:view/principal/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="row">
  <div class="spacing-1"></div>
  <div class="col s12">
    <a href="?view=perfil-wit& id=<?php echo $_SESSION['id'];?>
">
    <button type="button" class="btn waves-effect waves-light grey darken-4" name="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button>
    </a>
  </div>
</div>

<div class="container">

  <div class="row">
    <div class="col s12 center-align">
      <h4>Editar perfil</h4>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m10 offset-m1">
      <ul class="collapsible popout" data-collapsible="accordion">

        <!-- Datos generales -->
        <li>
          <div class="collapsible-header"><i class="fa fa-book" aria-hidden="true"></i> Datos generales</div>
          <div class="collapsible-body padding-edit">
            <!-- Descripción de la fase -->
            <span class="grey-text">
              Los siguientes datos nos ayudan a identificar en que proyectos te podemos asignar
            </span>

            <div class="row">
              <div class="col s3 m2">
                <div class="spacing-1"></div>
                <img id="perfil" src="images/<?php echo $_smarty_tpl->tpl_vars['contacto']->value['imagen'];?>
?<?php echo time();?>
" class="circle" alt="Imagen de perfil wit michael" width="100%">
              </div>
            </div>

            <form id="imagen_perfil" enctype="multipart/form-data">
              <div class="row">
                <div class="col s12">
                  <!-- Imagen de perfil -->
                  <div class="row">

                    <div class="col s12">
                        <label class="grey-text text-darken-2">Selecciona una imagen de perfil</label>
                        <div class="file-field input-field">
                          <div class="btn" style="background-color: #EBA820;">
                            <span><i class="fa fa-user" style="font-size: 2rem; color: white;"></i></span>
                            <input type="file" name="imagen_perfil">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" id="seleccion_imagen">
                          </div>
                        </div>
                    </div>

                    <div id="loadImagen" class="col s2 m1" hidden="hidden">
                        <img src="images/perfiles/load.gif" alt="subiendo imagen de perfil" style="width: 100%;"/>
                    </div>

                  </div>

                </div>
              </div>
            </form>

            <div class="divider"></div>

            <div class="row">
              <div class="spacing-1"></div>
              <form class="col s12" id="datos_contacto">

                <div class="row">

                  <div class="input-field col s12 m6">
                    <input class="black-text" type="text" id="ciudad" name="ciudad" value="<?php echo ucwords($_smarty_tpl->tpl_vars['contacto']->value['ciudad']);?>
">
                    <label for="ciudad" class="grey-text text-darken-1">¿En qué ciudad vives?</label>
                  </div>

                  <div class="input-field col s12 m6">
                    <input class="black-text" type="text" id="Telefono" name="tel" value="<?php echo ucwords($_smarty_tpl->tpl_vars['contacto']->value['tel']);?>
">
                    <label class="grey-text text-darken-1" for="Telefono">Teléfono móvil</label>
                  </div>

                  <div class="input-field col s12">
                    <input class="black-text" type="text" id="pais" name="pais" value="<?php echo ucwords($_smarty_tpl->tpl_vars['contacto']->value['pais']);?>
">
                    <label class="grey-text text-darken-1" for="pais">¿En que país vives?</label>
                  </div>

                  <div class="input-field col s12">
                    <textarea maxlength="144" id="tweets" class="materialize-textarea black-text" name="tweets"><?php echo ucfirst($_smarty_tpl->tpl_vars['contacto']->value['tweets']);?>
</textarea>
                    <label class="grey-text text-darken-1" for="tweets">Describete en <span class="text-accent">(<span id="pre-des">144</span>)</span> caracteres</label>
                  </div>

                  <div class="input-field col s12">
                    <textarea id="textarea" class="materialize-textarea black-text" name="area"><?php echo ucfirst($_smarty_tpl->tpl_vars['contacto']->value['des']);?>
</textarea>
                    <label class=" grey-text text-darken-1" for="textarea">Déjanos una frase o pensamiento propio o cuéntanos si hay algo más que debemos saber de ti</label>
                  </div>

                  <div class="container" id="load3" hidden="hidden">
                    <div class="row">
                      <div class="col s2 offset-s5 m1 offset-m5">
                        <img src="images/perfiles/load.gif" alt="load aptitud" width="100%;">
                      </div>
                    </div>
                  </div>

                    <div class="col s12 grey-text text-darken-2">
                      <i class="fa fa-save"></i> <span class="underline" id="actualizar_datos">Actualizar datos</span>
                      <div class="spacing-1"></div>
                    </div>

                  <div class="col s12">
                    <div class="divider"></div>
                    <div class="spacing-1"></div>
                  </div>

                  <!-- Idiomas -->
                  <div class="input-field col s6 m6">
                    <input id="idiomas" value="" type="text" class="validate">
                    <label for="idiomas" class="black-text">¿Qué idiomas hablas?</label>
                  </div>
                  <div class="col s6 m3">
                    <div class="spacing-1"></div>
                    <button type="button" class="btn waves-effect waves-light" name="button" style="background-color: #EBA820;" id="add_new_idioma">Agregar</button>
                  </div>

                  <div class="col s12 m8">
                    <table>
                      <thead>
                        <tr>
                          <th>Idiomas</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody id="getIdiomas">
                        <?php if ($_smarty_tpl->tpl_vars['idiomas']->value != 0) {?>
                          <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? count($_smarty_tpl->tpl_vars['idiomas']->value)-1+1 - (0) : 0-(count($_smarty_tpl->tpl_vars['idiomas']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                          <tr id="habilidad<?php echo $_smarty_tpl->tpl_vars['idiomas']->value[$_smarty_tpl->tpl_vars['i']->value][0];?>
">
                            <td><?php echo $_smarty_tpl->tpl_vars['idiomas']->value[$_smarty_tpl->tpl_vars['i']->value][1];?>
</td>
                            <td class="hover eliminar_idioma" id="<?php echo $_smarty_tpl->tpl_vars['idiomas']->value[$_smarty_tpl->tpl_vars['i']->value][0];?>
"><i class="fa fa-close red-text "></i> <span class="red-text">Eliminar</span></td>
                          </tr>
                          <?php }
}
?>

                        <?php }?>
                      </tbody>
                    </table>
                  </div>


                </div>
              </form>
            </div>



          </div>
        </li>

       <!-- Experiencia -->
       <li>
         <div class="collapsible-header "><i class="fa fa-briefcase" aria-hidden="true"></i> Experiencia</div>
         <div class="collapsible-body padding-edit">
           <!-- Descripción de la fase -->
           <span class="grey-text">
             Queremos conocer tu experiencia para así mismo asignarte en los proyectos en los cuales te puedas desempeñar mejor
           </span>

            <div class="spacing-1"></div>

            <div class="row">
              <div class="col s12">
                <button type="button" class="btn orange waves-effect waves-light" name="button" id="new_exp">Agregar nueva experiencia</button>
              </div>
            </div>

            <!-- Formulario -->
            <form id="form_dd_empresa" hidden="hidden">
              <div class="row">

                <input type="text" id="identificador" value="0" name="identificador" hidden="hidden">

                <!-- company name -->
                <div class="input-field col s12 m6">
                  <div class="spacing-2"></div>
                  <input id="company" type="text" class="validate" name="empresa">
                  <label for="company">Empresa</label>
                </div>

                <!-- Sector -->
                <div class="input-field col s12 m6">
                  <div class="spacing-2"></div>
                  <input id="sector" type="text" class="validate" name="sector">
                  <label for="sector">Sector</label>
                </div>

                <!-- Cargo -->
                <div class="input-field col s12 m6">
                  <input id="position" type="text" class="validate" name="cargo">
                  <label for="position">Cargo</label>
                </div>

                <!-- Pais -->
                <div class="input-field col s12 m6">
                  <input id="country" type="text" class="validate" name="pais">
                  <label for="country">País</label>
                </div>

              </div><!-- / End Row datos form -->

              <div class="container" id="load" hidden="hidden">
                <div class="row">
                  <div class="col s2 offset-s5 m1 offset-m5">
                    <img src="images/perfiles/load.gif" alt="load aptitud" width="100%;">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s6 m5 l3 black-text">
                  <i class="fa fa-floppy-o text-grey text-grey" aria-hidden="true"></i> <span id="guardar_experiencia" class="underline text-grey"> Guardar experiencia </span>
                </div>
                <div class="col s6 m5 l3 black-text" id="limpiar" hidden="hidden">
                  <i class="fa fa-eraser text-grey text-grey" aria-hidden="true"></i> <span  class="underline text-grey"> Limpiar </span>
                </div>
              </div>
            </form>


            <!-- Table -->
            <table class="responsive-table">
              <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Sector</th>
                    <th>Cargo</th>
                    <th>País</th>
                </tr>
              </thead>

              <tbody id="lista_de_experiencia">
                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? count($_smarty_tpl->tpl_vars['experiencia']->value)-1+1 - (0) : 0-(count($_smarty_tpl->tpl_vars['experiencia']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                <tr>
                  <td><?php echo ucfirst($_smarty_tpl->tpl_vars['experiencia']->value[$_smarty_tpl->tpl_vars['i']->value][1]);?>
</td>
                  <td>Software</td>
                  <td>Desarrollador web</td>
                  <td>Colombia</td>
                  <td><i class="fa fa-pencil text-grey" aria-hidden="true"></i> <span class="underline text-grey editar_empresa" id="<?php echo $_smarty_tpl->tpl_vars['experiencia']->value[$_smarty_tpl->tpl_vars['i']->value][0];?>
">Editar</span></td>
                  <td><i class="fa fa-trash text-grey" aria-hidden="true"></i> <span class="underline text-grey eliminar_empresa" id="<?php echo $_smarty_tpl->tpl_vars['experiencia']->value[$_smarty_tpl->tpl_vars['i']->value][0];?>
">Eliminar</span></td>
                </tr>
                <?php }
}
?>

              </tbody>
            </table>

         </div>
       </li>

       <!-- Aptitudes -->
       <li>
         <div class="collapsible-header"><i class="fa fa-child" aria-hidden="true"></i> Aptitudes</div>
         <div class="collapsible-body padding-edit">
           <!-- Descripción de la fase -->
           <span class="grey-text">
             Hablanos de sus aptitudes para resaltar lo mejor de usted.
           </span>

           <!-- Formulario -->
           <div class="row">
             <div class="input-field col s6 m7">
                 <input id="aptitud" value="" type="text" class="validate">
                 <label for="aptitud">Aptitud</label>
             </div>
             <div class="col s6 m3">
               <div class="spacing-1"></div>
               <button type="button" class="btn waves-effect waves-light" name="button" style="background-color: #242424;" id="add_new_aptitud">Agregar</button>
             </div>
           </div>

           <!-- Lista -->
             <div class="row">
               <div class="col s12 m7">
                 <table>
                  <thead>
                    <tr>
                        <th data-field="id">Aptitudes</th>
                        <th data-field="name"></th>
                    </tr>
                  </thead>

                  <tbody id="getAptitudes">
                    <?php if ($_smarty_tpl->tpl_vars['aptitud']->value != 0) {?>
                      <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? count($_smarty_tpl->tpl_vars['aptitud']->value)-1+1 - (0) : 0-(count($_smarty_tpl->tpl_vars['aptitud']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                      <tr id="habilidad<?php echo $_smarty_tpl->tpl_vars['aptitud']->value[$_smarty_tpl->tpl_vars['i']->value][0];?>
">
                        <td><?php echo $_smarty_tpl->tpl_vars['aptitud']->value[$_smarty_tpl->tpl_vars['i']->value][1];?>
</td>
                        <td class="hover eliminar_habilidad" id="<?php echo $_smarty_tpl->tpl_vars['aptitud']->value[$_smarty_tpl->tpl_vars['i']->value][0];?>
"><i class="fa fa-close red-text "></i> <span class="red-text">Eliminar</span></td>
                      </tr>
                      <?php }
}
?>

                    <?php }?>
                  </tbody>
                </table>
               </div>
             </div>

         </div>

       </li>

       <!-- Actividades -->
       <li>
         <div class="collapsible-header"><i class="fa fa-fire" aria-hidden="true"></i> Actividades</div>
         <div class="collapsible-body padding-edit">
           <!-- Descripción de la fase -->
           <span class="grey-text">
             Indícanos en que actividades le gustaría participar
           </span>

           <!-- Indicadores -->
           <div class="spacing-2"></div>

           <div class="row">
             <div class="col s12">
               <i class="fa fa-square" aria-hidden="true" style="color: #EBA820;"></i>
               <span class="grey-text text-darken-1">Estas participando</span>
             </div>
             <div class="col s12">
               <i class="fa fa-square grey-text" aria-hidden="true"></i>
                <span class="grey-text text-darken-1">No estas participando</span>
             </div>
           </div>

           <div class="row">
             <div class="col s12">
              <!-- Declaracion de variables -->
              <?php $_smarty_tpl->_assignInScope('actividad1', 'Proyectos innovadores');
?>
              <?php $_smarty_tpl->_assignInScope('actividad2', 'Mentoring');
?>
              <?php $_smarty_tpl->_assignInScope('actividad3', 'Asesoramiento');
?>
              <?php $_smarty_tpl->_assignInScope('actividad4', 'Formación');
?>
              <?php $_smarty_tpl->_assignInScope('actividad5', 'Contenidos');
?>


               <ul class="collection" id="lista_actividades_edit">
                 <!-- Actividad 1-->
                 <?php if (strpos($_smarty_tpl->tpl_vars['brains']->value,$_smarty_tpl->tpl_vars['actividad1']->value) === false) {?>
                   <li class="hover grey-hover collection-item avatar actividad_inactivo" id="actividad1">
                     <i class="fa fa-briefcase circle"></i>
                     <span>
                       Proyectos innovadores <br>
                       <small class="grey-text text-darken-2">Participar en proyectos innovadores</small>
                     </span>
                   </li>
                 <?php } else { ?>
                     <li class="hover grey-hover collection-item avatar actividad_activo" id="actividad1">
                       <i class="fa fa-briefcase activo circle"></i>
                       <span>
                         Proyectos innovadores <br>
                         <small class="grey-text text-darken-2">Participar en proyectos innovadores</small>
                       </span>
                     </li>
                 <?php }?>


                 <!-- Actividad 2-->
                 <?php if (strpos($_smarty_tpl->tpl_vars['brains']->value,$_smarty_tpl->tpl_vars['actividad2']->value) === false) {?>
                     <li class="hover grey-hover collection-item avatar actividad_inactivo" id="actividad2">
                       <i class="fa fa-users circle"></i>
                       <span>
                         Mentoring<br>
                         <small class="grey-text text-darken-2">Ser mentor de emprendimientos y proyectos innovadores</small>
                       </span>
                     </li>

                 <?php } else { ?>
                     <li class="hover grey-hover collection-item avatar actividad_activo" id="actividad2">
                       <i class="fa fa-users activo circle"></i>
                       <span>
                         Mentoring<br>
                         <small class="grey-text text-darken-2">Ser mentor de emprendimientos y proyectos innovadores</small>
                       </span>
                     </li>
                 <?php }?>

                 <!-- Actividad 3-->
                 <?php if (strpos($_smarty_tpl->tpl_vars['brains']->value,$_smarty_tpl->tpl_vars['actividad3']->value) === false) {?>
                   <li class="hover grey-hover collection-item avatar actividad_inactivo" id="actividad3">
                     <i class="fa fa-comments-o circle grey"></i>
                     <span>
                       Asesoramiento<br>
                       <small class="grey-text text-darken-2">Brindar asesoría a empresas y emprendedores</small>
                     </span>
                   </li>
                 <?php } else { ?>
                     <li class="hover grey-hover collection-item avatar actividad_activo" id="actividad3">
                       <i class="fa fa-comments-o activo circle grey"></i>
                       <span>
                         Asesoramiento<br>
                         <small class="grey-text text-darken-2">Brindar asesoría a empresas y emprendedores</small>
                       </span>
                     </li>
                 <?php }?>

                 <!-- Actividad 4-->
                 <?php if (strpos($_smarty_tpl->tpl_vars['brains']->value,$_smarty_tpl->tpl_vars['actividad4']->value) === false) {?>
                   <li class="hover grey-hover collection-item avatar actividad_inactivo" id="actividad4">
                     <i class="fa fa-pencil-square-o circle grey"></i>
                     <span>
                       Formación<br>
                       <small class="grey-text text-darken-2">Impartir charlas y formación</small>
                     </span>
                   </li>
                 <?php } else { ?>
                     <li class="hover grey-hover collection-item avatar actividad_activo" id="actividad4">
                       <i class="fa fa-pencil-square-o activo circle grey"></i>
                       <span>
                         Formación<br>
                         <small class="grey-text text-darken-2">Impartir charlas y formación</small>
                       </span>
                     </li>
                 <?php }?>

                 <!-- Actividad 5-->
                 <?php if (strpos($_smarty_tpl->tpl_vars['brains']->value,$_smarty_tpl->tpl_vars['actividad5']->value) === false) {?>
                     <li class="hover grey-hover collection-item avatar actividad_inactivo" id="actividad5">
                       <i class="fa fa-file-text circle grey"></i>
                       <span>
                         Contenidos<br>
                         <small class="grey-text text-darken-2">Generar contenido escrito o audiovisual</small>
                       </span>
                     </li>

                 <?php } else { ?>
                     <li class="hover grey-hover collection-item avatar actividad_activo" id="actividad5">
                       <i class="fa fa-file-text activo circle grey"></i>
                       <span>
                         Contenidos<br>
                         <small class="grey-text text-darken-2">Generar contenido escrito o audiovisual</small>
                       </span>
                     </li>
                 <?php }?>

               </ul>

             </div>
           </div>
         </div>
       </li>

       <li>
         <div class="collapsible-header"><i class="fa fa-cog" aria-hidden="true"></i></i> Configuración de la cuenta</div>
         <div class="collapsible-body padding-edit">
          <div class="spacing-1"></div>
          <form id="formulario_general">
            <div class="row">

              <!-- Nombres -->
              <div class="input-field col s12 m6">
                <input id="nombres_generales" type="text" class="validate grey-text text-darken-4" value="<?php echo ucwords($_smarty_tpl->tpl_vars['misDatos']->value['nombres']);?>
" name="nombre">
                <label for="nombres_generales">Nombres</label>
              </div>

              <!-- Apellidos -->
              <div class="input-field col s12 m6">
                <input id="apellido_general" type="text" class="validate grey-text text-darken-4" value="<?php echo ucwords($_smarty_tpl->tpl_vars['misDatos']->value['apellidos']);?>
" name="apellido">
                <label for="apellido_general">Apellidos</label>
              </div>

              <!-- Correo electrónico -->
              <div class="input-field col s12 m6">
                <input id="email_general" type="text" class="validate grey-text text-darken-4" value="<?php echo $_smarty_tpl->tpl_vars['misDatos']->value['email'];?>
" name="email">
                <label for="email_general">Correo electrónico</label>
              </div>

              <div class="input-field col s12 m6">
                <input id="clave_new" type="password" class="validate grey-text text-darken-4" value="" name="clave_new">
                <label for="clave_new">Nueva contraseña</label>
              </div>

              <div class="input-field col s12">
                <input id="clave_actual" type="password" class="validate grey-text text-darken-4" name="clave_actual">
                <label for="clave_actual">Contraseña Actual</label>
              </div>

              <div id="load_general" class="col s2 m1" hidden="hidden">
                  <img src="images/perfiles/load.gif" alt="subiendo imagen de perfil" style="width: 100%;"/>
                  Cargando...
              </div>

              <div class="col s12 grey-text text-darken-2">
                <div class="spacing-2"></div>
                <i class="fa fa-save"></i> <span class="underline" id="actualizar_datos_generales">Actualizar datos</span>
              </div>

              <!-- Modal Trigger -->

            </div>
        </form>

      </div>
    </li>

  </ul>
</div>
</div><!-- End row-->
</div><!-- End container -->

<?php echo '<script'; ?>
>
$(document).ready(function(){

  $("#aptitud").autocomplete({
    source: "controller/user/traerAptitud.php"
  });

});
<?php echo '</script'; ?>
>

<div class="fixed-action-btn vertical hide-on-small-only">
  <a href="?view=perfil-wit& id=<?php echo $_SESSION['id'];?>
" class="btn-floating btn-large white waves-effect tooltipped" data-position="left" data-delay="50" data-tooltip="Mi perfil">
    <i style="font-size: 1.7em; color: #727272;" class="fa fa-user" aria-hidden="true"></i>
  </a>
</div>

<div class="barra hide-on-med-and-up" style="width: 100%;background-color: white; position: fixed; z-index: 100; bottom: 0px;">
  <div class="row no-margin-b">
    <a href="?view=Mentes-a-la-Carta">
      <div class="col s6 center-align grey-text waves-effect" style="padding-top: 10px;">
        <i class="fa fa-users" style="font-size: 1.6rem;"></i>
        <br>
        Más mentes a la Carta
      </div>
    </a>

    <a href="?view=perfil-wit& id=<?php echo $_SESSION['id'];?>
">
      <div class="col s6 center-align grey-text waves-effect"  style="padding-top: 10px;">
        <i class="fa fa-user" style="font-size: 1.6rem;"></i><br>
        Mi perfil
      </div>
    </a>
  </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:view/principal/script.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
