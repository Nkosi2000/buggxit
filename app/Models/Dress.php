<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'sku_prefix',
        'custom_sku',
        'description',
        'price',
        'turnaround_time',
        'expected_delivery',
        'status',
        'is_featured',
        'sizes',
        'colors',
        'main_image_url',
        'gallery_images',
    ];

    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Helper methods
    public function getDisplaySkuAttribute()
    {
        return $this->sku_prefix === 'CUSTOM' 
            ? $this->custom_sku 
            : $this->sku_prefix;
    }

    public function getAvailableSizesAttribute()
    {
        $allSizes = range(32, 42);
        $selectedSizes = $this->sizes ?? [];
        
        return array_filter($allSizes, function($size) use ($selectedSizes) {
            return in_array($size, $selectedSizes);
        });
    }

    public function getDisplayColorsAttribute()
    {
        $colors = $this->colors ?? [];
        $colorMap = [
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
        
        return array_map(function($color) use ($colorMap) {
            return $colorMap[$color] ?? ucfirst($color);
        }, $colors);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}