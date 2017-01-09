{include file="view/principal/header.tpl"}
<!-- principal -->
<div class="row">
  <div class="col s3 no-padding-1 nav-right1 hide-on-med-and-down z-depth-1">
        <section class="row no-margin-b">
          <article class="col l4 offset-l2" style="padding-top: 1em;">
            <img src="images/bradlogo.png" width="100%" class="" alt="logo mentes a la carta">
          </article>
        </section>

        <section class="row">
          <article class="col l12 no-padding-1">
            <ul>
              <a href="?view=principal" class="accent-li1">
                <li class="item-nav-right1">
                  <i class="fa fa-home left resize"></i>
                  Página principal
                </li>
              </a>
              <a href="?view=panel" class="accent-li1">
                <li class="item-nav-right1">
                  <i class="fa fa-users left resize"></i>
                  Mentes a la carta
                </li>
              </a>
              <a href="?view=wits-pendientes" class="accent-li1">
                <li class="item-nav-right1">
                  <i class="fa fa-user-secret left resize"></i>
                  Mentes a la carta pendientes
                </li>
              </a>
              <a href="?view=emailMasivo" class="accent-li1">
                <li class="item-nav-right1">
                  <i class="fa fa-envelope left resize" style="font-size: 1.4rem;"></i>
                  Correos
                </li>
              </a>
              <a href="?view=newProyect" class="accent-li1">
                <li class="item-nav-right1 active-item">
                  <i class="fa fa-briefcase left resize"></i>
                  Proyectos
                </li>
              </a>
              <a href="?view=index" class="accent-li1">
                <li class="item-nav-right1">
                  <i class="fa fa-sign-out left resize" ></i>
                  Cerrar sesión
                </li>
              </a>

            </ul>
          </article>
        </section>

  </div>

  <div class="col s12 m9 offset-m3 seccion-panel">

    <div class="navbar-fixed">
      <nav class="orange lighten-1">
        <div class="nav-wrapper" style="padding-left: 15px;">
          <a href="#" class="brand-logo" style="font-size: 1.4rem;">Creador de proyectos</a>
        </div>
      </nav>
    </div>


    <div class="row" style="padding: 0px 20px;">
      <div class="col s10 no-padding">
        <div class="spacing-1"></div>

        <div class="row">
          <div class="col s12">
            <i class="fa fa-briefcase grey-text text-darken-2" aria-hidden="true" style="letter-spacing: 15px;"></i>
            <span class="grey-text text-darken-1">
              Crea un proyecto y agrega las Mentes a la carta que quieres que participen en el.
            </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <input id="nombre" type="text" class="validate grey-text">
            <label for="nombre" class="grey-text text-darken-2">Nombre del proyecto</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea" class="materialize-textarea grey-text"></textarea>
            <label for="textarea" class="grey-text text-darken-2">Descripcion del proyecto</label>
          </div>
        </div>

        <div class="row" id="loadProyect" hidden="hidden">
          <div class="col s12">
            <div class="preloader-wrapper small active">
              <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12">
            <span class="grey-text text-darken-1">Creando proyecto...</span>
          </div>
        </div>

        <div class="row">
          <div class="col s12">
            <button id="crear_proyecto" type="button" name="button" class="btn orange lighten-1 waves-effect waves-light">Crear</button>
          </div>
        </div>

        <!-- Divisor -->
        <div class="divider"></div>
        <div class="row">
          <div class="col s12">
            <div class="spacing-1"></div>
            <span class="title-proyect grey-text text-darken-2">
              Lista de proyectos
            </span>
          </div>
        </div>

        <div class="row" id="loadListaProyects" hidden="hidden">
          <div class="col s12">
            <div class="preloader-wrapper small active">
              <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="listaProyects">
          {if $proyectos != 0}
            {for $i = 0 to count($proyectos) - 1 }
            <div class="row">
              <div class="col s12 m10">
                <div style="width: 100%;" class="card card-spacing hover">
                  <span class="grey-text text-darken-2" style="font-size: 1.4rem;">
                    {ucfirst($proyectos[$i][1])}
                  </span>
                  <br>
                  <span class="grey-text spacing-parrafo">
                    {ucfirst($proyectos[$i][2])}
                  </span>
                  <br>
                  <a href="?view=adminProyect&proyect={$proyectos[$i][0]}">
                    <button type="button" name="button" class="btn orange lighten-1 waves-effect waves-light">Administrar</button>
                  </a>
                </div>
              </div>
            </div>
            {/for}
          {/if}
        </div>

      </div>
    </div>

  </div>

</div>


{include file="view/principal/cerrarSesion.tpl"}
{include file="view/principal/script.tpl"}