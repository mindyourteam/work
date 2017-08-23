<div class="col-sm-{{ $field['cols'] or 6 }}{{ !empty($field['offs']) ? " col-sm-offset-{$field['offs']}" : '' }}">
    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <label for="{{ $name }}">{{ $field['label'] }}</label>

        <?php
        $value = $errors->any() ? old($name) : (isset($entity->{$name}) ? $entity->{$name} : '');
        ?>
        @if (!empty($field['after']))
            <div class="input-group">
                @include('crud.fields._input')
                <span class="input-group-addon">{{ $field['after'] }}</span>
            </div>
        @elseif (!empty($field['button']))
            <div class="input-group">
                @include('crud.fields._input')
                <span class="input-group-btn">{!! $field['button'] !!}</span>
            </div>
        @else
            @include('crud.fields._input')
        @endif

    </div>
</div>
