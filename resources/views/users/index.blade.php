@extends('users.master')
@section('title') User Listing @endsection
@section('content')

<style>
    svg.w-5.h-5{
        width: 25px !important;
    }
    span.relative.z-0.inline-flex.shadow-sm.rounded-md{
        float: right !important;
    }
</style>

<div class="row">
    <div class="col-xl-6">
        <div id="result"></div>
    </div>

    <div class="col-xl-6 text-right">
        <a href="javascript:void(0);" data-target="#addUserModal" data-toggle="modal" class="btn btn-success"> Agregar Nuevo Usuario </a>
    </div>
</div>

<table class="table table-bordered" id="laravel-datatable-crud">
    <thead>
       <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Email</th>
          <th>Telefono </th>
          <th>Documento</th>
          <th>Edad</th>
          <th>Acción</th>
       </tr>
    </thead>
 </table>
</div>


<!-- Create post modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPostModalLabel"> Crear Usuario </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> × </span>
          </button>
        </div>

        <div class="modal-body">
            <form method="POST" id="userForm">
                {{-- @csrf --}}
                <input type="hidden" id="id_hidden" name="id" />
                <div class="form-group">
                    <label for="title"> Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">  Apellido <span class="text-danger">*</span></label>
                    <input type="text" name="lastname" id="lastname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Documento <span class="text-danger">*</span></label>
                    <input type="numeric" name="documento" id="documento" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Telefono <span class="text-danger">*</span></label>
                    <input type="numeric" name="telefono" id="telefono" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Fecha de nacimiento <span class="text-danger">*</span></label>
                    <input type="date" name="birthday" id="birthday" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

            </form>
        </div>

        <div class="modal-footer">
          <button type="submit" id="createBtn" class="btn btn-primary"> Guardar </button>
        </div>

        <div class="result"></div>

      </div>
    </div>
</div>

<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewPostModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewPostModalLabel"> Ver Usuario </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> × </span>
          </button>
        </div>

        <div class="modal-body">
            <form method="POST" id="viewuserForm">
                {{-- @csrf --}}
                <input type="hidden" id="viewid_hidden" name="id" />
                <div class="form-group">
                    <label for="title"> Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="viewname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Apellido <span class="text-danger">*</span></label>
                    <input type="text" name="lastname" id="viewlastname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Documento <span class="text-danger">*</span></label>
                    <input type="numeric" name="documento" id="viewdocumento" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="viewemail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Telefono <span class="text-danger">*</span></label>
                    <input type="numeric" name="telefono" id="viewtelefono" class="form-control">
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" id="createBtn" class="btn btn-primary"> Save </button>
          </div>
  
          <div class="result"></div>
  
        </div>
      </div>
  </div>
</div>
<script type="text/javascript">
    

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function deleteUser(user_id) {
        var status = confirm("Quiere borrar este usuario?");
        if(status == true) {
            $.ajax({
                url: "user/"+user_id,
                method: 'delete',
                dataType: 'json',

                success:function(res) {
                    if(res.status == "success") {
                        $("#result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                    }
                    else if(res.status == "failed") {
                        $("#result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                    }
                }
            });
        }
    }
</script>

@endsection