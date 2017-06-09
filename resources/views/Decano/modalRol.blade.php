<!DOCTYPE html>
<html lang="en">
<head>
    <title>
    </title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
</meta>
</meta>
</head>
<body>

    <div class="container">

    <div class="modal fade" id="modalRol" role="dialog">
        <div class="modal-dialog modal-xs ">
            <div class="modal-content">

                <div class="modal-header text-center">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title">
                        <b>
                            Roles Usuario
                        </b>
                    </h4>
                </div>

                <div class="modal-body">

            <div class="row">
                
              

<div class="col-md-12">

    <div class="table-responsive" >

        <table  class="table table-hover table-striped" cellspacing="0" width="100%">
                <thead>
                        <tr>  
                                <th>Nombre</th>
                                <th>Alias</th>
                                <th>Descripcion</th>
                               
                        </tr>
                </thead>
        <tbody>

        @foreach($rols as $rol)
        <tr role="row" class="odd" id="filaR_{{  $rol->id }}">
            
            <td><span class="label label-default">{{ $rol->name or "Ninguno" }}</span></td>
            <td class="mailbox-messages mailbox-name"><a href="javascript:void(0);" style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $rol->slug  }}</a></td>
            <td>{{ $rol->description }}</td>
            
        </tr>
        @endforeach



        </tbody>
        </table>

    </div>
</div>
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" type="button">
                    Cerrar
                </button>




            </div>
        </div>
    </div>
</div>
</div>


</body>
</html>