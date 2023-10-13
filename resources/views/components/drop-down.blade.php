@props(['name', 'label', 'options', 'selected'])

<div class="mb-6">
    <label for="{{ $name }}" class="inline-block text-lg mb-2">{{ $label }}</label>
    <select class="form-control" name="{{ $name }}">
        <option value="">--Select--</option>
        @foreach($options as $option)
            <option value="{{ $option }}" {{ old($name, $selected) === $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
