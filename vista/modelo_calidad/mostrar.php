<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlModelo_calidad&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Modelo Calidad</a>
    <br><br>
    <table class="table table-bordered border-primary table-info">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Modelo</th>
            <th>Calidad</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idmodelo_calidad"]?></td>
                <td><?=$c["modelo"]?></td>
                <td><?=$c["calidad"]?></td>
                <td>
                <a class="btn btn-success btn-sm" href="?ctrl=CtrlModelo_calidad&accion=editar&id=<?=$c["idmodelo_calidad"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a class="btn btn-danger btn-sm" href="?ctrl=CtrlModelo_calidad&accion=eliminar&id=<?=$c["idmodelo_calidad"]?>">
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