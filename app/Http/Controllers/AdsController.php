<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdsRequest;
use App\Models\Ad;
use App\Models\AdTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    
    public function index(Request $request)
    {
        $ads = Ad::with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
    
        return $ads;
    }
    



 
    
    public function store(StoreAdsRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $ad = Ad::create([
                'price' => $request->price,
                'reference_number' => strtoupper(Str::random(10)),
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'image' => $request->file('image') ? $request->file('image')->store('ads') : null,
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
                'data' => $ad->only('id', 'price', 'reference_number', 'user_id', 'category_id', 'city_id', 'image'), // Exclude created_at, updated_at
                'translations' => $request->translations, 
            ], 201);
        });
    }
    

    
    


    public function show(Ad $ads)
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
