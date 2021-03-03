<div>
    <div wire:ignore>
        <select wire:model="category" name="category_id" class="select-form select2" id="category2" >
            <option value="">-- {{__('Select Category')}} --</option>
            @foreach($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>

@push('scripts')
    <script>
    $(document).ready(function() {
        $('#category2').select2();
        $('#category2').on('change', function (e) {
            var data = $('#category2').select2("val");
            @this.set('category', data);
        });
    });
    </script>
@endpush
