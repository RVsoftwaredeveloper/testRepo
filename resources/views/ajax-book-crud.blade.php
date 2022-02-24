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
          <h2>Laravel 8 Ajax Book CRUD </h2>
        </div>
        <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNewBook" class="btn btn-success">Add</button></div>
        <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Book Title</th>
                  <th scope="col">Book Code</th>
                  <th scope="col">Book Author</th>
                  <th scope="col">Book Edition</th>
                  <th scope="col">Book Status</th>
                  <th scope="col">Publish Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody> 
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->code }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{$book->edition}}</td>
                    <td><select name="status" class="vStatus" data-id="{{ $book->id }}">
    <option value="valid" {{($book->status == 'valid') ? 'selected':''}}>Valid</option>
    <option value="invalid" {{($book->status == 'invalid') ? 'selected':''}}>InValid</option>
   
  </select>
</td>
                    <td>{{$book->publish}}</td>
                    <td>
                       <a href="javascript:void(0)" class="btn btn-primary edit" data-id="{{ $book->id }}">Edit</a>
                      <a href="javascript:void(0)" class="btn btn-primary delete" data-id="{{ $book->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
             {!! $books->links() !!}
        </div>
    </div>        
</div>
<!-- boostrap model -->
    <div class="modal fade" id="ajax-book-model" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ajaxBookModel"></h4>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" class="form-horizontal" method="POST">
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Book Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter Book Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Book Code</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="code" name="code" placeholder="Enter Book Code" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Book Author</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="author" name="author" placeholder="Enter author Name" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Book Edition</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="edition" name="edition" placeholder="Enter edition " value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="status">Book Status</label>
                <div class="col-sm-12">
                   <select name="status" id="status">
    <option value="valid">Valid</option>
    <option value="invalid">InValid</option>
   
  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Book Publish</label>
                <div class="col-sm-12">
                  <input type="radio" id="publish" name="fav_language" value="Yes">
  <label for="html">Yes</label><br>
  <input type="radio" id="publish" name="fav_language" value="No">
  <label for="css">No</label><br>
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes
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
<script type="text/javascript">
 $(document).ready(function($){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addNewBook').click(function () {
       $('#addEditBookForm').trigger("reset");
       $('#ajaxBookModel').html("Add Book");
       $('#ajax-book-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('edit-book') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxBookModel').html("Edit Book");
              $('#ajax-book-model').modal('show');
              $('#id').val(res.id);
              $('#title').val(res.title);
              $('#code').val(res.code);
              $('#author').val(res.author);
              $('#edition').val(res.edition);
              $('#status').val(res.status);
              $('#publish').val(res.publish);
           }
        });
    });
    $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('delete-book') }}",
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
          var title = $("#title").val();
          var code = $("#code").val();
          var author = $("#author").val();
          var edition = $("#edition").val();
           // var status  = $('#status').find(":selected").text();
           var status  = $( "#status option:selected" ).val();
           
           
            var publish = $("#publish").val();

          $("#btn-save").html('Please Wait...');
          $("#btn-save"). attr("disabled", true);
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('add-update-book') }}",
            data: {
              id:id,
              title:title,
              code:code,
              author:author,
              edition:edition,
              status:status,
              publish:publish,
            },
            dataType: 'json',
            success: function(res){
             window.location.reload();
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
           }
        });
    });

 //on change code dropdown

 $('.vStatus').on('change', function(){
  var id = $(this).data('id');
  var status  = $(this).val();

  // console.log('hello'+id);
  // 
        $.ajax({
            type:"GET",
            url: "{{ url('update-status') }}",
            data: {
              id:id,
              status:status
            },
            dataType: 'json',
            success: function(res){
              // console.log(res);
             window.location.reload();
            // $("#btn-save").html('Submit');
            // $("#btn-save"). attr("disabled", false);
           }
        });

 });


});



</script>
</body>
</html>