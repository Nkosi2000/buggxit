@props([
    'align' => 'right', 
    'width' => '48', 
    'contentClasses' => 'py-1 bg-gray-900 border border-gray-800',
    'triggerType' => 'click', // 'click' or 'hover'
])

@php
$alignmentClasses = match ($align) {
    'left' => 'origin-top-left left-1',
    'top' => 'origin-top',
    default => 'origin-top-right right-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => 'w-48',
};

// Hover or click behavior
$hoverAttributes = $triggerType === 'hover' ? 'x-on:mouseenter="open = true" x-on:mouseleave="open = false"' : '';
@endphp

<div class="relative" 
     x-data="{ open: false }" 
     @if($triggerType === 'click') 
        @click.outside="open = false" 
        @close.stop="open = false" 
     @endif
     {!! $hoverAttributes !!}>
    
    <!-- Trigger -->
    <div @if($triggerType === 'click') @click="open = !open" @endif>
        {{ $trigger }}
    </div>

    <!-- Dropdown Content -->
    <div x-show="open"
         @if($triggerType === 'click')
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
         @endif
         class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
         style="display: none;"
         @if($triggerType === 'click') @click="open = false" @endif>
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>