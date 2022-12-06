<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlDetalles_camisetas&accion=nuevo" 
        class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevos Detalles Camisetas</a>
    <br><br>
    <table class="table table-bordered border-primary table-info">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Camisetas</th>
            <th>Modelo Talla</th>
            <th>Modelo Seleccion</th>
            <th>Modelo Calidad</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["iddetalles_camisetas"]?></td>
                <td><?=$c["precio"]?></td>
                <td><?=$c["stock"]?></td>
                <td><?=$c["camiseta"]?></td>
                <td><?=$c["talla"]?></td>
                <td><?=$c["seleccion"]?></td>
                <td><?=$c["calidad"]?></td>
                <td>
                <a href="?ctrl=CtrlDetalles_camisetas&accion=editar&id=<?=$c["iddetalles_camisetas"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlDetalles_camisetas&accion=eliminar&id=<?=$c["iddetalles_camisetas"]?>">
                    <i class="bi bi-trash"></i> Eliminar </a>
                / 
                <a href="?ctrl=CtrlDetalles_camisetas&accion=verDetalles&id=<?=$c["iddetalles_camisetas"]?>">
                    <i class="bi bi-pencil-square"></i> Ver Detalles </a>

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