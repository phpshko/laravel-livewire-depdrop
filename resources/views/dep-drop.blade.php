<div>
    @if ($isShowDropdown)
        <select wire:model="selectedValue" name="{{ $name }}" class="{{ $cssClass }}">
            @if($placeholder)
                <option value="">{{ $placeholder  }}</option>
            @endif

            @foreach($values as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
        </select>
    @endif
</div>
