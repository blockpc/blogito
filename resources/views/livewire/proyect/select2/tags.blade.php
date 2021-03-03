<div>
    <div wire:ignore class="">
        <select wire:model="selected_tags" name="tags[]" multiple="multiple" class="select-form select2" id="tag2"
        data-placeholder="Seleccione las etiquetas"
        data-allow-clear="false"
        title="Seleccione las etiquetas...">
            @foreach($tags as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>

@push('scripts')
    <script>
    $(document).ready(function() {
        $('#tag2').select2();
        $('#tag2').on('change', function (e) {
            var data = $('#tag2').select2("val");
            // @this.set('selected_tags', data);
        });
    });
    </script>
@endpush