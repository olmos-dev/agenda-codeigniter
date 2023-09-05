<!-- Aqui se manda a llamar el layout base -->
<?php echo $this->extend("plantillas/layout"); ?>

<!-- Aqui empieza el contenido dinamico de cada sección -->
<?php echo $this->section('contenido'); ?>

<div class="row justify-content-center">
    <div class="col-12 col-md-4 my-5">
        <form action="<?php echo base_url().'contactos/'.$contacto->contacto_id ?>" method="post" novalidate>
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-title lead">Editar un contacto</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $contacto->nombre ?>">
                        <small class="text-danger"><?php echo validation_show_error('nombre'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" name="telefono" id="telefono" class="form-control" value="<?= $contacto->telefono ?>">
                        <small class="text-danger"><?php echo validation_show_error('telefono'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control" value="<?php echo $contacto->correo; ?>">
                        <small class="text-danger"><?php echo validation_show_error('correo'); ?></small>
                    </div>
                    <input type="hidden" name="_method" value="PUT">
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- cierra el cotenido dinamico -->
<?php echo $this->endSection(); ?>