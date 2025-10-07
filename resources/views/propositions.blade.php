<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Propositions - SAIT Survey</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- PWA Manifest -->
        <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-red-50:oklch(.971 .013 17.38);--color-red-100:oklch(.936 .032 17.717);--color-red-200:oklch(.885 .062 18.334);--color-red-300:oklch(.808 .114 19.571);--color-red-400:oklch(.704 .191 22.216);--color-red-500:oklch(.637 .237 25.331);--color-red-600:oklch(.577 .245 27.325);--color-red-700:oklch(.505 .213 27.518);--color-red-800:oklch(.444 .177 26.899);--color-red-900:oklch(.396 .141 25.723);--color-red-950:oklch(.258 .092 26.042);--color-orange-50:oklch(.98 .016 73.684);--color-orange-100:oklch(.954 .038 75.164);--color-orange-200:oklch(.901 .076 70.697);--color-orange-300:oklch(.837 .128 66.29);--color-orange-400:oklch(.75 .183 55.934);--color-orange-500:oklch(.705 .213 47.604);--color-orange-600:oklch(.646 .222 41.116);--color-orange-700:oklch(.553 .195 38.402);--color-orange-800:oklch(.47 .157 37.304);--color-orange-900:oklch(.408 .123 38.172);--color-orange-950:oklch(.266 .079 36.259);--color-amber-50:oklch(.987 .022 95.277);--color-amber-100:oklch(.962 .059 95.617);--color-amber-200:oklch(.924 .12 95.746);--color-amber-300:oklch(.879 .169 91.605);--color-amber-400:oklch(.828 .189 84.429);--color-amber-500:oklch(.769 .188 70.08);--color-amber-600:oklch(.666 .179 58.318);--color-amber-700:oklch(.555 .163 48.998);--color-amber-800:oklch(.473 .137 46.201);--color-amber-900:oklch(.414 .112 45.904);--color-amber-950:oklch(.279 .077 45.635);--color-yellow-50:oklch(.987 .026 102.212);--color-yellow-100:oklch(.973 .071 103.193);--color-yellow-200:oklch(.945 .129 101.54);--color-yellow-300:oklch(.905 .182 98.111);--color-yellow-400:oklch(.852 .199 91.936);--color-yellow-500:oklch(.795 .184 86.047);--color-yellow-600:oklch(.681 .162 75.834);--color-yellow-700:oklch(.554 .135 66.442);--color-yellow-800:oklch(.476 .114 61.907);--color-yellow-900:oklch(.421 .095 57.708);--color-yellow-950:oklch(.286 .066 53.813);--color-lime-50:oklch(.986 .031 120.757);--color-lime-100:oklch(.967 .067 122.328);--color-lime-200:oklch(.938 .127 124.321);--color-lime-300:oklch(.897 .196 126.665);--color-lime-400:oklch(.841 .238 128.85);--color-lime-500:oklch(.768 .233 130.85);--color-lime-600:oklch(.648 .2 131.684);--color-lime-700:oklch(.532 .157 131.589);--color-lime-800:oklch(.453 .124 130.933);--color-lime-900:oklch(.405 .101 131.063);--color-lime-950:oklch(.274 .072 132.109);--color-green-50:oklch(.982 .018 155.826);--color-green-100:oklch(.962 .044 156.743);--color-green-200:oklch(.925 .084 155.995);--color-green-300:oklch(.871 .15 154.449);--color-green-400:oklch(.792 .209 151.711);--color-green-500:oklch(.723 .219 149.579);--color-green-600:oklch(.627 .194 149.214);--color-green-700:oklch(.527 .154 150.069);--color-green-800:oklch(.448 .119 151.328);--color-green-900:oklch(.393 .095 152.535);--color-green-950:oklch(.266 .065 152.934);--color-emerald-50:oklch(.979 .021 166.113);--color-emerald-100:oklch(.95 .052 163.051);--color-emerald-200:oklch(.905 .093 164.15);--color-emerald-300:oklch(.845 .143 164.978);--color-emerald-400:oklch(.765 .177 163.223);--color-emerald-500:oklch(.696 .17 162.48);--color-emerald-600:oklch(.596 .145 163.225);--color-emerald-700:oklch(.508 .118 165.612);--color-emerald-800:oklch(.432 .095 166.913);--color-emerald-900:oklch(.378 .077 168.94);--color-emerald-950:oklch(.262 .051 172.552);--color-teal-50:oklch(.984 .014 180.72);--color-teal-100:oklch(.953 .051 180.801);--color-teal-200:oklch(.91 .096 180.426);--color-teal-300:oklch(.855 .138 181.071);--color-teal-400:oklch(.777 .152 181.912);--color-teal-500:oklch(.704 .14 182.503);--color-teal-600:oklch(.6 .118 184.704);--color-teal-700:oklch(.511 .096 186.391);--color-teal-800:oklch(.437 .078 188.216);--color-teal-900:oklch(.386 .063 188.416);--color-teal-950:oklch(.277 .046 192.524);--color-cyan-50:oklch(.984 .019 200.873);--color-cyan-100:oklch(.956 .045 203.388);--color-cyan-200:oklch(.917 .08 205.041);--color-cyan-300:oklch(.865 .127 207.078);--color-cyan-400:oklch(.789 .154 211.53);--color-cyan-500:oklch(.715 .143 215.221);--color-cyan-600:oklch(.609 .126 221.723);--color-cyan-700:oklch(.52 .105 223.128);--color-cyan-800:oklch(.45 .085 224.283);--color-cyan-900:oklch(.398 .07 227.392);--color-cyan-950:oklch(.302 .056 229.695);--color-sky-50:oklch(.977 .013 236.62);--color-sky-100:oklch(.951 .026 236.824);--color-sky-200:oklch(.901 .058 230.902);--color-sky-300:oklch(.828 .111 230.318);--color-sky-400:oklch(.746 .16 232.661);--color-sky-500:oklch(.685 .169 237.323);--color-sky-600:oklch(.588 .158 241.966);--color-sky-700:oklch(.5 .134 242.749);--color-sky-800:oklch(.443 .11 240.79);--color-sky-900:oklch(.391 .09 240.876);--color-sky-950:oklch(.293 .066 243.157);--color-blue-50:oklch(.97 .014 254.604);--color-blue-100:oklch(.932 .032 255.585);--color-blue-200:oklch(.882 .059 254.128);--color-blue-300:oklch(.809 .105 251.813);--color-blue-400:oklch(.707 .165 254.624);--color-blue-500:oklch(.623 .214 259.815);--color-blue-600:oklch(.546 .245 262.881);--color-blue-700:oklch(.488 .243 264.376);--color-blue-800:oklch(.424 .199 265.638);--color-blue-900:oklch(.379 .146 265.522);--color-blue-950:oklch(.282 .091 267.935);--color-indigo-50:oklch(.962 .018 272.314);--color-indigo-100:oklch(.93 .034 272.788);--color-indigo-200:oklch(.87 .065 274.039);--color-indigo-300:oklch(.785 .115 274.713);--color-indigo-400:oklch(.673 .182 276.935);--color-indigo-500:oklch(.585 .233 277.117);--color-indigo-600:oklch(.511 .262 276.966);--color-indigo-700:oklch(.457 .24 277.023);--color-indigo-800:oklch(.398 .195 277.366);--color-indigo-900:oklch(.359 .144 278.697);--color-indigo-950:oklch(.257 .09 281.288);--color-violet-50:oklch(.969 .016 293.756);--color-violet-100:oklch(.943 .029 294.588);--color-violet-200:oklch(.894 .057 293.283);--color-violet-300:oklch(.811 .111 293.571);--color-violet-400:oklch(.702 .183 293.541);--color-violet-500:oklch(.606 .25 292.717);--color-violet-600:oklch(.541 .281 293.009);--color-violet-700:oklch(.491 .27 292.581);--color-violet-800:oklch(.432 .232 292.759);--color-violet-900:oklch(.38 .189 293.745);--color-violet-950:oklch(.283 .141 291.089);--color-purple-50:oklch(.977 .014 308.299);--color-purple-100:oklch(.946 .033 307.174);--color-purple-200:oklch(.902 .063 306.703);--color-purple-300:oklch(.827 .119 306.383);--color-purple-400:oklch(.714 .203 305.504);--color-purple-500:oklch(.627 .265 303.9);--color-purple-600:oklch(.558 .288 302.321);--color-purple-700:oklch(.496 .265 301.924);--color-purple-800:oklch(.438 .218 303.724);--color-purple-900:oklch(.381 .176 304.987);--color-purple-950:oklch(.291 .149 302.717);--color-fuchsia-50:oklch(.977 .017 320.058);--color-fuchsia-100:oklch(.952 .037 318.852);--color-fuchsia-200:oklch(.903 .076 319.62);--color-fuchsia-300:oklch(.833 .145 321.434);--color-fuchsia-400:oklch(.74 .238 322.16);--color-fuchsia-500:oklch(.667 .295 322.15);--color-fuchsia-600:oklch(.591 .293 322.896);--color-fuchsia-700:oklch(.518 .253 323.949);--color-fuchsia-800:oklch(.452 .211 324.591);--color-fuchsia-900:oklch(.401 .17 325.612);--color-fuchsia-950:oklch(.293 .136 325.661);--color-pink-50:oklch(.971 .014 343.198);--color-pink-100:oklch(.948 .028 342.258);--color-pink-200:oklch(.899 .061 343.231);--color-pink-300:oklch(.823 .12 346.018);--color-pink-400:oklch(.718 .202 349.761);--color-pink-500:oklch(.656 .241 354.308);--color-pink-600:oklch(.592 .249 .584);--color-pink-700:oklch(.525 .223 3.958);--color-pink-800:oklch(.459 .187 3.815);--color-pink-900:oklch(.408 .153 2.432);--color-pink-950:oklch(.284 .109 3.907);--color-rose-50:oklch(.969 .015 12.422);--color-rose-100:oklch(.941 .03 12.58);--color-rose-200:oklch(.892 .058 10.001);--color-rose-300:oklch(.81 .117 11.638);--color-rose-400:oklch(.712 .194 13.428);--color-rose-500:oklch(.645 .246 16.439);--color-rose-600:oklch(.586 .253 17.585);--color-rose-700:oklch(.514 .222 16.935);--color-rose-800:oklch(.455 .188 13.697);--color-rose-900:oklch(.41 .159 10.272);--color-rose-950:oklch(.271 .105 12.094);--color-slate-50:oklch(.984 .003 247.858);--color-slate-100:oklch(.968 .007 247.896);--color-slate-200:oklch(.929 .013 255.508);--color-slate-300:oklch(.869 .022 252.894);--color-slate-400:oklch(.704 .04 256.788);--color-slate-500:oklch(.554 .046 257.417);--color-slate-600:oklch(.446 .043 257.281);--color-slate-700:oklch(.372 .044 257.287);--color-slate-800:oklch(.279 .041 260.031);--color-slate-900:oklch(.208 .042 265.755);--color-slate-950:oklch(.129 .042 264.695);--color-gray-50:oklch(.985 .002 247.839);--color-gray-100:oklch(.967 .003 264.542);--color-gray-200:oklch(.928 .006 264.531);--color-gray-300:oklch(.872 .01 258.338);--color-gray-400:oklch(.707 .022 261.325);--color-gray-500:oklch(.551 .027 264.364);--color-gray-600:oklch(.446 .03 256.802);--color-gray-700:oklch(.373 .034 259.733);--color-gray-800:oklch(.278 .033 256.848);--color-gray-900:oklch(.21 .034 264.665);--color-gray-950:oklch(.13 .028 261.692);--color-zinc-50:oklch(.985 0 0);--color-zinc-100:oklch(.967 .001 286.375);--color-zinc-200:oklch(.92 .004 286.32);--color-zinc-300:oklch(.871 .006 286.286);--color-zinc-400:oklch(.705 .015 286.067);--color-zinc-500:oklch(.552 .016 285.938);--color-zinc-600:oklch(.442 .017 285.786);--color-zinc-700:oklch(.37 .013 285.805);--color-zinc-800:oklch(.274 .006 286.033);--color-zinc-900:oklch(.21 .006 285.885);--color-zinc-950:oklch(.141 .005 285.823);--color-neutral-50:oklch(.985 0 0);--color-neutral-100:oklch(.97 0 0);--color-neutral-200:oklch(.922 0 0);--color-neutral-300:oklch(.87 0 0);--color-neutral-400:oklch(.708 0 0);--color-neutral-500:oklch(.556 0 0);--color-neutral-600:oklch(.439 0 0);--color-neutral-700:oklch(.371 0 0);--color-neutral-800:oklch(.269 0 0);--color-neutral-900:oklch(.205 0 0);--color-neutral-950:oklch(.145 0 0);--color-stone-50:oklch(.985 .001 106.423);--color-stone-100:oklch(.97 .001 106.424);--color-stone-200:oklch(.923 .003 48.717);--color-stone-300:oklch(.869 .005 56.366);--color-stone-400:oklch(.709 .01 56.259);--color-stone-500:oklch(.553 .013 58.071);--color-stone-600:oklch(.444 .011 73.639);--color-stone-700:oklch(.374 .01 67.558);--color-stone-800:oklch(.268 .007 34.298);--color-stone-900:oklch(.216 .006 56.043);--color-stone-950:oklch(.147 .004 49.25);--color-black:#000;--color-white:#fff;--spacing:.25rem;--breakpoint-sm:40rem;--breakpoint-md:48rem;--breakpoint-lg:64rem;--breakpoint-xl:80rem;--breakpoint-2xl:96rem;--container-3xs:16rem;--container-2xs:18rem;--container-xs:20rem;--container-sm:24rem;--container-md:28rem;--container-lg:32rem;--container-xl:36rem;--container-2xl:42rem;--container-3xl:48rem;--container-4xl:56rem;--container-5xl:64rem;--container-6xl:72rem;--container-7xl:80rem;--text-xs:.75rem;--text-xs--line-height:calc(1/.75);--text-sm:.875rem;--text-sm--line-height:calc(1.25/.875);--text-base:1rem;--text-base--line-height: 1.5 ;--text-lg:1.125rem;--text-lg--line-height:calc(1.75/1.125);--text-xl:1.25rem;--text-xl--line-height:calc(1.75/1.25);--text-2xl:1.5rem;--text-2xl--line-height:calc(2/1.5);--text-3xl:1.875rem;--text-3xl--line-height: 1.2 ;--text-4xl:2.25rem;--text-4xl--line-height:calc(2.5/2.25);--text-5xl:3rem;--text-5xl--line-height:1;--text-6xl:3.75rem;--text-6xl--line-height:1;--text-7xl:4.5rem;--text-7xl--line-height:1;--text-8xl:6rem;--text-8xl--line-height:1;--text-9xl:8rem;--text-9xl--line-height:1;--font-weight-thin:100;--font-weight-extralight:200;--font-weight-light:300;--font-weight-normal:400;--font-weight-medium:500;--font-weight-semibold:600;--font-weight-bold:700;--font-weight-extrabold:800;--font-weight-black:900;--tracking-tighter:-.05em;--tracking-tight:-.025em;--tracking-normal:0em;--tracking-wide:.025em;--tracking-wider:.05em;--tracking-widest:.1em;--leading-tight:1.25;--leading-snug:1.375;--leading-normal:1.5;--leading-relaxed:1.625;--leading-loose:2;--radius-xs:.125rem;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--radius-2xl:1rem;--radius-3xl:1.5rem;--radius-4xl:2rem;--shadow-2xs:0 1px #0000000d;--shadow-xs:0 1px 2px 0 #0000000d;--shadow-sm:0 1px 3px 0 #0000001a,0 1px 2px -1px #0000001a;--shadow-md:0 4px 6px -1px #0000001a,0 2px 4px -2px #0000001a;--shadow-lg:0 10px 15px -3px #0000001a,0 4px 6px -4px #0000001a;--shadow-xl:0 20px 25px -5px #0000001a,0 8px 10px -6px #0000001a;--shadow-2xl:0 25px 50px -12px #00000040;--inset-shadow-2xs:inset 0 1px #0000000d;--inset-shadow-xs:inset 0 1px 1px #0000000d;--inset-shadow-sm:inset 0 2px 4px #0000000d;--drop-shadow-xs:0 1px 1px #0000000d;--drop-shadow-sm:0 1px 2px #00000026;--drop-shadow-md:0 3px 3px #0000001f;--drop-shadow-lg:0 4px 4px #00000026;--drop-shadow-xl:0 9px 7px #0000001a;--drop-shadow-2xl:0 25px 25px #00000026;--ease-in:cubic-bezier(.4,0,1,1);--ease-out:cubic-bezier(0,0,.2,1);--ease-in-out:cubic-bezier(.4,0,.2,1);--animate-spin:spin 1s linear infinite;--animate-ping:ping 1s cubic-bezier(0,0,.2,1)infinite;--animate-pulse:pulse 2s cubic-bezier(.4,0,.6,1)infinite;--animate-bounce:bounce 1s infinite;--blur-xs:4px;--blur-sm:8px;--blur-md:12px;--blur-lg:16px;--blur-xl:24px;--blur-2xl:40px;--blur-3xl:64px;--perspective-dramatic:100px;--perspective-near:300px;--perspective-normal:500px;--perspective-midrange:800px;--perspective-distant:1200px;--aspect-video:16/9;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4,0,.2,1);--default-font-family:var(--font-sans);--default-font-feature-settings:var(--font-sans--font-feature-settings);--default-font-variation-settings:var(--font-sans--font-variation-settings);--default-mono-font-family:var(--font-mono);--default-mono-font-feature-settings:var(--font-mono--font-feature-settings);--default-mono-font-variation-settings:var(--font-mono--font-variation-settings)}}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}::file-selector-button{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji");font-feature-settings:var(--default-font-feature-settings,normal);font-variation-settings:var(--default-font-variation-settings,normal);-webkit-tap-highlight-color:transparent}body{line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:var(--default-mono-font-family,ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace);font-feature-settings:var(--default-mono-font-feature-settings,normal);font-variation-settings:var(--default-mono-font-variation-settings,normal);font-size:1em}small{font-size:80%}sub,sup{vertical-align:baseline;font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}:-moz-focusring{outline:auto}progress{vertical-align:baseline}summary{display:list-item}ol,ul,menu{list-style:none}img,svg,video,canvas,audio,iframe,embed,object{vertical-align:middle;display:block}img,video{max-width:100%;height:auto}button,input,select,optgroup,textarea{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}::file-selector-button{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}:where(select:is([multiple],[size])) optgroup{font-weight:bolder}:where(select:is([multiple],[size])) optgroup option{padding-inline-start:20px}::file-selector-button{margin-inline-end:4px}::placeholder{opacity:1;color:color-mix(in oklab,currentColor 50%,transparent)}textarea{resize:vertical}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-date-and-time-value{min-height:1lh;text-align:inherit}::-webkit-datetime-edit{display:inline-flex}::-webkit-datetime-edit-fields-wrapper{padding:0}::-webkit-datetime-edit{padding-block:0}::-webkit-datetime-edit-year-field{padding-block:0}::-webkit-datetime-edit-month-field{padding-block:0}::-webkit-datetime-edit-day-field{padding-block:0}::-webkit-datetime-edit-hour-field{padding-block:0}::-webkit-datetime-edit-minute-field{padding-block:0}::-webkit-datetime-edit-second-field{padding-block:0}::-webkit-datetime-edit-millisecond-field{padding-block:0}::-webkit-datetime-edit-meridiem-field{padding-block:0}:-moz-ui-invalid{box-shadow:none}button,input:where([type=button],[type=reset],[type=submit]){-webkit-appearance:button;-moz-appearance:button;appearance:button}::file-selector-button{-webkit-appearance:button;-moz-appearance:button;appearance:button}::-webkit-inner-spin-button{height:auto}::-webkit-outer-spin-button{height:auto}[hidden]:where(:not([hidden=until-found])){display:none!important}}@layer components;@layer utilities{.absolute{position:absolute}.relative{position:relative}.static{position:static}.inset-0{inset:calc(var(--spacing)*0)}.-mt-\[4\.9rem\]{margin-top:-4.9rem}.-mb-px{margin-bottom:-1px}.mb-1{margin-bottom:calc(var(--spacing)*1)}.mb-2{margin-bottom:calc(var(--spacing)*2)}.mb-4{margin-bottom:calc(var(--spacing)*4)}.mb-6{margin-bottom:calc(var(--spacing)*6)}.mt-1{margin-top:calc(var(--spacing)*1)}.mt-2{margin-top:calc(var(--spacing)*2)}.mt-4{margin-top:calc(var(--spacing)*4)}.mt-6{margin-top:calc(var(--spacing)*6)}.-ml-8{margin-left:calc(var(--spacing)*-8)}.flex{display:flex}.hidden{display:none}.inline-block{display:inline-block}.inline-flex{display:inline-flex}.table{display:table}.aspect-\[335\/376\]{aspect-ratio:335/376}.h-1{height:calc(var(--spacing)*1)}.h-1\.5{height:calc(var(--spacing)*1.5)}.h-2{height:calc(var(--spacing)*2)}.h-2\.5{height:calc(var(--spacing)*2.5)}.h-3{height:calc(var(--spacing)*3)}.h-3\.5{height:calc(var(--spacing)*3.5)}.h-14{height:calc(var(--spacing)*14)}.h-14\.5{height:calc(var(--spacing)*14.5)}.min-h-screen{min-height:100vh}.w-1{width:calc(var(--spacing)*1)}.w-1\.5{width:calc(var(--spacing)*1.5)}.w-2{width:calc(var(--spacing)*2)}.w-2\.5{width:calc(var(--spacing)*2.5)}.w-3{width:calc(var(--spacing)*3)}.w-3\.5{width:calc(var(--spacing)*3.5)}.w-\[448px\]{width:448px}.w-full{width:100%}.max-w-\[335px\]{max-width:335px}.max-w-none{max-width:none}.flex-1{flex:1}.shrink-0{flex-shrink:0}.translate-y-0{--tw-translate-y:calc(var(--spacing)*0);translate:var(--tw-translate-x)var(--tw-translate-y)}.transform{transform:var(--tw-rotate-x)var(--tw-rotate-y)var(--tw-rotate-z)var(--tw-skew-x)var(--tw-skew-y)}.flex-col{flex-direction:column}.flex-col-reverse{flex-direction:column-reverse}.items-center{align-items:center}.justify-center{justify-content:center}.justify-end{justify-content:flex-end}.gap-3{gap:calc(var(--spacing)*3)}.gap-4{gap:calc(var(--spacing)*4)}:where(.space-x-1>:not(:last-child)){--tw-space-x-reverse:0;margin-inline-start:calc(calc(var(--spacing)*1)*var(--tw-space-x-reverse));margin-inline-end:calc(calc(var(--spacing)*1)*calc(1 - var(--tw-space-x-reverse)))}.overflow-hidden{overflow:hidden}.rounded-full{border-radius:3.40282e38px}.rounded-sm{border-radius:var(--radius-sm)}.rounded-t-lg{border-top-left-radius:var(--radius-lg);border-top-right-radius:var(--radius-lg)}.rounded-br-lg{border-bottom-right-radius:var(--radius-lg)}.rounded-bl-lg{border-bottom-left-radius:var(--radius-lg)}.border{border-style:var(--tw-border-style);border-width:1px}.border-\[\#19140035\]{border-color:#19140035}.border-\[\#e3e3e0\]{border-color:#e3e3e0}.border-black{border-color:var(--color-black)}.border-transparent{border-color:#0000}.bg-\[\#1b1b18\]{background-color:#1b1b18}.bg-\[\#FDFDFC\]{background-color:#fdfdfc}.bg-\[\#dbdbd7\]{background-color:#dbdbd7}.bg-\[\#fff2f2\]{background-color:#fff2f2}.bg-white{background-color:var(--color-white)}.p-6{padding:calc(var(--spacing)*6)}.px-5{padding-inline:calc(var(--spacing)*5)}.py-1{padding-block:calc(var(--spacing)*1)}.py-1\.5{padding-block:calc(var(--spacing)*1.5)}.py-2{padding-block:calc(var(--spacing)*2)}.pb-12{padding-bottom:calc(var(--spacing)*12)}.text-sm{font-size:var(--text-sm);line-height:var(--tw-leading,var(--text-sm--line-height))}.text-\[13px\]{font-size:13px}.leading-\[20px\]{--tw-leading:20px;line-height:20px}.leading-normal{--tw-leading:var(--leading-normal);line-height:var(--leading-normal)}.font-medium{--tw-font-weight:var(--font-weight-medium);font-weight:var(--font-weight-medium)}.text-\[\#1b1b18\]{color:#1b1b18}.text-\[\#706f6c\]{color:#706f6c}.text-\[\#F53003\],.text-\[\#f53003\]{color:#f53003}.text-white{color:var(--color-white)}.underline{text-decoration-line:underline}.underline-offset-4{text-underline-offset:4px}.opacity-100{opacity:1}.shadow-\[0px_0px_1px_0px_rgba\(0\,0\,0\,0\.03\)\,0px_1px_2px_0px_rgba\(0\,0\,0\,0\.06\)\]{--tw-shadow:0px 0px 1px 0px var(--tw-shadow-color,#00000008),0px 1px 2px 0px var(--tw-shadow-color,#0000000f);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-\[inset_0px_0px_0px_1px_rgba\(26\,26\,0\,0\.16\)\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#1a1a0029);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.\!filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)!important}.filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)}.transition-all{transition-property:all;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.transition-opacity{transition-property:opacity;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.delay-300{transition-delay:.3s}.duration-750{--tw-duration:.75s;transition-duration:.75s}.not-has-\[nav\]\:hidden:not(:has(:is(nav))){display:none}.before\:absolute:before{content:var(--tw-content);position:absolute}.before\:top-0:before{content:var(--tw-content);top:calc(var(--spacing)*0)}.before\:top-1\/2:before{content:var(--tw-content);top:50%}.before\:bottom-0:before{content:var(--tw-content);bottom:calc(var(--spacing)*0)}.before\:bottom-1\/2:before{content:var(--tw-content);bottom:50%}.before\:left-\[0\.4rem\]:before{content:var(--tw-content);left:.4rem}.before\:border-l:before{content:var(--tw-content);border-left-style:var(--tw-border-style);border-left-width:1px}.before\:border-\[\#e3e3e0\]:before{content:var(--tw-content);border-color:#e3e3e0}@media (hover:hover){.hover\:border-\[\#1915014a\]:hover{border-color:#1915014a}.hover\:border-\[\#19140035\]:hover{border-color:#19140035}.hover\:border-black:hover{border-color:var(--color-black)}.hover\:bg-black:hover{background-color:var(--color-black)}}@media (width>=64rem){.lg\:-mt-\[6\.6rem\]{margin-top:-6.6rem}.lg\:mb-0{margin-bottom:calc(var(--spacing)*0)}.lg\:mb-6{margin-bottom:calc(var(--spacing)*6)}.lg\:-ml-px{margin-left:-1px}.lg\:ml-0{margin-left:calc(var(--spacing)*0)}.lg\:block{display:block}.lg\:aspect-auto{aspect-ratio:auto}.lg\:w-\[438px\]{width:438px}.lg\:max-w-4xl{max-width:var(--container-4xl)}.lg\:grow{flex-grow:1}.lg\:flex-row{flex-direction:row}.lg\:justify-center{justify-content:center}.lg\:rounded-t-none{border-top-left-radius:0;border-top-right-radius:0}.lg\:rounded-tl-lg{border-top-left-radius:var(--radius-lg)}.lg\:rounded-r-lg{border-top-right-radius:var(--radius-lg);border-bottom-right-radius:var(--radius-lg)}.lg\:rounded-br-none{border-bottom-right-radius:0}.lg\:p-8{padding:calc(var(--spacing)*8)}.lg\:p-20{padding:calc(var(--spacing)*20)}}@media (prefers-color-scheme:dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:border-\[\#3E3E3A\]{border-color:#3e3e3a}.dark\:border-\[\#eeeeec\]{border-color:#eeeeec}.dark\:bg-\[\#0a0a0a\]{background-color:#0a0a0a}.dark\:bg-\[\#1D0002\]{background-color:#1d0002}.dark\:bg-\[\#3E3E3A\]{background-color:#3e3e3a}.dark\:bg-\[\#161615\]{background-color:#161615}.dark\:bg-\[\#eeeeec\]{background-color:#eeeeec}.dark\:text-\[\#1C1C1A\]{color:#1c1c1a}.dark\:text-\[\#A1A09A\]{color:#a1a09a}.dark\:text-\[\#EDEDEC\]{color:#ededec}.dark\:text-\[\#F61500\]{color:#f61500}.dark\:text-\[\#FF4433\]{color:#f43}.dark\:shadow-\[inset_0px_0px_0px_1px_\#fffaed2d\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#fffaed2d);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.dark\:before\:border-\[\#3E3E3A\]:before{content:var(--tw-content);border-color:#3e3e3a}@media (hover:hover){.dark\:hover\:border-\[\#3E3E3A\]:hover{border-color:#3e3e3a}.dark\:hover\:border-\[\#62605b\]:hover{border-color:#62605b}.dark\:hover\:border-white:hover{border-color:var(--color-white)}.dark\:hover\:bg-white:hover{background-color:var(--color-white)}}}@starting-style{.starting\:translate-y-4{--tw-translate-y:calc(var(--spacing)*4);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:translate-y-6{--tw-translate-y:calc(var(--spacing)*6);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:opacity-0{opacity:0}}}@keyframes spin{to{transform:rotate(360deg)}}@keyframes ping{75%,to{opacity:0;transform:scale(2)}}@keyframes pulse{50%{opacity:.5}}@keyframes bounce{0%,to{animation-timing-function:cubic-bezier(.8,0,1,1);transform:translateY(-25%)}50%{animation-timing-function:cubic-bezier(0,0,.2,1);transform:none}}@property --tw-translate-x{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-y{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-z{syntax:"*";inherits:false;initial-value:0}@property --tw-rotate-x{syntax:"*";inherits:false;initial-value:rotateX(0)}@property --tw-rotate-y{syntax:"*";inherits:false;initial-value:rotateY(0)}@property --tw-rotate-z{syntax:"*";inherits:false;initial-value:rotateZ(0)}@property --tw-skew-x{syntax:"*";inherits:false;initial-value:skewX(0)}@property --tw-skew-y{syntax:"*";inherits:false;initial-value:skewY(0)}@property --tw-space-x-reverse{syntax:"*";inherits:false;initial-value:0}@property --tw-border-style{syntax:"*";inherits:false;initial-value:solid}@property --tw-leading{syntax:"*";inherits:false}@property --tw-font-weight{syntax:"*";inherits:false}@property --tw-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-shadow-color{syntax:"*";inherits:false}@property --tw-inset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-shadow-color{syntax:"*";inherits:false}@property --tw-ring-color{syntax:"*";inherits:false}@property --tw-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-ring-color{syntax:"*";inherits:false}@property --tw-inset-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-ring-inset{syntax:"*";inherits:false}@property --tw-ring-offset-width{syntax:"<length>";inherits:false;initial-value:0}@property --tw-ring-offset-color{syntax:"*";inherits:false;initial-value:#fff}@property --tw-ring-offset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-blur{syntax:"*";inherits:false}@property --tw-brightness{syntax:"*";inherits:false}@property --tw-contrast{syntax:"*";inherits:false}@property --tw-grayscale{syntax:"*";inherits:false}@property --tw-hue-rotate{syntax:"*";inherits:false}@property --tw-invert{syntax:"*";inherits:false}@property --tw-opacity{syntax:"*";inherits:false}@property --tw-saturate{syntax:"*";inherits:false}@property --tw-sepia{syntax:"*";inherits:false}@property --tw-drop-shadow{syntax:"*";inherits:false}@property --tw-duration{syntax:"*";inherits:false}@property --tw-content{syntax:"*";inherits:false;initial-value:""}
            </style>
        @endif

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
          /* Appliquer un flou sur tout le contenu sauf les modals lorsque le body a la classe 'modal-open' */
          body.modal-open > :not(#auth-modal):not(#one-day-modal) {
            filter: blur(5px);
          }
        </style>
    </head>
    <body class="depth-layer-1 min-h-screen pb-24">
        <!-- Main Content -->
        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header with Logo and Ideas -->
            <div class="flex items-center gap-3 sticky top-0 z-30 p-4 -mt-4 -mx-4 mb-4">
                <img src="{{ asset('image/campus_voice.png') }}" alt="Campus Voice Logo" class="h-10 w-auto">
                <h1 class="text-xl font-bold text-primary">Ideas</h1>
            </div>

            <!-- New Proposition Form at Top -->
                @auth
                    <form id="proposition-form" method="POST" action="{{ route('propositions.store') }}" class="flex p-3 items-center gap-3 sticky top-[4rem] z-30 -mx-4 px-4 mb-4">
                        @csrf
                        <input type="text" name="content" id="content" placeholder="Share your idea to improve SAIT..." maxlength="1000" required class="form-input !rounded-full flex-1">
                        <button type="submit" class="btn-primary !p-3 !rounded-full aspect-square flex-shrink-0">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                @else
                    <div class="flex items-center gap-3 sticky top-[4rem] z-30 -mx-4 px-4 py-3 mb-4">
                        <input
                            type="text"
                            id="guest-proposition-input"
                            placeholder="Login to share your ideas..."
                            maxlength="1000"
                            class="form-input flex-1 !rounded-full cursor-not-allowed opacity-70"
                            readonly
                        >
                        <button
                            id="guest-send-btn"
                            class="btn-secondary !p-3 !rounded-full aspect-square flex-shrink-0"
                        >
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                @endauth

            <!-- Sorting Options -->
            <div class="sticky-filter p-4 mb-6 sticky top-[8.5rem] z-20">
                <div class="flex justify-between items-center gap-3">
                    <div class="flex gap-2">
                        <button id="sort-recent" class="btn-primary px-3 py-1.5 text-xs font-medium whitespace-nowrap">Recent</button>
                        <button id="sort-top" class="btn-secondary px-3 py-1.5 text-xs font-medium whitespace-nowrap">Top</button>
                    </div>
                    <div class="text-xs text-muted whitespace-nowrap">
                        <span id="proposition-count">{{ $propositions->total() }}</span> ideas
                    </div>
                </div>
            </div>

            <!-- Propositions List -->
            <div id="propositions-list" class="space-y-4">
                @include('partials.propositions-list', ['propositions' => $propositions])
            </div>

            <!-- Loading Spinner -->
            <div id="loading-spinner" class="hidden text-center py-8">
                <div class="inline-flex items-center gap-3">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-brand"></div>
                    <span class="text-muted">Loading more ideas...</span>
                </div>
            </div>

            <!-- End of content indicator -->
            <div id="end-of-content" class="hidden text-center py-8">
                <div class="frosted-card p-6">
                    <p class="text-muted">You've reached the end! 🎉</p>
                    <p class="text-muted text-sm mt-1">All ideas have been loaded.</p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="frosted-card mt-12 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-muted">&copy; 2024 Campus Voice. Building a better student experience together.</p>
            </div>
        </footer>

        {{-- Auth Modal is now included directly in this file --}}

        <script>
            // Character counter for authenticated user form
            @auth
                const textarea = document.getElementById('content');
                const charCount = document.getElementById('char-count');

                textarea.addEventListener('input', function() {
                    charCount.textContent = this.value.length;
                });
            @endauth

            // Guest input functionality
            @guest
                document.addEventListener('DOMContentLoaded', function() {
                    const guestInput = document.getElementById('guest-proposition-input');
                    const guestCharCount = document.getElementById('guest-char-count');
                    const guestSendBtn = document.getElementById('guest-send-btn');
                    const loginFormElement = document.getElementById('login-form-element');
                    const registerFormElement = document.getElementById('register-form-element');

                    let pendingProposition = '';

                    // Character counter for guest input
                    if (guestInput) {
                        guestInput.addEventListener('input', function() {
                            if (guestCharCount) guestCharCount.textContent = this.value.length;
                        });
                    }

                    // Send button click
                    if (guestSendBtn) {
                        guestSendBtn.addEventListener('click', function() {
                            const propositionText = guestInput ? guestInput.value.trim() : '';
                            if (propositionText.length === 0) {
                                alert('Please enter your proposition first.');
                                return;
                            }
                            if (propositionText.length > 1000) {
                                alert('Proposition is too long. Maximum 1000 characters.');
                                return;
                            }

                            pendingProposition = propositionText;
                            openAuthModal();
                        });
                    }

                    // Handle form submissions with pending proposition
                    function handleFormSubmit(form, action) {
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                // Add the pending proposition as a hidden field
                                const propositionInput = document.createElement('input');
                                propositionInput.type = 'hidden';
                                propositionInput.name = 'pending_proposition';
                                propositionInput.value = pendingProposition;
                                form.appendChild(propositionInput);
                            });
                        }
                    }

                    handleFormSubmit(loginFormElement, 'login');
                    handleFormSubmit(registerFormElement, 'register');
                });
            @endguest

            // Voting functionality
            @auth
                document.addEventListener('DOMContentLoaded', function() {
                    // Function to update button states based on user's vote
                    function updateButtonStates() {
                        document.querySelectorAll('.proposition-card').forEach(card => {
                            const propositionId = card.dataset.id;
                            const upvoteBtn = card.querySelector('.upvote-btn');
                            const downvoteBtn = card.querySelector('.downvote-btn');

                            // Check if user has already voted for this proposition (would require server-side information)
                            // For now, we'll implement a client-side tracking
                            const userVoteType = localStorage.getItem(`vote_${propositionId}`);

                            // Reset classes first
                            upvoteBtn.classList.remove('bg-green-300', 'bg-green-500', 'text-white');
                            downvoteBtn.classList.remove('bg-red-300', 'bg-red-500', 'text-white');

                            // Add original styling
                            upvoteBtn.classList.add('bg-green-100', 'hover:bg-green-200');
                            downvoteBtn.classList.add('bg-red-100', 'hover:bg-red-200');

                            // Apply styling based on user's vote
                            if (userVoteType === 'upvote') {
                                upvoteBtn.classList.remove('bg-green-100', 'hover:bg-green-200');
                                upvoteBtn.classList.add('bg-green-500', 'text-white');
                            } else if (userVoteType === 'downvote') {
                                downvoteBtn.classList.remove('bg-red-100', 'hover:bg-red-200');
                                downvoteBtn.classList.add('bg-red-500', 'text-white');
                            }
                        });
                    }

                    // Initial update of button states
                    updateButtonStates();

                    // Upvote buttons
                    document.querySelectorAll('.upvote-btn').forEach(button => {
                        button.addEventListener('click', async function() {
                            const propositionId = this.dataset.id;
                            const countSpan = this.querySelector('.upvote-count');
                            const downvoteBtn = this.closest('.proposition-card').querySelector('.downvote-btn');
                            const downvoteCountSpan = downvoteBtn.querySelector('.downvote-count');
                            const svg = this.querySelector('svg');
                            const wasUpvoted = this.dataset.userVoted === 'true';

                            try {
                                const response = await fetch(`/propositions/${propositionId}/upvote`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    }
                                });

                                if (response.ok) {
                                    const data = await response.json();
                                    countSpan.textContent = data.upvotes;

                                    // Update downvote count if it changed
                                    if (downvoteCountSpan) {
                                        downvoteCountSpan.textContent = data.downvotes;
                                    }

                                    // Determine if user is now upvoting (not removing upvote)
                                    const isNowUpvoting = !wasUpvoted;

                                    if (wasUpvoted) {
                                        // User is removing their upvote
                                        this.dataset.userVoted = 'false';
                                    } else {
                                        // User is adding upvote - TRIGGER ANIMATION!
                                        this.classList.add('upvote-animate', 'upvote-hearts');
                                        this.dataset.userVoted = 'true';

                                        // Remove animation classes after animation completes
                                        setTimeout(() => {
                                            this.classList.remove('upvote-animate', 'upvote-hearts');
                                        }, 1000);

                                        // If user had downvoted before, update downvote button
                                        if (downvoteBtn.dataset.userVoted === 'true') {
                                            downvoteBtn.dataset.userVoted = 'false';
                                        }
                                    }
                                }
                            } catch (error) {
                                // Error handled silently
                            }
                        });
                    });

                    // Downvote buttons
                    document.querySelectorAll('.downvote-btn').forEach(button => {
                        button.addEventListener('click', async function() {
                            const propositionId = this.dataset.id;
                            const countSpan = this.querySelector('.downvote-count');
                            const upvoteBtn = this.closest('.proposition-card').querySelector('.upvote-btn');
                            const upvoteCountSpan = upvoteBtn.querySelector('.upvote-count');
                            const svg = this.querySelector('svg');
                            const wasDownvoted = this.dataset.userVoted === 'true';

                            try {
                                const response = await fetch(`/propositions/${propositionId}/downvote`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    }
                                });

                                if (response.ok) {
                                    const data = await response.json();
                                    countSpan.textContent = data.downvotes;

                                    // Update upvote count if it changed
                                    if (upvoteCountSpan) {
                                        upvoteCountSpan.textContent = data.upvotes;
                                    }

                                    // Simple animation for downvote (subtle)
                                    this.classList.add('downvote-animate');
                                    setTimeout(() => this.classList.remove('downvote-animate'), 300);

                                    if (wasDownvoted) {
                                        // User is removing their downvote
                                        this.classList.remove('bg-red-500', 'text-white', 'shadow-md');
                                        this.classList.add('hover:bg-red-50');
                                        svg.classList.remove('text-white');
                                        svg.classList.add('text-red-500');
                                        countSpan.classList.remove('text-white');
                                        countSpan.classList.add('text-red-500');
                                        this.dataset.userVoted = 'false';
                                    } else {
                                        // User is adding downvote
                                        this.classList.remove('hover:bg-red-50');
                                        this.classList.add('bg-red-500', 'text-white', 'shadow-md');
                                        svg.classList.remove('text-red-500');
                                        svg.classList.add('text-white');
                                        countSpan.classList.remove('text-red-500');
                                        countSpan.classList.add('text-white');
                                        this.dataset.userVoted = 'true';

                                        // If user had upvoted before, update upvote button
                                        if (upvoteBtn.dataset.userVoted === 'true') {
                                            const upvoteSvg = upvoteBtn.querySelector('svg');
                                            upvoteBtn.classList.remove('bg-green-500', 'text-white', 'shadow-md');
                                            upvoteBtn.classList.add('hover:bg-green-50');
                                            upvoteSvg.classList.remove('text-white');
                                            upvoteSvg.classList.add('text-green-500');
                                            upvoteCountSpan.classList.remove('text-white');
                                            upvoteCountSpan.classList.add('text-green-500');
                                            upvoteBtn.dataset.userVoted = 'false';
                                        }
                                    }
                                }
                            } catch (error) {
                                // Error handled silently
                            }
                        });
                    });

                    // Delete buttons
                    document.querySelectorAll('.delete-btn').forEach(button => {
                        button.addEventListener('click', async function() {
                            const propositionId = this.dataset.id;
                            const propositionCard = this.closest('.proposition-card');

                            // Show confirmation dialog
                            if (!confirm('Are you sure you want to delete this proposition? This action cannot be undone.')) {
                                return;
                            }

                            try {
                                const response = await fetch(`/propositions/${propositionId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    }
                                });

                                if (response.ok) {
                                    // Add fade out animation
                                    propositionCard.style.transition = 'opacity 0.3s ease-out';
                                    propositionCard.style.opacity = '0';

                                    // Remove the card from the DOM after animation
                                    setTimeout(() => {
                                        propositionCard.remove();

                                        // Update proposition count
                                        const propositionsList = document.getElementById('propositions-list');
                                        const countElement = document.getElementById('proposition-count');
                                        if (countElement) {
                                            countElement.textContent = propositionsList.children.length;
                                        }

                                        // Check if there are no more propositions
                                        if (propositionsList.children.length === 0) {
                                            propositionsList.innerHTML = '<div class="bg-white rounded-lg shadow-md p-8 text-center"><p class="text-gray-500 text-lg">No propositions yet. Be the first to share your idea!</p></div>';
                                        }
                                    }, 300);
                                } else {
                                    const data = await response.json();
                                    alert(data.error || 'Error deleting proposition');
                                }
                            } catch (error) {
                                alert('An error occurred while deleting the proposition');
                            }
                        });
                    });
                });
            @endauth

            // Comments functionality
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle comments section
                document.querySelectorAll('.comment-toggle-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const propositionId = this.dataset.id;
                        const card = this.closest('.proposition-card');
                        const commentsSection = card.querySelector('.comments-section');

                        if (commentsSection) {
                            commentsSection.classList.toggle('hidden');

                            // Toggle active state on button
                            if (commentsSection.classList.contains('hidden')) {
                                this.classList.remove('bg-brand', 'text-black');
                            } else {
                                this.classList.add('bg-brand', 'text-black');
                                // Focus on the comment input if authenticated
                                const commentInput = commentsSection.querySelector('input[name="content"]');
                                if (commentInput) {
                                    setTimeout(() => commentInput.focus(), 100);
                                }
                            }
                        }
                    });
                });

                // Submit comment
                document.querySelectorAll('.comment-form').forEach(form => {
                    form.addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const propositionId = this.dataset.propositionId;
                        const contentInput = this.querySelector('input[name="content"]');
                        const content = contentInput.value.trim();

                        if (!content) return;

                        try {
                            const response = await fetch(`/propositions/${propositionId}/comments`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ content })
                            });

                            if (response.ok) {
                                const data = await response.json();
                                const commentsList = this.closest('.comments-section').querySelector('.comments-list');

                                // Create new comment element
                                const commentHtml = `
                                    <div class="comment-item flex gap-3" data-comment-id="${data.comment.id}">
                                        <img src="${data.comment.user.profile_picture_url}" alt="${data.comment.user.display_name}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-medium text-primary text-sm">${data.comment.user.display_name}</span>
                                                <span class="text-xs text-muted">${data.comment.created_at}</span>
                                                ${data.comment.can_delete ? `
                                                    <button class="delete-comment-btn text-xs text-muted hover:text-red-500 ml-auto" data-comment-id="${data.comment.id}">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                ` : ''}
                                            </div>
                                            <p class="text-primary text-sm">${data.comment.content}</p>
                                        </div>
                                    </div>
                                `;

                                commentsList.insertAdjacentHTML('beforeend', commentHtml);

                                // Update comment count
                                const card = this.closest('.proposition-card');
                                const countSpan = card.querySelector('.comment-count');
                                if (countSpan) {
                                    countSpan.textContent = parseInt(countSpan.textContent) + 1;
                                }

                                // Clear input
                                contentInput.value = '';

                                // Re-attach delete event listeners
                                attachDeleteCommentListeners();
                            }
                        } catch (error) {
                            // Error handled silently
                        }
                    });
                });

                // Delete comment function
                function attachDeleteCommentListeners() {
                    document.querySelectorAll('.delete-comment-btn').forEach(button => {
                        button.replaceWith(button.cloneNode(true));
                    });

                    document.querySelectorAll('.delete-comment-btn').forEach(button => {
                        button.addEventListener('click', async function() {
                            const commentId = this.dataset.commentId;

                            if (!confirm('Delete this comment?')) return;

                            try {
                                const response = await fetch(`/comments/${commentId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    }
                                });

                                if (response.ok) {
                                    const commentItem = this.closest('.comment-item');
                                    const card = this.closest('.proposition-card');

                                    // Update count
                                    const countSpan = card.querySelector('.comment-count');
                                    if (countSpan) {
                                        countSpan.textContent = Math.max(0, parseInt(countSpan.textContent) - 1);
                                    }

                                    // Remove comment
                                    commentItem.remove();
                                }
                            } catch (error) {
                                // Error handled silently
                            }
                        });
                    });
                }

                // Initial attachment
                attachDeleteCommentListeners();
            });

            // Sorting functionality
            document.addEventListener('DOMContentLoaded', function() {
                const sortRecentBtn = document.getElementById('sort-recent');
                const sortTopBtn = document.getElementById('sort-top');
                const propositionsList = document.getElementById('propositions-list');
                let currentSort = 'recent';
                let currentPage = {{ $propositions->currentPage() }};
                let hasMorePages = {{ $propositions->hasMorePages() ? 'true' : 'false' }};
                let isLoading = false;

                function updateSortButtons(activeSort) {
                    currentSort = activeSort;

                    if (activeSort === 'recent') {
                        sortRecentBtn.classList.remove('btn-secondary');
                        sortRecentBtn.classList.add('btn-primary');
                        sortTopBtn.classList.remove('btn-primary');
                        sortTopBtn.classList.add('btn-secondary');
                    } else {
                        sortTopBtn.classList.remove('btn-secondary');
                        sortTopBtn.classList.add('btn-primary');
                        sortRecentBtn.classList.remove('btn-primary');
                        sortRecentBtn.classList.add('btn-secondary');
                    }
                }

                function loadPropositions(sort, resetList = false) {
                    if (isLoading) return;

                    isLoading = true;
                    document.getElementById('loading-spinner').classList.remove('hidden');

                    let url;
                    if (resetList) {
                        url = new URL('{{ route("propositions.index") }}');
                        url.searchParams.set('sort', sort);
                    } else {
                        url = new URL('{{ route("propositions.load-more") }}');
                        url.searchParams.set('sort', sort);
                        url.searchParams.set('page', currentPage + 1);
                    }

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (resetList) {
                            propositionsList.innerHTML = data.html;
                            currentPage = 1;
                        } else {
                            const newPropositions = document.createElement('div');
                            newPropositions.innerHTML = data.html;

                            // Append new propositions with animation
                            Array.from(newPropositions.children).forEach((proposition, index) => {
                                setTimeout(() => {
                                    proposition.style.opacity = '0';
                                    proposition.style.transform = 'translateY(20px)';
                                    propositionsList.appendChild(proposition);

                                    // Trigger animation
                                    setTimeout(() => {
                                        proposition.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                                        proposition.style.opacity = '1';
                                        proposition.style.transform = 'translateY(0)';
                                    }, 50);
                                }, index * 100);
                            });

                            currentPage++;
                        }

                        hasMorePages = data.hasMore;

                        // Update total count if provided
                        if (data.total) {
                            const countElement = document.getElementById('proposition-count');
                            if (countElement) {
                                countElement.textContent = data.total;
                            }
                        }

                        // Show end of content message if no more pages
                        if (!hasMorePages) {
                            document.getElementById('end-of-content').classList.remove('hidden');
                        } else {
                            document.getElementById('end-of-content').classList.add('hidden');
                        }

                        // Reattach event listeners for new elements
                        reattachEventListeners();
                    })
                    .catch(error => {
                        // Error handled silently
                    })
                    .finally(() => {
                        isLoading = false;
                        document.getElementById('loading-spinner').classList.add('hidden');
                    });
                }

                function reattachEventListeners() {
                    // Reattach voting listeners
                    @auth
                        attachVotingListeners();
                    @endauth

                    // Reattach comment listeners
                    attachCommentListeners();

                    // Reattach delete listeners
                    @auth
                        attachDeleteListeners();
                    @endauth
                }

                // Infinite scroll
                function checkScroll() {
                    if (isLoading || !hasMorePages) return;

                    const scrollPosition = window.innerHeight + window.scrollY;
                    const threshold = document.documentElement.offsetHeight - 1000; // Load 1000px before end

                    if (scrollPosition >= threshold) {
                        loadPropositions(currentSort, false);
                    }
                }

                // Throttle scroll events
                let scrollTimeout;
                window.addEventListener('scroll', function() {
                    if (scrollTimeout) clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(checkScroll, 100);
                });

                sortRecentBtn.addEventListener('click', function() {
                    if (currentSort === 'recent') return;

                    updateSortButtons('recent');
                    currentPage = 0;
                    hasMorePages = true;
                    loadPropositions('recent', true);
                });

                sortTopBtn.addEventListener('click', function() {
                    if (currentSort === 'top') return;

                    updateSortButtons('top');
                    currentPage = 0;
                    hasMorePages = true;
                    loadPropositions('top', true);
                });
            });

            // Helper functions for reattaching event listeners
            @auth
            function attachVotingListeners() {
                // Remove existing listeners and reattach
                document.querySelectorAll('.upvote-btn').forEach(button => {
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);
                });

                document.querySelectorAll('.downvote-btn').forEach(button => {
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);
                });

                // Upvote functionality (reattach)
                document.querySelectorAll('.upvote-btn').forEach(button => {
                    button.addEventListener('click', async function() {
                        const propositionId = this.dataset.id;
                        const countSpan = this.querySelector('.upvote-count');
                        const downvoteBtn = this.closest('.proposition-card').querySelector('.downvote-btn');
                        const downvoteCountSpan = downvoteBtn.querySelector('.downvote-count');
                        const svg = this.querySelector('svg');
                        const wasUpvoted = this.dataset.userVoted === 'true';

                        try {
                            const response = await fetch(`/propositions/${propositionId}/upvote`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });

                            if (response.ok) {
                                const data = await response.json();
                                countSpan.textContent = data.upvotes;
                                if (downvoteCountSpan) {
                                    downvoteCountSpan.textContent = data.downvotes;
                                }

                                const isNowUpvoting = !wasUpvoted;

                                if (wasUpvoted) {
                                    // User is removing their upvote
                                    this.dataset.userVoted = 'false';
                                } else {
                                    // User is adding upvote - TRIGGER ANIMATION!
                                    this.classList.add('upvote-animate', 'upvote-hearts');
                                    this.dataset.userVoted = 'true';

                                    // Remove animation classes after animation completes
                                    setTimeout(() => {
                                        this.classList.remove('upvote-animate', 'upvote-hearts');
                                    }, 1000);

                                    // If user had downvoted before, update downvote button
                                    if (downvoteBtn.dataset.userVoted === 'true') {
                                        downvoteBtn.dataset.userVoted = 'false';
                                    }
                                }
                            }
                        } catch (error) {
                            // Error handled silently
                        }
                    });
                });

                // Downvote functionality (reattach)
                document.querySelectorAll('.downvote-btn').forEach(button => {
                    button.addEventListener('click', async function() {
                        const propositionId = this.dataset.id;
                        const countSpan = this.querySelector('.downvote-count');
                        const upvoteBtn = this.closest('.proposition-card').querySelector('.upvote-btn');
                        const upvoteCountSpan = upvoteBtn.querySelector('.upvote-count');
                        const svg = this.querySelector('svg');
                        const wasDownvoted = this.dataset.userVoted === 'true';

                        try {
                            const response = await fetch(`/propositions/${propositionId}/downvote`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });

                            if (response.ok) {
                                const data = await response.json();
                                countSpan.textContent = data.downvotes;
                                if (upvoteCountSpan) {
                                    upvoteCountSpan.textContent = data.upvotes;
                                }

                                // Simple animation for downvote (subtle)
                                this.classList.add('downvote-animate');
                                setTimeout(() => this.classList.remove('downvote-animate'), 300);

                                if (wasDownvoted) {
                                    // User is removing their downvote
                                    this.dataset.userVoted = 'false';
                                } else {
                                    // User is adding downvote
                                    this.dataset.userVoted = 'true';

                                    // If user had upvoted before, update upvote button
                                    if (upvoteBtn.dataset.userVoted === 'true') {
                                        upvoteBtn.dataset.userVoted = 'false';
                                    }
                                }
                            }
                        } catch (error) {
                            // Error handled silently
                        }
                    });
                });
            }

            function attachDeleteListeners() {
                document.querySelectorAll('.delete-btn').forEach(button => {
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);
                });

                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', async function() {
                        const propositionId = this.dataset.id;
                        const propositionCard = this.closest('.proposition-card');

                        if (!confirm('Are you sure you want to delete this proposition? This action cannot be undone.')) {
                            return;
                        }

                        try {
                            const response = await fetch(`/propositions/${propositionId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });

                            if (response.ok) {
                                propositionCard.style.transition = 'opacity 0.3s ease-out';
                                propositionCard.style.opacity = '0';

                                setTimeout(() => {
                                    propositionCard.remove();

                                    const propositionsList = document.getElementById('propositions-list');
                                    const countElement = document.getElementById('proposition-count');
                                    if (countElement) {
                                        countElement.textContent = propositionsList.children.length;
                                    }

                                    if (propositionsList.children.length === 0) {
                                        propositionsList.innerHTML = '<div class="frosted-card p-12 text-center"><svg class="w-16 h-16 mx-auto mb-4 text-muted opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg><p class="text-muted text-lg mb-2">No propositions yet</p><p class="text-muted text-sm">Be the first to share your idea!</p></div>';
                                    }
                                }, 300);
                            } else {
                                const data = await response.json();
                                alert(data.error || 'Error deleting proposition');
                            }
                        } catch (error) {
                            alert('An error occurred while deleting the proposition');
                        }
                    });
                });
            }
            @endauth

            function attachCommentListeners() {
                // Comment toggle buttons
                document.querySelectorAll('.comment-toggle-btn').forEach(button => {
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);
                });

                document.querySelectorAll('.comment-toggle-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const propositionId = this.dataset.id;
                        const card = this.closest('.proposition-card');
                        const commentsSection = card.querySelector('.comments-section');

                        if (commentsSection) {
                            commentsSection.classList.toggle('hidden');

                            if (commentsSection.classList.contains('hidden')) {
                                this.classList.remove('bg-brand', 'text-black');
                            } else {
                                this.classList.add('bg-brand', 'text-black');
                                const commentInput = commentsSection.querySelector('input[name="content"]');
                                if (commentInput) {
                                    setTimeout(() => commentInput.focus(), 100);
                                }
                            }
                        }
                    });
                });

                // Comment forms
                document.querySelectorAll('.comment-form').forEach(form => {
                    const newForm = form.cloneNode(true);
                    form.parentNode.replaceChild(newForm, form);
                });

                document.querySelectorAll('.comment-form').forEach(form => {
                    form.addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const propositionId = this.dataset.propositionId;
                        const contentInput = this.querySelector('input[name="content"]');
                        const content = contentInput.value.trim();

                        if (!content) return;

                        try {
                            const response = await fetch(`/propositions/${propositionId}/comments`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ content })
                            });

                            if (response.ok) {
                                const data = await response.json();
                                const commentsList = this.closest('.comments-section').querySelector('.comments-list');

                                const commentHtml = `
                                    <div class="comment-item flex gap-3" data-comment-id="${data.comment.id}">
                                        <img src="${data.comment.user.profile_picture_url}" alt="${data.comment.user.display_name}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-medium text-primary text-sm">${data.comment.user.display_name}</span>
                                                <span class="text-xs text-muted">${data.comment.created_at}</span>
                                                ${data.comment.can_delete ? `
                                                    <button class="delete-comment-btn text-xs text-muted hover:text-red-500 ml-auto" data-comment-id="${data.comment.id}">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                ` : ''}
                                            </div>
                                            <p class="text-primary text-sm">${data.comment.content}</p>
                                        </div>
                                    </div>
                                `;

                                commentsList.insertAdjacentHTML('beforeend', commentHtml);

                                const card = this.closest('.proposition-card');
                                const countSpan = card.querySelector('.comment-count');
                                if (countSpan) {
                                    countSpan.textContent = parseInt(countSpan.textContent) + 1;
                                }

                                contentInput.value = '';
                                attachCommentDeleteListeners();
                            }
                        } catch (error) {
                            // Error handled silently
                        }
                    });
                });

                // Initial attachment of delete listeners
                attachCommentDeleteListeners();
            }

            function attachCommentDeleteListeners() {
                document.querySelectorAll('.delete-comment-btn').forEach(button => {
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);
                });

                document.querySelectorAll('.delete-comment-btn').forEach(button => {
                    button.addEventListener('click', async function() {
                        const commentId = this.dataset.commentId;

                        if (!confirm('Delete this comment?')) return;

                        try {
                            const response = await fetch(`/comments/${commentId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });

                            if (response.ok) {
                                const commentItem = this.closest('.comment-item');
                                const card = this.closest('.proposition-card');

                                const countSpan = card.querySelector('.comment-count');
                                if (countSpan) {
                                    countSpan.textContent = Math.max(0, parseInt(countSpan.textContent) - 1);
                                }

                                commentItem.remove();
                            }
                        } catch (error) {
                            // Error handled silently
                        }
                    });
                });
            }

            // Modal functionality
            document.addEventListener('DOMContentLoaded', function() {
                const authModal = document.getElementById('auth-modal');
                const closeModal = document.getElementById('close-modal');
                const loginTab = document.getElementById('login-tab');
                const registerTab = document.getElementById('register-tab');
                const loginForm = document.getElementById('login-form');
                const registerForm = document.getElementById('register-form');

                // Fonction pour ouvrir le modal
                window.openAuthModal = function() {
                    if (authModal) {
                        authModal.classList.remove('hidden');
                        document.body.classList.add('modal-open');
                    }
                };

                // Fonction pour fermer le modal
                window.closeAuthModal = function() {
                    if (authModal) {
                        authModal.classList.add('hidden');
                        document.body.classList.remove('modal-open');
                    }
                };

                // Fermer le modal avec le bouton X
                if (closeModal) {
                    closeModal.addEventListener('click', closeAuthModal);
                }

                // Fermer le modal en cliquant en dehors
                if (authModal) {
                    authModal.addEventListener('click', function(e) {
                        if (e.target === authModal) {
                            closeAuthModal();
                        }
                    });
                }

                // Basculement vers l'onglet de connexion
                if (loginTab) {
                    loginTab.addEventListener('click', function() {
                        loginTab.className = 'flex-1 py-2 px-4 text-center border-b-2 border-blue-500 text-blue-600 font-medium';
                        if (registerTab) registerTab.className = 'flex-1 py-2 px-4 text-center border-b-2 border-gray-200 text-gray-500';
                        if (loginForm) loginForm.classList.remove('hidden');
                        if (registerForm) registerForm.classList.add('hidden');
                    });
                }

                // Basculement vers l'onglet d'inscription
                if (registerTab) {
                    registerTab.addEventListener('click', function() {
                        registerTab.className = 'flex-1 py-2 px-4 text-center border-b-2 border-blue-500 text-blue-600 font-medium';
                        if (loginTab) loginTab.className = 'flex-1 py-2 px-4 text-center border-b-2 border-gray-200 text-gray-500';
                        if (registerForm) registerForm.classList.remove('hidden');
                        if (loginForm) loginForm.classList.add('hidden');
                    });
                }
            });

            // Show one-per-day modal when server indicates an error
            document.addEventListener('DOMContentLoaded', function() {
                const oneDayModal = document.getElementById('one-day-modal');
                const oneDayClose = document.getElementById('one-day-close');

                function openOneDayModal() {
                    if (oneDayModal) {
                        oneDayModal.classList.remove('hidden');
                        document.body.classList.add('modal-open');
                    }
                }

                function closeOneDayModal() {
                    if (oneDayModal) {
                        oneDayModal.classList.add('hidden');
                        document.body.classList.remove('modal-open');
                    }
                }

                if (oneDayClose) {
                    oneDayClose.addEventListener('click', closeOneDayModal);
                }

                // Close when clicking the backdrop
                if (oneDayModal) {
                    oneDayModal.addEventListener('click', function(e) {
                        if (e.target === oneDayModal) closeOneDayModal();
                    });
                }

                // Server-provided flags: show modal if session has error or validation errors for content
                const serverHasError = {!! json_encode(session()->has('error') || $errors->has('content')) !!};
                if (serverHasError) {
                    openOneDayModal();
                }
            });
        </script>

    {{-- Auth Modal --}}
        <div id="auth-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
          <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="flex justify-between items-center p-6 border-b">
              <h2 class="text-xl font-bold text-gray-900">Authentication Required</h2>
              <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>

            <div class="p-6">
              <div class="flex border-b mb-6">
                <button id="login-tab" class="flex-1 py-2 px-4 text-center border-b-2 border-blue-500 text-blue-600 font-medium">Login</button>
                <button id="register-tab" class="flex-1 py-2 px-4 text-center border-b-2 border-gray-200 text-gray-500">Register</button>
              </div>

              <div id="login-form" class="space-y-4">
                <form id="login-form-element" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div>
                    <label for="login-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="login-email" type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  </div>
                  <div>
                    <label for="login-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="login-password" type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  </div>
                  <br>
                  <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors font-medium">Login</button>
                </form>
                <div class="text-center">
                  <a href="{{ route('google.redirect') }}" class="inline-flex items-center justify-center w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-colors font-medium">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                      <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                      <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                      <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Login with Google
                  </a>
                </div>
              </div>

              <div id="register-form" class="space-y-4 hidden">
                <form id="register-form-element" method="POST" action="{{ route('register') }}">
                  @csrf
                  <div>
                    <label for="register-name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input id="register-name" type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  </div>
                  <div>
                    <label for="register-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="register-email" type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  </div>
                  <div>
                    <label for="register-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="register-password" type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  </div>
                  <br>
                  <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors font-medium">Register</button>
                </form>
                <div class="text-center">
                  <a href="{{ route('google.redirect') }}" class="inline-flex items-center justify-center w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-colors font-medium">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                      <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                      <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                      <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Register with Google
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

                {{-- One-per-day warning modal --}}
                <div id="one-day-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-60 hidden">
                    <div class="frosted-card max-w-lg w-full mx-4 p-8">
                        <h3 class="text-lg font-bold text-primary mb-3">Unauthorized Action</h3>
                        <p class="text-muted mb-6">You can not post more than one proposal per day. Please come back tomorrow to share a new idea.</p>
                        <div class="text-right">
                            <button id="one-day-close" class="btn-secondary">Close</button>
                        </div>
                    </div>
                </div>

        <!-- Bottom Navigation -->
        @include('components.bottom-navigation')

        <!-- Theme Detection Script -->
        <script>
            // Automatically detect and apply system theme preference
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                document.body.classList.add('light');
            }

            // Listen for theme changes
            window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', e => {
                if (e.matches) {
                    document.body.classList.add('light');
                } else {
                    document.body.classList.remove('light');
                }
            });
        </script>
    </body>
</html>