<!-- Aqui se manda a llamar el layout base -->
<?php echo $this->extend("plantillas/layout"); ?>

<!-- Aqui empieza el contenido dinamico de cada sección -->
<?php echo $this->section('contenido'); ?>

<div class="jumbotron">
  <h1 class="display-4">Error 404</h1>
  <p class="lead">Página no encontrada</p>
  <hr class="my-4">
  <p></p>
  <a class="btn btn-primary btn-lg" href="<?php echo base_url().'/contactos'; ?>" role="button">Volver</a>
</div>

<!-- cierra el cotenido dinamico -->
<?php echo $this->endSection(); ?>