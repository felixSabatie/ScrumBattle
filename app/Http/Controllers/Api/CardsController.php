<?php

namespace App\Http\Controllers\Api;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{

    static $variables = ['name','column_id', 'points'];

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
                'column_id.exists' => 'No an existing ID',
                'points' => 'integer'
            ]);
            $card = Card::Create([
                'name' => $request->name,
                'column_id' => $request->column_id,
                'points' => $request->points,
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
                'name' => 'string|max:255',
                'column_id' => 'required|exists:columns,id',
                'column_id.exists' => 'No an existing ID',
                'points' => 'integer'
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

    public function addUser($id, Request $request)
    {
        $card = Card::findOrFail($id);
        $request->validate([
            'id' => 'required'
        ]);
        $user = User::findOrFail($request->id);
        $card->users()->syncWithoutDetaching($user);

        return response()->json('success', 200);
    }

    public function removeUser($cardId, $userId, Request $request)
    {
        $card = Card::findOrFail($cardId);
        $user = User::findOrFail($userId);
        $card->users()->detach($user);

        return response()->json('success', 200);
    }
}
