<div class="col-sm-{{ $field['cols'] or 6 }}{{ !empty($field['offs']) ? " col-sm-offset-{$field['offs']}" : '' }}">
    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <label for="{{ $name }}">{{ $field['label'] }}</label>
        <select name="{{ $name }}" class="form-control">
            @if (!empty($options))
                @foreach ($options as $key => $value)
                    <option{!! !empty($entity) && $entity->{$name} == $key ? ' selected' : '' !!} value="{{ $key }}">{{ $value }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
