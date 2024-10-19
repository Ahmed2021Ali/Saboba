<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AdsController extends Controller
{
    

    // public function index(Request $request)
    // {
    //     $ads = Ad::get()->translations()->where('locale', $request->getLanguages())->get();
    //     return $ads;
    // }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'city_id' => 'required|exists:cities,id',
            'image' => 'nullable|image',
            'translations' => 'nullable|array',
            'translations.*.locale' => 'required|string',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'required|string|max:1000',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Create the ad
        $ad = Ad::create([
            'price' => $request->price,
            'reference_number' => strtoupper(Str::random(10)), // Generate unique reference number
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'image' => $request->image ? $request->file('image')->store('ads') : null,
        ]);
    
        // Check if translations are provided
        if (isset($request->translations) && is_array($request->translations)) {
            foreach ($request->translations as $translation) {
                $locale = $translation['locale'] ?? null;
                $name = $translation['name'] ?? null;
                $description = $translation['description'] ?? null;
    
                // Ensure data is valid
                if ($locale && $name && $description) {
                    // Check if translation already exists for this ad and locale
                    $existingTranslation = AdTranslation::where('ad_id', $ad->id)
                        ->where('locale', $locale)
                        ->first();
    
                    // If it doesn't exist, create a new translation
                    if (!$existingTranslation) {
                        AdTranslation::create([
                            'ad_id' => $ad->id,
                            'locale' => $locale,
                            'name' => $name,
                            'description' => $description,
                        ]);
                    }
                }
            }
        }
    
            
        // Return response without "name" and "description"
        return response()->json([
            'message' => 'Ad created successfully!',
            'data' => [
                'price' => $ad->price,
                'reference_number' => $ad->reference_number,
                'user_id' => $ad->user_id,
                'category_id' => $ad->category_id,
                'city_id' => $ad->city_id,
                'image' => $ad->image,
                'updated_at' => $ad->updated_at,
                'created_at' => $ad->created_at,
                'id' => $ad->id,
                'translations' => $request->translations, // include the translations
            ],
        ], 201);
    }
    
    
    


    public function show(Ad $ads)
    {
        //
    }

    
    public function edit(Ad $ads)
    {
        //
    }


    public function update(Request $request, Ad $ads)
    {
        //
    }


    public function destroy(Ad $ads)
    {
        //
    }
}
