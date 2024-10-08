@extends('adminlte::page')

@section('title', 'Crear Roles')

@section('content_header')

    <h1>Roles</h1>
@stop

@section('content')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div id="errorBox"></div>
           <form action="{{route('users.roles.store')}}" method="POST">
        @csrf
            <div class="card">
  
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label">Nombre <span  class="text-danger"> *</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Form e.g Manager" value={{old('name')}}>
                    @if($errors->has('name'))
                        <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <label for="name" class="form-label">Asignación de permiso <span  class="text-danger"> *</span></label>
                <div class="table-responsive">
                    <table id="tblData" class="table table-boardeed table-striped dataTable dtr-inline ">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="all_permission" name="all_permission"></th>
                                <th>Nombre</th>
                                <th>Guard</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar Rol</button>

            </div>
        </div>
           </form>
    </div>
        <div class="row">
           
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        $(document).ready(function(){
          //checked or
         $('[name="all_permission"]').on('click',function(){
            if($(this).is(":checked"))
         {
            $.each($('.permission'), function(){
                if($(this).val()!="dashboard")
            {
                $(this).prop('checked', true);
            }
            });
         }else{
            $.each($('.permission'), function(){
                if($(this).val()!="dashboard")
                {
                    $(this).prop('checked', false);
                }
            });
         }
         });   
        var table = $('#tblData').DataTable({
            reponsive:true, processing:true, serverSide:true, autoWidth:false, bPaginate:false, bFilter:false,
            ajax:"{{route('users.permissions.index')}}",
            columns:[
                {data:'chkBox', name:'chkBox', orderable:false, searchable:false, className:'text-center'},
                {data:'name', name:'name'},
                {data:'guard_name', name:'guard_name'},

            ],
            order:[[0, "desc"]]
        });
        $('body').on('click', '#btnDel',function(){
            //confirmacion
            var id = $(this).data('id');
            if(confirm('Borrar registro '+id+'?')==true)
        {
            var route = "{{route('users.permissions.destroy', ':id')}}"
            route = route.replace(':id', id);
            $.ajax({
                url:route,
                type:"delete",
                success:function(res){
                    $("#tblData").DataTable().ajax.reload();
                },
                error:function(res){
                     $('#errorBox').html('<div class="alert alert-danger"'+response.message+'</div>');   
                }
            });
        }else{
            //algo
        }
        });
    });
    
    </script>
@stop
@section('plugins.Datatables', true)