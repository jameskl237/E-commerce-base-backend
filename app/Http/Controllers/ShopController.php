<?php

namespace App\Http\Controllers;

use App\Services\ShopService;
use App\Helpers\ApiResponse;
use App\Helpers\HttpStatus;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function index()
    {
        try {
            $shops = $this->shopService->getAllShops();
            
            // S'assurer que $shops est toujours un tableau pour le frontend
            $shopsArray = $shops instanceof \Illuminate\Support\Collection 
                ? $shops->toArray() 
                : (is_array($shops) ? $shops : []);
            
            return ApiResponse::success(
                $shopsArray,
                'Boutiques récupérées avec succès',
                HttpStatus::OK
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des boutiques: ' . $e->getMessage(),
                HttpStatus::INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show($id)
    {
        try {
            $shop = $this->shopService->getShopById($id);

            if (!$shop) {
                return ApiResponse::notFound('Boutique non trouvée');
            }

            // S'assurer que les produits sont toujours un tableau
            if ($shop->products instanceof \Illuminate\Support\Collection) {
                $shop->products = $shop->products->toArray();
            } elseif (!is_array($shop->products)) {
                $shop->products = [];
            }

            return ApiResponse::success(
                $shop,
                'Boutique récupérée avec succès',
                HttpStatus::OK
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération de la boutique: ' . $e->getMessage(),
                HttpStatus::INTERNAL_SERVER_ERROR
            );
        }
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $shop = $this->shopService->createShop($data);
        return response()->json($shop, 201);
        // return redirect()->route('shops.index')->with('success', 'Shop created successfully');
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $shop = $this->shopService->updateShop($id, $data);
        return response()->json($shop, 200);
        // return redirect()->route('shops.index')->with('success', 'Shop updated successfully');
    }

    public function delete($id)
    {
        $result = $this->shopService->deleteShop($id);
        if ($result) {
            return response()->json(['message' => 'Shop deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Shop not found or could not be deleted'], 404);
        }
        // return redirect()->route('shops.index')->with('success', 'Shop deleted successfully');
    }
}
