


<select id="materia" name="materia" required=""  class="form-control">
	<option value="">--SELECCIONE MATERIA--</option>
	@foreach($materias as $mate)
	<option value="{!! $mate->id !!}">{!!$mate->nombre!!}</option>
    @endforeach
</select>



