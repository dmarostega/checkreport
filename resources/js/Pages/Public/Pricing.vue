<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

const baseUrl = 'https://checkreport.app';
const title = 'Preços e Planos - CheckLaudo';
const description = 'Conheça nossos planos de preços: Gratuito, Pro e Plus. Escolha o plano que melhor se adequa ao seu negócio de vistorias e relatórios técnicos.';
const image = `${baseUrl}/og-pricing.jpg`;
</script>

<template>
    <Head :title="title">
        <!-- Meta Tags -->
        <meta name="description" :content="description" />
        <meta name="keywords" content="preços, planos, checklist, relatório, gratuito, pro, plus" />
        <meta name="robots" content="index, follow" />
        
        <!-- Canonical -->
        <link rel="canonical" :href="`${baseUrl}/precos`" />
        
        <!-- Open Graph -->
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:url" :content="`${baseUrl}/precos`" />
        <meta property="og:image" :content="image" />
        
        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="image" />
    </Head>

    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">Planos que acompanham o <span class="text-indigo-600">seu crescimento.</span></h1>
                <p class="text-xl text-slate-600">Comece de graça e faça o upgrade apenas quando precisar expandir suas vistorias e relatórios.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Free Plan -->
                <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-md transition-shadow relative">
                    <h3 class="text-xl font-bold text-slate-900">Gratuito</h3>
                    <p class="text-slate-500 text-sm mt-2">Para experimentar ou para uso eventual.</p>
                    <div class="my-6">
                        <span class="text-4xl font-black text-slate-900">R$0</span>
                        <span class="text-slate-500">/mês</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-slate-600">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Até 3 Modelos de Checklist
                        </li>
                        <li class="flex items-center gap-3 text-slate-600">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Até 10 relatórios por mês
                        </li>
                        <li class="flex items-center gap-3 text-slate-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            Sem exportação de PDF
                        </li>
                    </ul>
                    <Link :href="route('register')" class="block w-full py-3 px-4 text-center text-sm font-semibold text-indigo-600 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition-colors">
                        Começar Grátis
                    </Link>
                </div>

                <!-- Pro Plan -->
                <div class="bg-slate-900 rounded-3xl border border-slate-800 p-8 shadow-xl relative transform md:-translate-y-4">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        <span class="bg-gradient-to-r from-indigo-500 to-violet-500 text-white text-xs font-bold uppercase tracking-wider py-1 px-3 rounded-full">Recomendado</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Pro</h3>
                    <p class="text-slate-400 text-sm mt-2">Para profissionais ativos em campo.</p>
                    <div class="my-6">
                        <span class="text-4xl font-black text-white">R$49</span>
                        <span class="text-slate-400">/mês</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-slate-300">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Modelos Ilimitados
                        </li>
                        <li class="flex items-center gap-3 text-slate-300">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Até 200 relatórios por mês
                        </li>
                        <li class="flex items-center gap-3 text-slate-300">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Exportação de PDF & Fotos
                        </li>
                    </ul>
                    <Link :href="route('register')" class="block w-full py-3 px-4 text-center text-sm font-semibold text-white bg-indigo-500 rounded-xl hover:bg-indigo-600 transition-colors">
                        Assinar o Pro
                    </Link>
                </div>

                <!-- Plus Plan -->
                <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-md transition-shadow relative">
                    <h3 class="text-xl font-bold text-slate-900">Plus</h3>
                    <p class="text-slate-500 text-sm mt-2">Para pequenas empresas e equipes.</p>
                    <div class="my-6">
                        <span class="text-4xl font-black text-slate-900">R$99</span>
                        <span class="text-slate-500">/mês</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-slate-600">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Relatórios Ilimitados
                        </li>
                        <li class="flex items-center gap-3 text-slate-600">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Personalização Visual
                        </li>
                        <li class="flex items-center gap-3 text-slate-600">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Templates Avançados
                        </li>
                    </ul>
                    <Link :href="route('register')" class="block w-full py-3 px-4 text-center text-sm font-semibold text-indigo-600 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition-colors">
                        Assinar o Plus
                    </Link>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
