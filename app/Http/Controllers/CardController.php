<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class CardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:card.index|card.create|card.show|card.edit|card.destroy', ['only'=>['index']]);
        $this->middleware('permission:card.create', ['only'=>['create','store']]);
        $this->middleware('permission:card.show', ['only'=>['show']]);
        $this->middleware('permission:card.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:card.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //$cards = Card::get();

            return DataTables::of(Card::query())
            ->addIndexColumn()
            ->addColumn('edit', 'admin/card/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.card.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardRequest $request)
    {
        $card = new Card;
        $card->name = $request->name;
        $card->save();

        return redirect('card');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view("admin.card.show", compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        return view("admin.card.edit", compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardRequest  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        $card->name = $request->name;
        $card->save();
        Alert::success('Tarjeta','Editada Satisfactoriamente.');
        return Redirect('card');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();
        toast('Tarjeta eliminada con éxito.','success');
        return redirect("card");
    }
}
