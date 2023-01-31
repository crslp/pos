<div>
    @foreach($tables as $table)
        <div>
            {{ __('Table') }} {{ $table->name }}
        </div>
    @endforeach
</div>
