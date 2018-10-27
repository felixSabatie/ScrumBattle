<?php

namespace App\Http\Controllers\Api;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{

    static $variables = ['name','column_id'];

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'column_id' => 'required|exists:columns,id',
                'column_id.exists' => 'No an existing ID'
            ]);
            $card = Card::Create([
                'name' => $request->name,
                'column_id' => $request->column_id
            ]);

            return response()->json($card);
        } catch (\Throwable $exception) {
            $r = [
                "ex" => $exception->getMessage(),
                'data' => [
                    "name" => $request->name,
                    "column" => $request->column_id
                ]
            ];
            return response()->json($r);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'column_id' => 'required|exists:columns,id',
                'column_id.exists' => 'No an existing ID'
            ]);

            Card::where('id', $card->id)
                ->firstOrFail()
                ->update($request->only(CardsController::$variables));
            $updateCard = $card->fresh();
            return response()->json($updateCard);
        } catch (\Throwable $exception) {
            return response()->json($exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     * return true if deleted
     * @param  \App\Models\Card $card
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Card $card)
    {
        $card->users()->detach();

        $deleted = $card->delete();
        return response()->json($deleted);
    }
}
