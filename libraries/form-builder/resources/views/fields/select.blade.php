<div class="mb-3 position-relative {{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">
    <label for="{{$id}}" class="{{$viewClass['label']}} form-label">
        {{$label}}
        @if(strpos($attributes, "required") !== false)
        <span class="text-danger">*</span>
        @endif
    </label>

    <div class="{{$viewClass['field']}}">
        <select class="form-control {{$class}}" style="width: 100%;" name="{{$name}}" data-select-mode="tomSelect" {!! $attributes !!} >
            @if($groups)
                @foreach($groups as $group)
                    <optgroup label="{{ $group['label'] }}">
                        @foreach($group['options'] as $select => $option)
                            <option value="{{$select}}" {{ $select == old($column, $value) ?'selected':'' }}>{{$option}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
                @else
                <option value=""></option>
                @foreach($options as $select => $option)
                    <option value="{{$select}}" {{ $select == old($column, $value) ?'selected':'' }}>{{$option}}</option>
                @endforeach
            @endif
        </select>
        @include('form-builder::help-block')
        @include('form-builder::error')
    </div>
</div>