@props(['name', 'type' => null, 'label', 'value'])

<div class="mb-6">
    <label for="{{ $name }}" class="inline-block text-lg mb-2">{{ $label }}</label>
    <input type="{{ $type }}" class="border border-gray-200 rounded p-2 w-full" name="{{ $name }}" value="{{ old($name, $value) }}" />
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>