<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlModelo_seleccion&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Modelo Seleccion</a>
    <br><br>
    <table class="table table-bordered border-primary table-info">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Descripcion</th>
            <th>Color</th>
            <th>Modelo</th>
            <th>Seleccion</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idmodelo_seleccion"]?></td>
                <td><?=$c["descripcion"]?></td>
                <td><?=$c["color"]?></td>
                <td><?=$c["modelo"]?></td>
                <td><?=$c["seleccion"]?></td>
                <td>
                <a class="btn btn-success btn-sm" href="?ctrl=CtrlModelo_seleccion&accion=editar&id=<?=$c["idmodelo_seleccion"]?>">
                    <i class="fas fa-pencil-alt"></i> Editar </a>
                / 
                <a class="btn btn-danger btn-sm" href="?ctrl=CtrlModelo_seleccion&accion=eliminar&id=<?=$c["idmodelo_seleccion"]?>">
                    <i class="fas fa-trash"></i> Eliminar </a>
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