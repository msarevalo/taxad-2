@extends('autenticacion')

<title>Taxad | Legales</title>

@section('formulario')

<style type="text/css">
	.read-more-state {
  display: none;
}

.read-more-target {
  opacity: 0;
  max-height: 0;
  font-size: 0;
  transition: .25s ease;
}

.read-more-state:checked~.read-more-wrap .read-more-target {
  opacity: 1;
  font-size: inherit;
  max-height: 999em;
}

.read-more-state~.read-more-trigger:before {
  content: 'Ver más';
}

.read-more-state:checked~.read-more-trigger:before {
  content: 'Ver menos';
}

.read-more-trigger {
  cursor: pointer;
  display: inline-block;
  padding: 0 .5em;
  color: #666;
  font-size: .9em;
  line-height: 2;
  border: 1px solid #ddd;
  border-radius: .25em;
}

</style>
<div id="proyectos-size">
  <div class="proyectos-content">
    <ul id="proyectos-list">
      <l1>
        <h2 class="proyectos-title">Legales</h2>
      </l1>
	  	<li>
        <h3>Tratamiendo de Datos</h3>
		</li>
        <div>
          <input type="checkbox" class="read-more-state" id="post-1" />

          <div class="read-more-wrap"><span class="read-more-target"><div style="text-align: justify;">{{$tratamiento->text}}</div></span></div>

          <label for="post-1" class="read-more-trigger"></label>
        </div>
        <li>
       <h3>Terminos y Condiciones</h3>
        </li>
        <div>
          <input type="checkbox" class="read-more-state" id="post-2" />

          <p class="read-more-wrap"><span class="read-more-target">{{$terminos->text}}</span></p>

          <label for="post-2" class="read-more-trigger"></label>
        </div> 
    </ul>
  </div>
</div>
@endsection