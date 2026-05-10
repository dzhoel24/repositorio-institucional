@foreach ($autores as $autor)
    <x-admin.modal-delete id="delete-modal{{ $autor->dni }}" title="ELIMINAR AUTOR"
        route="{{ route('admin.autores.destroy', $autor->dni) }}" itemName="{{ $autor->nombres }} {{ $autor->apellidos }}"
        itemId="{{ $autor->dni }}" />
@endforeach
