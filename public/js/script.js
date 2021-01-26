/******/ (() => { // webpackBootstrap
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
// Pass csrf token in ajax header
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
}); //----- [ button click function ] ----------

$("#createBtn").click(function (event) {
  event.preventDefault();
  $(".error").remove();
  $(".alert").remove();
  var name = $("#name").val();
  var lastname = $("#lastname").val();
  var documento = $("#documento").val();
  var email = $("#email").val();
  var telefono = $("#telefono").val();

  if (name == "") {
    $("#name").after('<span class="text-danger error"> Title is required </span>');
  }

  if (lastname == "") {
    $("#lastname").after('<span class="text-danger error"> Description is required </span>');
    return false;
  }

  if (telefono == "") {
    $("#lastname").after('<span class="text-danger error"> Telefono is required </span>');
    return false;
  }

  if (documento == "") {
    $("#lastname").after('<span class="text-danger error"> Documento is required </span>');
    return false;
  }

  if (email == "") {
    $("#lastname").after('<span class="text-danger error"> Email is required </span>');
    return false;
  }

  var form_data = $("#userForm").serialize(); // if post id exist

  if ($("#id_hidden").val() != "") {
    updatePost(form_data);
  } // else create post
  else {
      createPost(form_data);
    }
}); // create new post

function createPost(form_data) {
  $.ajax({
    url: 'user',
    method: 'post',
    data: form_data,
    dataType: 'json',
    beforeSend: function beforeSend() {
      $("#createBtn").addClass("disabled");
      $("#createBtn").text("Procesando..");
    },
    success: function success(res) {
      $("#createBtn").removeClass("disabled");
      $("#createBtn").text("Save");

      if (res.status == "success") {
        $(".result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
      } else if (res.status == "failed") {
        $(".result").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
      }
    },
    error: function error(xhr) {
      //Esto me trae todos los errores que son enviados por el validador en caso de haber errores
      $(".result").html('');
      $.each(xhr.responseJSON.errors, function (key, value) {
        $(".result").append('<div class="alert alert-danger">' + value + '</div');
      });
      $("#createBtn").removeClass("disabled");
      $("#createBtn").text("Save");
    }
  });
} // update post


function updatePost(form_data) {
  $.ajax({
    url: 'user',
    method: 'put',
    data: form_data,
    dataType: 'json',
    beforeSend: function beforeSend() {
      $("#createBtn").addClass("disabled");
      $("#createBtn").text("Procesando...");
    },
    success: function success(res) {
      $("#createBtn").removeClass("disabled");
      $("#createBtn").text("Actualizar");

      if (res.status == "success") {
        $(".result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
      } else if (res.status == "failed") {
        $(".result").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
      }
    },
    error: function error(xhr) {
      $(".result").html('');
      $.each(xhr.responseJSON.errors, function (key, value) {
        $(".result").append('<div class="alert alert-danger">' + value + '</div');
      });
      $("#createBtn").removeClass("disabled");
      $("#createBtn").text("Actializar");
    }
  });
} //Modal de creacion y eliminacion


$('#addUserModal').on('shown.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
  var name = $(e.relatedTarget).data('name');
  var lastname = $(e.relatedTarget).data('lastname');
  var documento = $(e.relatedTarget).data('documento');
  var email = $(e.relatedTarget).data('email');
  var telefono = $(e.relatedTarget).data('telefono');
  var password = $(e.relatedTarget).data('birthdayz');
  var birthday = $(e.relatedTarget).data('birthday');
  var action = $(e.relatedTarget).data('action');

  if (action !== undefined) {
    if (action === "edit") {
      // set modal title
      $(".modal-title").html("Actualizar Usuario");
      $("#createBtn").text("Actualizar"); // pass data to input fields

      $("#id_hidden").val(id);
      $("#name").attr("readonly", false);
      $("#name").val(name);
      $("#lastname").attr("readonly", false);
      $("#lastname").val(lastname);
      $("#documento").attr("readonly", false);
      $("#documento").val(documento);
      $("#email").attr("readonly", false);
      $("#email").val(email);
      $("#telefono").attr("readonly", false);
      $("#telefono").val(telefono);
      $("#password").attr("readonly", false);
      $("#password").val(password);
      $("#birthday").attr("readonly", false);
      $("#birthday").val(birthday); // hide button

      $("#createBtn").removeClass("d-none");
    }
  } else {
    $(".modal-title").html("Create user"); // pass data to input fields

    $("#name").removeAttr("readonly");
    $("#name").val("");
    $("#lastname").removeAttr("readonly");
    $("#lastname").val("");
    $("#documento").removeAttr("readonly");
    $("#documento").val("");
    $("#email").removeAttr("readonly");
    $("#email").val("");
    $("#telefono").removeAttr("readonly");
    $("#telefono").val(""); // hide button

    $("#createBtn").removeClass("d-none");
  }
}); // Es el modal de vista detallada 

$('#viewUserModal').on('shown.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
  var name = $(e.relatedTarget).data('name');
  var lastname = $(e.relatedTarget).data('lastname');
  var documento = $(e.relatedTarget).data('documento');
  var email = $(e.relatedTarget).data('email');
  var telefono = $(e.relatedTarget).data('telefono');
  var birthday = $(e.relatedTarget).data('birthday');
  var action = $(e.relatedTarget).data('action');

  if (action !== undefined) {
    if (action === "view") {
      // set modal title
      $(".modal-title").html("Detalles de Usuario"); // pass data to input fields

      $("#viewname").attr("readonly", "true");
      $("#viewname").val(name);
      $("#viewlastname").attr("readonly", "true");
      $("#viewlastname").val(lastname);
      $("#viewdocumento").attr("readonly", "true");
      $("#viewdocumento").val(documento);
      $("#viewemail").attr("readonly", "true");
      $("#viewemail").val(email);
      $("#viewtelefono").attr("readonly", "true");
      $("#viewtelefono").val(telefono);
      $("#viewpassword").attr("readonly", "true");
      $("#viewpassword").val(password); // hide button

      $("#createBtn").addClass("d-none");
    }
  }
}); //Se encarga de grilla 

$(document).ready(function () {
  $('#laravel-datatable-crud').DataTable({
    processing: true,
    serverSide: true,
    "ajax": {
      url: 'users',
      type: 'GET'
    },
    columns: [{
      data: 'id',
      name: 'id'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: 'lastname',
      name: 'lastname'
    }, {
      data: 'email',
      name: 'email'
    }, {
      data: 'telefono',
      name: 'telefono'
    }, {
      data: 'documento',
      name: 'documento'
    }, {
      data: 'Edad',
      name: 'Edad'
    }, {
      data: 'action',
      name: 'action'
    }]
  });
});
/******/ })()
;