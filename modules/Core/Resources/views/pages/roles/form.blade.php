@php
    $role   = isset($role) ? $role : null;
    $action = route('admin.system.roles.store');

    if($role) {
        $action = route('admin.system.roles.update', ['id' => $role->id]);
    }
@endphp

<x-forms::default-form method="POST" :action="$action">
    @if($role)
    <input type="hidden" name="__method" value="PUT">
    @endif
    <div class="card">
        <div class="card-body">
            <x-forms::group
                mode="input"
                name="name"
                :label="__('core::messages.roles.name')"
                placeholder="Eg: Admin, Publisher,..."
                required
            />
            <div class="fw-bold mb-2">Roles</div>
            <div class="px-3 py-2 rounded border">
                @foreach($permissions as $key => $values)
                    <div class="mb-2">{{$key}}</div>
                    <div class="list-group">
                    @foreach($values as $permission)
                        <label class="list-group-item">
                            <input
                                class="form-check-input me-1" 
                                type="checkbox" 
                                value="{{ $permission }}" 
                                name="permissions[]"
                            >
                            @lang('core::messages.roles.permissions.'.$permission)
                        </label>
                    @endforeach 
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-forms::default-form>