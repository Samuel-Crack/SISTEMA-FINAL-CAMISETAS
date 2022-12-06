<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary nuevo">
                <i class="fa fa-plus-circle"></i> 
                Insertar Nuevo Vendedor
            </a>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <button id="imprimirPDF" class="btn btn-secondary">
                    <i class="fa fa-file-pdf"></i> 
                    Descargar PDF
                </button>
                <a href="?ctrl=CtrlVendedor&accion=reporte&app=excel" class="btn btn-secondary">
                    <i class="fa fa-file-excel"></i> 
                    Descargar XLS
                </a>
                <a href="?ctrl=CtrlVendedor&accion=reporte&app=word" class="btn btn-secondary">
                    <i class="fa fa-file-word"></i> 
                    Descargar DOC
                </a>
            </div>
        </div>
    </div>
    
    <br><br>
    <table id="tablaDatos" class="table table-bordered border-primary table-info">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dni</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idvendedor"]?></td>
                <td><?=$c["nombres"]?></td>
                <td><?=$c["apellidos"]?></td>
                <td><?=$c["dni"]?></td>
                <td><?=$c["telefono"]?></td>
                <td><?=$c["direccion"]?></td>
                <td>
                <a data-id="<?=$c["idvendedor"]?>" class="editar" href="#">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a data-id="<?=$c["idvendedor"]?>" data-nombre="<?=$c["nombres"]?>" class="eliminar" href="#">
                    <i class="bi bi-trash"></i> Eliminar </a>
                </td>
            </tr>
        <?php }    ?>
        </tbody>
    </table>
    <br><a href="?" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
    </div>
</section>
<!-- Modal Formulario - Nuevo / Editar -->
<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="body-form">
    
        </div>
        
     </div>
    </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="modal-eliminar" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="frm-eliminar"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="body-eliminar">
                <div class="text-center">
                    <h5>¿Estas seguro que deseas seguir con la eliminación?</h5>
                    <h5 class="reg-eliminacion">Registro: </h5>
                </div>
            </div>
            <div class="modal-footer justify-content-between">            
                <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <a type="button" class="btn btn-danger" id="btn-confirmar" href="" data-id="">Eliminar</a>
            </div>
        </div>
    </div>
</div>
