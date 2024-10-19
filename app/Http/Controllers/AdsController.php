<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdsRequest;
use App\Models\Ad;
use App\Models\AdTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    
    public function index(Request $request)
    {
        $ads = Ad::with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
    
        if ($ads->isNotEmpty()) {
            return response()->json($ads, 200); 
        } 
        return response()->json([], 404);
    }
    
    

    public function store(StoreAdsRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $ad = Ad::create([
                'price' => $request->price,
                'reference_number' => strtoupper(Str::random(10)),
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'image' => $request->file('image') ? $request->file('image')->store('ads') : null,
                'status' => 0,
            ]);
    
            if ($request->has('translations') && is_array($request->translations)) {
                $translationsData = [];
                foreach ($request->translations as $translation) {
                    $translationsData[] = [
                        'ad_id' => $ad->id,
                        'locale' => $translation['locale'],
                        'name' => $translation['name'],
                        'description' => $translation['description'],
                    ];
                }
                // Insert all translations at once
                AdTranslation::insert($translationsData);
            }
    
            return response()->json([
                'message' => 'Ad created successfully!',
                'data' => $ad->only('id', 'price', 'reference_number', 'user_id', 'category_id', 'city_id', 'image', 'status'), // Exclude created_at, updated_at
                'translations' => $request->translations, 
            ], 201);
        });
    }
    

    
    


    public function show(Request $request, $id)
    {
        $ad = Ad::with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->find($id);
    
        if ($ad) {
            return response()->json($ad, 200); 
        }
    
        return response()->json(['message' => 'Ad not found'], 404);
    }
    


    public function update(Request $request, Ad $ad)
    {
        // Validate the incoming request
        $request->validate([
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'city_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'translations' => 'nullable|array',
            'translations.*.locale' => 'required|string',
            'translations.*.name' => 'required|string',
            'translations.*.description' => 'required|string',
        ]);
    
        // Update the ad's properties
        $ad->price = $request->price;
        $ad->category_id = $request->category_id;
        $ad->city_id = $request->city_id;
    
        // Handle the image upload if provided
        if ($request->hasFile('image')) {
            $ad->image = $request->file('image')->store('ads');
        }
    
        // Save the ad
        $ad->save();
    
        // Update translations if provided
        if ($request->has('translations') && is_array($request->translations)) {
            foreach ($request->translations as $translation) {
                AdTranslation::updateOrCreate(
                    [
                        'ad_id' => $ad->id,
                        'locale' => $translation['locale']
                    ],
                    [
                        'name' => $translation['name'],
                        'description' => $translation['description']
                    ]
                );
            }
        }
    
        return response()->json([
            'message' => 'Ad updated successfully!',
            'data' => $ad->only('id', 'price', 'reference_number', 'user_id', 'category_id', 'city_id', 'image'),
            'translations' => $request->translations,
        ], 200);
    }
    

    public function destroy(Ad $ad)
    {
        if ($ad) {
            $ad->delete(); 
            
            return response()->json(['message' => 'Ad deleted successfully'], 200); 
        }
    
        return response()->json(['message' => 'Ad not found'], 404);
    }
    
}
