<?php
/* Smarty version 3.1.30, created on 2016-11-08 22:57:46
  from "C:\xampp\htdocs\mentes\view\admin\panel.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58224a5a193bd2_74541654',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ffb19a34455e230fa0b6186c671c0876dd56fed' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentes\\view\\admin\\panel.tpl',
      1 => 1478642237,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:view/principal/header.tpl' => 1,
    'file:view/principal/script.tpl' => 1,
  ),
),false)) {
function content_58224a5a193bd2_74541654 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:view/principal/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<!-- Panel -->
<div class="row">

  <div class="col s3 no-padding-1 nav-right1 hide-on-med-and-down">

        <section class="row">
          <article class="col l8 offset-l2">
            <div class="spacing-1"></div>
            <img src="images/bradlogo.png" width="100%" class="" alt="logo mentes a la carta">
          </article>
        </section>

        <section class="row" >
          <article class="col l12 no-padding-1">
            <ul>
              <a href="?view=panel" class="accent-li1">
                <li class="item-nav-right1 active-item" id="project-pro">
                  <i class="fa fa-users left resize"></i>
                  Wits
                </li>
              </a>
              <a href="?view=wits-pendientes" class="accent-li1">
                <li class="item-nav-right1" id="asesores-pro">
                  <i class="fa fa-user-secret left resize"></i>
                  Wits Pendientes
                </li>
              </a>
              <a href="?view=index" class="accent-li1">
                <li class="item-nav-right1" id="asesores-pro">
                  <i class="fa fa-sign-out left resize"></i>
                  Cerrar sesión
                </li>
              </a>

            </ul>
          </article>
        </section>

  </div>

  <div class="col s12 m9 offset-m3">
    <!-- Contenido -->
    <div class="spacing-2"></div>
    <h3 class="accent-text">Lista de Mentes a la carta</h3>

    <div class="row">

      <!-- Nombres o apellidos -->
      <div class="input-field col s12 m6">
        <input id="last_name" type="text" class="validate">
        <label for="last_name">Nombres / Apellidos </label>
      </div>

      <!-- Sectores y empresas -->
      <div class="input-field col s12 m6">
        <select multiple>
          <option value="" disabled selected>Sectores</option>
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
          <option value="" disabled selected>Empresas</option>
          <option value="4">Option 4</option>
          <option value="5">Option 5</option>
          <option value="6">Option 6</option>
        </select>
        <label>Sectores / Empresas </label>
      </div>

      <!-- Ciudades -->
      <div class="input-field col s12 m6">
        <select multiple>
          <option value="" disabled selected></option>
          <option value="1">Cali</option>
          <option value="2">Medellín</option>
          <option value="3">Bógota</option>
        </select>
        <label>Ciudades</label>
      </div>

      <!-- Cargos -->
      <div class="input-field col s12 m6">
        <select multiple>
          <option value="" disabled selected></option>
          <option value="1">Periodista</option>
          <option value="2">Analista</option>
          <option value="3">Desarrollador web</option>
        </select>
        <label>Cargos</label>
      </div>

      <!-- Actividades -->
      <div class="input-field col s12 m6">
        <select multiple>
          <option value="" disabled selected></option>
          <option value="1">Periodista</option>
          <option value="2">Analista</option>
          <option value="3">Desarrollador web</option>
        </select>
        <label>Actividades</label>
      </div>

      <!-- Paises y empresas -->
      <div class="input-field col s12 m6">
        <select multiple>
          <option value="" disabled selected>Paises</option>
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
          <option value="" disabled selected>Idiomas</option>
          <option value="4">Option 4</option>
          <option value="5">Option 5</option>
          <option value="6">Option 6</option>
        </select>
        <label>Paises / Idiomas </label>
      </div>

      <!-- Aptitudes -->
      <div class="input-field col s12">
        <select multiple>
          <option value="" disabled selected></option>
          <option value="1">Periodista</option>
          <option value="2">Analista</option>
          <option value="3">Desarrollador web</option>
        </select>
        <label>Aptitudes</label>
      </div>

    </div>

    <div class="row">
      <div class="col s12">
        <table class="highlight hover">
        <thead>
          <tr>
              <th>Nombre</th>
              <th>Sector</th>
              <th>Ciudad</th>
              <th>País</th>
          </tr>
        </thead>

        <tbody>

          <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? count($_smarty_tpl->tpl_vars['wits']->value)-1+1 - (0) : 0-(count($_smarty_tpl->tpl_vars['wits']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
          <tr class="verPerfil" id="<?php echo $_smarty_tpl->tpl_vars['wits']->value[$_smarty_tpl->tpl_vars['i']->value][0];?>
">
            <td><?php echo $_smarty_tpl->tpl_vars['wits']->value[$_smarty_tpl->tpl_vars['i']->value][1];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['wits']->value[$_smarty_tpl->tpl_vars['i']->value][2];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['wits']->value[$_smarty_tpl->tpl_vars['i']->value][3];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['wits']->value[$_smarty_tpl->tpl_vars['i']->value][4];?>
</td>
          </tr>
          <?php }
}
?>

        </tbody>
      </table>
      </div>
    </div>
  </div>

</div><!-- / End .Panel-->

<?php $_smarty_tpl->_subTemplateRender("file:view/principal/script.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
