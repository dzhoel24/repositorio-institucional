@foreach ($informes as $info)
    <x-admin.modal-delete id="delete-modal{{ $info->id }}" title="ELIMINAR PROYECTO"
        route="{{ route('admin.informes.destroy', $info->id) }}" itemName="{{ $info->titulo }}"
        itemId="{{ $info->id }}" />
@endforeach
