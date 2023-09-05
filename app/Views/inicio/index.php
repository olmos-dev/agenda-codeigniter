<!-- Aqui se manda a llamar el layout base -->
<?php echo $this->extend("plantillas/layout"); ?>

<!-- Aqui empieza el contenido dinamico de cada sección -->
<?php echo $this->section('contenido'); ?>

<div class="jumbotron">
  <h1 class="display-4">CRUD | CodeIgniter</h1>
  <p class="lead">Es una aplicación web de una agenda de contactos, donde puedes agregar, editar y eliminar.</p>
  <hr class="my-4">
  <p>Ir a la aplicación web</p>
  <a class="btn btn-primary btn-lg" href="/contactos" role="button">Pulsa aquí</a>
</div>





<!-- cierra el cotenido dinamico -->
<?php echo $this->endSection(); ?>

<!--Se incluyen los scripts necesarios para esta pagina -->
<?php echo $this->section('js'); ?>

<script>
document.addEventListener("DOMContentLoaded", (event) => {
  console.log("DOM fully loaded and parsed");
});
</script>

<!--Se cierra la seccion de los scripts -->
<?php echo $this->endSection(); ?>