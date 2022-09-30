<div class="dropdown open" style="position: static">
    <button 
        class="btn btn-dropdown dropdown-toggle" 
        type="button" 
        data-bs-toggle="dropdown" 
        data-bs-boundary="viewport"
        aria-haspopup="true"
        aria-expanded="false"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><circle cx="8" cy="2.5" r=".75"/><circle cx="8" cy="8" r=".75"/><circle cx="8" cy="13.5" r=".75"/></g></svg>
    </button>
    <div class="dropdown-menu">
        @foreach($table->actions as $action)
            <a class="dropdown-item" href="{{ $action->url }}">{{ $action->text }}</a>
        @endforeach
    </div>
</div>