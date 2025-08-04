@props(['field'])


@error($field)
    <div class="mt-1 mb-3 list-disc list-inside text-sm text-red-600">
        {{ $message }}
    </div>
@enderror