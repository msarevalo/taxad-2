@extends('autenticacion')

<title>Taxad | Menus</title>

@section('formulario')

@if(session('mensaje'))
    <div class="alert alert-success">
        {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('negar'))
    <div class="alert alert-danger">
        {{session('negar')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container">
    </div>
    <h1>Listado Menus:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Ruta</th>
            <th scope="col">Submenu</th>
            <th scope="col">Menu Padre</th>
            <th scope="col">Logo</th>
            <th scope="col">Orden</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
        <tr>
            <th scope="row">{{$menu->id}}</th>
            <td>
                {{$menu->name}}
            </td>
            <td>
                @if($menu->route==NULL)
                   	Menú Padre
                @elseif($menu->name=="Cerrar Sesión")
                	Cerrar Sesión
                @else
                  	<a href="{{$menu->route}}">
                  		{{$menu->route}}
                   	</a>
                @endif
            </td>
            <td>
                @if($menu->submenu==0)
                	No
                @else
                	Si
                @endif
            </td>
            <td>
            	@if($menu->submenu==1)
	                @foreach($padres as $padre)
	                    @if($padre->id==$menu->parent)
	                        {{$padre->name}}
	                    @endif
	                @endforeach
                @else
                	-
                @endif
            </td>
            <td>
            	<span class="fa fa-fw mr-3"><i class="{{$menu->class}}" aria-hidden="true"></i></span>
            </td>
            <td>{{$menu->order}}</td>
            <td>
            	@if($menu->name=="Perfil")
            	@elseif($menu->name=="Menús")
            	@elseif($menu->name=="Cerrar Sesión")
            	@else
                    @if($permiso[0]->edit==1)
            	       <a href="{{ route('menu.edita', $menu->id) }}" style="text-decoration: none">
                	       <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        </a>
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $menus->links() }}

@endsection