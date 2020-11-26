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
            <form action="<?php echo _MSFW_PATH_ ?>modules/cargaPreguntas/carga_preguntas_callback" method="post" enctype="multipart/form-data" id="importFrm" target="_self">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
            <br />
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>id_pregunta</th>
                      <th>id_categoria</th>
                      <th>pregunta</th>
                      <th>puntaje</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($lista_preguntas[0])){ ?>
                  <?php foreach($lista_preguntas as $valor => $pregunta){ ?>
                      <tr>
                        <td><?php echo utf8_decode($pregunta['id_pregunta']); ?></td>
                        <td><?php echo utf8_decode($pregunta['id_categoria']); ?></td>
                        <td><?php echo utf8_decode($pregunta['pregunta']); ?></td>
                        <td><?php echo utf8_decode($pregunta['puntaje']); ?></td>
                      </tr>
                  <?php } ?>
                <?php }else{ ?>
                  <tr>
                    <td colspan="4">No hay preguntas cargadas dentro del aplicativo.</td>
                  </tr>
                <?php } ?>
                </tbody>
            </table>
            <br />
        </div>
    </div>
</div>