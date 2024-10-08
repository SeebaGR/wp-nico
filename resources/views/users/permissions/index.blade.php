@extends('adminlte::page')

@section('title', 'Permisos')

@section('content_header')

    <h1>Permisos</h1>
@stop

@section('content')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form method="POST" action="{{route('users.permissions.store')}}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Agregar nuevo</h5>
                            </div>
                        </div>
                   
                    <div class="card-body">

                        <div class="form-group">
                            <label class="form-label">Nombre <span class="text-danger"></span></label>
                            <input type="text" class="form-control" name="name" placeholder="Ingresa el permiso" value="{{old('name')}}">
                            @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                    
                </form>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Todos los permisos</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tblData" class="table table-boardeed table-striped dataTable dtr-inline ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Guard</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
        var table = $('#tblData').DataTable({
            reponsive:true, processing:true, serverSide:true, autoWidth:false,
            ajax:"{{route('users.permissions.index')}}",
            columns:[
                {data:'id', name:'id'},
                {data:'name', name:'name'},
                {data:'guard_name', name:'guard_name'},
                {data:'action', name:'action'}, 
            ],
            order:[[0, "desc"]]
        });
        $('body').on('click', '#btnDel',function(){
            //confirmacion
            var id = $(this).data('id');
            if(confirm('Borrar registro '+id+'?')==true)
        {
            var route = "{{route('users.permissions.destroy',':id')}}"
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