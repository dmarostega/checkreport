<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-slate-50 text-slate-900 font-sans selection:bg-indigo-500 selection:text-white">
        <!-- Navigation -->
        <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-2">
                        <Link href="/" class="text-2xl font-black tracking-tighter text-indigo-600 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/30">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            CheckLaudo
                        </Link>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <Link :href="route('features')" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Recursos</Link>
                        <Link :href="route('pricing')" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Preços</Link>
                        <Link :href="route('login')" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Entrar</Link>
                        <Link :href="route('register')" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-full hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                            Começar Grátis
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="pt-20">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <Link href="/" class="text-xl font-bold text-slate-900 flex items-center gap-2 mb-4">
                            CheckLaudo
                        </Link>
                        <p class="text-slate-500 text-sm max-w-sm">
                            A ferramenta definitiva para prestadores de serviços. Crie checklists, preencha vistorias simples e gere relatórios operacionais não regulados com agilidade e organização.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900 tracking-wider uppercase mb-4">Produto</h3>
                        <ul class="space-y-3">
                            <li><Link :href="route('features')" class="text-sm text-slate-500 hover:text-indigo-600 transition-colors">Recursos</Link></li>
                            <li><Link :href="route('pricing')" class="text-sm text-slate-500 hover:text-indigo-600 transition-colors">Preços</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900 tracking-wider uppercase mb-4">Legal</h3>
                        <ul class="space-y-3">
                            <li><Link :href="route('terms')" class="text-sm text-slate-500 hover:text-indigo-600 transition-colors">Termos de Uso</Link></li>
                            <li><Link :href="route('privacy')" class="text-sm text-slate-500 hover:text-indigo-600 transition-colors">Privacidade</Link></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-slate-400">
                        &copy; {{ new Date().getFullYear() }} CheckLaudo. Todos os direitos reservados.
                    </p>
                    <p class="text-xs text-slate-400">
                        Atenção: O sistema é apenas uma ferramenta de registro. A responsabilidade técnica é exclusiva do profissional.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
