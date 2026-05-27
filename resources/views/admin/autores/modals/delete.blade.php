{{-- MODALES ELIMINAR AUTOR --}}
@foreach ($autores as $autor)
    <x-admin.modal-simple id="delete-modal{{ $autor->dni }}" title="Eliminar Autor"
        subtitle="Esta acción no se puede deshacer" route="{{ route('admin.autores.destroy', $autor->dni) }}"
        type="danger" buttonText="Sí, eliminar">

        <div class="bg-slate-100 dark:bg-slate-700/50 rounded-lg p-4 flex flex-col items-center gap-2 text-center">
            <span
                class="rounded-lg bg-slate-200 dark:bg-slate-700 px-3 py-1 font-mono text-xs font-semibold text-slate-600 dark:text-slate-300 ring-1 ring-slate-300 dark:ring-slate-600">
                DNI: {{ $autor->dni }}
            </span>
            <p class="text-sm font-bold text-slate-800 dark:text-white">{{ $autor->nombres }}</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">¿Confirmas que deseas eliminar este autor?</p>
        </div>
    </x-admin.modal-simple>
@endforeach
