<?php

namespace Modules\Pet\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pet\Models\Pet;
use Modules\Pet\Models\PetType;
use Modules\Pet\Models\Breed;
use Modules\Pet\Models\PetNote;
use Modules\Pet\Transformers\PetResource;
use Modules\Pet\Transformers\PetTypeResource;
use Modules\Pet\Transformers\BreedResource;
use Modules\Pet\Transformers\PetNoteResource;
use Auth;

class PetController extends Controller
{
    public function petTypeList(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $pettype = PetType::where('status',1);
      
        if ($request->has('search')) {
            $pettype->where('name', 'like', "%{$request->search}%");
        }

        $pettype = $pettype->paginate($perPage);
        $items = PetTypeResource::collection($pettype);
      

        return response()->json([
            'status' => true,
            'data' => $items,
            'message' => __('pet.pettype_list'),
        ], 200);
    }

    public function petList(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 10);
        $user_id = !empty($request->user_id) ? $request->user_id : auth()->user()->id;
        $pet = Pet::with(['pettype','breed'])->where('status',1)->where('user_id',$user_id);
        
        if ($request->has('search')) {
            $pet->where('name', 'like', "%{$request->search}%");
        }

        if ($request->has('pettype_id') && $request->pettype_id != '') {
            // $pet = $pet->whereIn('pettype_id', $parent_id)->orWhere('pettype_id', $request->pettype_id);
            $pet = $pet->Where('pettype_id', $request->pettype_id);
        }
        $pet = $pet->paginate($perPage);
        $items = PetResource::collection($pet);
      

        return response()->json([
            'status' => true,
            'data' => $items,
            'message' => __('pet.pet_list'),
        ], 200);
    }

    public function breedList(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $breed = Breed::where('status',1);
      
        if ($request->has('search')) {
            $breed->where('name', 'like', "%{$request->search}%")
                ->orWhere('description', 'like', "%{$request->search}%");
        }
        if ($request->has('pettype_id')) {
            $breed->where('pettype_id',$request->pettype_id);
        }
        $breed = $breed->paginate($perPage);
        $items = BreedResource::collection($breed);
      

        return response()->json([
            'status' => true,
            'data' => $items,
            'message' => __('pet.breed_list'),
        ], 200);
    }

    public function petNoteList(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $pet_note = PetNote::where('status',1);
       
        if (!empty($request->pet_id)) {
            $pet_note->where('pet_id', $request->pet_id);
        }
        if ($request->has('search')) {
            $pet_note->where('name', 'like', "%{$request->search}%");
        }

        $pet_note = $pet_note->paginate($perPage);
        $items = PetNoteResource::collection($pet_note);
      

        return response()->json([
            'status' => true,
            'data' => $items,
            'message' => 'Pet Note List',
        ], 200);
    }
}
