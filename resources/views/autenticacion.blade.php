<?php
include '..\App\Http\Controllers\MenuController.php';
$menu = $items->menus();
$separa = $items->separador();
?>

<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <title>TAXAD</title>
    <link rel="shortcut icon" href="../../../../img/logo.ico" />
</head>
@if(Auth::user()->profile<=2)
<body onload="notificaciones('{{Auth::user()->username}}')">
@else
<body>
@endif
    <div class="container-fluid p-0">

        <!-- Bootstrap row -->
        <style type="text/css">
           @import url('https://fonts.googleapis.com/css?family=Montserrat');
           /*-------------------------------- END ----*/
           #body-row {
            margin-left: 0;
            margin-right: 0;
        }
        #sidebar-container {
            min-height: 100vh;
            background-color: #132644;
            padding: 0;
            /* flex: unset; */
        }
        .sidebar-expanded {
            width: 230px;
        }
        .sidebar-collapsed {
            /*width: 60px;*/
            width: 100px;
        }
        /* ----------| Menu item*/    
        #sidebar-container .list-group a {
            height: 50px;
            color: white;
        }
        /* ----------| Submenu item*/    
        #sidebar-container .list-group li.list-group-item {
            background-color: #132644;
        }
        #sidebar-container .list-group .sidebar-submenu a {
            height: 45px;
            padding-left: 30px;
        }
        .sidebar-submenu {
            font-size: 0.9rem;
        }
        /* ----------| Separators */    
        .sidebar-separator-title {
            background-color: #132644;
            height: 35px;
        }
        .sidebar-separator {
            background-color: #132644;
            height: 25px;
        }
        .logo-separator {
            background-color: #132644;
            height: 60px;
        }
        a.bg-dark {
            background-color: #132644 !important;
        }
        #not-estilo{
            border-radius: 200px 200px 200px 200px;
            background-color: red;
            margin-left: 10px;
            width: 30px;
        }
    </style>
    <script type="text/javascript">
        // Hide submenus
        //$('#body-row .collapse').collapse('hide'); 
        // Collapse/Expand icon
        //$('#collapse-icon').addClass('fa-angle-double-left'); 
        // Collapse click
        //$('[data-toggle=sidebar-colapse]').click(function() {
          //  SidebarCollapse();
        //});
        function SidebarCollapse () {
            $('.menu-collapsed').toggleClass('d-none');
            $('.sidebar-submenu').toggleClass('d-none');
            $('.submenu-icon').toggleClass('d-none');
            $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
            
            // Treating d-flex/d-none on separators with title
            var SeparatorTitle = $('.sidebar-separator-title');
            if ( SeparatorTitle.hasClass('d-flex') ) {
                SeparatorTitle.removeClass('d-flex');
            } else {
                SeparatorTitle.addClass('d-flex');
            }
            
            // Collapse/Expand icon
            $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
        }
    </script>

<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <?php 
        for ($i=0; $i < sizeof($menu); $i++):
            if ($menu[$i]->submenu==0) {
                for ($k=0; $k < sizeof($separa) ; $k++) { 
                    if ($separa[$k]['subsequent_menu']==$menu[$i]->id) {
                    ?>
                        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                            <small>{{$separa[$k]['name']}}</small>
                        </li>
                    <?php
                    }
                }
                if ($menu[$i]->ruta!==NULL) {
                    $ruta = $menu[$i]->ruta;
                    $icono = $menu[$i]->class;
                    $nombre = $menu[$i]->nombre;
                    if ($nombre==="Perfil") {
                        $nombre = Auth::user()->name;
                    }
                    if ($nombre!=="Cerrar Sesión") {    
                    ?>
                        <a href="{{ $ruta }}" class="bg-dark list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-fw mr-3"><i class="{{$icono}}" aria-hidden="true"></i></span>
                                <span class="menu-collapsed">{{$nombre}}</span>
                                <?php
                                    if ($nombre=="Notificaciones") {
                                        # code...
                                        ?>
                                            <span id="not-estilo"><center><span id="not"></span></center></span>
                                        <?php
                                    }
                                ?>
                            </div>
                        </a>
                    <?php
                }else{
                    ?>
                    <a href="{{ route('logout') }}" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span id="collapse-icon" class="a fa-fw mr-3"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                            <span id="collapse-text" class="menu-collapsed">Cerrar Sesión</span>
                            </div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    <?php
                    }
            }else{
                $ruta = "submenu" . $menu[$i]->id;
                $icono = $menu[$i]->class;
                $nombre = $menu[$i]->nombre;
                ?>

                <a href="#{{$ruta}}" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-fw mr-3"><i class="{{$icono}}" aria-hidden="true"></i></span>
                        <span class="menu-collapsed">{{$nombre}}</span> 
                        <span class="submenu-icon ml-auto"></span>   
                    </div>
                </a>
                <div id='{{$ruta}}' class="collapse sidebar-submenu">
                    <?php
                        $hijos = $items->hijos($menu[$i]->id);
                        for ($j=0; $j < sizeof($hijos); $j++):
                            if ($menu[$i]->id==$hijos[$j]->padre) {
                                
                                if ($hijos[$j]->ruta!==NULL) {
                                    $rutah = $hijos[$j]->ruta;
                                    $nombreh = $hijos[$j]->nombre;
                                    ?>
                                    <a href="{{ $rutah }}" class="list-group-item list-group-item-action bg-dark text-white">
                                        <span class="menu-collapsed">{{$nombreh}}</span>
                                    </a>
                                    <?php
                                }
                            }
                        endfor
                        ?>
                    </div>
                    <?php
                }
            }
        endfor
    ?>
    <!-- Logo -->
    <li class="list-group-item logo-separator d-flex justify-content-center">
        <img src='../../../../img/logo100x100.png' width="30" height="30" />    
    </li>   

</ul><!-- List Group END-->
</div><!-- sidebar-container END -->

<!-- MAIN -->
<div class="col">

    <div class="container">
        @yield('formulario')
    </div>

</div><!-- Main Col END -->

</div><!-- body-row END -->


</div><!-- container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../../../../js/notificacion.js"></script>
</body>
</html>
@yield('scripts')