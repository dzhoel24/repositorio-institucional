<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait WithFilteringAndPagination
{
    public function applyFilters(Request $request, $query)
    {
        $sort = $request->input('sort', 'asc'); 
        $itemsPerPage = $request->input('items_per_page', 10); 
        $query->orderBy('titulo', $sort);
        return $query->paginate($itemsPerPage)->appends($request->query());
    }
    public function applyFiltersAutor(Request $request, $query)
    {
        $sort = $request->input('sort', 'asc'); 
        $itemsPerPage = $request->input('items_per_page', 10); 
        $query->orderBy('apellidos', $sort);
        return $query->paginate($itemsPerPage)->appends($request->query());
    }
    public function applyFiltersFecha(Request $request, $query)
    {
        $sort = $request->input('sort', 'asc'); 
        $itemsPerPage = $request->input('items_per_page', 10); 
        $query->orderBy('anio', $sort);
        return $query->paginate($itemsPerPage)->appends($request->query());
    }
    public function applyFiltersTitle(Request $request, $query)
    {
        $sort = $request->input('sort', 'asc'); 
        $itemsPerPage = $request->input('items_per_page', 10); 
        $query->orderBy('titulo', $sort);
        return $query->paginate($itemsPerPage)->appends($request->query());
    }
    public function applyFiltersTitleSearh(Request $request, $query)
{
    // Obtener el tipo de orden desde la solicitud (asc o desc)
    $sort = $request->input('sort', 'asc'); 
    // Obtener la cantidad de elementos por página desde la solicitud
    $itemsPerPage = $request->input('items_per_page', 10); 

    // Aplicar el orden a la consulta
    $query->orderBy('titulo', $sort);

    // Realizar la paginación y retornar los resultados
    return $query->paginate($itemsPerPage)->appends($request->query());
}

    
}
