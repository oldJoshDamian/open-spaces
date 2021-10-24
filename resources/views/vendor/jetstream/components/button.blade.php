@props(['overideBg' => 'no'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 ' . (($overideBg == 'no') ? 'bg-[#0652c5] ' : '') . ' border border-transparent font-breadcrumb rounded-md font-bold text-xs text-white uppercase tracking-wider hover:bg-blue-500 active:bg-blue-500 focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-500 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
