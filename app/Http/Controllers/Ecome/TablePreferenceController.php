<?php

namespace App\Http\Controllers\Ecome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TablePreference;
class TablePreferenceController extends Controller
{
    //
    public function save(Request $request)
    {
        $request->validate([
            'table' => 'required|string',
            'preferences' => 'required|array'
        ]);

        TablePreference::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'table' => $request->table
            ],
            [
                'preferences' => $request->preferences
            ]
        );

        return response()->json(['success' => true]);
    }
    /**
     * Reset table preferences for logged-in user
     */
    public function reset(Request $request)
    {
        $request->validate([
            'table' => 'required|string|max:100',
        ]);

        TablePreference::where('user_id', auth()->id())
            ->where('table', $request->table)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Table preferences reset successfully'
        ]);
    }

}