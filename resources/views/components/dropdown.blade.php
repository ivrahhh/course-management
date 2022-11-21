<div class="relative" x-data="{ active: false }"> 
    <div @click="active = !active">
        {{ $toggler }}
    </div>
    <div
        x-show="active"
        @click="active = false"
        @click.outside="active = false"
        style="display: none;"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform scale-90 opacity-0"
        x-transition:enter-end="transform scale-100 opacity-100"
        x-transition:leave="transistion ease-in duration-100"
        x-transition:leave-start="transform scale-100 opacity-100"
        x-transition:leave-end="transform scale-90 opacity-0"
        class="absolute mt-2 right-0 origin-top-right z-50 w-48 rounded-lg shadow-lg" >
        <div class="rounded-lg ring-1 ring-gray-700 py-1 bg-slate-900">
            {{ $menu }}
        </div>
    </div>
</div>