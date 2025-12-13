<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TurnOver') }} - Gestão de Limpezas Inteligente</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-cloud/30 dark:bg-carbon text-carbon dark:text-cloud font-sans selection:bg-mint selection:text-white">

<nav class="fixed w-full z-50 bg-white/90 dark:bg-carbon/90 backdrop-blur-md border-b border-sage/20 dark:border-pine/30 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex-shrink-0 flex items-center gap-2 group cursor-pointer">
                <div class="p-2 bg-mint/10 group-hover:bg-mint/20 rounded-lg transition-colors">
                    <svg class="w-6 h-6 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <span class="font-bold text-xl tracking-tight text-pine dark:text-white group-hover:text-mint transition-colors">TurnOver</span>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-steel dark:text-sage hover:text-mint transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-pine dark:text-sage hover:text-mint transition-colors">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-pine hover:bg-lagoon text-white rounded-xl text-sm font-bold shadow-lg shadow-pine/20 transition-all transform hover:-translate-y-0.5">
                                Começar Grátis
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-mint/10 border border-mint/20 text-mint text-xs font-semibold uppercase tracking-wider mb-6 animate-pulse-glow">
            🚀 Nova Versão 2.0 Disponível
        </div>

        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-pine dark:text-white mb-8 leading-tight">
            Limpezas de AL <br class="hidden sm:block" />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-mint via-lagoon to-pine animate-pulse">sem dores de cabeça</span>
        </h1>

        <p class="mt-4 text-xl text-steel dark:text-sage max-w-2xl mx-auto mb-12 leading-relaxed">
            A plataforma tudo-em-um para proprietários, empresas e cleaners.
            <span class="font-medium text-pine dark:text-white">Sincronize calendários</span>, automatize escalas e garanta que o seu espaço está sempre
            <span class="underline decoration-gold decoration-4 underline-offset-2">impecável</span>.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('register') }}" class="px-8 py-4 bg-mint hover:bg-lagoon text-white rounded-2xl text-lg font-bold shadow-xl shadow-mint/20 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 group">
                Criar Conta Gratuita
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
            <a href="#features" class="px-8 py-4 bg-white dark:bg-pine/20 border border-sage/30 dark:border-pine/50 text-pine dark:text-cloud rounded-2xl text-lg font-medium hover:border-mint hover:text-mint dark:hover:bg-pine/40 transition-all">
                Ver Funcionalidades
            </a>
        </div>
    </div>

    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none opacity-40 dark:opacity-20">
        <div class="absolute top-20 left-10 w-96 h-96 bg-mint/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-40 right-10 w-80 h-80 bg-gold/20 rounded-full blur-3xl"></div>
        <div class="absolute top-40 right-1/3 w-64 h-64 bg-lagoon/20 rounded-full blur-3xl animate-pulse"></div>
    </div>
</div>

<section id="features" class="py-24 bg-white dark:bg-carbon border-y border-sage/10 dark:border-pine/20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-sm font-bold text-mint uppercase tracking-widest mb-2">Porquê o TurnOver?</h2>
            <h3 class="text-3xl md:text-4xl font-bold text-pine dark:text-white mb-6">Tudo o que precisa num só lugar</h3>
            <p class="text-steel dark:text-sage max-w-2xl mx-auto text-lg">
                Deixe as folhas de cálculo para trás. Centralize a operação do seu AL ou empresa de serviços numa única plataforma intuitiva.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 rounded-3xl bg-cloud/30 dark:bg-pine/10 border border-sage/20 dark:border-pine/30 hover:border-mint/50 hover:bg-white dark:hover:bg-pine/20 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-mint/10 text-mint flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-mint group-hover:text-white transition-all duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-pine dark:text-white mb-3">Agendamento Inteligente</h3>
                <p class="text-steel dark:text-sage leading-relaxed">
                    Sincronize limpezas automaticamente com o check-out. O nosso sistema evita conflitos e garante prontidão.
                </p>
            </div>

            <div class="p-8 rounded-3xl bg-white dark:bg-pine/20 border border-gold/30 dark:border-gold/20 shadow-xl shadow-gold/5 hover:border-gold hover:shadow-gold/10 transition-all duration-300 group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-gold/10 rounded-bl-full -mr-10 -mt-10"></div>
                <div class="w-14 h-14 rounded-2xl bg-gold/10 text-gold flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-gold group-hover:text-white transition-all duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-pine dark:text-white mb-3">Gestão de Equipas</h3>
                <p class="text-steel dark:text-sage leading-relaxed">
                    Atribua tarefas a cleaners específicos. Eles recebem notificações e marcam a conclusão em tempo real.
                </p>
            </div>

            <div class="p-8 rounded-3xl bg-cloud/30 dark:bg-pine/10 border border-sage/20 dark:border-pine/30 hover:border-lagoon/50 hover:bg-white dark:hover:bg-pine/20 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-lagoon/10 text-lagoon flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-lagoon group-hover:text-white transition-all duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-pine dark:text-white mb-3">Multisserviço</h3>
                <p class="text-steel dark:text-sage leading-relaxed">
                    Não apenas para AL. Adaptável para limpeza de escritórios, condomínios e manutenção de edifícios.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="bg-pine dark:bg-black py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#49a078 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-mint/20">
            <div class="p-4">
                <div class="text-4xl font-extrabold text-white mb-2">+500</div>
                <div class="text-sm font-medium text-sage uppercase tracking-wider">Alojamentos</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-extrabold text-gold mb-2">98%</div>
                <div class="text-sm font-medium text-sage uppercase tracking-wider">Pontualidade</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-extrabold text-mint mb-2">24/7</div>
                <div class="text-sm font-medium text-sage uppercase tracking-wider">Suporte</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-extrabold text-white mb-2">+10k</div>
                <div class="text-sm font-medium text-sage uppercase tracking-wider">Limpezas</div>
            </div>
        </div>
    </div>
</div>

<div class="py-24 bg-cloud/50 dark:bg-carbon">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-pine dark:text-white mb-6">Pronto para otimizar a sua operação?</h2>
        <p class="text-lg text-steel dark:text-sage mb-10 max-w-2xl mx-auto">
            Junte-se a centenas de gestores que poupam tempo e dinheiro com o TurnOver. A configuração demora menos de 2 minutos.
        </p>
        <a href="{{ route('register') }}" class="inline-flex items-center px-10 py-5 bg-pine hover:bg-lagoon text-white dark:bg-white dark:text-pine dark:hover:bg-mint dark:hover:text-white rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            Começar Agora
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
</div>

<footer class="bg-white dark:bg-carbon border-t border-sage/20 dark:border-pine/30 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-8">
            <div class="flex items-center gap-2">
                <div class="p-2 bg-pine/10 dark:bg-white/10 rounded-lg">
                    <svg class="w-6 h-6 text-pine dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <span class="font-bold text-xl text-pine dark:text-white">TurnOver</span>
            </div>

            <div class="flex gap-8 text-sm font-medium">
                <a href="/terms-of-service" class="text-steel hover:text-mint dark:text-sage dark:hover:text-white transition-colors">Termos e Condições</a>
                <a href="/privacy-policy" class="text-steel hover:text-mint dark:text-sage dark:hover:text-white transition-colors">Política de Privacidade</a>
                <a href="mailto:suporte@turnover.pt" class="text-steel hover:text-mint dark:text-sage dark:hover:text-white transition-colors">Suporte</a>
            </div>
        </div>

        <div class="border-t border-sage/10 dark:border-pine/20 pt-8 text-center md:text-left">
            <p class="text-sm text-steel/60 dark:text-sage/50">
                {{ date('Y') }} &copy; TurnOver. Todos os direitos reservados.<br />
                Dos Açores para o Mundo.
            </p>
        </div>
    </div>
</footer>
</body>
</html>
