<form action="<?php echo base_url(); ?>contactos" method="post" novalidate>
    <div class="card shadow">
        <div class="card-header">
            <div class="card-title lead">Registar un nuevo contacto</div>
        </div>

        <?php /* if (! empty(session('errors'))): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
            </ul>
        </div>
        <?php endif  */?>

        <div class="card-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?=old('nombre');?>">
                <small class="text-danger"><?php echo validation_show_error('nombre'); ?></small>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" class="form-control" value="<?=old('telefono');?>">
                <small class="text-danger"><?php echo validation_show_error('telefono'); ?></small>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" class="form-control" value="<?=old('correo');?>">
                <small class="text-danger"><?php echo validation_show_error('correo'); ?></small>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary btn-block">Guardar</button>
        </div>
    </div>
</form>