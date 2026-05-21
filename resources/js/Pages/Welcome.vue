<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();

const baseUrl = 'https://checkreport.app';
const title = 'CheckLaudo - Relatórios Técnicos e Checklists em Minutos';
const description = 'Crie vistorias simples, preencha modelos de inspeção no local e gere PDFs profissionais. Solução ideal para prestadores de serviço e técnicos em campo.';
const image = `${baseUrl}/og-image.jpg`;
</script>

<template>
    <Head :title="title">
        <!-- Meta Tags -->
        <meta name="description" :content="description" />
        <meta name="keywords" content="checklist, relatório, vistoria, inspeção, técnico, prestador, serviço, PDF" />
        <meta name="robots" content="index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="language" content="pt-BR" />
        <meta name="author" content="CheckLaudo" />
        
        <!-- Canonical -->
        <link rel="canonical" :href="baseUrl" />
        
        <!-- Open Graph -->
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:url" :content="baseUrl" />
        <meta property="og:image" :content="image" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:site_name" content="CheckLaudo" />
        <meta property="og:locale" content="pt_BR" />
        
        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="image" />
        <meta name="twitter:creator" content="@checkreport" />
        
        <!-- Schema.org (JSON-LD) -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SoftwareApplication",
            "name": "CheckLaudo",
            "description": "{{ description }}",
            "url": "{{ baseUrl }}",
            "image": "{{ image }}",
            "applicationCategory": "BusinessApplication",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "BRL"
            },
            "operatingSystem": "Web",
            "screenshot": "{{ image }}"
        }
        </script>
    </Head>

    <PublicLayout>
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-white">
            <div class="absolute inset-y-0 w-full h-full pointer-events-none">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-gradient-to-b from-indigo-50 to-white rounded-full blur-3xl opacity-50"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24 relative z-10">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-sm font-medium mb-8">
                        <span class="flex h-2 w-2 rounded-full bg-indigo-600"></span>
                        A solução ideal para prestadores de serviço
                    </div>
                    
                    <h1 class="text-5xl md:text-7xl font-black tracking-tight text-slate-900 mb-8 leading-tight">
                        Seus relatórios e checklists <br class="hidden md:block"/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">
                            feitos em minutos.
                        </span>
                    </h1>
                    
                    <p class="text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Crie vistorias simples, preencha modelos de inspeção no local e gere PDFs profissionais na hora. Sem burocracia, feito sob medida para quem está em campo.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <Link :href="route('register')" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            Comece Gratuitamente
                        </Link>
                        <Link :href="route('features')" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-slate-700 bg-white border border-slate-200 rounded-full hover:bg-slate-50 hover:border-slate-300 transition-all duration-300">
                            Conheça os Recursos
                        </Link>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Mockup Image -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pb-20">
                <div class="rounded-2xl border border-slate-200/60 bg-white/50 backdrop-blur-sm p-2 md:p-4 shadow-2xl shadow-indigo-900/5">
                    <div class="aspect-[16/9] rounded-xl bg-slate-100 overflow-hidden border border-slate-200 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-200"></div>
                        <!-- Decorative mockup -->
                        <div class="relative w-full h-full flex flex-col">
                            <div class="h-12 border-b border-slate-200 bg-white flex items-center px-4 gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="flex-1 flex p-6 gap-6">
                                <div class="w-64 hidden md:block bg-white rounded-lg border border-slate-200 shadow-sm space-y-4 p-4">
                                    <div class="h-8 bg-slate-100 rounded"></div>
                                    <div class="h-4 bg-slate-100 rounded w-2/3"></div>
                                    <div class="h-4 bg-slate-100 rounded w-1/2"></div>
                                </div>
                                <div class="flex-1 bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                                    <div class="h-10 bg-indigo-50 rounded mb-8 w-1/3"></div>
                                    <div class="space-y-4">
                                        <div class="h-16 bg-slate-50 border border-slate-100 rounded-lg"></div>
                                        <div class="h-16 bg-slate-50 border border-slate-100 rounded-lg"></div>
                                        <div class="h-16 bg-slate-50 border border-slate-100 rounded-lg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Quick Look -->
        <div class="py-24 bg-slate-50 border-t border-slate-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900">Tudo o que você precisa em campo</h2>
                    <p class="mt-4 text-lg text-slate-600">Simples de configurar, rápido de preencher.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6 text-indigo-600">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Modelos Customizáveis</h3>
                        <p class="text-slate-600 leading-relaxed">Crie perguntas de texto, seleções múltiplas, adicione fotos e gere seções para diferentes tipos de vistorias.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-6 text-violet-600">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Evidências Fotográficas</h3>
                        <p class="text-slate-600 leading-relaxed">Anexe fotos diretamente do seu celular durante a inspeção para documentar o estado de equipamentos ou locais.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-6 text-emerald-600">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Relatórios em PDF</h3>
                        <p class="text-slate-600 leading-relaxed">Com um clique, transforme o checklist preenchido em um PDF profissional, pronto para envio ao seu cliente.</p>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
