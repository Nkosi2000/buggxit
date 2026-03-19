@props(['showText' => false])

<div class="flex items-center text-gray-300 hover:text-yellow-500 transition-colors">
    <i class="fas fa-user-circle {{ $showText ? 'text-xl' : 'text-2xl' }}"></i>
    @if($showText && Auth::check())
        <span class="ml-2 text-sm">{{ Auth::user()->name }}</span>
    @endif
</div>