{include file="view/principal/header.tpl"}

<!-- Nav -->
<div class="navbar-fixed">
  <nav class="white z-depth-2">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center black-text">Mentes a la Carta</a>
    </div>
  </nav>
</div>
<!-- End nav -->

<div class="spacing-2"></div>
<!-- Mentes a la carta -->
<div class="container">

    {for $i = 0 to count($mentes) -1}
    <div class="row no-margin-b">
      <div class="col s12 m8 offset-m2">

        <a href="?view=perfil-wit& id={$mentes[$i]['id']}">

        <section class="card padding-list">
          <div class="row no-margin-b">

            <!-- Imagen de perfil -->
            <div class="col s4 l2">
              <img src="images/{$mentes[$i]['imagen']}" class="img-bordered" alt="imagen de perfil de Michael" width="100%;">
            </div>
            <!-- / End imagen de perfil -->

            <!-- Datos de la Mente a la Carta-->
            <div class="col s8 l10">
              <span class="encabezado-list">
                {ucwords($mentes[$i]['nombre'])}
              </span>

              <div class="row no-margin-b">
                <div class="col s4 l2">
                  <span class="black-text">Sector:</span>
                </div>
                <div class="col s8 l10">
                  <span class="grey-text text-darken-1">{ucwords($mentes[$i]['sector'])}</span>
                </div>
              </div>

              <div class="row no-margin-b">
                <div class="col s4 l2">
                  <span class="black-text">Ciudad:</span>
                </div>
                <div class="col s8 l10">
                  <span class="grey-text text-darken-1">{ucwords($mentes[$i]['ciudad'])}</span>
                </div>
              </div>

              <div class="row no-margin-b">
                <div class="col s4 l2">
                  <span class="black-text">País:</span>
                </div>
                <div class="col s8 l10">
                  <span class="grey-text text-darken-1">{ucwords($mentes[$i]['pais'])}</span>
                </div>
              </div>

            </div>
            <!-- / End datos Mentes a la Carta -->
          </div>
        </section>
        </a>
      </div>
    </div>
    {/for}

</div>




<!-- Botón flotante en la parte derecha -->
<div class="fixed-action-btn vertical">
  <a class="btn-floating btn-large grey darken-3">
    <i class="large material-icons"><i class="fa fa-plus"></i></i>
  </a>
  <ul>

    <li>
      <a href="?view=perfil-wit& id={$smarty.session.id}" class="btn-floating tooltipped white waves-effect" data-position="left" data-delay="50" data-tooltip="Mi perfil">
        <i style="font-size: 1.2em; color: #727272;" class="fa fa-user" aria-hidden="true"></i>
      </a>
    </li>

    <li>
      <a id="close-sesion" class="btn-floating tooltipped white waves-effect" data-position="left" data-delay="50" data-tooltip="Cerrar sesión">
        <i style="font-size: 1.2em; color: #727272;" class="fa fa-sign-out" aria-hidden="true"></i>
      </a>
    </li>

  </ul>
</div>
<!-- / End boton -->

{include file="view/principal/script.tpl"}
