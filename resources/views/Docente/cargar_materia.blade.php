<select class="form-control" id="materia" name="materia" required="">
    <option value="">
        --SELECCIONE MATERIA--
    </option>
    @foreach($materias as $mate)
    <option value="{!! $mate->id !!}">
        {!!$mate->nombre!!}
    </option>
    @endforeach
</select>
