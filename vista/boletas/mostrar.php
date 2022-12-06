<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlBoletas&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevas Boletas</a>
    <br><br>
    <table class="table table-bordered border-primary table-info">
    <thead class="table-dark">
        <tr>
            <th>Id</th>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Clientes</th>
            <th>Vendedor</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <?php 
    if (is_array($data))
    foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idboletas"]?></td>
                <td><?=$c["numero"]?></td>
                <td><?=$c["fecha"]?></td>
                <td><?=$c["total"]?></td>
                <td><?=$c["idclientes"]?></td>
                <td><?=$c["idvendedor"]?></td>
                <td>
                <a href="?ctrl=CtrlBoletas&accion=editar&id=<?=$c["idboletas"]?>">
                    <i class="bi bi-pencil-square "></i> Editar </a>
                / 
                <a href="?ctrl=CtrlBoletas&accion=eliminar&id=<?=$c["idboletas"]?>">
                    <i class="bi bi-trash"></i> Eliminar </a>
                </td>
            </tr>
        <?php }    ?>
    </table>
    <br><a href="?" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>

    </div>
</section>