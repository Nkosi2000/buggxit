{{-- resources/views/components/cart-icon.blade.php --}}
@props([
    'showText' => false,
    'count' => 0,
    'size' => 'md', // 'sm', 'md', 'lg'
])

@php
    // Determine icon size based on prop
    $iconSizeClasses = match($size) {
        'sm' => 'text-lg',
        'lg' => 'text-2xl',
        default => 'text-xl',
    };
    
    // Determine counter size based on prop
    $counterSizeClasses = match($size) {
        'sm' => 'w-4 h-4 text-[10px] -top-1 -right-1',
        'lg' => 'w-6 h-6 text-xs -top-2 -right-2',
        default => 'w-5 h-5 text-xs -top-2 -right-2',
    };
@endphp

<a href="{{ route('cart.index') }}" {{ $attributes->merge(['class' => 'flex items-center text-gray-300 hover:text-yellow-500 transition-colors duration-200']) }}>
    <div class="relative">
        <i class="fas fa-shopping-bag {{ $iconSizeClasses }}"></i>
        
        <!-- Cart Counter Badge -->
        @if($count > 0)
            <span class="absolute {{ $counterSizeClasses }} bg-yellow-500 text-gray-900 rounded-full flex items-center justify-center font-bold transform hover:scale-110 transition-transform duration-200">
                {{ $count > 99 ? '99+' : $count }}
            </span>
        @endif
    </div>
    
    @if($showText)
        <span class="ml-2 text-sm font-medium">Cart</span>
    @endif
</a>