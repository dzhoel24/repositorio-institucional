{{-- MODALES DESPUBLICAR --}}
@foreach ($publicaciones as $info)
    <x-admin.modal-simple id="despublicar-modal{{ $info->id }}" title="Retirar Publicación"
        subtitle="El documento dejará de ser visible al público"
        route="{{ route('admin.publicaciones.toggle', $info->id) }}" method="PATCH" type="warning" buttonText="Sí, retirar">

        <div class="text-center space-y-2">
            <span
                class="inline-flex items-center rounded-full bg-amber-50 dark:bg-amber-500/10 px-2.5 py-0.5 text-xs font-semibold text-amber-600 dark:text-amber-400 ring-1 ring-amber-200 dark:ring-amber-500/20">
                #{{ $info->id }}
            </span>
            <p class="text-sm font-bold text-slate-800 dark:text-slate-100">
                {{ $info->titulo }}
            </p>
        </div>

        <input type="hidden" name="acceso" value="{{ $info->acceso }}">
    </x-admin.modal-simple>
@endforeach
