<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $termino = $request->input('empleado');

        // Realiza la búsqueda en la base de datos
        $resultados = Empleado::where('nombre', 'LIKE', "%$termino%")->get();

        return view('empleado.index', compact('resultados'));
        //return view('empleado.index', ['empleados' => Empleado::orderBy('created_at', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleado.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpleadoRequest $request)
    {
        Empleado::create($request->validated());
        return to_route('empleado.index')->with('status', 'Empleado agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return view('empleado.show', ['empleado' => $empleado]);
    }

    public function buscar(Request $request)
    {
        $termino = $request->input('empleado');

        // Realiza la búsqueda en la base de datos
        $resultados = Empleado::where('nombre', 'LIKE', "%$termino%")->get();

        return view('empleado.partials.search', compact('resultados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado): View
    {
        return view('empleado.edit', ['empleado' => $empleado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        $empleado->update($request->validated());
        return to_route('empleado.index')->with('status', 'Empleado actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Empleado $empleado)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $empleado->delete();
        return to_route('empleado.index')->with('status', 'Empleado eliminado');
    }
}
