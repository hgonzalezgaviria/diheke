@if (! $errors->isEmpty())
    <div id="error" class="alert alert-danger" style="max-height: 150px; overflow-y: auto;">
        <p><strong>Error!</strong> Por favor solucione los siguientes errores:</p>
        <ul>
        	@foreach ($errors->all() as $error)
        		<li> {{ $error }} </li>
        	@endforeach
        </ul>
    </div>
@endif
