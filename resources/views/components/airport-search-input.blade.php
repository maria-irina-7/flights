@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-none dark:bg-slate-300 dark:text-slate-950 focus:border-sky-500 dark:focus:border-sky-600 focus:ring-sky-500 dark:focus:ring-sky-600 placeholder:text-slate-600']) }}>
