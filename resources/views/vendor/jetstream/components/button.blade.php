@props(['overideBg' => 'no'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 ' . (($overideBg == 'no') ? 'bg-green-600 ' : '') . ' border border-transparent font-breadcrumb rounded-md font-bold text-xs text-white uppercase tracking-wider hover:bg-green-500 active:bg-green-500 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-500 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
