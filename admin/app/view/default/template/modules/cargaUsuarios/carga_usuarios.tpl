<?php
//load the database configuration file
//include 'dbConfig.php';

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Members data has been inserted successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
<div class="container">
    <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Members list
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Members</a>
        </div>
        <div class="panel-body">
            <form action="<?php echo _MSFW_PATH_ ?>modules/cargaUsuarios/carga_usuarios_callback" method="post" enctype="multipart/form-data" id="importFrm" target="_self">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>id_usuario</th>
                      <th>id_rol</th>
                      <th>id_grupo</th>
                      <th>identificacion</th>
                      <th>codigo</th>
                      <th>nombres</th>
                      <th>apellidos</th>
                      <th>email</th>
                      <th>clave</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_usuarios as $valor => $usuario){ ?>
                    <tr>
                      <td><?php echo utf8_decode($usuario['id_usuario']); ?></td>
                      <td><?php echo utf8_decode($usuario['id_rol']); ?></td>
                      <td><?php echo utf8_decode($usuario['id_grupo']); ?></td>
                      <td><?php echo utf8_decode($usuario['identificacion']); ?></td>
                      <td><?php echo utf8_decode($usuario['codigo']); ?></td>
                      <td><?php echo utf8_decode($usuario['nombres']); ?></td>
                      <td><?php echo utf8_decode($usuario['apellidos']); ?></td>
                      <td><?php echo utf8_decode($usuario['email']); ?></td>
                      <td><?php echo utf8_decode($usuario['clave']); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>