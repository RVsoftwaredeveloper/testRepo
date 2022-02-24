@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.partials.head')
</head>
<body>
  @include('layouts.partials.sidebar')
  @include('layouts.partials.navbar')
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12 card-header text-center font-weight-bold">
          <h2>Old Project CRUD with AJax</h2>
        </div>
        <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNewProduct" class="btn btn-success">Add</button></div>
        <div class="col-md-12">
            <table class="table" id="prod">
              <thead>
                <tr>
                  <th scope="col">Checkall</th>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Details</th>
                  <th scope="col">File</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody> 
               
                @foreach ($products as $product)
                <tr>
                    <td><input type='checkbox' name='productid' value ='.$product["id"].'></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->details }}</td>
                    <td>{{ $product->file }}</td>
                   
                    <td>
                       <a href="javascript:void(0)" class="btn btn-primary edit" data-id="{{ $product->id }}">Edit</a>
                      <a href="javascript:void(0)" class="btn btn-primary delete" data-id="{{ $product->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
             {!! $products->links() !!}
        </div>
    </div>        
</div>
<!-- boostrap model -->
    <div class="modal fade" id="ajax-product-model" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ajaxproductModel"></h4>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="addEditProductForm" name="addEditProductForm" class="form-horizontal" method="POST">
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Product Detail</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="detail" name="detail" placeholder="Enter Product Detail" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                   <label for="name" class="col-sm-2 control-label">File</label>
                   <div class="col-sm-12">
                      <input type="file" name="file" placeholder="Choose file" id="file">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                  </div>
              </div>
              
              
              
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewProduct">Save changes
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>
<!-- end bootstrap model -->
<script>
             $(document).ready(function() {
   var table = $('#prod').DataTable({
      'ajax': '{{ url('edit-product') }}',
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi',
         'selector': 'td:first-child'
      },     
      'order': [[1, 'asc']]
   });
});


</script>
<script type="text/javascript">

 $(document).ready(function($){
    // $.ajaxSetup({
    //     headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    $('#addNewProduct').click(function () {
       $('#addEditProductForm').trigger("reset");
       $('#ajaxProductModel').html("Add Product");
       $('#ajax-product-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
            type:"POST",
            url: "{{ url('edit-product') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxproductModel').html("Edit Product");
              $('#ajax-product-model').modal('show');
              $('#id').val(res.id);
              $('#name').val(res.name);
              $('#detail').val(res.detail);
              $('#file').val(res.file);
              
           }
        });
    });
    $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
            type:"POST",
            url: "{{ url('delete-product') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              window.location.reload();
           }
        });
       }
    });
    $('body').on('click', '#btn-save', function (event) {
          var id = $("#id").val();
          var name = $("#name").val();
          var detail = $("#detail").val();
          var file = $("#file").val();
          

          $("#btn-save").html('Please Wait...');
          $("#btn-save"). attr("disabled", true);
         
        // ajax
        $.ajax({
            headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },

            type:"POST",
            url: "{{ route('Addition') }}",
            data: {
              id:id,
              name:name,
              detail:detail,
              file:file,
            },
            dataType: 'json',
            success: function(res){
                console.log(res);
             window.location.reload();
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
           }
        });
    });
});
</script>
</body>
</html>