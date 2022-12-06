<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlModelos&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Modelos</a>
    <br><br>
    <table class="table table-bordered border-primary table-info">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idmodelos"]?></td>
                <td><?=$c["modelo"]?></td>
                <td><?=$c["marca"]?></td>
                <td>
                <a href="?ctrl=CtrlModelos&accion=editar&id=<?=$c["idmodelos"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlModelos&accion=eliminar&id=<?=$c["idmodelos"]?>">
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