<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlDetalle_boleta&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Detalle Boleta</a>
    <br><br>
    <table class="table table-bordered border-primary table-info">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
            <th>Producto</th>
            <th>Boletas (Total)</th>
            <th>Detalles Camisetas (Stock)</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["iddetalle_boleta"]?></td>
                <td><?=$c["cantidad"]?></td>
                <td><?=$c["precio_unitario"]?></td>
                <td><?=$c["subtotal"]?></td>
                <td><?=$c["producto"]?></td>
                <td><?=$c["total"]?></td>
                <td><?=$c["stock"]?></td>
                <td>
                <a href="?ctrl=CtrlDetalle_boleta&accion=editar&id=<?=$c["iddetalle_boleta"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlDetalle_boleta&accion=eliminar&id=<?=$c["iddetalle_boleta"]?>">
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