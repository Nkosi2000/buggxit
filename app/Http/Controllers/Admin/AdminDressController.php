<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminDressController extends Controller
{
    // Dress categories with SKU prefixes
    private $dressCategories = [
        'SLMK' => 'Slay Makoti Dress Set',
        'ZMBN' => 'Zimbini Dress Set',
        'CLPS' => 'Classic Panel Skirt Apron and Doek Set',
        'NKWA' => 'Nokwanda Dress set',
        'PNDK' => 'Phenduka Skirt',
        'SLBL' => 'Slay Bubble Dress',
        'CUSTOM' => 'Other (Custom SKU)',
    ];

    // Available sizes (32-42)
    private $availableSizes = [32, 34, 36, 38, 40, 42];

    // Available colors
    private $availableColors = [
        'red' => 'Red',
        'blue' => 'Blue',
        'green' => 'Green',
        'yellow' => 'Yellow',
        'purple' => 'Purple',
        'pink' => 'Pink',
        'orange' => 'Orange',
        'black' => 'Black',
        'white' => 'White',
        'brown' => 'Brown',
        'gray' => 'Gray',
        'gold' => 'Gold',
        'silver' => 'Silver',
        'multi' => 'Multi-color',
    ];

    /**
     * Manual authentication check – redirects to login if not authenticated.
     */
    private function checkAuth()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    /**
     * Display a listing of dresses.
     */
    public function index()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $dresses = Dress::latest()->paginate(10);
        
        return view('admin.dresses.index', [
            'dresses' => $dresses,
            'categories' => $this->dressCategories,
        ]);
    }

    /**
     * Show the form for creating a new dress.
     */
    public function create()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.dresses.create', [
            'categories' => $this->dressCategories,
            'availableSizes' => $this->availableSizes,
            'availableColors' => $this->availableColors,
        ]);
    }

    /**
     * Store a newly created dress.
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku_prefix' => 'required|in:' . implode(',', array_keys($this->dressCategories)),
            'custom_sku' => 'nullable|required_if:sku_prefix,CUSTOM|string|max:20',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'turnaround_time' => 'required|string|max:100',
            'expected_delivery' => 'required|string|max:100',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'in:' . implode(',', $this->availableSizes),
            'colors' => 'required|array|min:1',
            'colors.*' => 'in:' . implode(',', array_keys($this->availableColors)),
            'status' => 'required|in:draft,active,out_of_stock',
            'is_featured' => 'boolean',
            'main_image' => 'nullable|image|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|max:2048',
        ]);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('dresses', 'public');
            $validated['main_image_url'] = Storage::url($path);
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('dresses/gallery', 'public');
                $galleryPaths[] = Storage::url($path);
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        // If not CUSTOM category, clear custom_sku
        if ($validated['sku_prefix'] !== 'CUSTOM') {
            $validated['custom_sku'] = null;
        }

        Dress::create($validated);

        return redirect()->route('admin.dresses.index')
            ->with('success', 'Dress created successfully!');
    }

    /**
     * Display the specified dress.
     */
    public function show(Dress $dress)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.dresses.show', [
            'dress' => $dress,
            'categories' => $this->dressCategories,
            'availableColors' => $this->availableColors,
        ]);
    }

    /**
     * Show the form for editing the specified dress.
     */
    public function edit(Dress $dress)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.dresses.edit', [
            'dress' => $dress,
            'categories' => $this->dressCategories,
            'availableSizes' => $this->availableSizes,
            'availableColors' => $this->availableColors,
        ]);
    }

    /**
     * Update the specified dress.
     */
    public function update(Request $request, Dress $dress)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku_prefix' => 'required|in:' . implode(',', array_keys($this->dressCategories)),
            'custom_sku' => 'nullable|required_if:sku_prefix,CUSTOM|string|max:20',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'turnaround_time' => 'required|string|max:100',
            'expected_delivery' => 'required|string|max:100',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'in:' . implode(',', $this->availableSizes),
            'colors' => 'required|array|min:1',
            'colors.*' => 'in:' . implode(',', array_keys($this->availableColors)),
            'status' => 'required|in:draft,active,out_of_stock',
            'is_featured' => 'boolean',
            'main_image' => 'nullable|image|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|max:2048',
        ]);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($dress->main_image_url) {
                $oldPath = str_replace('/storage/', 'public/', $dress->main_image_url);
                Storage::delete($oldPath);
            }
            $path = $request->file('main_image')->store('dresses', 'public');
            $validated['main_image_url'] = Storage::url($path);
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images if exists
            if ($dress->gallery_images) {
                foreach ($dress->gallery_images as $oldImage) {
                    $oldPath = str_replace('/storage/', 'public/', $oldImage);
                    Storage::delete($oldPath);
                }
            }
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('dresses/gallery', 'public');
                $galleryPaths[] = Storage::url($path);
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        // If not CUSTOM category, clear custom_sku
        if ($validated['sku_prefix'] !== 'CUSTOM') {
            $validated['custom_sku'] = null;
        }

        $dress->update($validated);

        return redirect()->route('admin.dresses.index')
            ->with('success', 'Dress updated successfully!');
    }

    /**
     * Remove the specified dress.
     */
    public function destroy(Dress $dress)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        // Delete images from storage
        if ($dress->main_image_url) {
            $path = str_replace('/storage/', 'public/', $dress->main_image_url);
            Storage::delete($path);
        }
        if ($dress->gallery_images) {
            foreach ($dress->gallery_images as $image) {
                $path = str_replace('/storage/', 'public/', $image);
                Storage::delete($path);
            }
        }
        $dress->delete();

        return redirect()->route('admin.dresses.index')
            ->with('success', 'Dress deleted successfully!');
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(Dress $dress)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $dress->update(['is_featured' => !$dress->is_featured]);
        $status = $dress->is_featured ? 'featured' : 'unfeatured';
        return back()->with('success', "Dress {$status} successfully!");
    }

    /**
     * Update status.
     */
    public function updateStatus(Request $request, Dress $dress)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $request->validate([
            'status' => 'required|in:draft,active,out_of_stock'
        ]);
        $dress->update(['status' => $request->status]);
        return back()->with('success', 'Status updated successfully!');
    }
}