<!-- Aqui se manda a llamar el layout base -->
<?php

use function PHPUnit\Framework\isEmpty;

 echo $this->extend("plantillas/layout"); ?>

<!-- Aqui empieza el contenido dinamico de cada sección -->
<?php echo $this->section('contenido'); ?>

<div class="container-fluid mt-3">

    <!--Mensaje de alerta-->
    <?php if(session('mensaje')): ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Mensaje </strong> <?php echo session('mensaje'); ?>
    </div>
   <?php endif; ?>

    <div class="row">
        <div class="col-12 col-md-4 my-5 my-md-0 order-2 order-md-1">
            <!--Se incluye el formulario de crear un nuevo contacto-->
           <?php  echo $this->include('contactos/create'); ?>
        </div>
        <div class="col-12 col-md-8 order-1 order-md-2">
            <!--EL formulario para buscar-->
            <div class="row">
                <div class="col-12 d-flex justify-content-center justify-content-md-end">
                    <form class="form-inline my-5 my-lg-0" method="get" action="<?php base_url().'/contactos'; ?>">
                        <div class="input-group mb-2">
                            <input class="form-control" name="buscar" type="search" placeholder="Buscar por nombre" aria-label="Search">
                            <div class="input-group-prepend">
                                <button class="btn btn-light my-sm-0" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2 d-flex justify-content-center justify-content-md-end">
                <small class="text-danger"><?php echo validation_show_error('buscar'); ?></small>
                </div>
            </div>
            <!-- se muestra el listado de contactos-->
            <?php if (!empty($contactos)): ?>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th colspan="2" style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody id="capturar">
                    <?php foreach($contactos as $contacto): ?>
                    <tr>
                        <td><?php echo $contacto->nombre; ?></td>
                        <td><?php echo $contacto->telefono; ?></td>
                        <td><?php echo $contacto->correo; ?></td>
                        <td>
                            <a href="<?php echo base_url().'contactos/editar/'.$contacto->contacto_id; ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                        <td>
                            <a href="#" data-id="<?php echo $contacto->contacto_id; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach;  ?>
                </tbody>                
            </table>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                <?= $pager->links() ?>
                </div>
            </div>
            <!-- Cuando el arreglo de los contactos esta vacio -->
            <?php else: ?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center justify-content-md-start">
                        <p class="text-muted h5">No hay resultados</p>
                    </div>
                </div>
               
            <?php endif ?>
        </div>
    </div>
</div>

<!-- cierra el cotenido dinamico -->
<?php echo $this->endSection(); ?>

<!-- Aqui empieza el contenido dinamico de cada sección -->
<?php echo $this->section('js'); ?>

<script src="<?php echo base_url().'/js/delete.js'; ?>"></script>

<!-- cierra el cotenido dinamico -->
<?php echo $this->endSection(); ?>