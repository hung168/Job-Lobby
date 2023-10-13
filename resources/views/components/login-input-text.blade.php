@props(['name', 'type' => null, 'label', 'value'])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-600">{{ $label }}</label>
    <input type="{{ $type }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="{{ $name }}" value="{{ old($name, $value) }}" />
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
