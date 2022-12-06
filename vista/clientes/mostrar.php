<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlClientes&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Clientes</a>
    <br><br>
    <table class="table table-bordered border-primary table-info">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dni</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Nacionalidad</th> 
            <th>Correo</th> 
            <th>Operaciones</th> 
 
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idclientes"]?></td>
                <td><?=$c["nombres"]?></td>
                <td><?=$c["apellidos"]?></td>
                <td><?=$c["dni"]?></td>
                <td><?=$c["direccion"]?></td>
                <td><?=$c["telefono"]?></td>
                <td><?=$c["nacionalidad"]?></td>
                <td><?=$c["email"]?></td>

                <td>
                <a href="?ctrl=CtrlClientes&accion=editar&id=<?=$c["idclientes"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlClientes&accion=eliminar&id=<?=$c["idclientes"]?>">
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