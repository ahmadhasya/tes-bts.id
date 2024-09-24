<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
    }

    public function save(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);

        $checklist = Checklist::create([
            "name" => $request->name,
            "userId" => Auth::user()->id
        ]);

        return response($checklist);
    }

    public function get()
    {
        $data = Checklist::with("details")->where("userId", Auth::user()->id)->get();

        return response($data);
    }

    public function delete($id)
    {
        $data = Checklist::where("userId", Auth::user()->id)->findOrFail($id);
        ChecklistDetail::where("id", $id)->delete();
        $data->delete();

        return response($data);
    }

    public function detailChecklist($id)
    {
        $data = Checklist::with("details")->where("userId", Auth::user()->id)->findOrFail($id);

        return response($data);
    }

    public function saveDetailChecklist(Request $request, $id)
    {
        $request->validate([
            "itemName" => "required"
        ]);

        $checklist = ChecklistDetail::create([
            "itemName" => $request->itemName,
            "checklistId" => $id
        ]);

        return response($checklist);
    }

    public function detailChecklistItem($id, $itemId)
    {
        $data = ChecklistDetail::whereHas("checklist", function ($q) use ($id) {
            $q->where("userId", Auth::user()->id)->where("id", $id);
        })->findOrFail($itemId);

        return response($data);
    }

    public function updateStatusChecklistItem($id, $itemId)
    {
        $data = ChecklistDetail::whereHas("checklist", function ($q) use ($id) {
            $q->where("userId", Auth::user()->id)->where("id", $id);
        })->findOrFail($itemId);

        $data->status = $data->status ? 0 : 1;
        $data->save();

        return response($data);
    }

    public function deleteStatusChecklistItem($id, $itemId)
    {
        $data = ChecklistDetail::whereHas("checklist", function ($q) use ($id) {
            $q->where("userId", Auth::user()->id)->where("id", $id);
        })->findOrFail($itemId);

        $data->delete();

        return response($data);
    }

    public function renameStatusChecklistItem(Request $request, $id, $itemId)
    {
        $request->validate([
            "itemName" => "required"
        ]);

        $data = ChecklistDetail::whereHas("checklist", function ($q) use ($id) {
            $q->where("userId", Auth::user()->id)->where("id", $id);
        })->findOrFail($itemId);

        $data->itemName = $request->itemName;
        $data->save();

        return response($data);
    }
}
