<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlImagenes_producto&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Imagenes de Productos</a>
    <br><br>
    <table class="table table-bordered border-primary table-info">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Url</th>
            <th>Nombre</th>
            <th>Detalles Camisetas</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idimagen"]?></td>
                <td><?=$c["url"]?></td>
                <td><?=$c["nombre"]?></td>
                <td><?=$c["iddetalles_camisetas"]?></td>
                <td>
                <a href="?ctrl=CtrlImagenes_producto&accion=editar&id=<?=$c["idimagen"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlImagenes_producto&accion=eliminar&id=<?=$c["idimagen"]?>">
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